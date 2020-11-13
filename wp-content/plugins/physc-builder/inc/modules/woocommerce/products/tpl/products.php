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


$template_path = $params['template_path'];

$layout = isset( $params['layout'] ) ? $params['layout'] : 'layout-1';

$title           = $params['title'];
$speed_slider          = $params['speed_slider'];
$element_tag     = $params['element_tag'];
$title_color     = $params['title_color'];
$product_cat     = $params['product_cat'];
$show            = $params['show'];
$orderby         = $params['orderby'];
$order           = $params['order'];
$limit           = $params['limit'];
$show_arrows     = $params['show_arrows'];
$show_dots       = $params['show_dots'];
$column          = $params['column'];
$show_view_more  = $params['show_view_more'];
$text_view_more  = $params['text_view_more'];
$phys_builder_animation = $params['el_class'] ? ' ' . $params['el_class'] : '';
$phys_builder_animation .= ' featured-' . $layout;

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

echo '<div class="wc-sc-product woocommerce' . $phys_builder_animation . '">';

physc_builder_get_template( $layout,
	array(
		'title'          => $title,
		'title_color'    => $title_color,
		'element_tag'    => $element_tag,
		'column'         => $column,
        'show_arrows'    => $show_arrows,
        'show_dots'      => $show_dots,
		'show_view_more' => $show_view_more,
		'speed_slider' => $speed_slider,
		'text_view_more' => $text_view_more,
		'r'              => $r,
	),
	$template_path );

echo '</div>';
?>