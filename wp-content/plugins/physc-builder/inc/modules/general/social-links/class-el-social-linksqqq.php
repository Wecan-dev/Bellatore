<?php
/**
 * PhyscBuilders Elementor Social Links widget
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

if ( !class_exists( 'PhyscBuilder_El_Social_Links' ) ) {
	/**
	 * Class PhyscBuilder_El_Posts
	 */
	class PhyscBuilder_El_Social_Links extends PhyscBuilder_El_Widget {

		/**
		 * @var string
		 */
		protected $config_class = 'PhyscBuilder_Config_Social_Links';

		/**
		 * Register controls.
		 */
		protected function _register_controls() {
			$this->start_controls_section(
				'el-social-links', [ 'label' => esc_html__( 'Social Links', 'physc-builder' ) ]
			);

			$controls = \PhyscBuilder_El_Mapping::mapping( $this->options() );

			foreach ( $controls as $key => $control ) {
				$this->add_control( $key, $control );
			}

			$this->end_controls_section();
		}
	}
}