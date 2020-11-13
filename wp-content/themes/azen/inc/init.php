<?php

/**
 * Get ThemeOptions
 * @return array|mixed|void
 */
function azen_get_data_themeoptions() {
	global $azen_theme_options;

	return $azen_theme_options;
}

function azen_get_option( $name = '', $value_default = '' ) {
 	$data = azen_get_data_themeoptions();

 	if ( isset( $data[$name] ) ) {
		return $data[$name];

	} else {
		return $value_default;
 	}
}

function azen_current_blog() {
	global $current_blog;

	return $current_blog;
}

/**
 * Add Tax Meta
 */
require get_template_directory() . '/inc/admin/tax-meta.php';

/**
 * Add action and add filter
 * Class azen_theme_include
 */
if ( !function_exists( 'azen_fonts_url' ) ) {
	function azen_fonts_url() {
		$font_url = '';

		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google font: on or off', 'azen' ) ) {
			$font_url = add_query_arg( 'family', urlencode( 'Muli:400,400i,500,500i,,600,600i,700,700i&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
		}

		return $font_url;
	}
}

if ( !function_exists( 'azen_column_masonry' ) ) {
	function azen_column_masonry() {
		$cat_obj = get_queried_object();
		$cat_ID  = '';
		if ( isset( $cat_obj->term_id ) ) {
			$cat_ID = $cat_obj->term_id;
		}
		$column               = azen_get_option( 'archive_cat_column', '3' );
		$custom_layout_column = azen_get_tax_meta( $cat_ID, 'phys_layout_column', true );
		if ( $custom_layout_column <> '' ) {
			$column = $custom_layout_column;
		}

		return $column;
	}
}

if ( !function_exists( 'azen_layout_blog' ) ) {
	function azen_layout_blog() {
		$style = azen_get_option( 'archive_cat_style', 'standard' );
		if ( isset( get_queried_object()->term_id ) ) {
			$custom_layout_content = azen_get_tax_meta( get_queried_object()->term_id, 'phys_layout_content', true );
			if ( $custom_layout_content <> '' ) {
				$style = azen_get_tax_meta( get_queried_object()->term_id, 'phys_layout_content', true );
			}
		}

		return $style;
	}
}

/**
 * Add action and add filter
 * Class azen_theme_include
 */
class azen_theme_include {
	public function __construct() {
		// Setup theme
		add_action( 'after_setup_theme', array( $this, 'azen_setup_theme' ) );

		// change position comment field
		add_action( 'after_setup_theme', array( $this, 'azen_change_field_message_comment' ) );

		//Process widget: add or remove
		add_action( 'widgets_init', array( $this, 'azen_widgets_init' ) );
		//Set the content width in pixels

		//Add Script
		add_action( 'wp_enqueue_scripts', array( $this, 'azen_init_scripts' ) );
		//Remove filter and Add new filther
		add_filter( 'excerpt_length', array( $this, 'azen_excerpt_length' ), 9 );

		add_filter( 'excerpt_more', array( $this, 'azen_excerpt_more' ) );
		/********************azen_entry_top**********************/
		add_filter( 'wpcf7_support_html5_fallback', '__return_true' );
		add_filter( 'embed_oembed_html', array( $this, 'azen_custom_oembed_filter' ), 10, 4 );

		/********************azen_entry_top**********************/
		add_action( 'azen_entry_top', array( $this, 'azen_post_formats' ), 10, 2 );

	}


	/**
	 * Override excerpt of post
	 *
	 * @param $text
	 *
	 * @return mixed|string|void
	 */
	function azen_excerpt_length( $length ) {
		global $azen_theme_options;
		$length = 55;
		if ( isset( $azen_theme_options['excerpt_length_blog'] ) && $azen_theme_options['excerpt_length_blog'] ) {
			$length = $azen_theme_options['excerpt_length_blog'];
		}

		return $length;
	}


	function azen_excerpt_more( $more ) {

		return false;
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function azen_init_scripts() {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.1.3' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'material-iconic', get_template_directory_uri() . '/assets/css/material-design-iconic-font.min.css' );
		wp_register_style( 'swipebox', get_template_directory_uri() . '/assets/css/swipebox.min.css', array() );

		wp_enqueue_style( 'azen-style', get_stylesheet_uri(), array(),filemtime(get_template_directory().'/style.css'));

		if ( is_file( AZEN_UPLOADS_FOLDER . AZEN_FILE_NAME ) ) {
			wp_enqueue_style( 'azen-options', AZEN_UPLOADS_URL . AZEN_FILE_NAME, array(), filemtime( AZEN_UPLOADS_FOLDER . AZEN_FILE_NAME ) );
		} else {
			wp_enqueue_style( 'azen-options', get_template_directory_uri() . '/assets/css/azen-options.css', array(),  filemtime( get_template_directory() . '/assets/css/azen-options.css' ) );
			wp_enqueue_style( 'azen-google-fonts', azen_fonts_url(), array(), null );
		}

 		if ( is_rtl() ) {
			wp_enqueue_style( 'azen-style-rtl', get_template_directory_uri() . '/rtl.css', array(), '6122019' );
		}

		//register script
 		wp_register_script( 'flexslider', get_template_directory_uri() . '/assets/js/flexslider.js', '2.2.2', true );
		wp_register_script( 'variations', get_template_directory_uri() . '/assets/js/variations-form.js', '1.0.1', true );
		wp_register_script( 'magnific', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.js', '0.8.9', true );
		wp_register_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js', '1.0', true );
		wp_register_script( 'swipebox', get_template_directory_uri() . '/assets/js/jquery.swipebox.min.js', '1.4.4', false );
		wp_register_script( 'infinitescroll', get_template_directory_uri() . '/assets/js/infinite-scroll.pkgd.min.js', array( 'jquery' ), '3.0.1', true );

		if ( azen_layout_blog() == 'masonry' && !is_search() ) {
			wp_enqueue_script( 'masonry' );
			wp_enqueue_script( 'infinitescroll' );
			wp_enqueue_script( 'flexslider' );
		}

		//enqueue script
		wp_enqueue_script( 'azen-theme', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), '10122019', true );
		wp_localize_script( 'azen-theme', 'quick_view', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}


	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	public function azen_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'azen' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Position on the left or right of content. It will not show on shop page.', 'azen' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar( array(
			'name'          => esc_html__( 'Menu Right', 'azen' ),
			'id'            => 'menu_right',
			'description'   => esc_html__( 'Position on the menu right.', 'azen' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Top Bar', 'azen' ),
			'id'            => 'top_bar',
			'description'   => esc_html__( 'Add widgets for top bar.', 'azen' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer', 'azen' ),
			'id'            => 'footer',
			'description'   => esc_html__( 'Add widgets here.', 'azen' ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Shop', 'azen' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Add widgets here.', 'azen' ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Slider before header', 'azen' ),
			'id'            => 'slider-before-header',
			'description'   => esc_html__( 'Add widgets here.', 'azen' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	public function azen_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'azen_content_width', 640 );
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public function azen_setup_theme() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on azen, use a find and replace
		 * to change 'azen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'azen', AZEN_THEME_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		  */

		add_theme_support( 'woocommerce' );

		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_attr__( 'Primary Menu', 'azen' ),
			)
		);
		add_theme_support( 'infinite-scroll', array(
			'container' => 'content',
			'footer'    => 'page',
		) );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );
		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'link', 'quote' ) );
		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		$args = apply_filters(
			'azen_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		);
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', $args );
		add_theme_support( "custom-header", $args );
	}

	public function azen_change_field_message_comment() {
		function move_comment_field_to_bottom( $fields ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;

			return $fields;
		}

		add_filter( 'comment_form_fields', 'move_comment_field_to_bottom' );
	}

	public function azen_custom_oembed_filter( $html ) {
		$return = '<div class="video-container">' . $html . '</div>';

		return $return;
	}

	public function azen_post_formats( $size, $show_image = false ) {
		$html = $schema = '';
		switch ( get_post_format() ) {
			case 'image':
				$imageID = get_post_meta( get_the_ID(), 'image_hover', true );
				$image   = wp_get_attachment_image_src( $imageID, $size );
				if ( has_post_thumbnail() ) {
					if ( is_single() ) {
						$html .= get_the_post_thumbnail( get_the_ID(), $size );
					} else {
						$html .= '<a class="post-image" href="' . esc_url( get_permalink() ) . '" title ="' . the_title_attribute( 'echo=0' ) . '">';
						$html .= get_the_post_thumbnail( get_the_ID(), $size );
						if ( $image ) {
							$html .= get_the_post_thumbnail( get_the_ID(), $size );
						}
						$html .= '</a>';
					}
				}
				break;
			case 'gallery':
				$images = get_post_meta( get_the_ID(), 'images', false );
				if ( $show_image == false ) {
					if ( empty( $images ) ) {
						if ( has_post_thumbnail() ) {
							if ( !is_single() ) {
								$html .= '<a class="post-image" href="' . esc_url( get_permalink() ) . '">';
							}
							$html .= get_the_post_thumbnail( get_the_ID(), $size );
							if ( !is_single() ) {
								$html .= '</a>';
							}
						}
					} else {
						wp_enqueue_script( 'flexslider' );
						$html .= '<div class="gallery-slider flexslider">';
						$html .= '<ul class="slides">';
						foreach ( $images as $image ) {
							$html .= '<li class="item-slider">';
							$html .= wp_get_attachment_image( $image, $size );
							$html .= '</li>';
						}
						$html .= '</ul>';
						$html .= '</div>';
					}
				} else {
					if ( empty( $images ) ) {
						if ( has_post_thumbnail() ) {
							if ( !is_single() ) {
								$html .= '<a class="post-image" href="' . esc_url( get_permalink() ) . '">';
							}
							$html .= get_the_post_thumbnail( get_the_ID(), $size );
							if ( !is_single() ) {
								$html .= '</a>';
							}
						}
					} else {
						if ( !is_single() ) {
							$html .= '<a class="post-image" href="' . esc_url( get_permalink() ) . '">';
						}
						$html .= wp_get_attachment_image( $images[0], $size );
						if ( !is_single() ) {
							$html .= '</a>';
						}
					}
				}
				break;

			case 'audio':
				if ( $show_image == false ) {
					$audio = get_post_meta( get_the_ID(), 'audio', true );
					if ( !$audio ) {
						break;
					}
					// If URL: show oEmbed HTML or jPlayer
					if ( filter_var( $audio, FILTER_VALIDATE_URL ) ) {
						if ( $oembed = @wp_oembed_get( $audio ) ) {
							$html .= '<div class="video-container">' . $oembed . '</div>';
						}
					} // If embed code: just display
					else {
						$html .= '<div class="video-container">' . $audio . '</div>';
					}

				} else {
					$thumb = get_the_post_thumbnail( get_the_ID(), $size );
					if ( $thumb ) {
						$html .= '<a class="post-image" href="' . esc_url( get_permalink() ) . '">';
						$html .= $thumb;
						$html .= '</a>';
					}
				}
				break;
			case 'video':
				if ( $show_image == false ) {
					$video = get_post_meta( get_the_ID(), 'video', true );
					if ( !$video ) {
						break;
					}
					// If URL: show oEmbed HTML
					if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
						if ( $oembed = @wp_oembed_get( $video ) ) {
							$html .= '<div class="video-container">' . $oembed . '</div>';
						}
					} // If embed code: just display
					else {
						$html .= '<div class="video-container">' . $video . '</div>';
					}
				} else {
					$thumb = get_the_post_thumbnail( get_the_ID(), $size );
					if ( $thumb ) {
						$html .= '<a class="post-image" href="' . esc_url( get_permalink() ) . '">';
						$html .= $thumb;
						$html .= '</a>';
					}
				}
				break;
			case 'link':
				$url   = get_post_meta( get_the_ID(), 'url', true );
				$thumb = get_the_post_thumbnail( get_the_ID(), $size );
				if ( $url && $thumb ) {
					$html .= '<a class="post-image" href="' . esc_url( $url ) . '">';
				}
				$html .= $thumb;
				if ( $url && $thumb ) {
					$html .= '</a/>';
				}

				break;

			default:
				$thumb = get_the_post_thumbnail( get_the_ID(), $size );
				if ( $thumb ) {
					if ( is_single() ) {
						$html .= $thumb;
					} else {
						$html .= '<a class="post-image" href="' . esc_url( get_permalink() ) . '">';
						$html .= $thumb;
						$html .= '<div class="overlay"></div></a>';
					}
				}
		}
		if ( $html ) {
			echo '<div class="post-formats-wrapper">' . $html . '</div>';
		}
	}

}

new azen_theme_include();

/**
 * Remove section in customize
 */
function azen_remove_styles_sections() {
	global $wp_customize;
	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
}

//Remove section in customize
add_action( 'customize_register', 'azen_remove_styles_sections' );

if ( !function_exists( 'azen_excerpt' ) ) {
	function azen_excerpt( $limit ) {
		$text  = get_the_content( '' );
		$text  = strip_shortcodes( $text );
		$text  = apply_filters( 'the_content', $text );
		$text  = str_replace( ']]>', ']]>', $text );
		$text  = strip_tags( $text );
		$text  = nl2br( $text );
		$words = explode( ' ', $text, $limit + 1 );
		if ( count( $words ) > $limit ) {
			array_pop( $words );
			array_push( $words, '' );
			$text = implode( ' ', $words );
		}

		return apply_filters( 'the_content', wpautop( $text ) );
	}
}

if ( !function_exists( 'azen_comment' ) ) :
	function azen_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">
					<p><?php esc_attr_e( 'Pingback:', 'azen' ); ?><?php comment_author_link(); ?><?php edit_comment_link( esc_attr__( 'Edit', 'azen' ), '<span class="edit-link">', '</span>' ); ?></p>
				</li>
				<?php
				break;
			default :
				?>

			<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
				<div class="wrapper-comment">
					<?php
					if ( $args['avatar_size'] != 0 ) {
						echo '<div class="wrapper_avatar">' . get_avatar( $comment, $args['avatar_size'] ) . '</div>';
					}
					?>
					<div class="comment-right">
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'azen' ) ?></em>
						<?php endif; ?>
						<div class="comment-extra-info">
							<div class="info-left">
								<div class="author"><?php printf( '%s', get_comment_author_link() ) ?></div>
								<div class="date">
									<?php printf( get_comment_date(), get_comment_time() ) ?>
								</div>
							</div>
						</div>
						<div class="content-comment">
							<?php comment_text() ?>
						</div>
						<div class="info-right">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_attr__( 'reply', 'azen' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ), $comment->comment_ID ); ?>
							<?php edit_comment_link( esc_attr__( 'edit', 'azen' ), '', '' ); ?>
						</div>
					</div>
				</div>
				<?php
				break;
		endswitch;
	}
endif;

/*
 * end list comment
 */

add_editor_style();

/**
 * shortcode
 */
if ( function_exists( 'vc_map' ) ) {
	get_template_part( 'inc/shortcode/shortcode' );
}
/*
 * breadcrumb
 */
require get_template_directory() . '/inc/breadcrumb.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * logo
 */
require get_template_directory() . '/inc/global/logo.php';

/**
 * Display Setting front end
 */
require_once get_template_directory() . '/inc/global/wrapper-before-after.php';

/**
 * Add Meta box
 */
require get_template_directory() . '/inc/admin/meta-boxes.php';

/**
 * Add WooCommerce Setting
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/woocommerce/woocommerce.php';
}

require get_template_directory() . '/inc/admin/required-plugins/plugins-require.php';
/*
	Theme Option
*/

require get_template_directory() . '/inc/admin/options-config.php';
/*
	Generator CSS from Theme Option
*/
require get_template_directory() . '/inc/admin/sassphp/sass2css.php';
/*
 * Module options
 */
require get_template_directory() . '/physc-builder/options-modules.php';


add_filter( 'get_the_archive_title', function ( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_404() ) {
		$title = '404';
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_page() ) {
		$title = single_post_title( '', false );
	} elseif ( is_single() ) {
		$title = esc_attr__( 'Blog', 'azen' );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_front_page() || is_home() ) {
		if ( get_option( 'page_for_posts' ) <> 0 ) {
			$title = get_the_title( get_option( 'page_for_posts' ) );
		} else {
			$title = esc_attr__( 'Blog', 'azen' );
		}
	} elseif ( is_search() ) {
		$title = sprintf( esc_html__( 'Search Results for: %s', 'azen' ), '<span>' . get_search_query( '' ) . '</span>' );
	}

	return $title;
} );

// Hard Crop
if ( false === get_option( "medium_crop" ) ) {
	add_option( "medium_crop", "1" );
} else {
	update_option( "medium_crop", "1" );
}
if ( false === get_option( "large_crop" ) ) {
	add_option( "large_crop", "1" );
} else {
	update_option( "large_crop", "1" );
}

add_filter( 'oembed_dataparse', function ( $return, $data, $url ) {
	if ( is_object( $data ) ) {
		$return = str_ireplace(
			array(
				'frameborder="0"'
			), '', $return
		);
	}

	return $return;
}, 10, 3 );



