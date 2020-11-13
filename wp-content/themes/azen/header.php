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
}
?>
<div class="<?php echo esc_attr($class); ?> wrapper-container<?php echo esc_attr($boxed); ?>">
    <?php
    echo '<div class="minicart-content woocommerce">
    <div class="widget_shopping_cart_contents">
        <p class="close-cart">'.esc_html__('Close','azen').'</p>
        <div class="widget_shopping_cart_content">
         </div>
         </div>
        <div class="background-overlay-cart"></div>
    </div>';
    ?>
    <?php if (is_active_sidebar('top_bar') && azen_get_option('main_menu_style') == 'header_v3') {
        echo '<div class="top-bar"><div class="container-fluid"><div class="row">';
        dynamic_sidebar('top_bar');
        echo '</div></div></div>';
    }
    ?>
    <?php if(azen_get_option('main_menu_style','header_v1') == 'header_v1') {
        echo '<div class="container container-box-header1">';
    } ?>
    <header id="masthead" class="site-header">
        <?php
        get_template_part('inc/header/' . azen_get_option('main_menu_style', 'header_v1'));
        ?>
    </header>
    <?php if(azen_get_option('main_menu_style','header_v1') == 'header_v1') {
        echo '</div>';
    } ?>


    <div class="site page-content">