<?php
/**
 * Template Name: Comming Soon
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
<div class="comming-soon-page wrapper-container<?php echo esc_attr($boxed); ?>">
    <div class="comming-soon">
        <?php
        while (have_posts()) : the_post();
            the_content();
        endwhile;
        ?>
    </div>
</div>
<?php
wp_footer();
?>
</body>
</html>