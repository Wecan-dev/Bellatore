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
$items_tab              = $params['items_tab'];
 $phys_builder_animation = $params['el_class'] ? ' ' . $params['el_class'] : '';
echo '<div class="wc-sc-product-tab woocommerce' . $phys_builder_animation . '">';
if ( count( $items_tab ) > 0 ) {
	echo '<ul class="nav nav-tabs" role="tablist">';
 	$rand_number = rand( 1, 100 );
	$i           = $j = 1;
	foreach ( $items_tab as $item_tab ) {
		$class       = '';
		$show        = isset( $item_tab['show'] ) ? $item_tab['show'] : '';
        $orderby        = isset( $item_tab['orderby'] ) ? $item_tab['orderby'] : 'date';
        $order      = isset( $item_tab['order'] ) ? $item_tab['order'] : 'asc';
		$product_cat = isset( $item_tab['product_cat'] ) ? $item_tab['product_cat'] : '';
		if ( $i == 1 ) {
			$class = " active";
		}
		if ( $show == '' && $orderby == 'date' && $order=='desc') {
			$title_tab = esc_attr__( 'New', 'azen' );
		}
        elseif ( $show == '' && $orderby == 'sales' && $order=='desc') {
            $title_tab = esc_attr__( 'Hot', 'azen' );
        }
        elseif ( $show == 'featured' ) {
			$title_tab = esc_attr__( 'Featured', 'azen' );
		} elseif ( $show == 'onsale' ) {
			$title_tab = esc_attr__( 'OnSale', 'azen' );
		} else {
			if ( $product_cat ) {
				$term      = get_term_by( 'id', $product_cat, 'product_cat' );
				if ( empty( $term ) ) {
					$title_tab = '';
				}else{
					$title_tab = $term->name;
				}

			} else {
				$title_tab = esc_attr__( 'All', 'azen' );
			}
		}
		echo '<li class="nav-item"><a class="nav-link' . $class . '" data-toggle="tab" href="#' . sanitize_title( $title_tab ) . '-' . $rand_number . '" role="tab">' . $title_tab . '</a></li>';
		$i ++;
	}
	echo '</ul><div class="tab-content">';
	foreach ( $items_tab as $item_tab ) {
		$class = '';
		if ( $j == 1 ) {
			$class = " show active";
		}
		$show           = isset( $item_tab['show'] ) ? $item_tab['show'] : '';
		$product_cat    = isset( $item_tab['product_cat'] ) ? $item_tab['product_cat'] : '';
		$orderby        = isset( $item_tab['orderby'] ) ? $item_tab['orderby'] : 'date';
		$order          = isset( $item_tab['order'] ) ? $item_tab['order'] : 'asc';
		$show_view_more = isset( $item_tab['show_view_more'] ) ? $item_tab['show_view_more'] : 'false';
		$text_view_more = isset( $item_tab['text_view_more'] ) ? $item_tab['text_view_more'] : '';
		$link_view_more = isset( $item_tab['link_view_more'] ) ? $item_tab['link_view_more'] : '';
		$limit          = $params['limit'];
		$columns        = $params['columns'];
		$query_args     = array(
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

        if ( $show == '' && $orderby == 'date' && $order=='desc') {
            $title_tab = esc_attr__( 'New', 'azen' );
        }
        elseif ( $show == '' && $orderby == 'sales' && $order=='desc') {
            $title_tab = esc_attr__( 'Hot', 'azen' );
        } elseif ( $show == 'featured' ) {
			$title_tab = esc_attr__( 'Featured', 'azen' );
		} elseif ( $show == 'onsale' ) {
			$title_tab = esc_attr__( 'OnSale', 'azen' );
		} else {
			if ( $product_cat ) {
				$term      = get_term_by( 'id', $product_cat, 'product_cat' );
				if ( empty( $term ) ) {
 					$title_tab = '';
				}else{
					$title_tab = $term->name;
				}
 			} else {
				$title_tab = esc_attr__( 'All', 'azen' );
			}
		}
		if ( $r->have_posts() ) {
			echo '<div class="inner-sc-product tab-pane fade' . $class . '" id="' . sanitize_title( $title_tab ) . '-' . $rand_number . '" role="tabpanel">';
			echo '<ul class="products columns-' . $columns . '">';
			while ( $r->have_posts() ) {
				$r->the_post();
				do_action( 'woocommerce_shop_loop' );
				wc_get_template_part( 'content', 'product' );
			}
			echo '</ul>';
			if ( $show_view_more == 'true' ) {
				echo '<div class="view-all"><a href="' . esc_url( $link_view_more ) . '" class="au-btn btn-small">' . $text_view_more . '</a></div>';
			}
			echo '</div>';
		}
		$j ++;
		wp_reset_postdata();
	}
	echo '</div>';
}
echo '</div>';