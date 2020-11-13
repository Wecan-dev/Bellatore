<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package azen
 */
?>
</div><!-- #content -->

<?php

if ( is_active_sidebar( 'footer' ) ) {
	echo '<div id="wrapper-footer" class="wrapper-footer"><div class="container"><div class="row">';
	dynamic_sidebar( 'footer' );
	echo '</div></div></div>';
}
?>

</div><!--end wrapper-container-->


<?php if (azen_get_option('box_layout') == 'boxed' && azen_get_option('set-header-homepage') == '2' && azen_get_option('main_menu_style') == 'header_v1') {
    echo '</div>';
}
?>


<?php
if ( azen_get_option( 'totop_show' ) == 1 ) {
	echo '<span class="footer__arrow-top">'.esc_html__('TOP','azen').'</span>';
}
wp_footer();
?>
</body>
</html>
