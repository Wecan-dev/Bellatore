<?php
/**
 * PhyscBuilders Products config class
 *
 * @version     1.0.0
 * @author      Physcode
 * @package     PhyscBuilders/Classes
 * @category    Classes
 * @author      Physcodes
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'PhyscBuilder_Config_Flash_Sale' ) ) {
	/**
	 * Class PhyscBuilder_Config_Products
	 */
	class PhyscBuilder_Config_Flash_Sale extends PhyscBuilder_Abstract_Config {

		/**
		 * PhyscBuilder_Config_Products constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'flash-sale';
			self::$name = __( 'Flash Sale Countdown', 'physc-builder' );
			self::$desc = __( 'Display flash sale count down', 'physc-builder' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {

			// options
			return array_merge(
				array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_attr__( 'Title', 'physc-builder' ),
						'param_name'  => 'title',
						'admin_label' => true,
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__( 'Image Left', 'physc-builder' ),
						'param_name' => 'image_left',
						'value'      => '', // default value to backend editor admin_label
					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_attr__( 'Background Color', 'physc-builder' ),
						'param_name'       => 'bg_color_sc',
						'value'            => '',
						'edit_field_class' => 'vc_col-xs-6',

					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_attr__( 'Color', 'physc-builder' ),
						'param_name'       => 'color_sc',
						'value'            => '',
						'edit_field_class' => 'vc_col-xs-6',

					),

					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Choose a Product Sale', 'physc-builder' ),
						'param_name' => 'product_id',
						'value'      => $this->_all_sales_options(),
						'std'        => ''
					),

				)
			);
		}

		public function get_scripts() {
			return array(
				'flash-countdown' => array(
					'src'  => 'flash-countdown.js',
					'deps' => array(
						'jquery',
						'physc-builder-jquery-plugin',
						'physc-builder-countdown'
					)
				)
			);
		}
	}
}