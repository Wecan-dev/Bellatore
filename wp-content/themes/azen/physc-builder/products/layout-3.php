<?php
$style_title = $title_color ? ' style="color:' . $title_color . '"' : '';
$data        = $speed_slider ? ' data-speed ="' . $speed_slider . '"' : '';
$data        .= $column ? ' data-item ="' . $column . '"' : '';
if ($title) {
    echo '<' . $element_tag . ' class="special-heading"' . $style_title . '>' . $title . '</' . $element_tag . '>';
}
echo '<div class="es-nav">
					<span class="es-nav-prev">'.esc_html__('PREV','azen').'</span>
					<span class="es-nav-next">'.esc_html__('NEXT','azen').'</span>
				</div>';
if ($r->have_posts()) {
    echo '<div class="inner-sc-product ">';
    echo '<div class="products"' . $data . '>';

    while ($r->have_posts()) {
        $r->the_post();
        global $product;
        $price             = $product->get_price();
        $get_regular_price = $product->get_regular_price();
        $sale              = ( ( $get_regular_price - $price ) / $get_regular_price ) * 100;
        $sale              = round( $sale );
        ?>
        <div <?php wc_product_class('', $product); ?>>
            <?php
            echo '<div class="container"><div class="row">';
            echo '<div class="col-md-6 col-12 content-layout3">';
            /**
             * Hook: woocommerce_before_shop_loop_item.
             *
             * @hooked woocommerce_template_loop_product_link_open - 10
             * @hooked woocommerce_template_loop_product_div_open - 1 (<div class="inner-item-product">)
             */
            do_action('woocommerce_before_shop_loop_item');
            /**
             * Hook: woocommerce_before_shop_loop_item_title.
             *
             * @hooked woocommerce_before_shop_loop_item_open - 1 (<div class="<div class="product-image">">)
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_wishlist - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             * @hooked woocommerce_before_shop_loop_item_close - 90 (</div>)
             */


            do_action('woocommerce_before_shop_loop_item_title');

            if ( $sale ) {
                echo '<span class="onsale"><span>-</span>' . $sale . ' %</span>';
            }
            echo '</div></div>';
            echo '<div class="col-md-6 col-12 content-layout3">';
            echo '<div class="wrapper-content-item">';
            /**
             * Hook: woocommerce_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action('woocommerce_shop_loop_item_title');

            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action('woocommerce_after_shop_loop_item_title');

            /**
             * Hook: woocommerce_after_shop_loop_item.
             *
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action('woocommerce_after_shop_loop_item');
            the_content();
            do_action('add_to_cart_layout_product3');
            echo '</div>';
            echo '</div>';
            /**
             * Hook: woocommerce_after_loop_product_div_close.
             *
             * @hooked woocommerce_template_loop_product_div_close - 5 </div>
             */
            do_action('woocommerce_after_loop_product_div_close');
            ?>
        </div></div>
        <?php
    }
    echo '</div>';

    if ($show_view_more == 'true') {
        echo '<div class="view-all"><a href="' . get_permalink(wc_get_page_id('shop')) . '" class="au-btn btn-small">' . $text_view_more . '<i class="zmdi zmdi-arrow-right"></i></a></div>';
    }

    echo '</div>';
}
wp_reset_postdata();