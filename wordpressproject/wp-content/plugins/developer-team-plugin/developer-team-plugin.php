<?php
/**
 * Plugin Name: Developer Team Plugin
 * Description: This plugin creates a Developer Post Type and Developer Type Taxonomy. It also checks for duplicate email before creating a Developer post.
 * Version: 1.0
 * Author: Your Name
 * Author URI: Your Website
 */

function custom_developer_enqueue_scripts() {
    // Enqueue jQuery
    wp_enqueue_script('jquery');

    // Enqueue the JavaScript file
    wp_enqueue_script('developer-ajax', plugin_dir_url(__FILE__) . 'developer-ajax.js', array('jquery'), '1.0', true);

    // Enqueue the CSS file
    wp_enqueue_style('developer-style', plugin_dir_url(__FILE__) . 'developer-style.css', array(), '1.0', 'all');
}

add_action('wp_enqueue_scripts', 'custom_developer_enqueue_scripts');



function create_developer_post_type() {
    $labels = array(
        'name'               => 'Developers',
        'singular_name'      => 'Developer',
        'menu_name'          => 'Developers',
        'name_admin_bar'     => 'Developer',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Developer',
        'new_item'           => 'New Developer',
        'edit_item'          => 'Edit Developer',
        'view_item'          => 'View Developer',
        'all_items'          => 'All Developers',
        'search_items'       => 'Search Developers',
        'parent_item_colon'  => 'Parent Developers:',
        'not_found'          => 'No developers found.',
        'not_found_in_trash' => 'No developers found in Trash.'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'developer' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'developer', $args );
}
add_action( 'init', 'create_developer_post_type' );


function create_developer_type_taxonomy() {
    $labels = array(
        'name'              => 'Developer Types',
        'singular_name'     => 'Developer Type',
        'search_items'      => 'Search Developer Types',
        'all_items'         => 'All Developer Types',
        'parent_item'       => 'Parent Developer Type',
        'parent_item_colon' => 'Parent Developer Type:',
        'edit_item'         => 'Edit Developer Type',
        'update_item'       => 'Update Developer Type',
        'add_new_item'      => 'Add New Developer Type',
        'new_item_name'     => 'New Developer Type Name',
        'menu_name'         => 'Developer Type',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'developer-type' ),
    );

    register_taxonomy( 'developer_type', 'developer', $args );
}
add_action( 'init', 'create_developer_type_taxonomy' );



// function check_duplicate_email( $postarr ) {
//     if ($postarr['post_type'] === 'developer') {
//         $developer_email = sanitize_email( $_POST['developer_email'] );
//         $existing_developer = get_posts( array(
//             'post_type' => 'developer',
//             'meta_query' => array(
//                 array(
//                     'key' => 'developer_email',
//                     'value' => $developer_email,
//                 ),
//             ),
//         ) );

//         if ( ! empty( $existing_developer ) ) {
//             // Prevent post insertion and display an error message.
//             wp_die( 'A developer with this email already exists.' );
//         }
//     }
//     return $postarr;
// }
// add_filter( 'pre_insert_post', 'check_duplicate_email' );

// Custom Meta Box for Developer Information
function developer_information_meta_box() {
    add_meta_box(
        'developer_information',
        'Developer Information',
        'render_developer_information_meta_box',
        'developer',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'developer_information_meta_box' );

function render_developer_information_meta_box( $post ) {
    // Add nonce for security
    wp_nonce_field( 'developer_information', 'developer_information_nonce' );

    // Retrieve existing values from the database
    $developer_email = get_post_meta( $post->ID, 'developer_email', true );
    $developer_type = get_post_meta( $post->ID, 'developer_type', true );

    // Display the form
    ?>
    <p>
        <label for="developer_email">Developer Email:</label>
        <input type="email" name="developer_email" id="developer_email" value="<?php echo esc_attr( $developer_email ); ?>" required>
    </p>
    <p>
        <label for="developer_type">Developer Type:</label>
        <?php
        $selected_developer_type = ! empty( $developer_type ) ? $developer_type : '';
        $developer_types = get_terms( array(
            'taxonomy' => 'developer_type',
            'hide_empty' => false,
        ) );
        ?>
        <select name="developer_type" id="developer_type">
            <option value="">Select Developer Type</option>
            <?php foreach ( $developer_types as $type ) : ?>
                <option value="<?php echo esc_attr( $type->term_id ); ?>" <?php selected( $selected_developer_type, $type->term_id ); ?>>
                    <?php echo esc_html( $type->name ); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <?php
}

// Save custom meta box data
function save_developer_information( $post_id ) {
    // Check if the nonce is set.
    if ( ! isset( $_POST['developer_information_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['developer_information_nonce'], 'developer_information' ) ) {
        return;
    }

    // Check if the current user has permission to edit the post.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Sanitize the developer email field and update post meta.
    if ( isset( $_POST['developer_email'] ) ) {
        update_post_meta( $post_id, 'developer_email', sanitize_email( $_POST['developer_email'] ) );
    }

    // Sanitize the developer type field and update post meta.
    if ( isset( $_POST['developer_type'] ) ) {
        update_post_meta( $post_id, 'developer_type', sanitize_text_field( $_POST['developer_type'] ) );
    }
}
add_action( 'save_post_developer', 'save_developer_information' );


///

// AJAX callback to submit the form data and create a new Developer post
function create_developer_member() {
    if ( isset( $_POST['action'] ) && $_POST['action'] === 'create_developer_member' ) {
        $name = sanitize_text_field( $_POST['name'] );
        $description = sanitize_textarea_field( $_POST['description'] );
        $email = sanitize_email( $_POST['email'] );
        $developer_type = isset( $_POST['developer_type'] ) ? absint( $_POST['developer_type'] ) : 0;
        $image = $_FILES['image']; // File data

        // Check for required fields before creating the post
        if ( empty( $name ) || empty( $description ) || empty( $email ) || empty( $developer_type ) || empty( $image ) ) {
            wp_send_json_error( 'All fields are required.' );
        }

        // Check for duplicate email before creating the post
        $existing_developer = get_posts( array(
            'post_type' => 'developer',
            'meta_query' => array(
                array(
                    'key' => 'developer_email',
                    'value' => $email,
                ),
            ),
        ) );

        if ( ! empty( $existing_developer ) ) {
            wp_send_json_error( 'A developer with this email already exists.' );
        }

        // Save form data as post meta
        $meta_data = array(
            'developer_name' => $name,
            'developer_description' => $description,
            'developer_email' => $email,
        );

        $post_data = array(
            'post_title'   => $name,
            'post_content' => $description,
            'post_status'  => 'publish',
            'post_type'    => 'developer',
        );

        $post_id = wp_insert_post( $post_data );

        if ( $post_id ) {
            // Set Developer type taxonomy
            wp_set_object_terms( $post_id, $developer_type, 'developer_type' );

            // Save the developer email as post meta
            update_post_meta( $post_id, 'developer_email', $email );

            // Upload and set the featured image
            $attachment_id = upload_featured_image( $image, $post_id );
            if ( $attachment_id ) {
                set_post_thumbnail( $post_id, $attachment_id );
            }

            // Save other form data as post meta
            foreach ( $meta_data as $key => $value ) {
                update_post_meta( $post_id, $key, $value );
            }

            $response = array(
                'success' => true,
                'data'    => array(
                    'message' => 'Developer member added successfully.',
                    'post_id' => $post_id,
                ),
            );

            wp_send_json_success( $response );
        } else {
            wp_send_json_error( 'Failed to create the Developer member.' );
        }
    }

    wp_send_json_error( 'Invalid request.' );
}
add_action( 'wp_ajax_create_developer_member', 'create_developer_member' );
add_action( 'wp_ajax_nopriv_create_developer_member', 'create_developer_member' );

// Shortcode callback to display the form
function developer_form_shortcode() {
    ob_start();
    ?>
    <style>
      #developer-form div {
        margin-bottom: 10px;
      }

      #message-container {
        margin-top: 20px;
      }

      #message-container .success {
        color: green;
      }

      #message-container .error {
        color: red;
      }
    </style>
    <form id="developer-form" enctype="multipart/form-data">
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="developer_type">Developer Type:</label>
            <?php
            $developer_types = get_terms( array(
                'taxonomy' => 'developer_type',
                'hide_empty' => false,
            ) );
            ?>
            <select name="developer_type" id="developer_type" required>
                <option value="">Select Developer Type</option>
                <?php foreach ( $developer_types as $type ) : ?>
                    <option value="<?php echo esc_attr( $type->term_id ); ?>"><?php echo esc_html( $type->name ); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image">
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>
    <div id="message-container"></div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'developer_form', 'developer_form_shortcode' );
