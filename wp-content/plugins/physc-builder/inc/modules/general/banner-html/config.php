<?php
/**
 * PhyscBuilders Banner Html config class
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

if ( !class_exists( 'PhyscBuilder_Config_Banner_Html' ) ) {
	/**
	 * Class PhyscBuilder_Config_Banner_Html
	 */
	class PhyscBuilder_Config_Banner_Html extends PhyscBuilder_Abstract_Config {

		/**
		 * PhyscBuilder_Config_Banner_Html constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'banner-html';
			self::$name = __( 'Banner HTML', 'physc-builder' );
			self::$desc = __( 'Display an banner', 'physc-builder' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {

			// options
			return array(
				array(
					'type'        => 'dropdown',
					'admin_label' => true,
					'heading'     => esc_attr__( 'Layout', 'physc-builder' ),
					'param_name'  => 'layout',
					'value'       => array(
						esc_attr__( 'Layout 1', 'physc-builder' ) => 'layout-1',
						esc_attr__( 'Layout 2', 'physc-builder' ) => 'layout-2',
						esc_attr__( 'Layout 3', 'physc-builder' ) => 'layout-3',
						esc_attr__( 'Layout 4', 'physc-builder' ) => 'layout-4',
					),
					'std'         => 'layout-1',
				),

				array(
					'type'        => 'dropdown',
					'admin_label' => true,
					'heading'     => esc_attr__( 'Text align', 'physc-builder' ),
					'param_name'  => 'text_align',
					'value'       => array(
						esc_attr__( 'Left', 'physc-builder' )   => 'left',
						esc_attr__( 'Right', 'physc-builder' )  => 'right',
						esc_attr__( 'Center', 'physc-builder' ) => 'center',
					),
					'std'         => 'left',
				),
				array(
					"type"       => "textarea",
					"heading"    => esc_html__( "Text 1", 'physc-builder' ),
					"param_name" => "text_1",
					"value"      => "",
					"holder"     => "div"
				),
				array(
					'type'             => 'colorpicker',
					'heading'          => esc_attr__( 'Text 1 color', 'physc-builder' ),
					'param_name'       => 'text_1_color',
					'value'            => '',
					'edit_field_class' => 'vc_col-xs-6'
				),
				array(
					'type'             => 'colorpicker',
					'heading'          => esc_attr__( 'Backgound Text 1 color', 'physc-builder' ),
					'param_name'       => 'bg_text_1_color',
					'value'            => '',
					'edit_field_class' => 'vc_col-xs-6',
					"dependency"       => Array( "element" => "layout", "value" => array( "layout-4" ) ),
				),
				array(
					"type"       => "textarea",
					"heading"    => esc_html__( "Text 2", 'physc-builder' ),
					"param_name" => "text_2",
					"value"      => "",
					"holder"     => "div"
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_attr__( 'Text 2 color', 'physc-builder' ),
					'param_name' => 'text_2_color',
					'value'      => '',
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Upload Image', 'physc-builder' ),
					'param_name' => 'thumbnail_image',
					'value'      => '', // default value to backend editor admin_label
				),
				array(
					"type"       => "textfield",
					"heading"    => esc_html__( "Link Banner", "physc-builder" ),
					"param_name" => "link_banner",
					'std'        => '#',
				),
				array(
					'type'             => 'dropdown',
					'admin_label'      => true,
					'heading'          => esc_attr__( 'Button', 'physc-builder' ),
					'param_name'       => 'show_button',
					'value'            => array(
						esc_attr__( 'Show', 'physc-builder' )   => 'true',
						esc_attr__( 'Hidden', 'physc-builder' ) => 'false',
					),
					'std'              => 'false',
					'edit_field_class' => 'vc_col-xs-3',
				),

				array(
					"type"             => "textfield",
					"heading"          => esc_html__( "Text Button", "physc-builder" ),
					"param_name"       => "text_button",
					"std"              => esc_html__( "Shop Now", "physc-builder" ),
					'edit_field_class' => 'vc_col-xs-6',
					"dependency"       => Array( "element" => "show_button", "value" => array( "true" ) ),
				),
				array(
					'type'             => 'colorpicker',
					'heading'          => esc_attr__( 'Text Button color', 'physc-builder' ),
					'param_name'       => 'text_btn_color',
					'value'            => '',
					'edit_field_class' => 'vc_col-xs-3',
					"dependency"       => Array( "element" => "show_button", "value" => array( "true" ) ),
				),
			);
		}
	}
}