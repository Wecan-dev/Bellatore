<?php
/**
 * Template for displaying global default template Testimonials element.
 *
 * This template can be overridden by copying it to yourtheme/physc-builder/testimonials/testimonials.php.
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

if ( !$params['list_sale_tab'] ) {
    return;
}


$data= '';
$list_sale    = $params['list_sale_tab'];


echo '<div class="list-sale-1"><div class="list-sale-content">';

echo '<div class="sc-list-sale owl-carousel owl-theme">';

foreach ( $list_sale as $value ) {
    ?>
    <div class="item">
        <?php
        $product_sale_id  = $value['product_sale_id'];
        if ( isset( $product_sale_id  ) ) {
            $query_args = array(
                'post_status' => 'publish',
                'post_type'   => 'product',
                'p'           => $product_sale_id,
            );
            $r          = new WP_Query( $query_args );
            if ( $r->have_posts() ) {
                while ( $r->have_posts() ) {
                    $r->the_post();
                    $product = wc_get_product(get_the_ID());
                    $sales_date_price_to   = $product->get_date_on_sale_to();
                    //thumb images
                    $link_product = get_permalink($r->ID);
                    echo '<a href ='.$link_product.'>'.woocommerce_get_product_thumbnail().'</a>';
                    //date
                    if ($sales_date_price_to) {
                        $date = new DateTime($sales_date_price_to->date('Y-m-d H:i'));
                        echo '<div class="wrap-countdown"><div class="countdown" data-time="' . esc_attr( $date->format( 'M j, Y H:i:s O' ) ) . '"></div></div>';
                    }
                    // title
                    do_action( 'woocommerce_shop_loop_item_title' );
                    // desc
                    // price
                    echo woocommerce_template_loop_price();

                }
            }
        }
        ?>
    </div>
    <?php
}

echo '</div></div>';
echo '</div>';

?>
