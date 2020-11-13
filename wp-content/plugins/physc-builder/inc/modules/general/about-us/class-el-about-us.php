<?php
/**
 * PhyscBuilders Elementor About Us widget
 *
 * @version     1.0.0
 * @author      Physcode
 * @package     PhyscBuilders/Classes
 * @category    Classes
 * @author      Physcode
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'PhyscBuilder_El_About_Us' ) ) {
	/**
	 * Class PhyscBuilder_El_Icon_Box
	 */
	class PhyscBuilder_El_About_Us extends PhyscBuilder_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'PhyscBuilder_Config_About_Us';

		/**
		 * Register controls.
		 */
		protected function _register_controls() {
			$this->start_controls_section(
				'el-about-us', [ 'label' => esc_html__( 'About Us', 'physc-builder' ) ]
			);

			$controls = \PhyscBuilder_El_Mapping::mapping( $this->options() );

			foreach ( $controls as $key => $control ) {
				$this->add_control( $key, $control );
			}

			$this->end_controls_section();
		}
	}
}