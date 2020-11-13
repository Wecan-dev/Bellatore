<?php
/**
 * PhyscBuilders Countdown config class
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

if ( !class_exists( 'PhyscBuilder_Config_Countdown' ) ) {
	/**
	 * Class PhyscBuilder_Config_Countdown
	 */
	class PhyscBuilder_Config_Countdown extends PhyscBuilder_Abstract_Config {

		/**
		 * PhyscBuilder_Config_Countdown constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'countdown';
			self::$name = __( 'Countdown', 'physc-builder' );
			self::$desc = __( 'Display countdown', 'physc-builder' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {

			// options
			return array(
				array(
					'type'       => 'textarea',
					'heading'    => esc_attr__( 'Text before title', 'physc-builder' ),
					'param_name' => 'before_title',
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_attr__( 'Text color', 'physc-builder' ),
					'param_name' => 'before_title_color',
					'value'      => '',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_attr__( 'Title', 'physc-builder' ),
					'param_name'  => 'title',
					'admin_label' => true,
				),

				array(
					'type'             => 'dropdown',
					'heading'          => esc_attr__( 'Element tag', 'physc-builder' ),
					'param_name'       => 'element_tag',
					'value'            => array(
						'H1' => 'h2',
						'H2' => 'h2',
						'H3' => 'h3',
						'H4' => 'h4',
						'H5' => 'h5',
						'H6' => 'h6',
					),
					'std'              => 'h3',
					'edit_field_class' => 'vc_col-xs-6'
				),
				array(
					'type'             => 'colorpicker',
					'heading'          => esc_attr__( 'Title color', 'physc-builder' ),
					'param_name'       => 'title_color',
					'value'            => '',
					'edit_field_class' => 'vc_col-xs-6'
				),

				array(
					'type'        => 'datetimepicker',
					'heading'     => esc_html__( 'Date', 'physc-builder' ),
					'param_name'  => 'countdown-date',
					'admin_label' => true,
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Upload Background Image', 'physc-builder' ),
					'param_name' => 'bg_image',
					'value'      => '',
				),
				array(
					'type'             => 'dropdown',
					"heading"          => esc_html__( "View More", "physc-builder" ),
					'param_name'       => 'show_view_more',
					'value'            => array(
						esc_attr__( 'Show', 'physc-builder' )   => 'true',
						esc_attr__( 'Hidden', 'physc-builder' ) => 'false',
					),
					'std'              => 'false',
					'edit_field_class' => 'vc_col-xs-3',
				),
				array(
					"type"             => "textfield",
					"heading"          => esc_html__( "Text View More", "physc-builder" ),
					"param_name"       => "text_view_more",
					"std"              => esc_html__( "View More", "physc-builder" ),
					"dependency"       => Array( "element" => "show_view_more", "value" => array( "true" ) ),
					'edit_field_class' => 'vc_col-xs-4'
				),
				array(
					"type"             => "textfield",
					"heading"          => esc_html__( "Link View More", "physc-builder" ),
					"param_name"       => "link_view_more",
					"std"              => "#",
					"dependency"       => Array( "element" => "show_view_more", "value" => array( "true" ) ),
					'edit_field_class' => 'vc_col-xs-5'
				),
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'countdown' => array(
					'src'  => 'countdown.js',
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