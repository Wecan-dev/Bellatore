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

// global params
$product_cat            = $params['product_cat'];
$phys_builder_animation = $params['el_class'] ? ' ' . $params['el_class'] : '';

echo '<div class="categories-hp-1' . $phys_builder_animation . '">';
if ( $product_cat <> '' ) {
	echo '<div class="categories-detail">';
	$term = get_term( $product_cat, 'product_cat' );

	if ( is_wp_error( $term ) ) {
	} else {
		if ( empty( $term ) ) {
		} else {
			$term_link = get_term_link( $term );
			$meta      = get_term_meta( $product_cat );
			if ( $meta ) {
				if ( isset( $meta['thumbnail_id'][0] ) ) {
					$thumbnail_id = $meta['thumbnail_id'][0];
					$image        = wp_get_attachment_url( $thumbnail_id );
					echo '<a href="' . $term_link . '" class="images" title="' . $term->name . '"><img src="' . $image . '" alt="' . $term->name . '" /></a>';
				} else {
					$string = wc_placeholder_img_src( 'full' );
					echo '<a href="' . $term_link . '" class="images" title="' . $term->name . '"><img src="' . $string . '" alt="' . $term->name . '" /></a>';
				}
			}
			echo '<div class="product"><a href="' . $term_link . '" title="' . $term->name . '">
										<span class="name"> <span class="line">- </span>' . $term->name . '</span>
										<span class="quantity">- ' . $term->count . ' ' . esc_html__( 'Products', 'physc-builder' ) . '</span>
									</a>
								</div>';
		}
	}
	echo '</div>';
}
echo '</div>';
?>