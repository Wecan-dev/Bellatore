<?php
/**
 * Template Name: Home Page
 *
 **/
?>
<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package azen
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>
<?php
if (azen_get_option('show_preload') == '1') {
    echo '<div class="images-preloader" id="preload">
			<div id="preloader_1" class="rectangle-bounce">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>';
}

$class_header = azen_get_option('sticky_menu') == '1' ? ' sticky_header' : '';
$boxed = azen_get_option('box_layout') == 'boxed' ? ' boxed-area' : '';
?>
<?php
$class = '';
if (azen_get_option('main_menu_style') == 'header_v3') {
    $class = 'homepage-v3';
} elseif (azen_get_option('set-header-homepage') == '1' && azen_get_option('main_menu_style') == 'header_v2') {
    $class = 'homepage-v4';
} elseif (azen_get_option('set-header-homepage') == '2' && azen_get_option('box_layout') == 'boxed' && azen_get_option('main_menu_style') == 'header_v1') {
    $class = 'homepage-v5';
} elseif (azen_get_option('set-header-homepage') == '3') {
    $class = 'homepage-v6';
}
?>
<div class="<?php echo esc_attr($class); ?> wrapper-container<?php echo esc_attr($boxed); ?>">
<?php
echo '<div class="minicart-content woocommerce">
    <div class="widget_shopping_cart_contents">
        <p class="close-cart">close</p>
        <div class="widget_shopping_cart_content">
         </div>
         </div>
        <div class="background-overlay-cart"></div>
    </div>';
?>

    <!--homepage 3-->
<?php if (is_active_sidebar('top_bar') && azen_get_option('main_menu_style') == 'header_v3') {
    echo '<div class="top-bar"><div class="container-fluid"><div class="row">';
    dynamic_sidebar('top_bar');
    echo '</div></div></div>';
}
?>
    <!--homepage 5-->
<?php if (azen_get_option('box_layout') == 'boxed' && azen_get_option('set-header-homepage') == '2' && azen_get_option('main_menu_style') == 'header_v1') {
    echo '<div class="container content-hp5">';
}
?>
    <!--homepage 6-->
<?php if (is_active_sidebar('slider-before-header') && azen_get_option('set-header-homepage') == '3' && azen_get_option('main_menu_style') == 'header_v1') {
    dynamic_sidebar('slider-before-header');
    echo '<div class="container container-box-header1">';
}
?>
    <!--homepage 1-->
<?php if (azen_get_option('main_menu_style') == 'header_v1') {
    echo '<div class="container container-box-header1">';
} ?>

    <header id="masthead" class="site-header">
        <?php
        //  homepage 4
        if (azen_get_option('set-header-homepage') == '1' && azen_get_option('main_menu_style') == 'header_v2') {
            get_template_part('inc/header/header_v4');
        } else {
            get_template_part('inc/header/' . azen_get_option('main_menu_style', 'header_v1'));
        }
        ?>
    </header>


    <!--homepage 1-->
<?php if (azen_get_option('main_menu_style') == 'header_v1') {
    echo '</div>';
} ?>

    <!--homepage 6-->
<?php if (is_active_sidebar('slider-before-header') && azen_get_option('set-header-homepage') == '3' && azen_get_option('main_menu_style') == 'header_v1') {
    echo '</div>';
} ?>


    <div class="site page-content">
    <div class="home-content" role="main">
        <div class="container">
            <?php

            // Start the Loop.
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div><!-- #main-content -->
<?php get_footer();