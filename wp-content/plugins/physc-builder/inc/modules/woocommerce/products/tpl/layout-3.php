<?php
$style_title = $title_color ? ' style="color:' . $title_color . '"' : '';
$data        = $speed_slider ? ' data-speed ="' . $speed_slider . '"' : '';
$data        .= $column ? ' data-item ="' . $column . '"' : '';
if ( $title ) {
	echo '<' . $element_tag . ' class="special-heading"' . $style_title . '>' . $title . '</' . $element_tag . '>';
}
echo '<div class="es-nav">
					<span class="es-nav-prev"><i class="zmdi zmdi-chevron-left"></i></span>
					<span class="es-nav-next"><i class="zmdi zmdi-chevron-right"></i></span>
				</div>';
if ( $r->have_posts() ) {
	echo '<div class="inner-sc-product ">';
	echo '<div class="products"' . $data . '>';

	while ( $r->have_posts() ) {
		$r->the_post();
		global $product;
		?>
		<div <?php wc_product_class( '', $product ); ?>>
			<?php

			/**
			 * Hook: woocommerce_before_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_open - 10
			 * @hooked woocommerce_template_loop_product_div_open - 1 (<div class="inner-item-product">)
			 */

			do_action( 'woocommerce_before_shop_loop_item' );


			/**
			 * Hook: woocommerce_before_shop_loop_item_title.
			 *
			 * @hooked woocommerce_before_shop_loop_item_open - 1 (<div class="<div class="product-image">">)
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 * @hooked woocommerce_before_shop_loop_item_close - 90 (</div>)
			 */
			echo '<div class="product-image">';
			/**
			 * Hook: woocommerce_before_shop_loop_item_title.
			 *
			 * @hooked woocommerce_before_shop_loop_item_open - 1 (<div class="<div class="product-image">">)
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 * @hooked woocommerce_before_shop_loop_item_close - 90 (</div>)
			 */

			echo '<a href="' . esc_url( get_the_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '" class="wp-post-image">';
			echo woocommerce_get_product_thumbnail();
			echo '</a>';

			echo '</div>';
			echo '<div class="wrapper-content-item">';
			/**
			 * Hook: woocommerce_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );

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
			 * @hooked woocommerce_template_loop_wishlist - 5
			 */
			do_action( 'woocommerce_after_shop_loop_item_wishlist' );

			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
			echo '</div>';
			/**
			 * Hook: woocommerce_after_loop_product_div_close.
			 *
			 * @hooked woocommerce_template_loop_product_div_close - 5 </div>
			 */
			do_action( 'woocommerce_after_loop_product_div_close' );

			?>
		</div>
		<?php
	}
	echo '</div>';

	if ( $show_view_more == 'true' ) {
		echo '<div class="view-all">
						<a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '" class="au-btn btn-small">' . $text_view_more . '<i class="zmdi zmdi-arrow-right"></i></a>
			</div>';
	}

	echo '</div>';
}
wp_reset_postdata();