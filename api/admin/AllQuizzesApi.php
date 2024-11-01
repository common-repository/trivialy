<?php
if ( ! defined( 'ABSPATH' ) ) exit;

require_once( TRVL_PLUGIN_PATH . 'netro-trivaly-database.php' );

// Register REST API endpoint for saving quiz data
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/all-quizzes-list', array(
        'methods' => 'GET',
        'callback' => 'trvl_all_quizzes_list',
        'permission_callback' => '__return_true',
    ));

    register_rest_route('custom/v1', '/change-status', array(
        'methods' => 'POST',
        'callback' => 'trvl_change_status',
        'permission_callback' => '__return_true',
    ));

    register_rest_route('custom/v1', '/bulk-delete-quizzes-list', array(
        'methods' => 'POST',
        'callback' => 'trvl_bulk_delete_quizzes_list',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

    register_rest_route('custom/v1', '/delete-quizzes-list/(?P<id>\d+)', array(
        'methods' => 'POST',
        'callback' => 'trvl_delete_quizzes_list',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

    
});

function trvl_change_status(WP_REST_Request $request) {
    global $wpdb;

    $data = $request->get_json_params();
    
    $table = isset($data['table']) ? sanitize_text_field($data['table']) : '';
    $id = isset($data['id']) ? absint($data['id']) : 0;
    
    if (empty($table) || empty($id)) {
        return new WP_Error('invalid_data', 'Invalid table or ID provided.', array('status' => 400));
    }

    $data_to_update = array(
        'live_status' => 3, // Set the desired status value
    );

    $where = array(
        'ID' => $id,
    );

      // Escape the table name using $wpdb->prepare() to prevent SQL injection
    // $table_escaped = $wpdb->prepare("%s", $table);

    
    $result = $wpdb->update($table, $data_to_update, $where);  // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

     // Check if the update was successful
    if ($result === false) {
        return new WP_Error('update_failed', 'Failed to update live_status.', array('status' => 500));
    }

    $cache_key = 'all_quizzes_list';
    wp_cache_delete($cache_key);
 
     // Return a success response
     return new WP_REST_Response(array('message' => 'Live status updated successfully.'), 200);

}



// Callback function for saving quiz data
function trvl_all_quizzes_list(WP_REST_Request $request) {
    global $wpdb;

    $cache_key = 'all_quizzes_list';
    $cached_quizzes = wp_cache_get($cache_key);

    $custom_quiz_table = $wpdb->prefix . 'custom_quiz';
    $quiz_table = $wpdb->prefix . 'quiz';
    $image_quiz_table = $wpdb->prefix . 'image_quiz';


    if ($cached_quizzes === false) {
        $custom_quiz_table = esc_sql($custom_quiz_table);
        $wpdb->custom_quiz_table =  $custom_quiz_table;
        // Fetch data from the custom_quiz table
        $custom_quizzes = $wpdb->get_results("SELECT id, quiz_type, quiz_title, live_status, question_number, time, 'Custom Quiz' AS quizType FROM {$wpdb->custom_quiz_table}"); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

        $quiz_table = esc_sql($quiz_table);
        $wpdb->quiz_table =  $quiz_table;
        // Fetch data from the quiz table
        $quizzes = $wpdb->get_results("SELECT id, quiz_type, quiz_title, live_status, question_number, time, 'Text Quiz' AS quizType FROM {$wpdb->quiz_table}"); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

        $image_quiz_table = esc_sql($image_quiz_table);
        $wpdb->image_quiz_table =  $image_quiz_table;
        // Fetch data from the image_quiz table
        $image_quizzes = $wpdb->get_results("SELECT id, quiz_type, quiz_title, live_status, question_number, time, 'Image Quiz' AS quizType FROM {$wpdb->image_quiz_table}"); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

        // Merge the data from all tables
        $all_quizzes = array_merge($custom_quizzes, $quizzes, $image_quizzes);

        // Create a new array with the required fields
        $result = array_map(function ($quiz) {
            $formatted_time = date_i18n('Y-m-d H:i:s', strtotime($quiz->time));
            return array(
                'id' => (int) $quiz->id,
                'quiz_type' => sanitize_text_field($quiz->quiz_type),
                'quiz_title' => sanitize_text_field($quiz->quiz_title),
                'live_status' => (int) $quiz->live_status,
                'question_number' => (int) $quiz->question_number,
                'time' => $formatted_time,
            );
        }, $all_quizzes);
        
        wp_cache_set($cache_key, $cached_quizzes, '', 3600);
    }

    return rest_ensure_response($result);

}

function trvl_delete_quizzes_list(WP_REST_Request $request){
    global $wpdb;

    $id = absint($request['id']);
    $data = $request->get_json_params();

    $quizType = isset($data['quiz_type']) ? sanitize_text_field($data['quiz_type']) : '';


    // Delete based on quiz_type
    switch ($quizType) {
        case 'custom_quiz':
            $table = $wpdb->prefix . 'custom_quiz';
            $wpdb->delete($table, array('id' => $id)); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
            break;
        case 'text_quiz':
            $table = $wpdb->prefix . 'quiz';
            $wpdb->delete($table, array('id' => $id)); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
            break;
        case 'image_quiz':
            $table = $wpdb->prefix . 'image_quiz';
            $wpdb->delete($table, array('id' => $id)); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
            break;
        default:
            return new WP_Error('invalid_quiz_type', 'Invalid quiz type specified.', array('status' => 400));
        // Add more cases if needed for other quiz types
    }

      // Clear the relevant cache
      $cache_key = 'all_quizzes_list';
      wp_cache_delete($cache_key);

    return new WP_REST_Response(array('success' => true), 200);
}

function trvl_bulk_delete_quizzes_list(WP_REST_Request $request){
    global $wpdb;

    $data = $request->get_json_params();

    if (!isset($data['ids']) || !is_array($data['ids'])) {
        return new WP_Error('invalid_data', 'Invalid or missing IDs array.', array('status' => 400));
    }

    // var_dump($data['ids']);
    foreach ($data['ids'] as $item) {
        $id = isset($item['id']) ? absint($item['id']) : 0;
        $quizType = isset($item['quiz_type']) ? sanitize_text_field($item['quiz_type']) : '';

        if (empty($quizType) || empty($id)) {
            continue; // Skip this iteration if data is invalid
        }

        // Delete based on quiz_type
        switch ($quizType) {
            case 'custom_quiz':
                $table = $wpdb->prefix . 'custom_quiz';
                $wpdb->delete($table, array('id' => $id)); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
                break;
            case 'text_quiz':
                $table = $wpdb->prefix . 'quiz';
                $wpdb->delete($table, array('id' => $id)); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
                break;
            case 'image_quiz':
                $table = $wpdb->prefix . 'image_quiz';
                $wpdb->delete($table, array('id' => $id)); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
                break;
            // Add more cases if needed for other quiz types
        }
    }

    $cache_key = 'all_quizzes_list';
    wp_cache_delete($cache_key);

    return new WP_REST_Response(array('success' => true), 200);
}




?>
