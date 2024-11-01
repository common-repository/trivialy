<?php
/**
 * Plugin Name: Trivialy
 * Plugin URI: https://trivialy.co    
 * Author: Netro Systems
 * Author URI: https://netrosystems.com/
 * Version: 1.0.0
 * Description: Trivialy Plugin by Netro Systems
 * Tags: boost sales, campaign, quiz, trivia, engagement
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: netro-trivialy
 * Domain Path: /languages
 */

 /*
This plugin is distributed under the terms of the GNU General Public License v2 or later.
See the LICENSE file for details.
*/
defined('ABSPATH') || exit;

require_once('vendor/autoload.php');

define('TRVL_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('TRVL_PLUGIN_URL', plugin_dir_url(__FILE__));
define('TRVL_PLUGIN_FILE',  __FILE__);
define('TRVL_TRIVIALY_IMAGE_PATH', TRVL_PLUGIN_URL . 'src/assets/stat-images/');

require_once( TRVL_PLUGIN_PATH . 'netro-trivaly-database.php' );

require_once(TRVL_PLUGIN_PATH.'api/admin/InformationApi.php');
require_once(TRVL_PLUGIN_PATH.'api/admin/SpinApi.php');
require_once(TRVL_PLUGIN_PATH.'api/admin/DragApi.php');
require_once(TRVL_PLUGIN_PATH.'api/admin/PopupApi.php');
require_once(TRVL_PLUGIN_PATH.'api/admin/ScratchApi.php');
require_once(TRVL_PLUGIN_PATH.'api/admin/QuizApi.php');
require_once(TRVL_PLUGIN_PATH.'api/admin/CheckingApi.php');
require_once(TRVL_PLUGIN_PATH.'api/admin/AllQuizzesApi.php');
require_once(TRVL_PLUGIN_PATH.'api/admin/DragLeaderboardApi.php');
require_once(TRVL_PLUGIN_PATH.'api/admin/QuizLeaderboardApi.php');
require_once(TRVL_PLUGIN_PATH.'api/admin/DashboardApi.php');

if (!class_exists('trvl_netro_trivialy_plugin')) {
    class trvl_netro_trivialy_plugin
    {
        public function __construct()
        {   

            //Admin Panel
            add_action('admin_menu', array($this, 'trvl_trivialy_menu'));
            add_action('admin_enqueue_scripts', array($this, 'trvl_admin_enqueue_vue_scripts'), PHP_INT_MAX );
            add_filter('admin_footer_text', array($this, 'trvl_change_admin_footer_text'));
            add_filter('update_footer', array($this, 'trvl_customize_admin_footer'), 11);

            //Frontend
            add_action('wp_enqueue_scripts', array($this, 'trvl_front_enqueue_vue_scripts'), PHP_INT_MAX);
            add_action('wp_footer', array($this, 'trvl_trivialy_vue_render_frontend'));

            // Register deactivation and uninstallation hooks
            register_activation_hook( __FILE__, array('NetroTrivalyDatabase', 'activate') );
            register_deactivation_hook(__FILE__, array('NetroTrivalyDatabase', 'deactivate'));
            register_uninstall_hook(__FILE__, array('NetroTrivalyDatabase', 'uninstall'));

            
        }
        
        public function trvl_change_admin_footer_text($footer_text)
        {
            // Modify the footer text as needed
            $screen = get_current_screen();

            // Check if the current screen is related to your plugin
            if ($screen && (strpos($screen->id, 'netro_trivialy') !== false)) {
                // Modify the footer text for the entire plugin
                $footer_text = '';
            }

            return $footer_text;
        }

        public function trvl_customize_admin_footer($footer_text)
        {
            // Check if the current screen is related to your plugin
            $screen = get_current_screen();

            if ($screen && (strpos($screen->id, 'netro_trivialy') !== false)) {
                // Replace WordPress version with custom text
                $footer_text = '';
            }

            return $footer_text;
        }

        public function trvl_admin_enqueue_vue_scripts($hook_suffix)
        {

            if (strpos($hook_suffix, 'netro_trivialy') === false) {
                return;
            }

            $assets_dir = TRVL_PLUGIN_PATH . 'dist/assets/';
            $asset_files = scandir($assets_dir);

            $css_files = array_filter($asset_files, function ($file) {
                return pathinfo($file, PATHINFO_EXTENSION) === 'css';
            });

            $js_files = array_filter($asset_files, function ($file) {
                return pathinfo($file, PATHINFO_EXTENSION) === 'js';
            });

            $latest_css = end($css_files);
            $latest_js = end($js_files);

            wp_enqueue_script('vue-script', TRVL_PLUGIN_URL . 'dist/assets/' . $latest_js, array(), '1.0.0', true);
           
            wp_localize_script('vue-script', 'wpApiSettings', array(
                'root' => esc_url_raw(rest_url()),
                'nonce' => wp_create_nonce('wp_rest'),
                'imagePath' => TRVL_TRIVIALY_IMAGE_PATH,
            ));
            

            wp_enqueue_style('vue-style', TRVL_PLUGIN_URL . 'dist/assets/' . $latest_css, array(), '1.0.0', 'all');
           

            wp_enqueue_style('font-family', 'https://fonts.googleapis.com/css?family=Inter', array(), '1.0.0', 'all');
          
        }

        

        public function trvl_front_enqueue_vue_scripts()
        {
            $assets_dir = TRVL_PLUGIN_PATH . 'dist/assets/';
            $asset_files = scandir($assets_dir);

            $css_files = array_filter($asset_files, function ($file) {
                return pathinfo($file, PATHINFO_EXTENSION) === 'css';
            });

            $js_files = array_filter($asset_files, function ($file) {
                return pathinfo($file, PATHINFO_EXTENSION) === 'js';
            });

            $latest_css = end($css_files);
            $latest_js = end($js_files);

            wp_enqueue_script('vue-script', TRVL_PLUGIN_URL . 'dist/assets/' . $latest_js, array(), '1.0.0', true);
            wp_localize_script('vue-script', 'wpApiSettings', array(
                'root' => esc_url_raw(rest_url()),
                'nonce' => wp_create_nonce('wp_rest'),
                'imagePath' => TRVL_TRIVIALY_IMAGE_PATH,
            ));
            

            wp_enqueue_style('vue-style', TRVL_PLUGIN_URL . 'dist/assets/' . $latest_css, array(), '1.0.0', 'all');
          

            wp_enqueue_style('font-family', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), '1.0.0', 'all');
            
        }

        public function trvl_trivialy_menu()
        {
            add_menu_page(
                'Trivialy',  // Page title
                'Trivialy',   // Menu title
                'manage_options', // Capability
                'netro_trivialy', // Menu slug
                array($this, 'trivialy_menu_page'), // Callback function to display the menu page
                TRVL_TRIVIALY_IMAGE_PATH . 'wp_logo_grey.png', // Icon URL or Dashicons class
                $position = null // Position in the menu
            );

            add_submenu_page('netro_trivialy', 'Quiz', 'Quiz', 'manage_options', 'netro_trivialy_quiz', array($this, 'trivialy_quiz_func'));
           


        }


        public function trivialy_menu_page()
        {
            ?>
            <div class="wrap custom-wrap">
                <div id="trivialy-plugin">

                </div>
            </div>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    // Add your custom class to the wpcontent div
                    $('#wpcontent').addClass('custom-wpcontent');
                });
            </script>
            <?php
        }

       
        public function trvl_trivialy_vue_render_frontend()
        {
            
            ?>

            <div class="wrap">
                <div id="front-trivialy">

                </div>
            </div>
            <?php
        }
        public function trivialy_quiz_func(){
            ?>
            <div class="wrap custom-wrap">
                <div id="trivialy-quiz-plugin">

                </div>
            </div>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    // Add your custom class to the wpcontent div
                    $('#wpcontent').addClass('custom-wpcontent');
                });
            </script>
            <?php
        }

        
    }
    
    new trvl_netro_trivialy_plugin();
}
?>
