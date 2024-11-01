<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Include the database class file

require_once( TRVL_PLUGIN_PATH . 'netro-trivaly-database.php' );

// Register REST API endpoint for saving quiz data
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/check-live-status', array(
        'methods' => 'GET',
        'callback' => 'trvl_chk_live_status',
        'permission_callback' => '__return_true',
    ));
});

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/get-prefix', array(
        'methods' => 'GET',
        'callback' => 'trvl_get_db_prefix',
        'permission_callback' => '__return_true',
    ));
});


function trvl_get_db_prefix() {
    global $wpdb;
    return array('prefix' => $wpdb->prefix);
}


// Callback function for saving quiz data
function trvl_chk_live_status(WP_REST_Request $request) {
    global $wpdb;

    // Define the cache key
    $cache_key = 'chk_live_status';
    $cached_result = wp_cache_get($cache_key);

    // If a cached result is found, return it
    if ($cached_result !== false) {
        return new WP_REST_Response($cached_result, 200);
    }

    $tables = array(
        $wpdb->prefix . 'custom_quiz',
        $wpdb->prefix . 'quiz',
        $wpdb->prefix . 'image_quiz',
        $wpdb->prefix . 'spin_quiz',
        $wpdb->prefix . 'drag_quiz',
        $wpdb->prefix . 'scratch_quiz',
        $wpdb->prefix . 'popup_quiz'
    );

    foreach ($tables as $table) {
        // Ensure the table name is escaped correctly
        $table = esc_sql($table);
        $wpdb->my_table = $table;

        $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->my_table} WHERE live_status = %d", 1)); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

        if ($result) {
            // If a record is found with live_status = 1, prepare the response
            $response = array(
                'success' => true, 
                'table' => $table, 
                'row_id' => $result->id, 
                'popup_time' => $result->popup_time, 
                'campaign_time' => $result->campaign_time, 
                'time' => $result->time
            );

            // Cache the result for future requests
            wp_cache_set($cache_key, $response, '', 300); // Cache for 5 minutes

            return new WP_REST_Response($response, 200);
        }
    }


    // If no matching record is found in any table, prepare the response
    $response = array('success' => false);

    // Cache the result for future requests
    wp_cache_set($cache_key, $response, '', 300); // Cache for 5 minutes

    // If no matching record is found in any table, return false
    return new WP_REST_Response($response, 200);
}


?>
