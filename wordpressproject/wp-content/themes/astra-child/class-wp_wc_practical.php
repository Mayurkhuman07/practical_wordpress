<?php

/**
 * WP_practical
 */
global $wp_wc_practical_obj;
class WP_WC_practical
{
	function __construct()
	{
		add_action('wp_ajax_content_aria_filter', array( $this, 'content_aria_filter_ajax_handler' ) );
		add_action('wp_ajax_nopriv_content_aria_filter', array( $this, 'content_aria_filter_ajax_handler' ) );
	}
	function content_aria_filter_ajax_handler() {
		if ( isset( $_REQUEST['aria_filter'] ) ) {
			switch ($_REQUEST['aria_filter']) {
				case 'popular':
					$this->wp_best_selling_products();
					break;
				case 'featured':
					$this->wp_featured_products();
					break;
				case 'categories':
					$this->wp_category_list_data();
					break;
				default:
					$this->wp_featured_products();
					$this->wp_best_selling_products();
					$this->wp_category_list_data();
					break;
			}
		}
		exit();
	}
	public function wp_featured_products()	{
		echo '<div class="featured_products"><h2>featured products</h2>'.do_shortcode('[featured_products limit="3"]').'</div>';
	}
	public function wp_best_selling_products() {
		echo '<div class="best_selling_products"><h2>Best selling products</h2><ul class="products columns-4">';
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 6,
            'post_status' => 'publish',
            'meta_key' => 'total_sales',
            'orderby' => 'meta_value_num',
            'meta_key' => '_price',
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key'       => 'total_sales',
                    'compare'   => 'EXISTS'
                )
            ),
        );
        $best_selling_products = new WP_Query( $args );
        if ($best_selling_products->have_posts() ) : 
            while ($best_selling_products->have_posts() ) : $best_selling_products->the_post();
                wc_get_template_part( 'content', 'product' );
            endwhile;
        endif;
        echo '</ul></div>';
	}
	public function wp_category_list_data() {
		echo '<div class="category_filter_container"><h2>Category</h2>'.do_shortcode('[product_categories]').'</div>';
	}
}
$wp_wc_practical_obj = new WP_WC_practical();