<?php
/**
 * Template for displaying default template Products element.
 *
 * This template can be overridden by copying it to yourtheme/physc-builder/products/products.php.
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
if ( !function_exists( 'sale_flash' ) ) {

	function sale_flash() {
		global $product;
		$price             = $product->get_price();
		$get_regular_price = $product->get_regular_price();
		$sale              = '';
		if ( $get_regular_price > $price && $product->product_type == 'simple' ) {
			$sale = ( ( $get_regular_price - $price ) / $get_regular_price ) * 100;
			$sale = round( $sale );
		}
		ob_start();
		if ( $sale ) {
			echo '<span class="onsale">-' . $sale . '%</span>';
		}
		$data = ob_get_clean();

		return $data;
	}
}

// global params
$title       = $params['title'];
$bg_color_sc = $params['bg_color_sc'];
$color_sc    = $params['color_sc'];
$product_id  = $params['product_id'];
$image_left  = $params['image_left'];
$style_sc    = $params['bg_color_sc'] ? 'background-color:' . $params['bg_color_sc'] . ';' : '';
$style_sc    .= $params['color_sc'] ? 'color:' . $params['color_sc'] . ';' : '';
$style       = $style_sc ? ' style="' . $style_sc . '"' : '';

$phys_builder_animation = $params['el_class'] ? ' ' . $params['el_class'] : '';
$link_image             = $image_left ? wp_get_attachment_image_src( $image_left, 'full' ) : '';
echo '<div class="flash-sale-countdown' . $phys_builder_animation . '"' . $style . '>';
if ( $product_id ) {
	$dates_from   = get_post_meta( $product_id, '_sale_price_dates_from', true );
	$dates_to     = get_post_meta( $product_id, '_sale_price_dates_to', true );
	$current_time = strtotime( 'NOW', current_time( 'timestamp' ) );


	if ( $link_image ) {
		echo '<div class="wrap-image"><img src="' . $link_image[0] . '" alt="banner">';
//	if ( ( $dates_from < $current_time ) && ( $current_time < $dates_to ) ) {
		$dates_from_1 = date( 'M j, Y H:i:s O', $dates_to );
		echo '<div class="wrap-countdown"><div class="countdown" data-time="' . esc_attr( $dates_from_1 ) . '"></div></div>';
//	}
		echo '</div>';
	}
	echo '<div class="content-right"><div class="content-inner">';

	$query_args = array(
		'post_status' => 'publish',
		'post_type'   => 'product',
		'p'           => $product_id,
	);
	$r          = new WP_Query( $query_args );

	if ( $r->have_posts() ) {
		while ( $r->have_posts() ) {
			$r->the_post();
			$product           = wc_get_product( get_the_ID() );
			$price             = $product->get_price();
			$get_regular_price = $product->get_regular_price();
			$sale              = ( ( $get_regular_price - $price ) / $get_regular_price ) * 100;
			$sale              = round( $sale );
			if ( $sale ) {
				echo '<span class="onsale">-' . $sale . '%</span>';
			}
			if ( $title ) {
				echo '<p class="title">' . $title . '</p>';
			}
			// title
			do_action( 'woocommerce_shop_loop_item_title' );
			// desc
			do_action( 'woocommerce_shop_loop_item_desc' );
			// price
			echo woocommerce_template_loop_price();

			// add to cart
			echo woocommerce_template_loop_add_to_cart();

		}
	}
	wp_reset_postdata();

	echo '</div></div>';
} else {
	echo '<p>' . esc_html__( 'Please choose a product', 'physc-builder' ) . '</p>';
}

echo '</div>';