<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Include the database class file

require_once( TRVL_PLUGIN_PATH . 'netro-trivaly-database.php' );

// Register REST API endpoint for saving quiz data
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/save-quiz-data', array(
        'methods' => 'POST',
        'callback' => 'trvl_add_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

    register_rest_route('custom/v1', '/get-quiz-data/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'trvl_fetch_quiz_data_by_id',
        'permission_callback' => '__return_true',
    ));

    register_rest_route('custom/v1', '/update-quiz-data/(?P<id>\d+)', array(
        'methods' => 'POST',
        'callback' => 'trvl_up_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));
});



// Callback function for saving quiz data
function trvl_add_quiz_data(WP_REST_Request $request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'quiz';

    $data = $request->get_json_params();

    if(empty($data['quiz_title']) || empty($data['campaign_time']) || empty($data['popup_time'] || empty($data['quiz_location'] || empty($data['quiz_category']) || empty($data['quiz_hardness']) || $data['quiz_type'] ))){
        return new WP_REST_Response(array('error' => true), 400);
    }

    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
    $wpdb->insert(
        $table_name,
        array(
            'quiz_title' => sanitize_text_field($data['quiz_title']),
            'campaign_time' => sanitize_text_field($data['campaign_time']),
            'popup_time' => sanitize_text_field($data['popup_time']),
            'quiz_location' => sanitize_text_field($data['quiz_location']),
            'quiz_category' => sanitize_text_field($data['quiz_category']),
            'quiz_hardness' => sanitize_text_field($data['quiz_hardness']),
            'reward' => wp_json_encode(array_map('sanitize_text_field', $data['reward'])),
            'reward_message' => wp_json_encode(array_map('sanitize_text_field', $data['reward_message'])),
            'question_number' => intval($data['question_number']),
            'quiz_type' => sanitize_text_field($data['quiz_type']),
            'live_status' => intval($data['live_status']),
            'time' => sanitize_text_field($data['time']),
            'link' => esc_url($data['link']),
        )
    ); 


    return new WP_REST_Response(array('success' => true), 200);
}


function trvl_fetch_quiz_data_by_id($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'quiz';

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    $id = $request['id'];

    // Define a cache key unique to the quiz data based on ID
    $cache_key = 'quiz_data_' . $id;
    $cached_data = wp_cache_get($cache_key, 'quiz_data');

    if ($cached_data === false) {
        // Cache miss: data not found in cache, fetch from database
        $table_name = esc_sql($table_name);
        $wpdb->my_table =  $table_name;

        // Retrieve data from database 
        $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->my_table} WHERE id = %d", $id), ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

        if ($data) {
            // Cache the data for future requests
            wp_cache_set($cache_key, $data, 'quiz_data', 3600); // Cache for 1 hour (adjust TTL as needed)

            // Return the data as WP_REST_Response
            return new WP_REST_Response($data, 200);
        } else {
            // Data not found in database
            return new WP_REST_Response(array('error' => 'Data not found'), 404);
        }
    } else {
        // Cache hit: return cached data
        return new WP_REST_Response($cached_data, 200);
    }
}

function trvl_up_quiz_data(WP_REST_Request $request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'quiz';
    $id = $request['id'];
    $data = $request->get_json_params();

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    $cached_data = wp_cache_get('quiz_data_' . $id, 'quiz_data');

     if ($cached_data === false) {
         // Data not found in cache, fetch from database
         $existing_quiz = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->my_table} WHERE id = %d", $id), ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
 
         if (!$existing_quiz) {
             return new WP_REST_Response(array('error' => 'Quiz not found'), 404);
         }
 
         // Cache the fetched data
         wp_cache_set('quiz_data_' . $id, $existing_quiz, 'quiz_data');
     } else {
         // Data found in cache, use cached data
         $existing_quiz = $cached_data;
     }

 

    // Update the quiz data
    $updated_data = array(
        'quiz_title' => sanitize_text_field($data['quiz_title']),
        'campaign_time' => sanitize_text_field($data['campaign_time']),
        'popup_time' => sanitize_text_field($data['popup_time']),
        'reward' => wp_json_encode(array_map('sanitize_text_field', $data['reward'])),
        'live_status' => intval($data['live_status']),
        'reward_message' => wp_json_encode(array_map('sanitize_text_field', $data['reward_message'])),
        'time' => sanitize_text_field($data['time']),
        'link' => esc_url($data['link']),
    );

    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
    $wpdb->update(
        $table_name,
        $updated_data,
        array('id' => $id),
        array('%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s'),
        array('%d')
    ); 

    // Clear cache for the updated quiz
    wp_cache_delete('quiz_data_' . $id, 'quiz_data');

    return new WP_REST_Response(array('success' => true), 200);
}
?>
