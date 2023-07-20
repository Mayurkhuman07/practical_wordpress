<?php /* Template Name: Product page vrsvs */ 

get_header();
?>
<div class="container">

<?php
// Display 3 featured products at the top
$featured_products = wc_get_products(array(
    'status' => 'publish',
    'limit' => 3,
    'featured' => true,
));
// echo '<pre>';
// var_dump($featured_products);
// echo '</pre>';
if ($featured_products) :
    echo '<h2 class="section-title">Featured Products</h2>';
    echo '<div class="product-container">';
    foreach ($featured_products as $product) {
           echo '<div class="product-item">';
        // Display the product image with the link to the product page
        echo '<a href="' . esc_url(get_permalink($product->get_id())) . '">';
        echo '<div class="product-image">' . $product->get_image() . '</div>';
        echo '</a>';

        // Display the product name with the link to the product page
        echo '<a href="' . esc_url(get_permalink($product->get_id())) . '">';
        echo '<h4 class="product-name">' . esc_html($product->get_name()) . '</h4>';
        echo '</a>';
        // Display the add to cart button
        echo '<div class="add-to-cart">' . do_shortcode('[add_to_cart id="' . $product->get_id() . '"]') . '</div>';

        echo '</div>';
    }
    echo '</div>';
endif;



// Display 6 popular products with pricing high to low
$popular_products = wc_get_products(array(
    'status' => 'publish',
    'limit' => 6,
    'orderby' => 'meta_value_num',
    'meta_key' => '_price',
    'order' => 'DESC',
));

if ($popular_products) :
    echo '<h2 class="section-title">Popular Products + Pricing High to Low</h2>';
    echo '<div class="product-container">';
    foreach ($popular_products as $product) {
         echo '<div class="product-item">';
        // Display the product image with the link to the product page
        echo '<a href="' . esc_url(get_permalink($product->get_id())) . '">';
        echo '<div class="product-image">' . $product->get_image() . '</div>';
        echo '</a>';

        // Display the product name with the link to the product page
        echo '<a href="' . esc_url(get_permalink($product->get_id())) . '">';
        echo '<h4 class="product-name">' . esc_html($product->get_name()) . '</h4>';
        echo '</a>';
        // Display the add to cart button
        echo '<div class="add-to-cart">' . do_shortcode('[add_to_cart id="' . $product->get_id() . '"]') . '</div>';

        echo '</div>';
    }
    echo '</div>';
endif;

?>
<!-- Step 3: Categories - New and Old -->
<h2 class="section-title">Categories</h2>
<div class="categories">

    <!-- New Category -->
    <div class="category-container">
        <h3 class="category-title">New</h3>

        <?php
        $new_category_products = wc_get_products(array(
            'status' => 'publish',
            'limit' => 4, // Display 4 products from the "New" category
            'category' => array('new') // Replace 'new' with the slug of your "New" category
        ));

        if ($new_category_products) {
            echo '<div class="product-container">';
            foreach ($new_category_products as $product) {
                     echo '<div class="product-item">';
        // Display the product image with the link to the product page
        echo '<a href="' . esc_url(get_permalink($product->get_id())) . '">';
        echo '<div class="product-image">' . $product->get_image() . '</div>';
        echo '</a>';

        // Display the product name with the link to the product page
        echo '<a href="' . esc_url(get_permalink($product->get_id())) . '">';
        echo '<h4 class="product-name">' . esc_html($product->get_name()) . '</h4>';
        echo '</a>';
        // Display the add to cart button
        echo '<div class="add-to-cart">' . do_shortcode('[add_to_cart id="' . $product->get_id() . '"]') . '</div>';

        echo '</div>';
            }
            echo '</div>';
        }
        ?>
    </div>

    <!-- Old Category -->
    <div class="category-container">
        <h3 class="category-title">Old</h3>

        <?php
        $old_category_products = wc_get_products(array(
            'status' => 'publish',
            'limit' => 4, // Display 4 products from the "Old" category
            'category' => array('old') // Replace 'old' with the slug of your "Old" category
        ));

        if ($old_category_products) {
            echo '<div class="product-container">';
            foreach ($old_category_products as $product) {
           	echo '<div class="product-item">';
	        // Display the product image with the link to the product page
	        echo '<a href="' . esc_url(get_permalink($product->get_id())) . '">';
	        echo '<div class="product-image">' . $product->get_image() . '</div>';
	        echo '</a>';

	        // Display the product name with the link to the product page
	        echo '<a href="' . esc_url(get_permalink($product->get_id())) . '">';
	        echo '<h4 class="product-name">' . esc_html($product->get_name()) . '</h4>';
	        echo '</a>';
	        // Display the add to cart button
	        echo '<div class="add-to-cart">' . do_shortcode('[add_to_cart id="' . $product->get_id() . '"]') . '</div>';

	        echo '</div>';
            }
            echo '</div>';
        }
        ?>
    </div>
</div>



<?php
get_footer();
