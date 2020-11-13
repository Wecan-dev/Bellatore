<?php
/**
 * PhyscBuilders Elementor Countdown widget
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

if ( ! class_exists( 'PhyscBuilder_El_Countdown' ) ) {
	/**
	 * Class PhyscBuilder_El_Countdown
	 */
	class PhyscBuilder_El_Countdown extends PhyscBuilder_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'PhyscBuilder_Config_Countdown';

		/**
		 * Register controls.
		 */
		protected function _register_controls() {
			$this->start_controls_section(
				'el-countdown', [ 'label' => esc_html__( 'Countdown', 'physc-builder' ) ]
			);

			$controls = \PhyscBuilder_El_Mapping::mapping( $this->options() );

			foreach ( $controls as $key => $control ) {
				$this->add_control( $key, $control );
			}

			$this->end_controls_section();
		}
	}
}