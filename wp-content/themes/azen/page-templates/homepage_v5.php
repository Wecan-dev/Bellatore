<?php
/**
 * Template Name: Home page 5
 *
 **/
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<?php
$boxed = azen_get_option('box_layout') == 'boxed' ? ' boxed-area' : '';
?>
<body <?php body_class(); ?>>
<div class=" homepage-v5 wrapper-container">
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
    <?php if (azen_get_option('box_layout') == 'boxed') {
        echo '<div class="container content-hp5">';
    }
    ?>

    <header id="masthead" class="site-header">
        <div class="affix-top header-hp-1 style-header-hp-1">
            <div id="js-navbar-fixed" class="menu-desktop">
                <div class="menu-desktop-inner">
                    <!-- Logo -->
                    <?php
                    echo '<div class="menu-mobile-effect hamburger hamburger--spin"><div class="hamburger-box">
							<span class="hamburger-inner"></span> 
						</div></div>';
                    do_action('azen_logo');
                    ?>
                    <div class="space-header"></div>
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        <?php
                        get_template_part('inc/header/main-menu');
                        ?>
                    </nav>
                    <!-- Header Right -->
                    <?php if (is_active_sidebar('menu_right')) {
                        echo '<div class="header-right">';
                        dynamic_sidebar('menu_right');
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </header>
    <div class="site page-content">
        <div class="home-content" role="main">
            <?php
            // Start the Loop.
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
    <!-- #content -->
    <?php

    if (is_active_sidebar('footer')) {
        echo '<div id="wrapper-footer" class="wrapper-footer"><div class="container"><div class="row">';
        dynamic_sidebar('footer');
        echo '</div></div></div>';
    }
    ?>

</div><!--end wrapper-container-->
<?php if (azen_get_option('box_layout') == 'boxed') {
    echo '</div>';
}
?>
<?php
if (azen_get_option('totop_show') == 1) {
    echo '<span class="footer__arrow-top">TOP</span>';
}
wp_footer();
?>
</body>
</html>

