<?php
/**
 * Plugin Name: Portfolio
 * Plugin URI: https://wpdeveloperking.com/
 * Description: A custom plugin to manage portfolios with custom post types and taxonomies And Display portfolio post with shortcode.
 * Version: 1.0.0
 * Author: Mayur Khuman
 * Author URI: https://wpdeveloperking.com/
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}
// include plugin_dir_path(__FILE__) . 'ajax-load-more.php';

// Add link to Plugin Settings
function wpplugin_add_settings_link($links) {
    $settings_link = '<a href="admin.php?page=custom-portfolio-settings">' . __('Settings', 'custom-portfolio-settings') . '</a>';
    array_push($links, $settings_link);
    return $links;
}

$filter_name = "plugin_action_links_" . plugin_basename(__FILE__);
add_filter($filter_name, 'wpplugin_add_settings_link');



function custom_portfolio_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Custom Portfolio Shortcode Syntax', 'custom-portfolio'); ?></h1>
        <p><?php esc_html_e('Use the following shortcode to display your portfolios:', 'custom-portfolio'); ?></p>
        <code>[custom_portfolio limit="5" show_featured_image="true" pagination="true"]</code>
    </div>
    <?php
}
// Add the settings page to the admin menu
function custom_portfolio_settings_menu() {
    add_menu_page(
        esc_html__('Custom Portfolio Settings', 'custom-portfolio'),
        esc_html__('Portfolio Settings', 'custom-portfolio'),
        'manage_options',
        'custom-portfolio-settings',
        'custom_portfolio_settings_page',
        'dashicons-admin-generic',
        30
    );
}
add_action('admin_menu', 'custom_portfolio_settings_menu');



function custom_portfolio_enqueue_scripts() {
    // Enqueue the JavaScript file
    wp_enqueue_script('custom-portfolio-popup', plugin_dir_url(__FILE__) . 'custom-portfolio.js', array('jquery'), '1.0', true);

    // Enqueue the CSS file
    wp_enqueue_style('custom-portfolio-css', plugin_dir_url(__FILE__) . 'portfolio-css.css', array(), '1.0', 'all');
}

add_action('wp_enqueue_scripts', 'custom_portfolio_enqueue_scripts');



function custom_portfolio_register_post_type() {
    $labels = array(
        'name' => 'Portfolios',
        'singular_name' => 'Portfolio',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Portfolio',
        'edit_item' => 'Edit Portfolio',
        'new_item' => 'New Portfolio',
        'view_item' => 'View Portfolio',
        'search_items' => 'Search Portfolios',
        'not_found' => 'No portfolios found',
        'not_found_in_trash' => 'No portfolios found in Trash',
        'parent_item_colon' => 'Parent Portfolio:',
        'menu_name' => 'Portfolios',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'portfolio'),
        'supports' => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('portfolio', $args);
}
add_action('init', 'custom_portfolio_register_post_type');

function custom_portfolio_register_taxonomy() {
    $labels = array(
        'name' => 'Portfolio Categories',
        'singular_name' => 'Portfolio Category',
        'search_items' => 'Search Portfolio Categories',
        'all_items' => 'All Portfolio Categories',
        'parent_item' => 'Parent Portfolio Category',
        'parent_item_colon' => 'Parent Portfolio Category:',
        'edit_item' => 'Edit Portfolio Category',
        'update_item' => 'Update Portfolio Category',
        'add_new_item' => 'Add New Portfolio Category',
        'new_item_name' => 'New Portfolio Category Name',
        'menu_name' => 'Portfolio Categories',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'portfolio-category'),
    );

    register_taxonomy('portfolio_cat', 'portfolio', $args);
}
add_action('init', 'custom_portfolio_register_taxonomy');

// Add Custom Fields
function custom_portfolio_add_custom_fields() {
    add_meta_box(
        'custom_portfolio_text_field',
        'Portfolio Text',
        'custom_portfolio_text_field_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'custom_portfolio_add_custom_fields');

function custom_portfolio_text_field_callback($post) {
    $text_value = get_post_meta($post->ID, '_custom_portfolio_text', true);
    wp_nonce_field('custom_portfolio_text_nonce', 'custom_portfolio_text_nonce');
    ?>
    <p>
        <label for="custom_portfolio_text">Enter text:</label>
        <input type="text" id="custom_portfolio_text" name="custom_portfolio_text" value="<?php echo esc_attr($text_value); ?>" style="width: 100%;">
    </p>
    <?php
}

function custom_portfolio_save_custom_fields($post_id) {
    if (!isset($_POST['custom_portfolio_text_nonce']) || !wp_verify_nonce($_POST['custom_portfolio_text_nonce'], 'custom_portfolio_text_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['custom_portfolio_text'])) {
        update_post_meta($post_id, '_custom_portfolio_text', sanitize_text_field($_POST['custom_portfolio_text']));
    }
}
add_action('save_post', 'custom_portfolio_save_custom_fields');



// Portfolio Shortcode (modified for pagination parameter)
// Portfolio Shortcode (modified for pagination parameter)
function custom_portfolio_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => get_option('custom_portfolio_limit', 5),
        'show_featured_image' => get_option('custom_portfolio_show_image', 'true'),
        'pagination' => 'true', // Default is true
    ), $atts);

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => intval($atts['limit']),
        'paged' => $paged,
    );

    $portfolio_posts = new WP_Query($args);

    $output = '<div class="portfolio-wrapper">';
    while ($portfolio_posts->have_posts()) {
        $portfolio_posts->the_post();
        $output .= '<div class="portfolio-item">';
        if (strtolower($atts['show_featured_image']) === 'true' && has_post_thumbnail()) {
            $output .= '<a class="portfolio-thumbnail-link" href="#popup-' . get_the_ID() . '">';
            $output .= get_the_post_thumbnail(get_the_ID(), 'thumbnail');
            $output .= '</a>';
        }
        $output .= '<h3 class="portfolio-title">' . get_the_title() . '</h3>';
        $output .= '</div>'; // End of the portfolio-item

        // Content for the popup
        $output .= '<div id="popup-' . get_the_ID() . '" class="portfolio-popup">';
        $output .= '<h2 class="popup-title">' . get_the_title() . '</h2>';
        $output .= '<div class="popup-content">' . get_the_content() . '</div>';

        // Get custom field data (Portfolio Text)
        $portfolio_text = get_post_meta(get_the_ID(), '_custom_portfolio_text', true);
        if ($portfolio_text) {
            $output .= '<div class="popup-text">' . $portfolio_text . '</div>';
        }

        // Close button
        $output .= '<button class="portfolio-popup-close">x</button>';

        $output .= '</div>'; // End of the popup
    }
    $output .= '</div>'; // End of the portfolio-wrapper

    // Add pagination if 'pagination' parameter is true
    if (strtolower($atts['pagination']) === 'true') {
        $output .= custom_portfolio_get_pagination($portfolio_posts->max_num_pages);
    }

    wp_reset_postdata();

    return $output;
}
add_shortcode('custom_portfolio', 'custom_portfolio_shortcode');



function custom_portfolio_get_pagination($max_num_pages) {
    global $wp_query;

    $total_posts = $wp_query->found_posts;

    $output = '<div class="portfolio-pagination">';
    $output .= paginate_links(array(
        'type' => 'list',
        'total' => $max_num_pages,
        'current' => max(1, get_query_var('paged')),
        'prev_next' => true,
        'prev_text' => __('« Previous'),
        'next_text' => __('Next »'),
        'mid_size' => 2,
        'end_size' => 1,
    ));
    $output .= '</div>';

    return $output;
}
