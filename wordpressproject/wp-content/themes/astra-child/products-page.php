<?php /* Template Name: Product page */ 

get_header();
global $wp_wc_practical_obj;
?>
<div class="container">
    <div class="filter_aria">
        <select name="content_aria_filter">
            <option value="">Select Content Type</option>
            <option value="popular">Show only Popular</option>
            <option value="featured">Show only featured</option>
            <option value="categories">Show only categories</option>
        </select>
    </div>
    <div class="filter_aria_product">
        <?php
            $wp_wc_practical_obj->wp_featured_products();
            $wp_wc_practical_obj->wp_best_selling_products();
            $wp_wc_practical_obj->wp_category_list_data();
        ?>
    </div>
</div>
<style>
    li.product {
        width: 25% !important;
    }
</style>
<script type="text/javascript">
    const ajaxurl = "<?php echo admin_url('admin-ajax.php')?>";
    jQuery(document).on('change','select[name="content_aria_filter"]',function(e){
        let content_aria_filter = jQuery(this).val();
        let load_more_data = {action: "content_aria_filter",aria_filter: content_aria_filter};
        jQuery.ajax({url: ajaxurl,data: load_more_data,type: "POST", beforeSend: function(e) {
                jQuery(".container").css({'opacity': '0.5','cursor':'progress'});
            }, success: function(res){
                jQuery(".container").css({'opacity': '','cursor':''});
                jQuery('.filter_aria_product').html(res);
            }
        });
    });
</script>
<?php get_footer(); ?>