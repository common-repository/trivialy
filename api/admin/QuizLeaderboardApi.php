<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Include the database class file

require_once( TRVL_PLUGIN_PATH . 'netro-trivaly-database.php' );


add_action('rest_api_init', function () {
    // Register REST API endpoint for saving quiz data
    register_rest_route('custom/v1', '/save-quiz-leaderboard-data', array(
        'methods' => 'POST',
        'callback' => 'trvl_add_quiz_leaderboard_data',
        'permission_callback' => '__return_true',
    ));

    // Register REST API endpoint for getting all quiz data
    register_rest_route('custom/v1', '/get-all-quiz-leaderboard-data', array(
        'methods' => 'GET',
        'callback' => 'trvl_fetch_all_quiz_leaderboard_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

    register_rest_route('custom/v1', '/get-all-quiz-leaderboard-sorted-data', array(
        'methods' => 'POST',
        'callback' => 'trvl_fetch_all_quiz_leaderboard_sorted_data',
        'permission_callback' => '__return_true',
    ));

   

   
});



// Callback function for saving quiz data
function trvl_add_quiz_leaderboard_data(WP_REST_Request $request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'quiz_leaderboard';

    $data = $request->get_json_params();

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
    $wpdb->insert(
        $table_name,
        array(
            'user_name' => sanitize_text_field($data['user_name']),
            'user_email' => sanitize_email($data['user_email']),
            'spent_time' => sanitize_text_field($data['spent_time']),
            'won_reward' => sanitize_text_field($data['won_reward']),
            'quiz_type' => sanitize_text_field($data['quiz_type']),
            'right_ans' => sanitize_text_field($data['right_ans']),
        )
    ); 

    $inserted_id = (int) $wpdb->insert_id;

    if ($inserted_id) {
        $cached_data = wp_cache_get('quiz_leaderboard_data_' . $inserted_id, 'quiz_leaderboard');
        // Fetch the inserted data
        if ($cached_data === false) {
            // Data not found in cache, fetch from database
            $inserted_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->my_table} WHERE id = %d", $inserted_id), ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

            // Cache the fetched data
            if ($inserted_data) {
                wp_cache_set('quiz_leaderboard_data_' . $inserted_id, $inserted_data, 'quiz_leaderboard');
            }
        } else {
            $inserted_data = $cached_data;
        }

        
        // Return success along with the inserted data
        return new WP_REST_Response(array('success' => true, 'data' => $inserted_data), 200);
    } else {
        // Return an error response if insertion fails
        return new WP_REST_Response(array('success' => false, 'message' => 'Failed to save data'), 500);
    }
    
      
}


function trvl_fetch_all_quiz_leaderboard_data() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'quiz_leaderboard';

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    $cache_key = 'all_quiz_leaderboard_data';
    $data = wp_cache_get($cache_key, 'quiz_leaderboard');

    if ($data === false) {
        // If data is not found in cache, fetch it from database
        $data = $wpdb->get_results("SELECT * FROM {$wpdb->my_table} ORDER BY CAST(spent_time AS SIGNED) ASC", ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

        // Cache the data for future requests
        if ($data) {
            wp_cache_set($cache_key, $data, 'quiz_leaderboard');
        }
    }

    return new WP_REST_Response($data, 200);
}

function trvl_fetch_all_quiz_leaderboard_sorted_data(WP_REST_Request $request){

    global $wpdb;

    $table_name = $wpdb->prefix . 'quiz_leaderboard';

    $data = $request->get_json_params();

    $id = isset($request['id']) ? absint($request['id']) : 0;

    
    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

     // Attempt to retrieve sorted data from cache
     $cache_key = 'all_quiz_leaderboard_sorted_data';
     $sortedData = wp_cache_get($cache_key, 'quiz_leaderboard');
    
     if ($sortedData === false) {
        // If data is not found in cache, fetch it from database and sort
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
        $sortedData = $wpdb->get_results("
            SELECT *,
            ROW_NUMBER() OVER (ORDER BY CAST(won_reward AS SIGNED) DESC, CAST(spent_time AS SIGNED) ASC) AS rank
            FROM {$wpdb->my_table}
            ORDER BY rank ASC;
        ", ARRAY_A); 

        // Cache the sorted data
        if ($sortedData) {
            wp_cache_set($cache_key, $sortedData, 'quiz_leaderboard');
        }
    }

    $matchedRow = null;

    // return new WP_REST_Response($sortedData, 200);
    // Find the row with the specified id
    foreach ($sortedData as $row) {
        
        if ($row['id'] == $id) {
            $matchedRow = $row;
            break; // Break the loop once a match is found
        }
    }

    $first5Rows = array_slice($sortedData, 0, 5);

    // Add $matchedRow to $first5Rows
    if ($matchedRow !== null) {
        $first5Rows[] = $matchedRow;
    }


    return new WP_REST_Response($first5Rows, 200);

}


?>
