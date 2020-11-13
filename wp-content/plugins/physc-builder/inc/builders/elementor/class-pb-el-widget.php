<?php
/**
 * PhyscBuilders Elementor widget class
 *
 * @version     1.0.0
 * @author      Physcode
 * @package     PhyscBuilders/Classes
 * @category    Classes
 * @author      Physcode
 */

//namespace Physc Builder;

use \Elementor\Widget_Base;

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'PhyscBuilder_El_Widget' ) ) {
	/**
	 * Class PhyscBuilder_El_Widget
	 */
	abstract class PhyscBuilder_El_Widget extends Widget_Base {

		/**
		 * @var string
		 */
		protected $config_class = '';

		/**
		 * @var null
		 */
		protected $keywords = array();

		/**
		 * @var null
		 */
		protected $class = null;

		/**
		 * PhyscBuilder_El_Widget constructor.
		 *
		 * @param array $data
		 * @param array|null $args
		 *
		 * @throws Exception
		 */
		public function __construct( array $data = [], array $args = null ) {

			if ( ! $this->config_class ) {
				return;
			}
			/**
			 * @var $config_class PhyscBuilder_Abstract_Config
			 */
 			$config_class = new $this->config_class();
			$config_class::enqueue_scripts();
			$config_class::register_scripts();
			// enqueue scripts in Preview mode
			add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );

			add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_scripts' ) );
			add_action( 'elementor/preview/enqueue_scripts', array( $this, 'preview_scripts' ) );
			parent::__construct( $data, $args );
		}

		public function preview_scripts() {
			/**
			 * @var $config_class PhyscBuilder_Abstract_Config
			 */
			$config_class = new $this->config_class();

			$config_class::enqueue_scripts();
		}

		/**
		 * Register scripts
		 */
		public function register_scripts() {
			/**
			 * @var $config_class PhyscBuilder_Abstract_Config
			 */
			$config_class = new $this->config_class();

			$config_class::register_scripts();
		}

		/**
		 * @return mixed|string
		 */
		public function get_name() {

			if ( ! $this->config_class ) {
				return '';
			}

			// config class
			$config_class = new $this->config_class();

			return 'physc-' . $config_class::$base;
		}

		/**
		 * @return string
		 */
		public function get_base() {
			if ( ! $this->config_class ) {
				return '';
			}

			// config class
			$config_class = new $this->config_class();

			return $config_class::$base;
		}

		/**
		 * @return mixed|string
		 */
		public function get_title() {

			if ( ! $this->config_class ) {
				return '';
			}

			// config class
			$config_class = new $this->config_class();

			return $config_class::$name;
		}

		/**
		 * @return string
		 */
		public function get_group() {

			if ( ! $this->config_class ) {
				return '';
			}

			// config class
			$config_class = new $this->config_class();

			return $config_class::$group;
		}

		/**
		 * @return array
		 */
		public function get_categories() {
			return array( 'physc-builder' );
		}

		/**
		 * @return array
		 */
		public function get_keywords() {
			$keywords = array_merge( $this->keywords, array( $this->get_name(), 'physc-builder' ) );

			return $keywords;
		}

		/**
		 * @return array
		 */
		public function get_script_depends() {
			/**
			 * @var $config_class PhyscBuilder_Abstract_Config
			 */
			$config_class = new $this->config_class();

			$assets = $config_class::_get_assets();

			$depends = array();
			if ( ! empty( $assets['scripts'] ) ) {
				foreach ( $assets['scripts'] as $key => $script ) {
					$depends[] = $key;
				}
			}

			return $depends;
		}

		/**
		 * @return array
		 */
		public function get_style_depends() {
			/**
			 * @var $config_class PhyscBuilder_Abstract_Config
			 */
			$config_class = new $this->config_class();

			$assets = $config_class::_get_assets();

			$depends = array();
			if ( ! empty( $assets['styles'] ) ) {
				foreach ( $assets['styles'] as $key => $style ) {
					$depends[] = $key;
				}
			}

			return $depends;
		}

		/**
		 * Render.
		 */
		protected function render() {
			if ( ! $this->config_class ) {
				return;
			}

			// allow hook before template
			do_action( 'physc-builder/before-modules-template', $this->get_name() );

			// get settings
			$settings = $this->get_settings_for_display();

			// handle settings
			$settings = $this->_handle_settings( $settings );

			$settings = array_merge( $settings, array(
				'group'         => $this->get_group(),
				'base'          => $this->get_base(),
				'template_path' => $this->get_group() . '/' . $this->get_base() . '/tpl/'
			) );

			physc_builder_get_template( $this->get_base(), array( 'params' => $settings ), $settings['template_path'] );
		}

		/**
		 * @param      $settings
		 * @param null $controls
		 *
		 * @return mixed
		 */
		private function _handle_settings( $settings, $controls = null ) {

			if ( ! $controls ) {
				$controls = $this->options();
			}

			foreach ( $controls as $key => $control ) {
				if ( array_key_exists( $control['param_name'], $settings ) ) {

					$type  = $control['type'];
					$value = $settings[ $control['param_name'] ];
					switch ( $type ) {
						case 'param_group':
							if ( isset( $value ) ) {
								foreach ( $value as $_key => $_value ) {
									$settings[ $control['param_name'] ][ $_key ] = $this->_handle_settings( $_value, $control['params'] );
								}
							}
							break;
						case 'vc_link':
							$settings[ $control['param_name'] ] = array(
								'url'    => $value['url'],
								'target' => $value['is_external'] == 'on' ? '_blank' : '',
								'rel'    => $value['nofollow'] == 'on' ? 'nofollow' : '',
								'title'  => ''
							);
							break;
						case 'attach_image':
							$settings[ $control['param_name'] ] = $value['id'];
							break;
						default:
							break;
					}
				}
			}

			return $settings;
		}

		/**
		 * @return array
		 */
		public function options() {
			if ( ! $this->config_class ) {
				return array();
			}

			// config class
			$config_class = new $this->config_class();
			$options      = $config_class::$options;
			foreach ( $options as $key_lv1 => $value_lv1 ) {
				if ( $value_lv1['type'] != 'param_group' ) {
					continue;
				}
				$params_lv1 = $value_lv1['params'];
				foreach ( $params_lv1 as $key_lv2 => $value_lv2 ) {
					if ( $value_lv2['type'] != 'param_group' ) {
						continue;
					}
					if ( isset( $value_lv2['max_el_items'] ) && $value_lv2['max_el_items'] > 0 ) {
						$params_lv2    = $value_lv2['params'];
						$separate_text = $params_lv1[ $key_lv2 ]['heading'];
						unset( $params_lv1[ $key_lv2 ] );
						$params_lv1 = array_values( $params_lv1 );
						$i          = 0;
						while ( $i < $value_lv2['max_el_items'] ) {
							$i ++;
							$default_hidden = array();
							foreach ( $params_lv2 as $key_lv3 => $value_lv3 ) {
								$horizon = array(
									'type'       => 'bp_heading',
									'heading'    => $separate_text . ' #' . $i,
									'param_name' => 'horizon_line' . ' #' . $i
								);
								if ( $i === 1 ) {
									$default_hidden[] = $value_lv3['param_name'];
									$hidden           = array(
										'type'       => 'bp_hidden',
										'param_name' => $value_lv2['param_name'],
										'std'        => $value_lv2['max_el_items'] . '|' . implode( ',', $default_hidden )
									);
									$params_lv1[]     = $hidden;
								}
								$params_lv1[]            = $horizon;
								$value_lv3['param_name'] = $value_lv3['param_name'] . $i;
								if ( isset( $value_lv3['dependency'] ) && $value_lv3['dependency']['element'] != '' ) {
									$value_lv3['dependency']['element'] = $value_lv3['dependency']['element'] . $i;
								}
								$params_lv1[] = $value_lv3;
							}
						}
					}
				}
				$options[ $key_lv1 ]['params'] = $params_lv1;
			}

			return $options;
		}

		/**
		 * @return string
		 */
		public function assets_url() {
			if ( ! $this->config_class ) {
				return '';
			}

			// config class
			$config_class = new $this->config_class();

			return $config_class::$assets_url;
		}
	}

}