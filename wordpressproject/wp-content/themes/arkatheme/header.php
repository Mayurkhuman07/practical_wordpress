<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package arkatheme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="dark-mode">
  <header id="masthead" class="header">
    <div class="navbar">
      <div class="your-name">Your Name</div>
      <div class="menu">
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'menu-1',
            'menu_id' => '43',
          )
        );
        ?>
        <?php if (!is_single()) { ?>
          <div class="toggle-mode">
            <img class="iconoutlinesun1" alt="" src="<?php echo get_template_directory_uri(); ?>/images/iconoutlinesun1.svg">

            <div class="iconoutlinemoon1" id="iconoutlinemoonContainer">
              <img class="moon-icon1" alt="" src="<?php echo get_template_directory_uri(); ?>/images/moon1.svg">
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </header><!-- #masthead -->

  <div id="content">

