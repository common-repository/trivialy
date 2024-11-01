<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/dashboard-info', array(
        'methods'  => 'GET',
        'callback' => 'trvl_dashboard_info',
    ));
});

function trvl_dashboard_info(){
    $totalCampaign = trvl_total_campaign_count();

    return array(
        'total_campaign' => $totalCampaign,
    );
}

function trvl_total_campaign_count(){
    global $wpdb;

    $cache_key = 'total_campaign_count';
    $cache_duration = 300; // Cache duration in seconds (e.g., 300 seconds = 5 minutes)

    // Check if the result is already cached
    $cached_total_count = wp_cache_get($cache_key);
    if ($cached_total_count !== false) {
        return $cached_total_count;
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

    $totalCount = 0;

    foreach ($tables as $table) {
        // Ensure the table name is escaped correctly
        $table = esc_sql($table);
        $wpdb->my_table = $table;

        $result = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->my_table}"); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

        if ($result !== null) {
            $totalCount += intval($result);
        }
    }

    // Cache the result
    wp_cache_set($cache_key, $totalCount, '', $cache_duration);
    return $totalCount;
}



?>