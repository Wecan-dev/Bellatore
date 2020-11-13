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

if ( !class_exists( 'PhyscBuilder_Config_Flash_List_Sale' ) ) {
	/**
	 * Class PhyscBuilder_Config_Products
	 */
	class PhyscBuilder_Config_Flash_List_Sale extends PhyscBuilder_Abstract_Config {

		/**
		 * PhyscBuilder_Config_Products constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'flash-list-sale';
			self::$name = __( 'Flash List Sale Countdown', 'physc-builder' );
			self::$desc = __( 'Display flash list sale count down', 'physc-builder' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {
			// options
			return array(
                array(
                    'type'       => 'param_group',
                    'heading'    => __( 'Product Sale', 'physc-builder' ),
                    'param_name' => 'list_sale_tab',
                    'value'      => '',
                    'params'     => array(
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Choose a Product Sale', 'physc-builder' ),
                            'param_name' => 'product_sale_id',
                            'value'      => $this->_all_sales_options(),
                            'std'        => ''
                        ),
                    ),
                )
			);
		}

		public function get_scripts() {
			return array(
				'flash-list-countdown' => array(
					'src'  => 'flash-list-countdown.js',
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