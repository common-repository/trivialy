<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Include the database class file

require_once( TRVL_PLUGIN_PATH . 'netro-trivaly-database.php' );


add_action('rest_api_init', function () {
    // Register REST API endpoint for saving quiz data
    register_rest_route('custom/v1', '/save-drag-quiz-data', array(
        'methods' => 'POST',
        'callback' => 'trvl_add_drag_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

    // Register REST API endpoint for getting all quiz data
    register_rest_route('custom/v1', '/get-all-drag-quiz-data', array(
        'methods' => 'GET',
        'callback' => 'trvl_fetch_all_drag_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

    // Register REST API endpoint for getting single quiz data by ID
    register_rest_route('custom/v1', '/get-drag-quiz-data/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'trvl_fetch_drag_quiz_data_by_id',
        'permission_callback' => '__return_true',
    ));

    // Register REST API endpoint for Deleting single quiz data by ID
    register_rest_route('custom/v1', '/delete-drag-quiz-data/(?P<id>\d+)', array(
        'methods' => 'DELETE',
        'callback' => 'trvl_delete_drag_quiz_data_by_id',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

    // Register REST API endpoint for updating single quiz data by ID
    register_rest_route('custom/v1', '/update-drag-quiz-data/(?P<id>\d+)', array(
        'methods' => 'POST',
        'callback' => 'trvl_up_drag_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));

    register_rest_route('custom/v1', '/bulk-delete-drag-quiz-data', array(
        'methods' => 'POST',
        'callback' => 'trvl_bulk_delete_drag_quiz_data',
        'permission_callback' => function () {
            return current_user_can('manage_options');
        },
    ));
});



// Callback function for saving quiz data
function trvl_add_drag_quiz_data(WP_REST_Request $request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'drag_quiz';

    $nonce = $request->get_header('X-WP-Nonce');
    if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
        return new WP_REST_Response( array( 'error' => 'Invalid nonce.' ), 403 );
    }

    // Get the uploaded file
    $image_file = isset($_FILES['image']) ? $_FILES['image'] : null;

    // Check if the file is uploaded successfully
    if ($image_file && $image_file['error'] === UPLOAD_ERR_OK) {

        // Handle the upload using wp_handle_upload
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $uploaded_file = wp_handle_upload($image_file, array('test_form' => false));

        if (isset($uploaded_file['file'])) {
            // Get the uploaded file path
            $file_path = $uploaded_file['file'];

            // Create a new image resource
            $source = imagecreatefromjpeg($file_path);

            if ($source === false) {
                return new WP_REST_Response(array('error' => 'Failed to create image resource'), 500);
            }

            // Get original dimensions
            $original_width = imagesx($source);
            $original_height = imagesy($source);

            // Calculate new dimensions
            $new_width = 240;
            $new_height = 240;

            // Create a new true color image
            $resized = imagecreatetruecolor($new_width, $new_height);

            // Resize and crop the image to fit 240x240 pixels
            imagecopyresampled($resized, $source, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

            // Save the resized image
            imagejpeg($resized, $file_path);

            // Sanitize and validate input data
            $title = sanitize_text_field($request->get_param('title'));
            $image_url = esc_url_raw($uploaded_file['url']);
            $board_size = sanitize_text_field($request->get_param('board_size'));
            $reward = sanitize_text_field($request->get_param('reward'));
            $coupon = sanitize_text_field($request->get_param('coupon'));
            $campaign_time = sanitize_text_field($request->get_param('campaign_time'));
            $popup_time = sanitize_text_field($request->get_param('popup_time'));
            $live_status = absint($request->get_param('live_status'));
            $time = sanitize_text_field($request->get_param('time'));
            $link = esc_url_raw($request->get_param('link'));
            $unique_id = sanitize_text_field($request->get_param('unique_id'));

            // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
            $wpdb->insert(
                $table_name,
                array(
                    'title' => $title,
                    'image' => $image_url, // Save the file URL in the database
                    'board_size' => $board_size,
                    'reward' => $reward,
                    'coupon' => $coupon,
                    'campaign_time' => $campaign_time,
                    'popup_time' => $popup_time,
                    'live_status' => $live_status,
                    'time' => $time,
                    'link' => $link,
                    'unique_id' => $unique_id,
                ),
                array(
                    '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s'
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




function trvl_fetch_all_drag_quiz_data() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'drag_quiz';

    // Define the cache key and duration
    $cache_key = 'all_drag_quiz_data';
    $cache_duration = 300; // Cache duration in seconds (e.g., 300 seconds = 5 minutes)

    // Check if the result is already cached
    $cached_data = wp_cache_get($cache_key);
    if ($cached_data !== false) {
        return new WP_REST_Response($cached_data, 200);
    }

    // Ensure the table name is escaped correctly
    $table_name = esc_sql($table_name);

    $wpdb->my_table_name =  $table_name;

    // Prepare and execute the SQL query
    $query = $wpdb->get_results("SELECT * FROM {$wpdb->my_table_name}", ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

    return new WP_REST_Response($query);
    // $results = $wpdb->get_results($query, ARRAY_A);

    // Sanitize the output data
    $data = array_map(function($row) {
        return array_map('sanitize_text_field', $row);
    }, $query);

    // Cache the result
    wp_cache_set($cache_key, $data, '', $cache_duration);

    return new WP_REST_Response($data, 200);
}

function trvl_fetch_drag_quiz_data_by_id($request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'drag_quiz';

    

    // Sanitize and validate the input ID
    $id = isset($request['id']) ? absint($request['id']) : 0;

    if ($id <= 0) {
        return new WP_REST_Response(array('error' => 'Invalid ID provided'), 400);
    }

    // Define the cache key and duration
    $cache_key = 'drag_quiz_data_' . $id;
    $cache_duration = 300; // Cache duration in seconds (e.g., 300 seconds = 5 minutes)

    // Check if the result is already cached
    $cached_data = wp_cache_get($cache_key);
    if ($cached_data !== false) {
        return new WP_REST_Response($cached_data, 200);
    }

    // Ensure the table name is escaped correctly
    $table_name = esc_sql($table_name);

    $wpdb->my_table_name =  $table_name;

    // Prepare and execute the SQL query
    $query = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->my_table_name} WHERE id = %d", $id), ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
    

    if ($query) {
        // Sanitize the output data before returning it
        $sanitized_data = array_map('sanitize_text_field', $query);

         // Cache the result
         wp_cache_set($cache_key, $sanitized_data, '', $cache_duration);

        return new WP_REST_Response($sanitized_data, 200);
    } else {
        return new WP_REST_Response(array('error' => 'Data not found'), 404);
    }
}

function trvl_delete_drag_quiz_data_by_id($request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'drag_quiz';

    // Sanitize and validate the input ID
    $id = isset($request['id']) ? absint($request['id']) : 0;

    if ($id <= 0) {
        return new WP_REST_Response(array('error' => 'Invalid ID provided'), 400);
    }

    $table_name = esc_sql($table_name);

    $wpdb->my_table_name =  $table_name;

    // Check if data is cached before fetching from database
    $cache_key = 'drag_quiz_data_' . $id;
    $cached_data = wp_cache_get($cache_key, 'quiz_data');

    if ($cached_data === false) {
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
        $image_url = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT image FROM {$wpdb->my_table_name} WHERE id = %d",
                $id
            )
        ); 

        // Cache the fetched image URL
        wp_cache_set($cache_key, $image_url, 'quiz_data');
    } else {
        $image_url = $cached_data;
    }

 

    // Check if the image URL is not empty
    if (!empty($image_url)) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $upload_dir = wp_upload_dir();
        // Replace the base URL with the base directory to get the absolute path
        $absolute_file_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $image_url);

        // Check if the file exists before attempting to delete
        if (file_exists($absolute_file_path)) {
            // Delete the file
            wp_delete_file($absolute_file_path);
        }
    }

    // Ensure the table name and ID are escaped correctly
    $table_name = esc_sql($table_name);

    // Delete the record from the database
    $result = $wpdb->delete($table_name, array('id' => $id), array('%d')); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

    // Clear the cache for the deleted quiz
    wp_cache_delete($cache_key, 'quiz_data');

    if ($result !== false) {
        return new WP_REST_Response(array('success' => true), 200);
    } else {
        return new WP_REST_Response(array('error' => 'Failed to delete data'), 500);
    }
}


function trvl_up_drag_quiz_data(WP_REST_Request $request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'drag_quiz';
    $id = isset($request['id']) ? absint($request['id']) : 0;

    $nonce = $request->get_header('X-WP-Nonce');
    if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
        return new WP_REST_Response( array( 'error' => 'Invalid nonce.' ), 403 );
    }

     // Sanitize and validate the input ID
    if ($id <= 0) {
        return new WP_REST_Response(array('error' => 'Invalid ID provided'), 400);
    }

    $table_name = esc_sql($table_name);
    $wpdb->my_table_name =  $table_name;


   // Check if the quiz exists
    $cache_key = 'drag_quiz_data_' . $id;
    $cached_quiz = wp_cache_get($cache_key, 'quiz_data');

    if ($cached_quiz === false) {
        // Data not found in cache, retrieve from database
        $existing_quiz = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->my_table_name} WHERE id = %d", $id), ARRAY_A); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery

        if (!$existing_quiz) {
            return new WP_REST_Response(array('error' => 'Quiz not found'), 404);
        }

        // Cache the fetched quiz data
        wp_cache_set($cache_key, $existing_quiz, 'quiz_data');
    } else {
        $existing_quiz = $cached_quiz;
    }

    // Update the quiz data
    $updated_data = array(
        'title' => isset($request['title']) ? sanitize_text_field($request['title']) : '',
        'board_size' => isset($request['board_size']) ? sanitize_text_field($request['board_size']) : '',
        'reward' => isset($request['reward']) ? sanitize_text_field($request['reward']) : '',
        'coupon' => isset($request['coupon']) ? sanitize_text_field($request['coupon']) : '',
        'popup_time' => isset($request['popup_time']) ? sanitize_text_field($request['popup_time']) : '',
        'campaign_time' => isset($request['campaign_time']) ? sanitize_text_field($request['campaign_time']) : '',
        'live_status' => isset($request['live_status']) ? absint($request['live_status']) : 0, // Assuming live_status is an integer
        'time' => isset($request['time']) ? sanitize_text_field($request['time']) : '',
        'link' => isset($request['link']) ? esc_url_raw($request['link']) : '',
    );

    

    if (isset($_FILES['image'])) {
        // Delete the previous file
        $previous_image_path = $existing_quiz['image'];
        if (!empty($previous_image_path)) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            $upload_dir = wp_upload_dir();
            $previous_image_full_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $previous_image_path);
            wp_delete_file($previous_image_full_path);
        }

        // Handle the new image file using wp_handle_upload
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        $image_file = $_FILES['image'];
        $uploaded_file = wp_handle_upload($image_file, array('test_form' => false));

        if (isset($uploaded_file['file'])) {
            // Get the uploaded file path
            $file_path = $uploaded_file['file'];

            // Create a new image resource
            $source = imagecreatefromjpeg($file_path);

            // Get original dimensions
            $original_width = imagesx($source);
            $original_height = imagesy($source);

            // Calculate new dimensions
            $new_width = 240;
            $new_height = 240;

            // Create a new true color image
            $resized = imagecreatetruecolor($new_width, $new_height);

            // Resize and crop the image to fit 240x240 pixels
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

    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
    $wpdb->update(
        $table_name,
        $updated_data,
        array('id' => $id),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s'),
        array('%d')
    ); 

     // Clear the cache for the updated quiz
     wp_cache_delete($cache_key, 'quiz_data');

    return new WP_REST_Response(array('success' => true), 200);
}




function trvl_bulk_delete_drag_quiz_data(WP_REST_Request $request) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'drag_quiz';

    // Get the IDs to be deleted from the request
    $data = $request->get_json_params();
    $ids = $data['ids'];

    $table_name = esc_sql($table_name);
    $wpdb->my_table_name =  $table_name;

    if (!empty($ids)) {
        // Create a comma-separated string of IDs for the SQL query
        $id_s = array_map('absint', wp_parse_id_list( $ids ) );
        $ids_str = implode( ',', $id_s );

        // Get the image paths associated with the selected IDs
        $image_paths = wp_cache_get('drag_quiz_image_paths_' . $ids_str, 'quiz_data');

        if ($image_paths === false) {
            $image_paths = array();
            // Data not found in cache, fetch from database
            foreach ($ids as $key => $id) {
                $id = intval($id);
                // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
                $results = $wpdb->get_col(
                    $wpdb->prepare(
                        "SELECT image FROM {$wpdb->my_table_name} WHERE id= %d", $id
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
                    "DELETE FROM {$wpdb->my_table_name} WHERE id= %d", $id
                )
            ); 
        }

        // Check for successful deletion
        if ($wpdb->last_error === '') {
            // Successfully deleted

            // Delete associated image files using WordPress function
            foreach ($image_paths as $image_path) {
                // Ensure the path is valid and not empty
                if (!empty($image_path)) {
                    // Delete file using WordPress function
                    trvl_delete_image_by_url($image_path);
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

// Function to delete an image by its URL
function trvl_delete_image_by_url($image_url) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    $upload_dir = wp_upload_dir();
    // Replace the base URL with the base directory to get the absolute path
    $absolute_file_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $image_url);

    // Check if the file exists before attempting to delete
    if (file_exists($absolute_file_path)) {
        // Delete the file using WordPress function
        wp_delete_file($absolute_file_path);
    }
}

?>
