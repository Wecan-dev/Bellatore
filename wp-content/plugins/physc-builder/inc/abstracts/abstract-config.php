<?php
/**
 * PhyscBuilders Abstract Config
 *
 * @version     1.0.0
 * @author      Physcode
 * @package     PhyscBuilders/Classes
 * @category    Classes/Abstract
 * @author      Physcode
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'PhyscBuilder_Abstract_Config' ) ) {

	/**
	 * Class PhyscBuilder_Abstract_Config
	 */
	abstract class PhyscBuilder_Abstract_Config {

		/**
		 * @var string
		 */
		public static $group = '';

		/**
		 * @var string
		 */
		public static $base = '';

		/**
		 * @var string
		 */
		public static $name = '';

		/**
		 * @var string
		 */
		public static $desc = '';

		/**
		 * @var array
		 */
		public static $options = array();

		/**
		 * @var string
		 */
		public static $assets_url = '';

		/**
		 * @var string
		 */
		public static $assets_path = '';

		/**
		 * @var array
		 */
		public static $styles = array();

		/**
		 * @var array
		 */
		public static $scripts = array();

		/**
		 * @var array
		 */
		public static $queue_assets = array();

		/**
		 * @var array
		 */
		public static $localize = array();

		/**
		 * PhyscBuilder_Abstract_Config constructor.
		 */
		public function __construct() {

			// set group
			self::$group = physc_builder_get_group( self::$base );

			self::$assets_url  = PHYSC_BUILDER_URL . 'inc/modules/' . self::$group . '/' . self::$base . '/assets/';
			self::$assets_path = PHYSC_BUILDER_INC . 'modules/' . self::$group . '/' . self::$base . '/assets/';

			// set options
			self::$options = is_array( $this->get_options() ) ? $this->get_options() : array();
			// handle std, add default options
			self::$options = apply_filters( "physc-builder/" . self::$base . '/config-options', $this->_handle_options( array_merge( self::$options, $this->_default_options() ) ) );

			// set styles
			self::$styles = apply_filters( 'physc-builder/' . self::$base . '/styles', $this->get_styles() );
			// set scripts
			self::$scripts = apply_filters( 'physc-builder/' . self::$base . '/scripts', $this->get_scripts() );
			// set localize
			self::$localize = apply_filters( 'physc-builder/' . self::$base . '/localize', $this->get_localize() );
		}

		/**
		 * @param $options
		 *
		 * @return mixed
		 */
		protected function _handle_options( $options ) {

			foreach ( $options as $key => $option ) {
				if ( !isset( $option['std'] ) ) {
					$type = $option['type'];

					switch ( $type ) {
						case 'dropdown':
							$values               = ( !empty( $option['value'] ) && is_array( $option['value'] ) ) ? array_values( $option['value'] ) : '';
							$options[$key]['std'] = $values ? reset( $values ) : '';
							break;
						case 'param_group':
							$options[$key]['params'] = $this->_handle_options( $option['params'] );
							break;
						case 'radio_image':
							$values               = ( !empty( $option['options'] ) && is_array( $option['options'] ) ) ? array_values( $option['options'] ) : '';
							$options[$key]['std'] = $values ? reset( $values ) : '';
							break;
						default:
							$options[$key]['std'] = '';
							break;
					}
				}
			}

			return $options;
		}

		/**
		 * @return array
		 */
		public function get_options() {
			return array();
		}

		/**
		 * @return array
		 */
		public function get_styles() {
			return array();
		}

		/**
		 * @return array
		 */
		public function get_scripts() {
			return array();
		}

		/**
		 * @return array
		 */
		public function get_localize() {
			return array();
		}

		/**
		 * @return array
		 */
		public static function _get_assets() {

			$queue_assets = array();

			$prefix = apply_filters( 'physc-builder/prefix-assets', 'physc-builder-element-' );

			if ( self::$styles ) {
				// allow hook default folder
				$default_folder_css = apply_filters( 'physc-builder/default-assets-folder', self::$assets_path . 'css/', self::$base );
				$default_url_css    = apply_filters( 'physc-builder/default-assets-folder', self::$assets_url . 'css/', self::$base );

				foreach ( self::$styles as $handle => $args ) {
					$src      = $args['src'];
					$depends  = ( isset( $args['deps'] ) && is_array( $args['deps'] ) ) ? $args['deps'] : array();
					$media    = !empty( $args['media'] ) ? $args['media'] : 'all';
					$deps_src = isset( $args['deps_src'] ) ? $args['deps_src'] : array();

					if ( file_exists( $default_folder_css . $src ) ) {
						// enqueue depends
						if ( $depends ) {
							foreach ( $depends as $depend ) {
								if ( wp_script_is( $depend ) ) {

									wp_enqueue_style( $depend );
								} else {
									do_action( 'physc-builder/enqueue-depends-styles', self::$base, $depend );
								}
							}
						}

						// add to queue
						$queue_assets['styles'][$prefix . $handle] = array(
							'url'      => $default_url_css . $src,
							'deps'     => $depends,
							'media'    => $media,
							'deps_src' => $deps_src
						);
					}
				}
			}

			if ( self::$scripts ) {
				// allow hook default folder
				$default_folder_js = apply_filters( 'physc-builder/default-assets-folder', self::$assets_path . 'js/', self::$base );
				$default_url_js    = apply_filters( 'physc-builder/default-assets-folder', self::$assets_url . 'js/', self::$base );
				$localized         = false;
				foreach ( self::$scripts as $handle => $args ) {
					$src       = $args['src'];
					$depends   = !empty( $args['deps'] ) ? $args['deps'] : array();
					$in_footer = isset( $args['in_footer'] ) ? $args['in_footer'] : true;
					$deps_src  = isset( $args['deps_src'] ) ? $args['deps_src'] : array();

					if ( file_exists( $default_folder_js . $src ) ) {
						// enqueue depends
						if ( $depends ) {
							foreach ( $depends as $depend ) {
								if ( wp_script_is( $depend ) && $depend != 'jquery' ) {
									wp_enqueue_script( $depend );
								} else {
									do_action( 'physc-builder/enqueue-depends-scripts', self::$base, $depend );
								}
							}
						}

						// add to queue
						$queue_assets['scripts'][$prefix . $handle] = array(
							'url'       => $default_url_js . $src,
							'deps'      => $depends,
							'in_footer' => $in_footer,
							'deps_src'  => $deps_src
						);

						if ( self::$localize ) {
							foreach ( self::$localize as $name => $data ) {
								$queue_assets['scripts'][$prefix . $handle]['localize'][$name] = $data;
							}
						}

						if ( !$localized && self::$localize ) {
							foreach ( self::$localize as $name => $data ) {
								wp_localize_script( $prefix . $handle, $name, $data );
							}
							$localized = true;
						}
					}
				}
			}

			return $queue_assets;
		}

		/**
		 * Register scripts
		 */
		public static function register_scripts() {

			$queue = self::_get_assets();

			$localized = false;
			if ( $queue ) {
				foreach ( $queue as $key => $assets ) {
					if ( $key == 'styles' ) {
						foreach ( $assets as $name => $args ) {
							wp_register_style( $name, $args['url'], $args['deps'], PHYSC_BUILDER_VER, $args['media'] );
						}
					} else {
						if ( $key == 'scripts' ) {
							foreach ( $assets as $name => $args ) {
								wp_register_script( $name, $args['url'], $args['deps'], PHYSC_BUILDER_VER, $args['in_footer'] );

								// localize scripts
								if ( !$localized && isset( $args['localize'] ) ) {
									foreach ( $args['localize'] as $index => $data ) {
										wp_localize_script( $name, $index, $data );
									}
									$localized = true;
								}
							}
						}
					}
				}
			}
		}

		/**
		 * Enqueue scripts.
		 */
		public static function enqueue_scripts() {
			$queue = self::_get_assets();

			if ( $queue ) {
				foreach ( $queue as $key => $assets ) {
					if ( $key == 'styles' ) {
						foreach ( $assets as $name => $args ) {
							if ( !empty( $args['deps_src'] ) ) {
								foreach ( $args['deps_src'] as $deps_name => $deps_src ) {
									if ( !wp_script_is( $deps_name, 'registered' ) ) {
										wp_register_style( $deps_name, $deps_src );
									}
								}
							}
							wp_enqueue_style( $name );
						}
					} else {
						if ( $key == 'scripts' ) {
							foreach ( $assets as $name => $args ) {
								if ( !empty( $args['deps_src'] ) ) {
									foreach ( $args['deps_src'] as $deps_name => $deps_src ) {
										if ( !wp_script_is( $deps_name, 'registered' ) ) {
											wp_register_script( $deps_name, $deps_src );
										}
									}
								}
								wp_enqueue_script( $name );
							}
						}
					}
				}
			}
		}

		/**
		 * @return mixed
		 */
		protected function _icon_options() {

			$icon_options = array(
				array(
					'type'             => 'dropdown',
					'heading'          => esc_attr__( 'Icon type', 'physc-builder' ),
					'param_name'       => 'icon_type',
					'admin_label'      => true,
					'value'            => array(
						esc_attr__( 'None', 'physc-builder' )         => 'none',
						esc_attr__( 'Font Awesome', 'physc-builder' ) => 'icon_fontawesome',
						esc_attr__( 'Upload Image', 'physc-builder' ) => 'icon_upload',
					),
					'std'              => 'icon_fontawesome',
					'edit_field_class' => 'vc_col-sm-6',
				),

				// Fontawesome Picker
				array(
					'type'             => 'iconpicker',
					'heading'          => esc_attr__( 'Font Awesome', 'physc-builder' ),
					'param_name'       => 'icon_fontawesome',
					'value'            => 'fa fa-heart',
					'settings'         => array(
						'emptyIcon'    => false,
						'iconsPerPage' => 50,
						'type'         => 'fontawesome',
					),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'icon_fontawesome' ),
					),
					'edit_field_class' => 'vc_col-sm-6',
					'description'      => esc_html__( 'Font awesome library.', 'physc-builder' ),
				),
				// Upload icon image
				array(
					'type'             => 'attach_image',
					'heading'          => esc_attr__( 'Upload icon', 'physc-builder' ),
					'param_name'       => 'icon_upload',
					'admin_label'      => true,
					'description'      => esc_attr__( 'Select an image to upload', 'physc-builder' ),
					'dependency'       => array(
						'element' => 'icon_type',
						'value'   => array( 'icon_upload' )
					),
					'edit_field_class' => 'vc_col-sm-6',
				)
			);

			return apply_filters( 'physc-builder/element-icon-options', $icon_options );
		}

		/**
		 * Options to config number items in slider.
		 *
		 * @param array $default
		 * @param array $depends
		 *
		 * @return mixed
		 */
		protected function _number_items_options( $default = array(), $depends = array() ) {

			$options = apply_filters( 'physc-builder/element-default-number-items-slider', array(
				array(
					'type'             => 'number',
					'heading'          => esc_html__( 'Visible Items', 'physc-builder' ),
					'param_name'       => 'items_visible',
					'std'              => '4',
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-xs-4',
				),

				array(
					'type'             => 'number',
					'heading'          => esc_html__( 'Tablet Items', 'physc-builder' ),
					'param_name'       => 'items_tablet',
					'std'              => '2',
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-xs-4',
				),

				array(
					'type'             => 'number',
					'heading'          => esc_html__( 'Mobile Items', 'physc-builder' ),
					'param_name'       => 'items_mobile',
					'std'              => '1',
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-xs-4',
				)
			) );

			// handle default value
			if ( $default ) {
				foreach ( $options as $key => $item ) {
					$name = $item['param_name'];
					if ( array_key_exists( $name, $default ) ) {
						$options[$key]['std'] = $default[$name];
					}
				}
			}

			// handle dependency
			if ( $depends ) {
				foreach ( $options as $key => $item ) {
					$options[$key]['dependency'] = $depends;
				}
			}

			return $options;
		}

		/**
		 * Get all Post type categories.
		 *
		 * @param       $category_name
		 *
		 * @return array
		 */
		protected function _post_type_categories( $category_name ) {

			global $wpdb;
			$categories = $wpdb->get_results( $wpdb->prepare(
				"
				  SELECT      t2.term_id, t2.name
				  FROM        $wpdb->term_taxonomy AS t1
				  INNER JOIN $wpdb->terms AS t2 ON t1.term_id = t2.term_id
				  WHERE t1.taxonomy = %s
				  ",
				$category_name
			) );

			$options = array( esc_html__( 'All Category', 'physc-builder' ) => ' ' );
			foreach ( $categories as $category ) {
				$options[html_entity_decode( $category->name )] = $category->term_id;
			}

			return $options;

		}

		/**
		 * @return mixed
		 */
		protected function _setting_font_weights() {

			$font_weight = array(
				esc_html__( 'Select', 'physc-builder' ) => '',
				esc_html__( 'Normal', 'physc-builder' ) => 'normal',
				esc_html__( 'Bold', 'physc-builder' )   => 'bold',
				'100'                                   => '100',
				'200'                                   => '200',
				'300'                                   => '300',
				'400'                                   => '400',
				'500'                                   => '500',
				'600'                                   => '600',
				'700'                                   => '700',
				'800'                                   => '800',
				'900'                                   => '900'
			);

			return apply_filters( 'physc-builder/settings-font-weight', $font_weight );
		}

		/**
		 * @return mixed
		 */
		protected function _setting_tags() {

			$tags = array(
				esc_html__( 'Select tag', 'physc-builder' ) => '',
				'h2'                                        => 'h2',
				'h3'                                        => 'h3',
				'h4'                                        => 'h4',
				'h5'                                        => 'h5',
				'h6'                                        => 'h6'
			);

			return apply_filters( 'physc-builder/settings-tags', $tags );
		}

		/**
		 * @return mixed
		 */
		protected function _setting_text_transform() {

			$text_transform = array(
				esc_html__( 'None', 'physc-builder' )       => 'none',
				esc_html__( 'Capitalize', 'physc-builder' ) => 'capitalize',
				esc_html__( 'Uppercase', 'physc-builder' )  => 'uppercase',
				esc_html__( 'Lowercase', 'physc-builder' )  => 'lowercase',
			);

			return apply_filters( 'physc-builder/settings-text-transform', $text_transform );
		}

		/**
		 * Default options for all elements.
		 *
		 * @return mixed
		 */
		protected function _default_options() {

			$default_options = array(
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => __( 'Extra class', 'physc-builder' ),
					'param_name'  => 'el_class',
					'value'       => '',
					'description' => __( 'Add extra class for element.', 'physc-builder' ),
				),
			);

			return apply_filters( 'physc-builder/element-default-options', $default_options );
		}

		protected function _all_sales_options() {
			$product_cat        = array();
			$product_categories = wc_get_product_ids_on_sale();
			if ( is_array( $product_categories ) ) {
				foreach ( $product_categories as $cat ) {
					$product_cat[get_the_title( $cat )] = $cat;
				}
			}

			return $product_cat;
		}
	}
}