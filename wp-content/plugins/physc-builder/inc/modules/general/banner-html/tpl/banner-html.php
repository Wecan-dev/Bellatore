<?php
/**
 * Template for displaying default template Products element.
 *
 * This template can be overridden by copying it to yourtheme/physc-builder/banner-html/banner-html.php.
 *
 * @author      Physcode
 * @package     PhyscBuilders/Templates
 * @version     1.0.0
 * @author      Physcodes
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

$layout     = $params['layout'];
$text_align = $params['text_align'];

$thumbnail_image = $params['thumbnail_image'];
$link_banner     = $params['link_banner'];
$text_1          = $params['text_1'];
$text_1_color    = $params['text_1_color'];
$bg_text_1_color = $params['bg_text_1_color'];
$text_2          = $params['text_2'];
$text_2_color    = $params['text_2_color'];
$text_btn_color  = $params['text_btn_color'];
$show_button     = $params['show_button'];
$text_button     = $params['text_button'];

$css_text_1      = $bg_text_1_color ? ' background-color:' . $bg_text_1_color . ';' : '';
$css_text_1      .= $text_1_color ? ' color:' . $text_1_color : '';
$style_text_1    = $css_text_1 ? ' style="' . $css_text_1 . '"' : '';
$style_text_2    = $text_2_color ? ' style="color:' . $text_2_color . '"' : '';
$style_btn_color = $text_2_color ? ' style="color:' . $text_btn_color . '"' : '';
$phys_builder_animation = $params['el_class'] ? ' ' . $params['el_class'] : '';

$link_image = $thumbnail_image ? wp_get_attachment_image_src( $thumbnail_image, 'full' ) : '';
echo '<div class="banner-section' . $phys_builder_animation . '">';
echo '<div class="banner-' . $layout . ' text_' . $text_align . '">';
if ( $link_image ) {
	echo '<div class="wrap-image"><a href="' . $link_banner . '" class="bg-image"><img src="' . $link_image[0] . '" alt="banner"></a></div>';
}
echo '<div class="info">';
if ( $text_1 ) {
	echo '<p class="text-1"' . $style_text_1 . '>' . $text_1 . '</p>';
}
if ( $text_2 ) {
	echo '<p class="text-2"' . $style_text_2 . '>' . $text_2 . '</p>';
}
if ( $show_button == 'true' ) {
	echo '<a href="' . $link_banner . '" class="shop"' . $style_btn_color . '>' . $text_button . '<i class="zmdi zmdi-arrow-right"></i></a>';
}

echo '</div></div>';
echo '</div>';