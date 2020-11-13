<?php
/**
 * PhyscBuilders Reviews config class
 *
 * @version     1.0.0
 * @author      Physcodes
 * @package     PhyscBuilders/Classes
 * @category    Classes
 * @author      Physcodes
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'PhyscBuilder_Config_Reviews' ) ) {
	/**
	 * Class PhyscBuilder_Config_Reviews
	 */
	class PhyscBuilder_Config_Reviews extends PhyscBuilder_Abstract_Config {
		/**
		 * PhyscBuilder_Config_Reviews constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'reviews';
			self::$name = __( 'Reviews', 'physc-builder' );
			self::$desc = __( 'Display a reviews box.', 'physc-builder' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {
			// options
			return array_merge( array(
					array(
						'type'        => 'number',
						'heading'     => esc_html__( 'Number of revies', 'physc-builder' ),
						'param_name'  => 'number',
						'std'         => '5',
						'admin_label' => true,
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Order', 'physc-builder' ),
						'param_name'  => 'order',
						'std'         => 'desc',
						'value'       => array(
							esc_html__( 'DESC', 'physc-builder' ) => 'desc',
							esc_html__( 'ASC', 'physc-builder' )  => 'asc'
						),
						'admin_label' => true,
					),
				)
			);
		}


	}
}