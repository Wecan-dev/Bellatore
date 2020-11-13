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

if ( !class_exists( 'PhyscBuilder_Config_Products_Cat' ) ) {
	/**
	 * Class PhyscBuilder_Config_Products_Cat
	 */
	class PhyscBuilder_Config_Products_Cat extends PhyscBuilder_Abstract_Config {

		/**
		 * PhyscBuilder_Config_Products_Cat constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'products-cat';
			self::$name = __( 'Category Products', 'physc-builder' );
			self::$desc = __( 'Display category products', 'physc-builder' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {

			return array(
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Category', 'physc-builder' ),
					'param_name'  => 'product_cat',
					'value'       => $this->_post_type_categories( 'product_cat' ),
					"admin_label" => true,
				),
			);
		}
	}
}