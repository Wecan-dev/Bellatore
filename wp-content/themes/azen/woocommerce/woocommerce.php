<?php

/**
 * Add action and add filter
 * Class azen_woocommerce_include
 */
class azen_woocommerce_include {
	public function __construct() {
		//Remove each style one by one
		add_filter( 'woocommerce_enqueue_styles', array( $this, 'jk_dequeue_styles' ) );
		add_filter( 'woocommerce_breadcrumb_defaults', array( $this, 'azen_change_breadcrumb_delimiter' ) );
		// remove hook default woocommerce
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
		remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
		remove_action( 'woocommerce_widget_shopping_cart_total', 'woocommerce_widget_shopping_cart_subtotal', 10 );

		//add attribute max input qty
		add_filter( 'woocommerce_quantity_input_max', 'woocommerce_quantity_input_max' );
		function woocommerce_quantity_input_max( $max ) {
			$max = 100;

			return $max;
		}

		add_action( 'woocommerce_widget_shopping_cart_total', 'woocommerce_widget_shopping_cart_subtotal_azen', 11 );
		add_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart_azen', 11 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 50 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 51 );

		add_action( 'add_to_cart_layout_product3', 'woocommerce_template_loop_add_to_cart' );

		// hook wrapper inner item
		add_action( 'woocommerce_before_shop_loop_item', array( $this, 'woocommerce_template_loop_product_div_open' ), 1 );
		add_action( 'woocommerce_after_loop_product_div_close', array( $this, 'woocommerce_template_loop_product_div_close' ), 1 );
		// add button button wishlist
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_before_box_hover' ), 11 );

		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_quick_view' ), 12 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_wishlist' ), 13 );
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 14 );

		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_after_box_hover' ), 15 );

		// hook wrapper result_count
		add_action( 'woocommerce_before_shop_loop', array( $this, 'woocommerce_result_count_open' ), 1 );
		add_action( 'woocommerce_before_shop_loop', array( $this, 'woocommerce_result_count_close' ), 90 );

		// hook thumbnail image
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_before_shop_loop_item_open' ), 1 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_before_shop_loop_item_close' ), 90 );


		add_action( 'woocommerce_after_shop_loop_item_wishlist', 'woocommerce_template_loop_add_to_cart', 4 );
		add_action( 'woocommerce_after_shop_loop_item_wishlist', array( $this, 'woocommerce_template_loop_wishlist' ), 5 );
		add_action( 'woocommerce_shop_loop_item_desc', array( $this, 'add_product_description' ), 5 );
		// single product


		// Quick View
		add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_title', 5 );
        add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_loop_price', 15 );
		add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_rating', 10 );
		add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_excerpt', 20 );
		add_action( 'woocommerce_single_product_summary_quick', array( $this, 'woocommerce_template_loop_wishlist' ), 40 );
		add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_add_to_cart', 30 );

		// share product
		add_action( 'woocommerce_share', array( $this, 'azen_wooshare_title' ) );

		// paging number
		add_filter( 'loop_shop_per_page', array( $this, 'azen_loop_shop_per_page' ), 20 );

		// hidden related product
		add_filter( 'woocommerce_output_related_products_args', array( $this, 'azen_related_products_args' ) );
		add_filter( 'woocommerce_cross_sells_columns', array( $this, 'azen_woocommerce_cross_sale_count_mod' ), 21 );

		///* PRODUCT QUICK VIEW */
		add_action( 'wp_ajax_jck_quickview', array( $this, 'azen_jck_quickview' ) );
		add_action( 'wp_ajax_nopriv_jck_quickview', array( $this, 'azen_jck_quickview' ) );
		add_filter( 'woocommerce_sale_flash', array( $this, 'azen_custom_sale_text' ), 10, 3 );
	}

	function azen_custom_sale_text( $text, $post, $_product ) {
		return '<span class="onsale">' . esc_html__( 'Sale', 'azen' ) . '</span>';
	}

	function jk_dequeue_styles( $enqueue_styles ) {
		unset( $enqueue_styles['woocommerce-layout'] );        // Remove the layout

		return $enqueue_styles;
	}

	// Change the breadcrumb separator
	function azen_change_breadcrumb_delimiter( $defaults ) {
		// Change the breadcrumb delimeter from '/' to ' '
		$defaults['delimiter'] = ' ';

		return $defaults;
	}

	function woocommerce_template_loop_product_div_open() {
		echo '<div class="inner-item-product">';
	}

	function woocommerce_template_loop_product_div_close() {
		echo '</div>';
	}

	// hook wrapper result_count
	function woocommerce_result_count_open() {
		echo '<div class="wrapper-result-count">';
	}

	function woocommerce_template_loop_wishlist_before_div() {
		echo '<div class="box-button">';
	}

	function woocommerce_result_count_close() {
		echo '</div>';
	}

	function woocommerce_template_loop_quick_view() {
		wp_enqueue_script( 'magnific' );
		wp_enqueue_script( 'flexslider' );

		echo '<a href="javascript:void(0)" class="quick-view" data-prod="' . get_the_ID() . '"></a>';
	}

	function woocommerce_template_loop_wishlist() {
		if ( class_exists( 'YITH_WCWL_Frontend' ) ) {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
		}
	}

	function woocommerce_template_loop_before_box_hover() {
		echo '<div class="box-hover">';
	}

	function woocommerce_template_loop_after_box_hover() {
		echo '</div>';
	}

	// hook wrapper thumbnail
	function woocommerce_before_shop_loop_item_open() {
		echo '<div class="product-image">';
	}

	function woocommerce_before_shop_loop_item_close() {
		echo '</div>';
	}

	function woocommerce_before_shop_loo_close() {
		echo '</div>';
	}

	function add_product_description() {
		echo '<div class="description">';
		the_excerpt();
		echo '</div>';
	}

// share product title
	function azen_wooshare_title() {
		if ( azen_get_option( 'sharing_facebook' ) == 1 ||
			azen_get_option( 'sharing_twitter' ) == 1 ||
			azen_get_option( 'sharing_pinterset' ) == 1 ||
			azen_get_option( 'sharing_google' ) == 1
		) {
			echo '<div class="product-share">';
			echo '<span>' . esc_html__( 'Share ', 'azen' ) . '</span>';
			echo '<div class="item-social">';
			if ( azen_get_option( 'sharing_facebook' ) == 1 ) {
				echo '<a class="face" title="Share on Facebook" href="http://www.facebook.com/sharer.php?u=' . get_the_permalink() . '">' . esc_html__( '#facebook', 'azen' ) . '</a>';
			}
			if ( azen_get_option( 'sharing_twitter' ) == 1 ) {
				echo '<a class="twitter" title="Tweet this!" href="https://twitter.com/intent/tweet?text=' . urlencode( get_the_title( get_the_ID() ) ) . '&url=' . urlencode( esc_url( get_permalink( get_the_ID() ) ) ) . '">' . esc_html__( '#twitter', 'azen' ) . '</a>';
			}
			if ( azen_get_option( 'sharing_pinterset' ) == 1 ) {
				$url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
				echo '<a class="pinterest" href="http://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&media=' . $url . '">' . esc_html__( '#pinterset', 'azen' ) . '</a>';
			}
			if ( azen_get_option( 'sharing_google' ) == 1 ) {
				echo '<a class="google" href="https://plus.google.com/share?url=' . get_the_permalink() . '">' . esc_html__( '#google', 'azen' ) . '</a>';
			}

			echo '</div></div>';
		}
	}


	// paging number
	function azen_loop_shop_per_page( $cols ) {
		if ( azen_get_option( 'woo_product_per_page' ) ) {
			$cols = azen_get_option( 'woo_product_per_page' );
		} else {
			$cols = 10;
		}

		return $cols;
	}

	function azen_woocommerce_cross_sale_count_mod( $count ) {
		return 3;
	}

	// hidden related product
	function azen_related_products_args( $args ) {
		$args['posts_per_page'] = azen_get_option( 'number_related', '4' );
		$args['columns']        = azen_get_option( 'column_related', '4' );

		return $args;
	}

	// Ajax  minicart
	function azen_add_to_cart_success_ajax( $count_cat_product ) {
		list( $cart_items ) = azen_get_current_cart_info();
		if ( $cart_items < 0 ) {
			$cart_items = '0';
		}
		$count_cat_product['#header-mini-cart .wrapper-items-number'] = '<span class="wrapper-items-number">' . $cart_items . '</span>';

		return $count_cat_product;
	}


	///* PRODUCT QUICK VIEW */
	function azen_jck_quickview() {
		global $post, $product;
		$prod_id = $_POST["product"];
		$post    = get_post( $prod_id );
		$product = wc_get_product( $prod_id );
		ob_start();
		wc_get_template( 'content-single-product-lightbox.php' );
		$output = ob_get_contents();

		ob_end_clean();
		echo ent2ncr( $output );
		die();
	}
}

new azen_woocommerce_include();


/**
 * Custom current cart
 * @return array
 */
function azen_get_current_cart_info() {
	global $woocommerce;
	$items = count( $woocommerce->cart->get_cart() );

	return array( $items, get_woocommerce_currency_symbol() );
}

if ( !function_exists( 'woocommerce_template_loop_product_title' ) ) {
	function woocommerce_template_loop_product_title() {
		echo '<h2 class="woocommerce-loop-product_title"><a href="' . esc_url( get_the_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_title() . '</a></h2>';
	}
}
// Override WooCommerce function
if ( !function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
	function woocommerce_template_loop_product_thumbnail() {
		global $product;
		$attachment_ids = $product->get_gallery_image_ids();

		echo '<a href="' . esc_url( get_the_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '" class="wp-post-image">';
		echo woocommerce_get_product_thumbnail();
		if ( isset( $attachment_ids[0] ) ) {
			echo wp_get_attachment_image( $attachment_ids[0], apply_filters( 'shop_catalog', 'shop_catalog' ), '', array( "class" => "product-change-images" ) );
		}

		echo '</a>';
	}
}


if ( !function_exists( 'woocommerce_widget_shopping_cart_button_view_cart_azen' ) ) {

	/**
	 * Output the view cart button.
	 */
	function woocommerce_widget_shopping_cart_button_view_cart_azen() {
		global $woocommerce;
		$items = count( $woocommerce->cart->get_cart() );
		echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button wc-forward">' . esc_html__( 'View cart', 'azen' ) . ' (' . $items . ')' . '</a>';
	}
}


if ( !function_exists( 'woocommerce_widget_shopping_cart_subtotal_azen' ) ) {
	/**
	 * Output to view cart subtotal.
	 *
	 * @since 3.7.0
	 */
	function woocommerce_widget_shopping_cart_subtotal_azen() {
		echo '<strong>' . esc_html__( 'Total', 'azen' ) . ':</strong> ' . WC()->cart->get_cart_subtotal(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
