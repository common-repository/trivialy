<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Include the database class file

require_once( TRVL_PLUGIN_PATH . 'netro-trivaly-database.php' );


add_action('rest_api_init', function () {
    // Register REST API endpoint for saving quiz data
    register_rest_route('custom/v1', '/save-drag-leaderboard-data', array(
        'methods' => 'POST',
        'callback' => 'trvl_add_drag_leaderboard_data',
        'permission_callback' => '__return_true',
    ));

    // Register REST API endpoint for getting all quiz data
    register_rest_route('custom/v1', '/get-all-drag-leaderboard-data', array(
        'methods' => 'GET',
        'callback' => 'trvl_fetch_all_drag_leaderboard_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));


    register_rest_route('custom/v1', '/get-all-drag-leaderboard-sorted-data', array(
        'methods' => 'POST',
        'callback' => 'trvl_fetch_all_drag_leaderboard_sorted_data',
        'permission_callback' => '__return_true',
    ));

   

   
});



// Callback function for saving quiz data
function trvl_add_drag_leaderboard_data(WP_REST_Request $request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'drag_leaderboard';

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    $data = $request->get_json_params();

     // Sanitize and validate the input data
     $user_name = sanitize_text_field($data['user_name']);
     $user_email = sanitize_email($data['user_email']);
     $spent_time = sanitize_text_field($data['spent_time']);
     $won_reward = sanitize_text_field($data['won_reward']);
 
     if (empty($user_name) || !is_email($user_email) || empty($spent_time) || empty($won_reward)) {
         return new WP_REST_Response(array('success' => false, 'message' => 'Invalid input data'), 400);
     }

     // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
    $wpdb->insert(
        $table_name,
        array(
            'user_name' => $user_name,
            'user_email' => $user_email,
            'spent_time' => $spent_time,
            'won_reward' => $won_reward,
        ),
        array('%s', '%s', '%s', '%s')
    ); 

    $inserted_id = (int) $wpdb->insert_id;

    if ($inserted_id) {
        // Fetch the inserted data
        $cached_data = wp_cache_get('drag_leaderboard_data_' . $inserted_id, 'leaderboard_data');

        if ($cached_data === false) {
            // Data not found in cache, fetch from database
            $inserted_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->my_table} WHERE id = %d", $inserted_id), ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

            // Cache the fetched data
            if ($inserted_data) {
                wp_cache_set('drag_leaderboard_data_' . $inserted_id, $inserted_data, 'leaderboard_data');
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


function trvl_fetch_all_drag_leaderboard_data() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'drag_leaderboard';

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    // Attempt to retrieve data from cache
    $cached_data = wp_cache_get('all_drag_leaderboard_data', 'leaderboard_data');

    if ($cached_data === false) {
        // Data not found in cache, fetch from database
        $data = $wpdb->get_results("SELECT * FROM {$wpdb->my_table} ORDER BY CAST(spent_time AS SIGNED) ASC", ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

        // Cache the fetched data
        if ($data) {
            wp_cache_set('all_drag_leaderboard_data', $data, 'leaderboard_data');
        }
    } else {
        // Data found in cache
        $data = $cached_data;
    }

    return new WP_REST_Response($data, 200);
}

function trvl_fetch_all_drag_leaderboard_sorted_data(WP_REST_Request $request){
    global $wpdb;
    $table_name = $wpdb->prefix . 'drag_leaderboard';

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    $data = $request->get_json_params();

    $id = isset($data['id']) ? absint($data['id']) : 0;

    // Attempt to retrieve sorted data from cache
    $cached_data = wp_cache_get('sorted_drag_leaderboard_data', 'leaderboard_data');

    if ($cached_data === false) {
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
        $sortedData = $wpdb->get_results("
            SELECT *, 
                ROW_NUMBER() OVER (ORDER BY CAST(spent_time AS SIGNED) ASC) AS rank
            FROM {$wpdb->my_table}
            ORDER BY CAST(spent_time AS SIGNED) ASC
        ", ARRAY_A); 

        // Cache the fetched sorted data
        if ($sortedData) {
            wp_cache_set('sorted_drag_leaderboard_data', $sortedData, 'leaderboard_data');
        }
    } else {
        // Data found in cache
        $sortedData = $cached_data;
    }

    $matchedRow = null;

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
