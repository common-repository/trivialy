<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Include the database class file

require_once( TRVL_PLUGIN_PATH . 'netro-trivaly-database.php' );


add_action('rest_api_init', function () {
    // Register REST API endpoint for saving quiz data
    register_rest_route('custom/v1', '/save-scratch-quiz-data', array(
        'methods' => 'POST',
        'callback' => 'trvl_add_scratch_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

     // Register REST API endpoint for getting all quiz data
     register_rest_route('custom/v1', '/get-all-scratch-quiz-data', array(
        'methods' => 'GET',
        'callback' => 'trvl_fetch_all_scratch_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

    // Register REST API endpoint for getting single quiz data by ID
    register_rest_route('custom/v1', '/get-scratch-quiz-data/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'trvl_fetch_scratch_quiz_data_by_id',
        'permission_callback' => '__return_true',
    ));

    // Register REST API endpoint for Deleting single quiz data by ID
    register_rest_route('custom/v1', '/delete-scratch-quiz-data/(?P<id>\d+)', array(
        'methods' => 'DELETE',
        'callback' => 'trvl_delete_scratch_quiz_data_by_id',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));


    // Register REST API endpoint for updating single quiz data by ID
    register_rest_route('custom/v1', '/update-scratch-quiz-data/(?P<id>\d+)', array(
        'methods' => 'POST',
        'callback' => 'trvl_up_scratch_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

    register_rest_route('custom/v1', '/delete-bulk-scratch-quiz-data', array(
        'methods' => 'POST',
        'callback' => 'trvl_delete_bulk_scratch_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));
});

// Callback function for saving quiz data
function trvl_add_scratch_quiz_data(WP_REST_Request $request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'scratch_quiz';

    $data = $request->get_json_params();


    function check_and_replace_empty($value) {
        return $value !== '' ? $value : 'N/A';
    }

    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
    $wpdb->insert(
        $table_name,
        array(
            'select_number' => sanitize_text_field($data['select_number']),
            'live_status' => intval($data['live_status']),
            'popup_time' => sanitize_text_field($data['popup_time']),
            'campaign_time' => sanitize_text_field($data['campaign_time']),
            'time' => sanitize_text_field($data['time']),
            'link' => esc_url($data['link']),
            'title' => sanitize_text_field($data['title']),

            'reward_one' => sanitize_text_field($data['reward']['reward_one']),
            'reward_two' => sanitize_text_field($data['reward']['reward_two']),
            'reward_three' => sanitize_text_field($data['reward']['reward_three']),
            'reward_four' => sanitize_text_field($data['reward']['reward_four']),
            'reward_five' => sanitize_text_field($data['reward']['reward_five']),
            'reward_six' => sanitize_text_field($data['reward']['reward_six']),
            'reward_seven' => sanitize_text_field($data['reward']['reward_seven']),
            'reward_eight' => sanitize_text_field($data['reward']['reward_eight']),
            'reward_nine' => sanitize_text_field($data['reward']['reward_nine']),
            'reward_ten' => sanitize_text_field($data['reward']['reward_ten']),
            
            'coupon_one' => sanitize_text_field($data['coupon']['coupon_one']),
            'coupon_two' => sanitize_text_field($data['coupon']['coupon_two']),
            'coupon_three' => sanitize_text_field($data['coupon']['coupon_three']),
            'coupon_four' => sanitize_text_field($data['coupon']['coupon_four']),
            'coupon_five' => sanitize_text_field($data['coupon']['coupon_five']),
            'coupon_six' => sanitize_text_field($data['coupon']['coupon_six']),
            'coupon_seven' => sanitize_text_field($data['coupon']['coupon_seven']),
            'coupon_eight' => sanitize_text_field($data['coupon']['coupon_eight']),
            'coupon_nine' => sanitize_text_field($data['coupon']['coupon_nine']),
            'coupon_ten' => sanitize_text_field($data['coupon']['coupon_ten']),

        )
    ); 


    return new WP_REST_Response(array('success' => true), 201);
}

function trvl_fetch_all_scratch_quiz_data(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'scratch_quiz';

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

     // Attempt to retrieve data from cache
     $cache_key = 'all_scratch_quiz_data';
     $cached_data = wp_cache_get($cache_key, 'quiz_data');
 
     if ($cached_data === false) {
         // If data is not found in cache, fetch it from database
         $data = $wpdb->get_results("SELECT * FROM {$wpdb->my_table}", ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
 
         // Cache the data for future use
         if ($data) {
             wp_cache_set($cache_key, $data, 'quiz_data');
         }
     } else {
         // Use cached data if available
         $data = $cached_data;
     }

    return new WP_REST_Response($data, 200); 
}

function trvl_fetch_scratch_quiz_data_by_id($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'scratch_quiz';

    $id = $request['id'];

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

     // Define the cache key based on the requested ID
     $cache_key = 'scratch_quiz_data_' . $id;

     // Attempt to retrieve data from cache
     $cached_data = wp_cache_get($cache_key, 'quiz_data');
 
     if ($cached_data === false) {
         // If data is not found in cache, fetch it from the database
         $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->my_table} WHERE id = %d", $id), ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
 
         if ($data) {
             // Cache the data for future use
             wp_cache_set($cache_key, $data, 'quiz_data');
         }
     } else {
         // Use cached data if available
         $data = $cached_data;
     }

    if ($data) {
        return new WP_REST_Response($data, 200);
    } else {
        return new WP_REST_Response(array('error' => 'Data not found'), 404);
    }
}


function trvl_up_scratch_quiz_data(WP_REST_Request $request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'scratch_quiz';
    $id = $request['id'];
    
    $data = $request->get_json_params();

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    // Check if the quiz exists using cached result
    $cache_key = 'scratch_quiz_exists_' . $id;
    $existing_quiz = wp_cache_get($cache_key, 'quiz_exists');

    if (false === $existing_quiz) {
        // If not cached, query from database
        $existing_quiz = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->my_table} WHERE id = %d", $id), ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

        // Cache the result
        wp_cache_set($cache_key, $existing_quiz, 'quiz_exists');
    }

    if (!$existing_quiz) {
        return new WP_REST_Response(array('error' => 'Quiz not found'), 404);
    }

    function check_and_replace_empty($value) {
        return $value !== '' ? $value : 'N/A';
    }

    // Update the quiz data
    $updated_data = array(
        'select_number' => sanitize_text_field($data['select_number']),
        'live_status' => intval($data['live_status']),
        'popup_time' => sanitize_text_field($data['popup_time']),
        'campaign_time' => sanitize_text_field($data['campaign_time']),
        'time' => sanitize_text_field($data['time']),
        'link' => esc_url($data['link']),
        'title' => sanitize_text_field($data['title']),

        'reward_one' => sanitize_text_field($data['reward']['reward_one']),
        'reward_two' => sanitize_text_field($data['reward']['reward_two']),
        'reward_three' => sanitize_text_field($data['reward']['reward_three']),
        'reward_four' => sanitize_text_field($data['reward']['reward_four']),
        'reward_five' => sanitize_text_field($data['reward']['reward_five']),
        'reward_six' => sanitize_text_field($data['reward']['reward_six']),
        'reward_seven' => sanitize_text_field($data['reward']['reward_seven']),
        'reward_eight' => sanitize_text_field($data['reward']['reward_eight']),
        'reward_nine' => sanitize_text_field($data['reward']['reward_nine']),
        'reward_ten' => sanitize_text_field($data['reward']['reward_ten']),
        
        'coupon_one' => sanitize_text_field($data['coupon']['coupon_one']),
        'coupon_two' => sanitize_text_field($data['coupon']['coupon_two']),
        'coupon_three' => sanitize_text_field($data['coupon']['coupon_three']),
        'coupon_four' => sanitize_text_field($data['coupon']['coupon_four']),
        'coupon_five' => sanitize_text_field($data['coupon']['coupon_five']),
        'coupon_six' => sanitize_text_field($data['coupon']['coupon_six']),
        'coupon_seven' => sanitize_text_field($data['coupon']['coupon_seven']),
        'coupon_eight' => sanitize_text_field($data['coupon']['coupon_eight']),
        'coupon_nine' => sanitize_text_field($data['coupon']['coupon_nine']),
        'coupon_ten' => sanitize_text_field($data['coupon']['coupon_ten']),
        
    );

    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
    $wpdb->update(
        $table_name,
        $updated_data,
        array('id' => $id),
        array('%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'),
        array('%d')
    ); 

    // Clear cache for the updated quiz data
    $cache_key = 'scratch_quiz_data_' . $id;
    wp_cache_delete($cache_key, 'quiz_data');

    return new WP_REST_Response(array('success' => true), 200);
}

function trvl_delete_scratch_quiz_data_by_id($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'scratch_quiz';


    $id = $request['id'];
    $result = $wpdb->delete($table_name, array('id' => $id), array('%d')); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

    if ($result) {
         // Clear cache for the deleted item
         $cache_key = 'scratch_quiz_data_' . $id;
         wp_cache_delete($cache_key, 'quiz_data');

        return new WP_REST_Response(array('success' => true), 200);
    } else {
        return new WP_REST_Response(array('error' => 'Failed to delete data'), 500);
    }
}

function trvl_delete_bulk_scratch_quiz_data(WP_REST_Request $request){
    global $wpdb;

    $table_name = $wpdb->prefix . 'scratch_quiz';

    $data = $request->get_json_params();
    $ids = $data['ids'];

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    if (!empty($ids)) {
         // Check if results are in cache
        $id_s = array_map('absint', wp_parse_id_list( $ids ) );
        $ids_str = implode( ',', $id_s );

         $cache_key = 'delete_bulk_scratch_quiz_data_' . $ids_str; // Unique cache key
         $results = wp_cache_get($cache_key, 'my_plugin_group');
        // Construct and execute the DELETE query
        if ($results === false) {
            // Results not found in cache, perform DB operation
            foreach($ids as $id){
                $id = intval($id);
                // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
                $wpdb->query(
                    $wpdb->prepare(
                        "DELETE FROM {$wpdb->my_table} WHERE id=%d", $id
                    )
                ); 
            }

            // Check for successful deletion
            if ($wpdb->last_error === '') {
                // Successfully deleted
                $response = array('success' => true, 'message' => 'Rows deleted successfully.');
            } else {
                // Failed to delete
                $response = array('success' => false, 'message' => 'Error deleting rows.');
            }

            // Cache the results for 1 hour (adjust time as needed)
            wp_cache_set($cache_key, $response, 'my_plugin_group', HOUR_IN_SECONDS); // Cache for 1 hour
        } else {
            // Results found in cache
            $response = $results;
        }
    } else {
        // No IDs provided
        $response = array('success' => false, 'message' => 'No IDs provided for deletion.');
    }

    // Send the response
    wp_send_json($response);
}
?>
