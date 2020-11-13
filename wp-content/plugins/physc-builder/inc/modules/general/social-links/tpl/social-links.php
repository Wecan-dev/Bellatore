<?php
/**
 * Template for displaying default template Posts element.
 *
 * This template can be overridden by copying it to yourtheme/physc-builder/posts/categories.php.
 *
 * @author      Physcodes
 * @package     PhyscBuilders/Templates
 * @version     1.0.0
 * @author      Physcodes
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

/**
 * @var $params array - shortcode params
 */
$face_url                = $params['face_url'];
$twitter_url             = $params['twitter_url'];
$google_url              = $params['google_url'];
$dribble_url             = $params['dribble_url'];
$linkedin_url            = $params['linkedin_url'];
$instagram_url           = $params['instagram_url'];
$youtube_url             = $params['youtube_url'];
$behance_url             = $params['behance_url'];
$physc_builder_animation = $params['el_class'] ? ' ' . $params['el_class'] : '';

echo '<ul class="physcode_social_links' . $physc_builder_animation . '">';

if ( $face_url != '' ) {
	echo '<li><a class="face" href="' . esc_url( $face_url ) . '" ><i class="fa fa-facebook"></i></a></li>';
}
if ( $twitter_url != '' ) {
	echo '<li><a class="twitter" href="' . esc_url( $twitter_url ) . '"  ><i class="fa fa-twitter"></i></a></li>';
}
if ( $google_url != '' ) {
	echo '<li><a class="google" href="' . esc_url( $google_url ) . '"  ><i class="fa fa-google-plus"></i></a></li>';
}
if ( $dribble_url != '' ) {
	echo '<li><a class="dribble" href="' . esc_url( $dribble_url ) . '"  ><i class="fa fa-dribbble"></i></a></li>';
}
if ( $linkedin_url != '' ) {
	echo '<li><a class="linkedin" href="' . esc_url( $linkedin_url ) . '"  ><i class="fa fa-linkedin"></i></a></li>';
}

if ( $instagram_url != '' ) {
	echo '<li><a class="instagram" href="' . esc_url( $instagram_url ) . '"  ><i class="fa fa-instagram"></i></a></li>';
}
if ( $youtube_url != '' ) {
	echo '<li><a class="youtube" href="' . esc_url( $youtube_url ) . '"  ><i class="fa fa-youtube"></i></a></li>';
}
if ( $behance_url != '' ) {
	echo '<li><a class="behance" href="' . esc_url( $behance_url ) . '"  ><i class="fa fa-behance"></i></a></li>';
}
echo '</ul>';


?>
