<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package arkatheme
 */

?>
</div><!-- #page -->
<footer id="colophon-1" class="footer">
    <div>
        <div class="container5">
            <div class="div">© <?php echo date('Y'); ?></div>
            <?php
            wp_nav_menu(array(
                'menu_id' => '56',
            ));
            ?>
        </div>
    </div>
</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>
