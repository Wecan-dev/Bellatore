<?php
/**
 * PhyscBuilders Elementor Icon Box widget
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

if ( ! class_exists( 'PhyscBuilder_El_Banner_Html' ) ) {
	/**
	 * Class PhyscBuilder_El_Icon_Box
	 */
	class PhyscBuilder_El_Banner_Html extends PhyscBuilder_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'PhyscBuilder_Config_Banner_Html';

		/**
		 * Register controls.
		 */
		protected function _register_controls() {
			$this->start_controls_section(
				'el-banner-html', [ 'label' => esc_html__( 'Banner HTML', 'physc-builder' ) ]
			);

			$controls = \PhyscBuilder_El_Mapping::mapping( $this->options() );

			foreach ( $controls as $key => $control ) {
				$this->add_control( $key, $control );
			}

			$this->end_controls_section();
		}
	}
}