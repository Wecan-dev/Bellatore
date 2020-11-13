<?php
if ( !function_exists( 'azen_wrapper_layout' ) ) :
	function azen_wrapper_layout() {
		$wrapper_layout = '';
		$class_col      = 'col-sm-9 alignleft';
		$prefix_inner = '_single_';
		if ( get_post_type() == "product" ) {
			$prefix = 'woo_';
		} else {
			$prefix = 'archive_';
		}
		if( is_page()){
			$prefix_inner = '_page_';
		}
		if ( is_page() || is_single() ) {
			if ( azen_get_option( $prefix .$prefix_inner. 'layout', 'sidebar-right' ) ) {
				$wrapper_layout = azen_get_option( $prefix .$prefix_inner. 'layout', 'sidebar-right' );
			}
			/* custom layout **/
			$wrapper_layout = get_post_meta( get_the_ID(), 'phys_custom_layout', true ) ? get_post_meta( get_the_ID(), 'layout', true ) : $wrapper_layout;
		}elseif(is_page()){

		} else {
			if ( azen_get_option( $prefix . 'cate_layout' ) ) {
				$wrapper_layout = azen_get_option( $prefix . 'cate_layout' );
			}
			/* custom layout **/
			if ( isset( get_queried_object()->term_id ) ) {
				$using_custom_layout = azen_get_tax_meta( get_queried_object()->term_id, 'phys_layout', true );
				if ( $using_custom_layout <> '' ) {
					$wrapper_layout = azen_get_tax_meta( get_queried_object()->term_id, 'phys_layout', true );
				}
			}
		}

		if ( $wrapper_layout == 'full-content' ) {
			$class_col = "col-sm-12 full-width";
		}
		if ( $wrapper_layout == 'sidebar-right' ) {
			$class_col = "col-sm-9 alignleft";
		}
		if ( $wrapper_layout == 'sidebar-left' ) {
			$class_col = 'col-sm-9 alignright';
		}
		if ( get_the_ID() == get_option( 'woocommerce_cart_page_id' ) ||
			get_the_ID() == get_option( 'woocommerce_checkout_page_id' ) ||
			get_the_ID() == get_option( 'woocommerce_myaccount_page_id' ) ||
			get_the_ID() == get_option( 'woocommerce_terms_page_id' ) ) {
			$class_col = 'col-sm-12 full-width';
		}
		if ( get_post_type() == "product" ) {
			if ( !is_active_sidebar( 'sidebar-shop' ) ) {
				$class_col = 'col-sm-12 full-width';
			}
		} else {
			if ( !is_active_sidebar( 'sidebar-1' ) ) {
				$class_col = 'col-sm-12 full-width';
			}
		}
		if ( is_search() ) {
			$class_col = "col-sm-9 alignleft";
		}
		if ( is_search() && !is_active_sidebar( 'sidebar-1' ) ) {
			$class_col = 'col-sm-12 full-width';
		}


		return $class_col;
	}
endif;
add_action( 'azen_wrapper_loop_start', 'azen_wrapper_loop_start' );

if ( !function_exists( 'azen_wrapper_loop_start' ) ) :
	function azen_wrapper_loop_start() {
		$no_padding = '';
		$class_col  = azen_wrapper_layout();

		if ( is_page() || is_single() ) {
			$no_padding = ( get_post_meta( get_the_ID(), 'phys_no_padding', true ) == '1' ) ? ' content-no-padding' : '';
		}
		echo '<div class="content-area' . $no_padding . '"><div class="container"><div class="row"><div class="site-main ' . $class_col . '">';
	}
endif;

add_action( 'azen_wrapper_loop_end', 'azen_wrapper_loop_end' );
if ( !function_exists( 'azen_wrapper_loop_end' ) ) :
	function azen_wrapper_loop_end() {
		$class_col = azen_wrapper_layout();
		echo '</div>';
		if ( $class_col != 'col-sm-12 full-width' ) {
			if ( get_post_type() == "product" && !is_search() ) {
				get_sidebar( 'shop' );
			} else {
				get_sidebar();
			}
		}
		echo '</div></div></div>';
	}
endif;

// Heading Top
add_action( 'azen_banner_heading', 'azen_banner_heading' );

if ( !function_exists( 'azen_banner_heading' ) ) :
	function azen_banner_heading() {
		global $azen_theme_options;
		global $post;
		/***********custom Top Images*************/
		$bg_color         = $phys_custom_heading = $cate_top_image_src = $front_title = $text_color = $cate_top_image_src = $custom_desc = '';
		$hide_breadcrumbs = $hide_title = $default = 0;
		if ( get_post_type() == "product" ) {
			$prefix       = 'phys_woo';
			$prefix_inner = '_cate_';
		} else {
			$prefix       = 'phys_archive';
			$prefix_inner = '_cate_';
		}

		// single and archive
		if ( is_single() ) {
			$prefix_inner = '_single_';
			$default      = 1;
		} elseif ( is_page() || is_front_page() ) {
			$prefix_inner = '_page_';
		}
		// get data for theme customizer
		if ( azen_get_option( $prefix . $prefix_inner . 'heading_text_color' ) ) {
			$text_color = azen_get_option( $prefix . $prefix_inner . 'heading_text_color' );
		}
		if ( azen_get_option( $prefix . $prefix_inner . 'heading_bg_color' ) ) {
			$bg_color = $azen_theme_options[$prefix . $prefix_inner . 'heading_bg_color'];
		}
		if ( azen_get_option( $prefix . $prefix_inner . 'top_image' ) ) {
			$cate_top_image_src = $azen_theme_options[$prefix . $prefix_inner . 'top_image']['url'];
		}
		if ( azen_get_option( $prefix . $prefix_inner . 'hide_title', "$default" ) ) {
			$hide_title = azen_get_option( $prefix . $prefix_inner . 'hide_title', "$default" );
		}
 		if ( azen_get_option( $prefix . $prefix_inner . 'hide_breadcrumbs' ) ) {
			$hide_breadcrumbs = azen_get_option( $prefix . $prefix_inner . 'hide_breadcrumbs');
		}
 		if ( is_page() || is_single() ) {
			$using_custom_heading = get_post_meta( get_the_ID(), 'phys_user_featured_title', true );
			if ( $using_custom_heading ) {
				$hide_title = get_post_meta( get_the_ID(), 'phys_hide_title', true );

				$hide_breadcrumbs = get_post_meta( get_the_ID(), 'phys_hide_breadcrumbs', true );
				$text_color_1     = get_post_meta( get_the_ID(), 'phys_text_color', true );
				if ( $text_color_1 <> '' ) {
					$text_color = $text_color_1;
				}
				$bg_color_1 = get_post_meta( get_the_ID(), 'phys_bg_color', true );
				if ( $bg_color_1 <> '' ) {
					$bg_color = $bg_color_1;
				}
				$cate_top_image = get_post_meta( get_the_ID(), 'phys_top_image', true );
				if ( $cate_top_image ) {
					$cate_top_images = wp_get_attachment_image_src( $cate_top_image, 'full' );
					if ( $cate_top_images ) {
						$cate_top_image_src = $cate_top_images[0];
					}
				}
			}
		} else {
			if ( isset( get_queried_object()->term_id ) ) {
				$cat_ID              = get_queried_object()->term_id;
				$phys_custom_heading = azen_get_tax_meta( $cat_ID, 'phys_custom_heading', true );
				if ( $phys_custom_heading == 'custom' ) {
					$text_color       = ( azen_get_tax_meta( $cat_ID, 'phys_cate_heading_text_color', true ) != '#' ) ? azen_get_tax_meta( $cat_ID, 'phys_cate_heading_text_color', true ) : $text_color;
					$bg_color         = ( azen_get_tax_meta( $cat_ID, 'phys_cate_heading_bg_color', true ) != '#' ) ? azen_get_tax_meta( $cat_ID, 'phys_cate_heading_bg_color', true ) : $bg_color;
					$hide_breadcrumbs = ( azen_get_tax_meta( $cat_ID, 'phys_cate_hide_breadcrumbs', true ) == 'on' ) ? '1' : $hide_breadcrumbs;
					$hide_title       = ( azen_get_tax_meta( $cat_ID, 'phys_cate_hide_title', true ) == 'on' ) ? '1' : $hide_title;
					$cate_top_image   = azen_get_tax_meta( $cat_ID, 'phys_cate_top_image', true );
					if ( $cate_top_image ) {
						$cate_top_image_src = $cate_top_image['url'];
					}
				}
			}
		}
		$c_css_style = ( $text_color != '' ) ? 'color: ' . $text_color . ';' : '';
		$c_css_style .= ( $bg_color != '' ) ? 'background-color: ' . $bg_color . ';' : '';
		$c_css_style .= ( $cate_top_image_src != '' ) ? 'background-image:url( ' . $cate_top_image_src . ');' : '';
		$c_css       = ( $c_css_style != '' ) ? ' style="' . $c_css_style . '"' : '';
		if ( $hide_title != '1' || $hide_breadcrumbs != '1' ) {
			echo '<div class="breadcrumb-contact-us breadcrumb-section section-box"' . $c_css . '>';
			echo '<div class="container breadcrumb-inner">';
			if ( is_single() ) {
				$element_tag = 'h2';
			} else {
				$element_tag = 'h1';
			}
			if ( $hide_title != '1' ) {
				if ( get_post_type() == 'product' ) {
					echo '<' . $element_tag . ' class="heading_primary">';
					woocommerce_page_title();
					echo '</' . $element_tag . '>';
				} else {
					the_archive_title( '<' . $element_tag . ' class="heading_primary">', '</' . $element_tag . '>' );
				}
			}
			if ( $hide_breadcrumbs != '1' ) { ?>
				<div class="breadcrumbs-wrapper">
					<?php
					if ( get_post_type() == 'product' ) {
						$array = array(
							'before'      => '<li>',
							'after'       => '</li>',
							'wrap_before' => '<ul class="phys-breadcrumb">',
							'wrap_after'  => '</ul>',
						);
						woocommerce_breadcrumb( $array );
					} elseif ( is_home() ) {

					} else {
						azen_breadcrumbs();
					}
					?>
				</div>
			<?php }
			echo '</div>';
			echo '</div>';
		}
	}
endif;
