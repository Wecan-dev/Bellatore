<?php
/**
 * Template for displaying default template Countdown element.
 *
 * This template can be overridden by copying it to yourtheme/physc-builder/countdown/countdown.php.
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

if ( !$params['countdown-date'] ) {
	return false;
}

$title              = $params['title'];
$countdown_date     = $params['countdown-date'];
$before_title       = $params['before_title'];
$before_title_color = $params['before_title_color'];
$element_tag        = $params['element_tag'];
$title_color        = $params['title_color'];
$bg_image           = $params['bg_image'];
$show_view_more     = $params['show_view_more'];
$text_view_more     = $params['text_view_more'];
$link_view_more     = $params['link_view_more'];
$phys_builder_animation    = $params['el_class'] ? ' ' . $params['el_class'] : '';

$link_image      = $bg_image ? wp_get_attachment_image_src( $bg_image, 'full' ) : '';
$style           = $link_image ? ' style="background-image: url(' . $link_image[0] . ')"' : '';
$style_before_tt = $before_title_color ? ' style="color: ' . $before_title_color . '"' : '';
$style_title     = $title_color ? ' style="color: ' . $title_color . '"' : '';
echo '<div class="deal-hp-2' . $phys_builder_animation . '"><div class="deal-content"' . $style . '>';
if ( $before_title ) {
	echo '<p' . $style_before_tt . '>' . $before_title . '</p>';
}
if ( $title ) {
	echo '<' . $element_tag . ' class="special-heading"' . $style_title . '>' . $title . '</' . $element_tag . '>';
}
$date = new DateTime( date( 'Y-m-d H:i', strtotime( $countdown_date ) ) );
echo '<div class="wrap-countdown"><div class="countdown" data-time="' . esc_attr( $date->format( 'M j, Y H:i:s O' ) ) . '"></div></div>';

if ( $show_view_more == 'true' ) {
	echo '<div class="shop">
		<a href="' . $link_view_more . '" class="au-btn btn-small">' . $text_view_more . '<i class="zmdi zmdi-arrow-right"></i></a>
	</div>';
}
echo '</div></div>';
?>
<?php ?>