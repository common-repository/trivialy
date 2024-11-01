<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Include the database class file

require_once( TRVL_PLUGIN_PATH . 'netro-trivaly-database.php' );


add_action('rest_api_init', function () {
    // Register REST API endpoint for saving quiz data
    register_rest_route('custom/v1', '/save-popup-quiz-data', array(
        'methods' => 'POST',
        'callback' => 'trvl_add_popup_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));
    

    register_rest_route('custom/v1', '/get-popup-image-path', array(
        'methods' => 'POST',
        'callback' => 'trvl_fetch_popup_image_path_data',
        'permission_callback' => '__return_true',
    ));

    // Register REST API endpoint for getting single quiz data by ID
    register_rest_route('custom/v1', '/get-popup-quiz-data/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'trvl_fetch_popup_quiz_data_by_id',
        'permission_callback' => '__return_true',
    ));

    // Register REST API endpoint for Deleting single quiz data by ID
    register_rest_route('custom/v1', '/delete-popup-quiz-data/(?P<id>\d+)', array(
        'methods' => 'DELETE',
        'callback' => 'trvl_delete_popup_quiz_data_by_id',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

    // Register REST API endpoint for updating single quiz data by ID
    register_rest_route('custom/v1', '/update-popup-quiz-data/(?P<id>\d+)', array(
        'methods' => 'POST',
        'callback' => 'trvl_up_popup_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

    // Register REST API endpoint for getting all quiz data
    register_rest_route('custom/v1', '/get-all-popup-quiz-data', array(
        'methods' => 'GET',
        'callback' => 'trvl_fetch_all_popup_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

    register_rest_route('custom/v1', '/bulk-delete-popup-quiz-data', array(
        'methods' => 'POST',
        'callback' => 'trvl_bulk_delete_popup_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));
});

function trvl_fetch_popup_image_path_data(WP_REST_Request $request) {

    $TRVL_PLUGIN_URL = plugin_dir_url(__FILE__);
    $plugin_base_url = trailingslashit(dirname($TRVL_PLUGIN_URL));
    $plugin_main_root = trailingslashit(dirname($plugin_base_url));

    $data = $request->get_json_params();

    // Get the 'image_relative_path' parameter from the request data
    $image_relative_path = $data['image'];

    if (empty($image_relative_path)) {
        return new WP_Error('missing_parameter', 'Image relative path parameter is missing', array('status' => 400));
    }

    $image_full_path = $plugin_main_root . $image_relative_path;


    return $image_full_path;

    
    
}

// Callback function for saving quiz data
function trvl_add_popup_quiz_data(WP_REST_Request $request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'popup_quiz';

    $nonce = $request->get_header('X-WP-Nonce');
    if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
        return new WP_REST_Response( array( 'error' => 'Invalid nonce.' ), 403 );
    }

    // Get the uploaded file
    $image_file = $_FILES['image'];

    // Check if the file is uploaded successfully
    if ($image_file['error'] === UPLOAD_ERR_OK) {
        // Handle the upload using wp_handle_upload
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $uploaded_file = wp_handle_upload($image_file, array('test_form' => false));

        if (isset($uploaded_file['file'])) {
            // Get the uploaded file path
            $file_path = $uploaded_file['file'];

            // Resize the uploaded image
            list($original_width, $original_height) = getimagesize($file_path);
            $new_width = 380;
            $new_height = 769;

            $source = imagecreatefromjpeg($file_path);
            $resized = imagecreatetruecolor($new_width, $new_height);

            imagecopyresampled($resized, $source, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

            // Save the resized image
            imagejpeg($resized, $file_path);

            // Insert data into the database
            // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
            $wpdb->insert(
                $table_name,
                array(
                    'image' => esc_url($uploaded_file['url']), // Save the file URL in the database
                    'title' => sanitize_text_field($request->get_param('title')),
                    'description' => sanitize_textarea_field($request->get_param('description')),
                    'button_select' => intval($request->get_param('button_select')),
                    'coupon_select' => intval($request->get_param('coupon_select')),
                    'button_title' => sanitize_text_field($request->get_param('button_title')),
                    'button_link' => esc_url($request->get_param('button_link')),
                    'coupon_code' => sanitize_text_field($request->get_param('coupon_code')),
                    'popup_time' => sanitize_text_field($request->get_param('popup_time')),
                    'campaign_time' => sanitize_text_field($request->get_param('campaign_time')),
                    'live_status' => intval($request->get_param('live_status')),
                    'time' => sanitize_text_field($request->get_param('time')),
                )
            ); 

            // Free up memory
            imagedestroy($source);
            imagedestroy($resized);

            // Return a success response
            return new WP_REST_Response(array('success' => true), 201);
        } else {
            // Return an error response if file upload fails
            return new WP_REST_Response(array('error' => 'File upload failed'), 500);
        }
    } else {
        // Return an error response if file upload fails
        return new WP_REST_Response(array('error' => 'File upload failed'), 500);
    }
}



function trvl_fetch_all_popup_quiz_data(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'popup_quiz';

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    // Check cache first
    $cached_data = wp_cache_get('all_popup_quiz_data', 'quiz_data');

    if ($cached_data === false) {
        // If not found in cache, fetch data from database
        $data = $wpdb->get_results("SELECT * FROM {$wpdb->my_table}", ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

        // Cache the data for 1 hour (adjust as needed)
        wp_cache_set('all_popup_quiz_data', $data, 'quiz_data', 3600);
    } else {
        // If found in cache, use cached data
        $data = $cached_data;
    }

    return new WP_REST_Response($data, 200); 
}


function trvl_fetch_popup_quiz_data_by_id($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'popup_quiz';

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    $id = $request['id'];
    // Define cache key based on the ID
    $cache_key = 'popup_quiz_data_' . $id;

    // Check cache first
    $cached_data = wp_cache_get($cache_key, 'quiz_data');

    if ($cached_data === false) {
        // If not found in cache, fetch data from database
        $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->my_table} WHERE id = %d", $id), ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

        if ($data) {
            // Cache the data for 1 hour (adjust as needed)
            wp_cache_set($cache_key, $data, 'quiz_data', 3600);
            return new WP_REST_Response($data, 200);
        } else {
            // If data not found, return 404 response
            return new WP_REST_Response(array('error' => 'Data not found'), 404);
        }
    } else {
        // If found in cache, return cached data
        return new WP_REST_Response($cached_data, 200);
    }
}

function trvl_delete_popup_quiz_data_by_id($request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'popup_quiz';
    $id = $request['id'];

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    $image_path = wp_cache_get('popup_quiz_image_' . $id, 'quiz_data');

    if (false === $image_path) {
        // Cache miss, fetch from database
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
        $image_path = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT image FROM {$wpdb->my_table} WHERE id = %d",
                $id
            )
        ); 

        // Cache the result for future requests
        wp_cache_set('popup_quiz_image_' . $id, $image_path, 'quiz_data');
    }

    // Check if the image path is not empty
    if (!empty($image_path)) {
        // Use WordPress function to delete the file
        $upload_dir = wp_upload_dir();
        $image_full_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $image_path);
        
        // Ensure the file exists before attempting to delete
        if (file_exists($image_full_path)) {
            wp_delete_file($image_full_path); // This function handles deleting the file from the file system
        }
    }

    // Delete the record from the database
    $result = $wpdb->delete($table_name, array('id' => $id), array('%d')); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

    if ($result) {
        // Clear cache for the deleted quiz
        wp_cache_delete('popup_quiz_data_' . $id, 'quiz_data');

        return new WP_REST_Response(array('success' => true), 200);
    } else {
        return new WP_REST_Response(array('error' => 'Failed to delete data'), 500);
    }
}


function trvl_up_popup_quiz_data(WP_REST_Request $request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'popup_quiz';
    $id = $request->get_param('id');

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    // Check if the quiz exists and retrieve from cache if available
    $existing_quiz = wp_cache_get('popup_quiz_data_' . $id, 'quiz_data');
    
    if (false === $existing_quiz) {
        // Cache miss, fetch from database
        $existing_quiz = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->my_table} WHERE id = %d", $id), ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

        // Cache the result for future requests
        if ($existing_quiz) {
            wp_cache_set('popup_quiz_data_' . $id, $existing_quiz, 'quiz_data');
        }
    }

    if (!$existing_quiz) {
        return new WP_REST_Response(array('error' => 'Quiz not found'), 404);
    }

    // Update the quiz data
    $updated_data = array(
        'title' => sanitize_text_field($request->get_param('title')),
        'description' => sanitize_textarea_field($request->get_param('description')),
        'button_select' => intval($request->get_param('button_select')),
        'coupon_select' => intval($request->get_param('coupon_select')),
        'button_title' => sanitize_text_field($request->get_param('button_title')),
        'button_link' => sanitize_text_field($request->get_param('button_link')),
        'coupon_code' => sanitize_text_field($request->get_param('coupon_code')),
        'popup_time' => sanitize_text_field($request->get_param('popup_time')),
        'campaign_time' => sanitize_text_field($request->get_param('campaign_time')),
        'live_status' => intval($request->get_param('live_status')),
        'time' => sanitize_text_field($request->get_param('time')),
    );

    $nonce = $request->get_header('X-WP-Nonce');
    if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
        return new WP_REST_Response( array( 'error' => 'Invalid nonce.' ), 403 );
    }

    // Check if a new image file is provided
    if (isset($_FILES['image'])) {
        // Delete the previous file
        $previous_image_path = $existing_quiz['image'];
        if (!empty($previous_image_path)) {
            // Get the absolute path to the previous image
            $upload_dir = wp_upload_dir();
            $previous_image_abs_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $previous_image_path);

            // Delete the previous image file
            if (file_exists($previous_image_abs_path)) {
                wp_delete_file($previous_image_abs_path);
            }
        }

        // Handle the new image file using wp_handle_upload
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $image_file = $_FILES['image'];
        $uploaded_file = wp_handle_upload($image_file, array('test_form' => false));

        if (isset($uploaded_file['file'])) {
            // Get the uploaded file path
            $file_path = $uploaded_file['file'];

            // Resize the uploaded image
            list($original_width, $original_height) = getimagesize($file_path);
            $new_width = 380;
            $new_height = 769;

            $source = imagecreatefromjpeg($file_path);
            $resized = imagecreatetruecolor($new_width, $new_height);

            imagecopyresampled($resized, $source, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

            // Save the resized image
            imagejpeg($resized, $file_path);

            // Update data with the new image URL
            $updated_data['image'] = $uploaded_file['url'];

            // Free up memory
            imagedestroy($source);
            imagedestroy($resized);
        } else {
            // Return an error response if file upload fails
            return new WP_REST_Response(array('error' => 'File upload failed'), 500);
        }
    } else {
        // No new image file provided, keep the existing image URL
        $updated_data['image'] = $existing_quiz['image'];
    }

    // Perform the database update
    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
    $wpdb->update(
        $table_name,
        $updated_data,
        array('id' => $id),
        array('%s', '%s', '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s'),
        array('%d')
    ); 

     // Clear cache for the updated quiz
     wp_cache_delete('popup_quiz_data_' . $id, 'quiz_data');

    // Return success response
    return new WP_REST_Response(array('success' => true), 200);
}


function trvl_bulk_delete_popup_quiz_data(WP_REST_Request $request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'popup_quiz';

    // Get the IDs to be deleted from the request
    $data = $request->get_json_params();
    $ids = $data['ids'];

    $table_name = esc_sql($table_name);
    $wpdb->my_table =  $table_name;

    if (!empty($ids)) {
        // Create a comma-separated string of IDs for the SQL query
        $id_s = array_map('absint', wp_parse_id_list( $ids ) );
        $ids_str = implode( ',', $id_s );

        $image_paths = wp_cache_get('popup_quiz_image_paths_' . $ids_str, 'quiz_data');

        if ($image_paths === false) {
            $image_paths = array();
            // Get the image paths associated with the selected IDs
            
            foreach ($ids as $key => $id) {
                $id = intval($id);
                // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
                $results = $wpdb->get_col(
                    $wpdb->prepare(
                        "SELECT image FROM {$wpdb->my_table} WHERE id = %d", $id
                    )
                ); 
                if($results){
                    $image_paths = array_merge($image_paths, $results);
                }
            }
            

            // Cache the fetched image paths
            wp_cache_set('drag_quiz_image_paths_' . $ids_str, $image_paths, 'quiz_data');
        }
        // Construct and execute the DELETE query
        foreach($ids as $id){
            $id = intval($id);
            // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
            $wpdb->query(
                $wpdb->prepare(
                    "DELETE FROM {$wpdb->my_table} WHERE id = %d", $id
                )
            ); 
        }
        

        // Check for successful deletion
        if ($wpdb->last_error === '') {
            // Successfully deleted

            // Delete associated image files
            foreach ($image_paths as $image_path) {
                // Ensure the path is valid and not empty
                if (!empty($image_path)) {
                    trvl_delete_image_by_path($image_path);
                }
            }

            // Clear cache for deleted image paths
            wp_cache_delete('drag_quiz_image_paths_' . $ids_str, 'quiz_data');


            $response = array('success' => true, 'message' => 'Rows deleted successfully.');
        } else {
            // Failed to delete
            $response = array('success' => false, 'message' => 'Error deleting rows.');
        }
    } else {
        // No IDs provided
        $response = array('success' => false, 'message' => 'No IDs provided for deletion.');
    }

    // Send the response
    wp_send_json($response);
}

/**
 * Helper function to delete image by its path.
 *
 * @param string $image_path The path of the image file to delete.
 */
function trvl_delete_image_by_path($image_path) {
    // Convert image URL to absolute path
    $upload_dir = wp_upload_dir();
    $image_full_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $image_path);

    // Check if the file exists before attempting to delete
    if (file_exists($image_full_path)) {
        wp_delete_file($image_full_path); // This function handles deleting the file from the file system
    }
}


?>
