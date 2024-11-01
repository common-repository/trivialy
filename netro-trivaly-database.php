<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if (!class_exists('trvl_netro_trivialy_plugin')) {
    class NetroTrivalyDatabase {
        public static function activate() {
            self::trvl_crate_quizLeaderboard_table();
            self::trvl_crate_dragLeaderboard_table();
            self::trvl_create_quiz_table();
            self::trvl_create_spin_quiz_table();
            self::trvl_create_drag_quiz_table();
            self::trvl_create_popup_quiz_table();
            self::trvl_create_scratch_quiz_table();
        }

        public static function deactivate() {
            self::trvl_truncate_quizLeaderboard_table();
            self::trvl_truncate_dragLeaderboard_table();
            self::trvl_create_spin_quiz_table();
            self::trvl_truncate_quiz_table();
            self::trvl_truncate_spin_quiz_table();
            self::trvl_truncate_drag_quiz_table();
            self::trvl_truncate_popup_quiz_table();
            self::trvl_truncate_scratch_quiz_table();
        }

        public static function uninstall() {
            self::trvl_drop_quizLeaderboard_table();
            self::trvl_drop_dragLeaderboard_table();
            self::trvl_drop_quiz_table();
            self::trvl_drop_spin_quiz_table();
            self::trvl_drop_drag_quiz_table();
            self::trvl_drop_popup_quiz_table();
            self::trvl_drop_scratch_quiz_table();
        }

        private static function trvl_crate_quizLeaderboard_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'quiz_leaderboard';

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                user_name varchar(255) NOT NULL,
                user_email varchar(255) NOT NULL,
                spent_time varchar(255) NOT NULL,
                won_reward varchar(255) NOT NULL,
                quiz_type varchar(255) NOT NULL,
                right_ans varchar(255) NOT NULL,
                time datetime NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }

        private static function trvl_crate_dragLeaderboard_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'drag_leaderboard';

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                user_name varchar(255) NOT NULL,
                user_email varchar(255) NOT NULL,
                spent_time varchar(255) NOT NULL,
                won_reward varchar(255) NOT NULL,
                time datetime NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }

        

        private static function trvl_create_quiz_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'quiz';

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                quiz_title varchar(255) NOT NULL,
                question_number smallint(5) NOT NULL,
                campaign_time varchar(255) NOT NULL,
                popup_time varchar(255) NOT NULL,
                quiz_category varchar(255) NOT NULL,
                quiz_location varchar(255) NOT NULL,
                quiz_hardness varchar(255) NOT NULL,
                quiz_type varchar(255) NOT NULL,
                reward json NOT NULL,
                reward_message json NOT NULL,
                live_status smallint(5) NOT NULL,
                link longtext NOT NULL,
                time datetime NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }

       

        private static function trvl_create_spin_quiz_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'spin_quiz';

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                title varchar(255) NOT NULL,
                select_quadrant smallint(5) NOT NULL,
                reward_one varchar(255) NOT NULL,
                coupone_one varchar(255) NOT NULL,
                reward_two varchar(255) NOT NULL,
                coupone_two varchar(255) NOT NULL,
                reward_three varchar(255) NOT NULL,
                coupone_three varchar(255) NOT NULL,
                reward_four varchar(255) NOT NULL,
                coupone_four varchar(255) NOT NULL,
                reward_five varchar(255) NOT NULL,
                coupone_five varchar(255) NOT NULL,
                reward_six varchar(255) NOT NULL,
                coupone_six varchar(255) NOT NULL,
                reward_seven varchar(255) NOT NULL,
                coupone_seven varchar(255) NOT NULL,
                campaign_time varchar(255) NOT NULL,
                popup_time varchar(255) NOT NULL,
                live_status smallint(5) NOT NULL,
                link longtext NOT NULL,
                time datetime NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }

        private static function trvl_create_drag_quiz_table(){
            global $wpdb;

            $table_name = $wpdb->prefix . 'drag_quiz';

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                title varchar(255) NOT NULL,
                image varchar(255) NOT NULL,
                board_size varchar(255) NOT NULL,
                coupon varchar(255) NOT NULL,
                reward varchar(255) NOT NULL,
                campaign_time varchar(255) NOT NULL,
                popup_time varchar(255) NOT NULL,
                live_status smallint(5) NOT NULL,
                unique_id varchar(255) NOT NULL,
                link longtext NOT NULL,
                time datetime NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }

        private static function trvl_create_popup_quiz_table(){
            global $wpdb;

            $table_name = $wpdb->prefix . 'popup_quiz';

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                image varchar(255) NOT NULL,
                title varchar(255) NOT NULL,
                campaign_time varchar(255) NOT NULL,
                popup_time varchar(255) NOT NULL,
                description longtext NOT NULL,
                button_select smallint(5) NOT NULL,
                coupon_select smallint(5) NOT NULL,
                button_title varchar(255) NOT NULL,
                button_link longtext NOT NULL,
                coupon_code varchar(255) NOT NULL,
                live_status smallint(5) NOT NULL,
                time datetime NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }

        private static function trvl_create_scratch_quiz_table(){
            global $wpdb;

            $table_name = $wpdb->prefix . 'scratch_quiz';

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                title varchar(255) NOT NULL,
                select_number smallint(5) NOT NULL,
                reward_one varchar(255) NOT NULL,
                reward_two varchar(255) NOT NULL,
                reward_three varchar(255) NOT NULL,
                reward_four varchar(255) NOT NULL,
                reward_five varchar(255) NOT NULL,
                reward_six varchar(255) NOT NULL,
                reward_seven varchar(255) NOT NULL,
                reward_eight varchar(255) NOT NULL,
                reward_nine varchar(255) NOT NULL,
                reward_ten varchar(255) NOT NULL,
                coupon_one varchar(255) NOT NULL,
                coupon_two varchar(255) NOT NULL,
                coupon_three varchar(255) NOT NULL,
                coupon_four varchar(255) NOT NULL,
                coupon_five varchar(255) NOT NULL,
                coupon_six varchar(255) NOT NULL,
                coupon_seven varchar(255) NOT NULL,
                coupon_eight varchar(255) NOT NULL,
                coupon_nine varchar(255) NOT NULL,
                coupon_ten varchar(255) NOT NULL,
                campaign_time varchar(255) NOT NULL,
                popup_time varchar(255) NOT NULL,
                live_status smallint(5) NOT NULL,
                link longtext NOT NULL,
                time datetime NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }




        private static function trvl_truncate_quizLeaderboard_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'quiz_leaderboard';

            $table_name = esc_sql($table_name);
            $wpdb->my_table_name =  $table_name;

            $wpdb->query("TRUNCATE TABLE {$wpdb->my_table_name}");
        }
        

        private static function trvl_truncate_dragLeaderboard_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'drag_leaderboard';

            $table_name = esc_sql($table_name);
            $wpdb->my_table_name =  $table_name;

            $wpdb->query("TRUNCATE TABLE {$wpdb->my_table_name}");
        }


        private static function trvl_truncate_quiz_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'quiz';

            $table_name = esc_sql($table_name);
            $wpdb->my_table_name =  $table_name;

            $wpdb->query("TRUNCATE TABLE {$wpdb->my_table_name}");
        }



        private static function trvl_truncate_spin_quiz_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'spin_quiz';

            $table_name = esc_sql($table_name);
            $wpdb->my_table_name =  $table_name;

            $wpdb->query("TRUNCATE TABLE {$wpdb->my_table_name}");
        }

        private static function trvl_truncate_popup_quiz_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'popup_quiz';

            $table_name = esc_sql($table_name);
            $wpdb->my_table_name =  $table_name;

            $wpdb->query("TRUNCATE TABLE {$wpdb->my_table_name}");
        }

        private static function trvl_truncate_drag_quiz_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'drag_quiz';

            $table_name = esc_sql($table_name);
            $wpdb->my_table_name =  $table_name;

            $wpdb->query("TRUNCATE TABLE {$wpdb->my_table_name}");
        }

        private static function trvl_truncate_scratch_quiz_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'scratch_quiz';

            $table_name = esc_sql($table_name);
            $wpdb->my_table_name =  $table_name;

            $wpdb->query("TRUNCATE TABLE {$wpdb->my_table_name}");
        }




        private static function trvl_drop_quizLeaderboard_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'quiz_leaderboard';

            // Construct the SQL query to drop the table
            $sql = "DROP TABLE IF EXISTS $table_name;";

            // Include the upgrade.php file to access dbDelta function
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';

            // Execute the SQL query using dbDelta
            

            // Remove any cached data related to the dropped table if necessary
            wp_cache_delete('quiz_leaderboard_dropped_' . $table_name);
        }


        private static function trvl_drop_dragLeaderboard_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'drag_leaderboard';

            // Construct the SQL query to drop the table
            $sql = "DROP TABLE IF EXISTS $table_name;";

            // Include the upgrade.php file to access dbDelta function
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';

            // Execute the SQL query using dbDelta
            dbDelta($sql);

            // Remove any cached data related to the dropped table if necessary
            wp_cache_delete('drag_leaderboard_dropped_' . $table_name);
        }


       

        private static function trvl_drop_quiz_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'quiz';

            // Construct the SQL query to drop the table
            $sql = "DROP TABLE IF EXISTS $table_name;";

            // Include the upgrade.php file to access dbDelta function
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';

            // Execute the SQL query using dbDelta
            dbDelta($sql);

            // Remove any cached data related to the dropped table if necessary
            wp_cache_delete('quiz_dropped_' . $table_name);
        }


        private static function trvl_drop_spin_quiz_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'spin_quiz';

            // Construct the SQL query to drop the table
            $sql = "DROP TABLE IF EXISTS $table_name;";

            // Include the upgrade.php file to access dbDelta function
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';

            // Execute the SQL query using dbDelta
            dbDelta($sql);

            // Remove any cached data related to the dropped table if necessary
            wp_cache_delete('spin_quiz_dropped_' . $table_name);
        }

        private static function trvl_drop_drag_quiz_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'drag_quiz';

            // Construct the SQL query to drop the table
            $sql = "DROP TABLE IF EXISTS $table_name;";

            // Include the upgrade.php file to access dbDelta function
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';

            // Execute the SQL query using dbDelta
            dbDelta($sql);

            // Remove any cached data related to the dropped table if necessary
            wp_cache_delete('drag_quiz_dropped_' . $table_name);
        }

        private static function trvl_drop_popup_quiz_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'popup_quiz';

            // Construct the SQL query to drop the table
            $sql = "DROP TABLE IF EXISTS $table_name;";

            // Include the upgrade.php file to access dbDelta function
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';

            // Execute the SQL query using dbDelta
            dbDelta($sql);

            // Remove any cached data related to the dropped table if necessary
            wp_cache_delete('popup_quiz_dropped_' . $table_name);
        }

        private static function trvl_drop_scratch_quiz_table() {
            global $wpdb;

            $table_name = $wpdb->prefix . 'scratch_quiz';

            // Construct the SQL query to drop the table
            $sql = "DROP TABLE IF EXISTS $table_name;";

            // Include the upgrade.php file to access dbDelta function
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';

            // Execute the SQL query using dbDelta
            dbDelta($sql);

            // Remove any cached data related to the dropped table if necessary
            wp_cache_delete('scratch_quiz_dropped_' . $table_name);
        }
    }
}

?>