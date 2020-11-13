<?php
/**
 * PhyscBuilders functions
 *
 * @version     1.0.0
 * @package     PhyscBuilders/Classes
 * @category    Classes
 * @author      Physcode
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( !function_exists( 'physc_builder_get_template' ) ) {
	/**
	 * @param        $template_name
	 * @param array  $args
	 * @param string $template_path
	 * @param string $default_path
	 */
	function physc_builder_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
		if ( is_array( $args ) && isset( $args ) ) {
			extract( $args );
		}

		if ( false === strpos( $template_name, '.php' ) ) {
			$template_name .= '.php';
		}

		$template_file = physc_builder_locate_template( $template_name, $template_path, $default_path );

		if ( !file_exists( $template_file ) ) {
			_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );

			return;
		}

		include $template_file;
	}
}

if ( !function_exists( 'physc_builder_locate_template' ) ) {
	/**
	 * @param        $template_name
	 * @param string $template_path
	 * @param string $default_path
	 *
	 * @return mixed
	 */
	function physc_builder_locate_template( $template_name, $template_path = '', $default_path = '' ) {

		if ( !$template_path ) {
			$template_path = 'modules/';
		}

		// Set default plugin templates path.
		if ( !$default_path ) {
			$default_path = PHYSC_BUILDER_INC . 'modules/' . $template_path; // Path to the template folder
		}

		$base = substr( ( substr( $template_path, 0, strpos( $template_path, '/tpl' ) ) ), strpos( $template_path, '/' ) + 1 );
		// Search template file in theme folder.
		$template = locate_template( array(
			"physc-builder/$base/$template_name",
			$template_name
		) );
		// Get plugins template file.
		if ( !$template ) {
			$template = $default_path . $template_name;
		}

		return apply_filters( 'physc-builder/locate-template', $template, $template_name, $template_path, $default_path );
	}
}

if ( !function_exists( 'physc_builder_get_modules' ) ) {
	/**
	 * @return mixed
	 */
	function physc_builder_get_modules() {
		$BP      = Physc_Builder();
		$modules = $BP->get_modules();

		// allow unset elements
		$unset = apply_filters( 'physc-builder/modules-unset', array() );
		foreach ( $modules as $plugin => $_modules ) {
			foreach ( $unset as $item ) {
				$index = array_search( $item, $_modules );
				if ( $index != false ) {
					unset( $modules[$plugin][$index] );
				}
			}
		}

		return $modules;
	}
}

if ( !function_exists( 'physc_builder_get_group' ) ) {
	/**
	 * Get group of element (widget/shortcode) by name
	 *
	 * @param $name
	 *
	 * @return int|mixed|string
	 */
	function physc_builder_get_group( $name ) {
		$BP      = Physc_Builder();
		$modules = $BP->get_modules();

		foreach ( $modules as $group => $_modules ) {
			if ( in_array( $name, $_modules ) ) {
				return $group;
			}
		}

		return apply_filters( 'physc-builder/default-group', 'general', $name );
	}
}

if ( !function_exists( 'bp_custom_image_size' ) ) {
	function bp_custom_image_size( $width, $height, $img_url ) {
		if ( $img_url ) {
			$data = @getimagesize( $img_url );
			if ( $data ) {
				$width_data  = $data[0];
				$height_data = $data[1];
			} else {
				global $wpdb;
				$id          = $wpdb->get_var( "SELECT ID FROM {$wpdb->posts} WHERE guid='$img_url'" );
				$data        = wp_get_attachment_image_src( $id, 'full' );
				$width_data  = $data[1];
				$height_data = $data[2];
			}
			if ( !( $width_data > $width ) || !( $height_data > $height ) ) {
				return $img_url;
			} else {
				$crop       = ( $height_data < $height ) ? false : true;
				$image_crop = aq_resize( $img_url, $width, $height, $crop );

				return $image_crop;
			}
		}
	}
}
if ( !function_exists( 'woocommerce_template_loop_product_thumbnail_layout_4' ) ) {
	function woocommerce_template_loop_product_thumbnail_layout_4( $i ) {
		global $product;
		$attachment_ids = $product->get_gallery_image_ids();
		$with_size      = 420;
		$height_size    = 320;
		if ( $i == 5 || $i == 12 ) {
			$with_size   = 740;
			$height_size = 639;
		}
		if ( $i == 6 || $i == 11 ) {
			$with_size   = 740;
			$height_size = 282;
		}
		echo '<div class="product-image">';
		echo woocommerce_show_product_loop_sale_flash();

		if ( class_exists( 'YITH_WCWL_Init' ) ) {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
		}
		echo '<a href="' . esc_url( get_the_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '" class="wp-post-image">';
		if ( has_post_thumbnail() ) {
			$link_image = bp_custom_image_size( $with_size, $height_size, get_the_post_thumbnail_url( get_the_ID(), 'full' ) );
			echo '<img src="' . $link_image . '" alt="' . get_the_title() . '">';
		}
		if ( isset( $attachment_ids[0] ) ) {
			$url_image_gallery  = wp_get_attachment_image_src( $attachment_ids[0], 'full' );
			$link_image_gallery = bp_custom_image_size( $with_size, $height_size, $url_image_gallery[0] );
			echo '<img src="' . $link_image_gallery . '" alt="' . get_the_title() . '" class="product-change-images">';
		}

		echo '</a>';
		echo '</div>';
	}
}


add_action( 'woocommerce_gallery_showcase', 'woocommerce_slider_gallery', 5 );
if ( !function_exists( 'woocommerce_slider_gallery' ) ) {
	function woocommerce_slider_gallery() {
		global $product;
		$attachment_ids = $product->get_gallery_image_ids();
		if ( $attachment_ids ) {
			echo '<div class="woocommerce-product-gallery">
					<div class="owl-carousel">';
			foreach ( $attachment_ids as $attachment_id ) {
				$image_link = wp_get_attachment_url( $attachment_id );
				if ( !$image_link ) {
					continue;
				}
				$image_title = esc_attr( get_the_title( $attachment_id ) );
				$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ), 0, $attr = array(
					'title' => $image_title,
					'alt'   => $image_title
				) );
				echo apply_filters( 'woocommerce_slider_gallery_showcase', sprintf( ' <div class="item">%s</div>', $image ) );
			}
			echo '</div>
				</div>';
		} else {
			echo '<div class="woocommerce-product-gallery">' . woocommerce_get_product_thumbnail( 'shop_single' ) . '</div>';
		}
	}
}


/**
 * Override WooCommerce Widgets
 */
if ( !function_exists( 'physc_override_woocommerce_widgets' ) ) {
	function physc_override_woocommerce_widgets() {
		if ( class_exists( 'WC_Widget_Cart' ) ) {
			unregister_widget( 'WC_Widget_Cart' );
			require_once( PHYSC_BUILDER_INC . 'widgets/class-wc-widget-cart.php' );
			register_widget( 'Physc_Custom_WC_Widget_Cart' );
		}
	}
}
add_action( 'widgets_init', 'physc_override_woocommerce_widgets', 15 );


/**
 * Custom current cart
 * @return array
 */
if ( !function_exists( 'physc_get_current_cart_info' ) ) {
	function physc_get_current_cart_info() {
		global $woocommerce;
		$items = count( $woocommerce->cart->get_cart() );

		return array( $items, get_woocommerce_currency_symbol() );
	}

}

if ( !function_exists( 'physc_add_to_cart_success_ajax' ) ) {
// Ajax  minicart
	function physc_add_to_cart_success_ajax( $count_cat_product ) {
		list( $cart_items ) = physc_get_current_cart_info();
		if ( $cart_items < 0 ) {
			$cart_items = '0';
		}
		$count_cat_product['#header-mini-cart .wrapper-items-number'] = '<span class="wrapper-items-number">' . $cart_items . '</span>';

		return $count_cat_product;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'physc_add_to_cart_success_ajax' );

if ( !function_exists( 'physc_renders_stars_rating' ) ) {
	function physc_renders_stars_rating( $rating ) {
		$stars_html = '<div class="item_rating"><div class="star-rating" title="' . sprintf( esc_html__( 'Rated %s out of 5', 'physc-builder' ), $rating ) . '">';
		$stars_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"></span>';
		$stars_html .= '</div></div>';
		printf( '%s', $stars_html );
	}
}

add_action( 'physc_share_social', 'physc_share_social', 5 );
if ( !function_exists( 'physc_share_social' ) ) {
	function physc_share_social() {
		echo '<div class="social-left">
        <span>' . esc_html__( 'Share:', 'arito' ) . '</span>
		   <a href="https://www.facebook.com/sharer/sharer.php?u=' . get_permalink() . '"><i class="zmdi zmdi-facebook"></i></a>
		   <a href="https://twitter.com/intent/tweet?url=' . get_permalink() . '"><i class="zmdi zmdi-twitter"></i></a>  
		   <a href="https://www.linkedin.com/shareArticle/?url=' . get_permalink() . '"><i class="zmdi zmdi-linkedin"></i></a>   
		   <a href=""><i class="zmdi zmdi-google-plus"></i></a>
       </div>';
	}
}


function show_categories_azen($value)
{
    $id = $value['id'];
    echo '<div class="product_categories_shortcode" >';
    $thumbnail_id = get_term_meta($id, 'thumbnail_id', true);
    $link = get_category_link($id);
    $image = wp_get_attachment_url($thumbnail_id);
    echo "<div class='images-top'><a href='$link'><img src='{$image}' alt='$id' /></a></div>";
    echo '<p><a href='.$link.'>#';
    if( $term = get_term_by( 'id', $id, 'product_cat' ) ){
        echo $term->name;
    }
    echo '</a></p>';
    echo '</div >';
}
add_shortcode('show_categories_shortcode', 'show_categories_azen');
