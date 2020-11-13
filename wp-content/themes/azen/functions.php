<?php
/**
 * azen functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package azen
 */

// Constants: Folder directories/uri's
define( 'AZEN_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'AZEN_THEME_URI', trailingslashit( get_template_directory_uri() ) );

/**
 * Theme Includes
 */

require_once AZEN_THEME_DIR . 'inc/init.php';
add_filter( 'woocommerce_get_image_size_single', 'azen_theme_override_woocommerce_image_size_single' );
function azen_theme_override_woocommerce_image_size_single( $size ) {
	return array(
		'width'  => get_option( 'woocommerce_single_image_width' ),
		'height' => get_option( 'woocommerce_single_image_width' ),
		'crop'   => 1,
	);
}