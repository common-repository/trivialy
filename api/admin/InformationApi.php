<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function trvl_fetch_about_info() { 
    $current_theme = wp_get_theme();
    $theme_name = sanitize_text_field($current_theme->get('Name'));
    $theme_version = sanitize_text_field($current_theme->get('Version'));

    $site_url = esc_url(get_site_url());
    $home_url = esc_url(get_home_url());
    $language = sanitize_text_field(get_bloginfo('language'));
    $wordpress_version = sanitize_text_field(get_bloginfo('version'));
    
    // Get the permalink structure
    $permalink_structure = get_option('permalink_structure');

    // If the permalink structure is empty, it means the default (plain) structure is used
    if (empty($permalink_structure)) {
        $permalink_structure = '/?p=%post_id%';
    } else {
        $permalink_structure = sanitize_text_field($permalink_structure);
    }

    // Get PHP version
    $php_version = sanitize_text_field(phpversion());

    // Get web server information
    $web_server = sanitize_text_field($_SERVER['SERVER_SOFTWARE']);

    // Get MySQL version
    global $wpdb;
    $mysql_version = sanitize_text_field($wpdb->db_version());

    
    $memory_limit = sanitize_text_field(ini_get('memory_limit'));
    $active_quiz = intval(trvl_live_quiz());

    $totalCampaign = intval(trvl_totalCampaign());

    // Plugin Data
    $TRVL_PLUGIN_PATH = dirname(dirname(dirname(__FILE__)));
    $plugin_main_file = $TRVL_PLUGIN_PATH.'/netro-trivaly.php';
    $plugin_data = get_file_data($plugin_main_file, array('Version' => 'Version'), false);
    $plugin_version = sanitize_text_field($plugin_data['Version']);

    


    return array(
        'name'                => $theme_name,
        'version'             => $theme_version,
        'site_url'            => $site_url,
        'home_url'            => $home_url,
        'language'            => $language,
        'wordpress_version'   => $wordpress_version,
        'permalink_structure' => $permalink_structure,
        'php_version'         => $php_version,
        'web_server'          => $web_server,
        'mysql_version'       => $mysql_version,
        'plugin_version'      => $plugin_version,
        'memory_limit'        => $memory_limit,
        'active_quiz'         => $active_quiz,
        'total_campaign'      => $totalCampaign,
    );
}


function trvl_fetch_user_info() {
    // Get the current user ID
    $current_user_id = get_current_user_id();

    // Check if a user is logged in
    if ($current_user_id !== 0) {
        // Get user data based on user ID
        $user_data = get_userdata($current_user_id);

        // Extract relevant information
        $user_name = sanitize_user($user_data->user_login);
        $user_email = sanitize_email($user_data->user_email);

        return array(
            'user_name'  => $user_name,
            'user_email' => $user_email,
        );
    } else {
        // If no user is logged in, return an empty array or an error message
        return array('error' => 'No user logged in');
    }
}

function trvl_live_quiz() {
    global $wpdb;

    $tables = array(
        $wpdb->prefix . 'custom_quiz',
        $wpdb->prefix . 'quiz',
        $wpdb->prefix . 'image_quiz',
        $wpdb->prefix . 'spin_quiz',
        $wpdb->prefix . 'drag_quiz',
        $wpdb->prefix . 'scratch_quiz',
    );

    $totalRows = 0;

    // Check cache first
    $cached_count = wp_cache_get('live_quiz_count', 'quiz_data');

    if ($cached_count === false) {
        // If not found in cache, calculate the total count from database
        foreach ($tables as $table) {
            $table = esc_sql($table);
            $wpdb->my_table =  $table;

            $result = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->my_table} WHERE live_status = %d", 1)); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

            if ($result) {
                // If a count is found for the table, add it to the total count
                $totalRows += intval($result);
            }
        }

        // Cache the total count for 1 hour (3600 seconds)
        wp_cache_set('live_quiz_count', $totalRows, 'quiz_data', 3600);
    } else {
        // If found in cache, use cached value
        $totalRows = $cached_count;
    }

    // Return the total count of rows with live_status = 1 in all tables
    return $totalRows;
}

function trvl_totalCampaign(){
    global $wpdb;

    $tables = array(
        $wpdb->prefix . 'custom_quiz',
        $wpdb->prefix . 'quiz',
        $wpdb->prefix . 'image_quiz',
        $wpdb->prefix . 'spin_quiz',
        $wpdb->prefix . 'drag_quiz',
        $wpdb->prefix . 'scratch_quiz',
    );

    $totalCount = 0;

    // Check cache first
    $cached_count = wp_cache_get('total_campaign_count', 'quiz_data');

    if ($cached_count === false) {
        // If not found in cache, calculate the total count from database
        foreach ($tables as $table) {
            $table = esc_sql($table);
            $wpdb->my_table =  $table;

            $result = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->my_table}"); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

            if ($result !== null) {
                // If a count is found for the table, add it to the total count
                $totalCount += intval($result);
            }
        }

        // Cache the total count for 1 hour (3600 seconds)
        wp_cache_set('total_campaign_count', $totalCount, 'quiz_data', 3600);
    } else {
        // If found in cache, use cached value
        $totalCount = $cached_count;
    }

    return $totalCount;

    
}

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/about-data', array(
        'methods'  => 'GET',
        'callback' => 'trvl_fetch_about_info',
    ));

    register_rest_route('custom/v1', '/user-data', array(
        'methods'  => 'GET',
        'callback' => 'trvl_fetch_user_info',
    ));

});

?>