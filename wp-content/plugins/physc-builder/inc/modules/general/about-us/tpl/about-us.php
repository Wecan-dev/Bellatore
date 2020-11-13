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


$thumbnail_image = $params['thumbnail_image'];
$title           = $params['title'];
$element_tag     = $params['element_tag'];
$title_color     = $params['title_color'];
 $content         = $params['desc'];
 $signature_image = $params['signature_image'];
$name            = $params['name'];
$works           = $params['works'];
$css_title_color = $title_color ? ' style="color:' . $title_color . '"' : '';

$link_image           = $thumbnail_image ? wp_get_attachment_image_src( $thumbnail_image, 'full' ) : '';
$link_signature_image = $signature_image ? wp_get_attachment_image_src( $signature_image, 'full' ) : '';
$phys_builder_animation      = $params['el_class'] ? ' ' . $params['el_class'] : '';

echo '<div class="story-about-section' . $phys_builder_animation . '"><div class="story-content row">';
if ( $link_image ) {
	echo '<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
								<div class="images">
									<img src="' . $link_image[0] . '" alt="story">
								</div>
							</div>';
}
echo '<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12"><div class="story-detail">';
if ( $title ) {
	echo '<' . $element_tag . ' class="special-heading"' . $css_title_color . '>' . $title . '</' . $element_tag . '>';
}
if ( $content ) {
	echo '<div class="desc">' . $content . '</div>';
}
if ( $link_signature_image || $name || $works ) {
	echo '<div class="info">';
	if ( $link_signature_image ) {
		echo '<div class="images"><img src="' . $link_signature_image[0] . '" alt="signatures"></div>';
	}
	if ( $name || $works ) {
		echo '<div class="author">';
		if ( $name ) {
			echo '<span class="name">' . $name . '</span>';
		}
		if ( $works ) {
			echo '<span class="job">-  ' . $works . '  -</span>';
		}
		echo '</div>';
	}

	echo '</div>';
}

echo '</div></div>';

echo '</div></div>';