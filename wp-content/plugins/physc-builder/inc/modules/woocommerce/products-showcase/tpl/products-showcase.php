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
$product_visibility_term_ids = wc_get_product_visibility_term_ids();

$product_cat     = $params['product_cat'];
$show            = $params['show'];
$orderby         = $params['orderby'];
$order           = $params['order'];
$limit           = $params['limit'];
$phys_builder_animation = $params['el_class'] ? ' ' . $params['el_class'] : '';

$query_args = array(
	'posts_per_page' => $limit,
	'post_status'    => 'publish',
	'post_type'      => 'product',
	'no_found_rows'  => 1,
	'order'          => $order == 'asc' ? 'asc' : 'desc'
);

if ( $show == 'cats' && $product_cat <> '' ) {
	$cats_id                 = explode( ',', $product_cat );
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'term_id',
			'terms'    => $cats_id
		)
	);
}
$query_args['meta_query'] = array();

switch ( $show ) {
	case 'featured' :
		$query_args['tax_query'][] = array(
			'taxonomy' => 'product_visibility',
			'field'    => 'term_taxonomy_id',
			'terms'    => $product_visibility_term_ids['featured'],
		);
		break;
	case 'onsale' :
		$product_ids_on_sale    = wc_get_product_ids_on_sale();
		$product_ids_on_sale[]  = 0;
		$query_args['post__in'] = $product_ids_on_sale;
		break;
}

switch ( $orderby ) {
	case 'price' :
		$query_args['meta_key'] = '_price';
		$query_args['orderby']  = 'meta_value_num';
		break;
	case 'rand' :
		$query_args['orderby'] = 'rand';
		break;
	case 'sales' :
		$query_args['meta_key'] = 'total_sales';
		$query_args['orderby']  = 'meta_value_num';
		break;
	default :
		$query_args['orderby'] = 'date';
}

$r = new WP_Query( apply_filters( 'physc-builder/products-query', $query_args ) );
if ( $r->have_posts() ) {
	echo '<div class="sc-product-showcase' . $phys_builder_animation . '">';

	while ( $r->have_posts() ) {
		$r->the_post();
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 * @hooked woocommerce_template_loop_product_div_open - 1 (<div class="inner-item-product">)
		 */
		do_action( 'woocommerce_before_shop_loop_item' );
		echo '<div class="product-image">';
		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_before_shop_loop_item_open - 1 (<div class="<div class="product-image">">)
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 * @hooked woocommerce_before_shop_loop_item_close - 90 (</div>)
		 */

		echo '<a href="' . esc_url( get_the_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '" class="wp-post-image">';
		echo woocommerce_get_product_thumbnail( 'shop_single' );
		echo '</a>';

		echo '</div>';

		echo '<div class="wrapper-content-item"><div class="entry-summary">';
		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );

		do_action( 'woocommerce_shop_loop_item_desc' );

		/**
		 * Hook: woocommerce_after_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );

		/**
		 * Hook: woocommerce_after_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		echo '</div>';
		/**
		 * Hook: woocommerce_gallery_showcase.
		 *
		 * @hooked woocommerce_slider_gallery - 5
		 */
		do_action( 'woocommerce_gallery_showcase' );

		echo '</div>';
		/**
		 * Hook: woocommerce_after_loop_product_div_close.
		 *
		 * @hooked woocommerce_template_loop_product_div_close - 5 </div>
		 */
		do_action( 'woocommerce_after_loop_product_div_close' );


	}

	echo '</div>';
}
wp_reset_postdata();
?>