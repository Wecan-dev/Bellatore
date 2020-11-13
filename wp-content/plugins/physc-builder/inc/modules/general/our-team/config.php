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

if ( !class_exists( 'PhyscBuilder_Our_Team' ) ) {
	/**
	 * Class PhyscBuilder_Config_Banner_Html
	 */
	class PhyscBuilder_Our_Team extends PhyscBuilder_Abstract_Config {

		/**
		 * PhyscBuilder_Config_Banner_Html constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'our-team';
			self::$name = __( 'Our Team', 'physc-builder' );
			self::$desc = __( 'Display an our team', 'physc-builder' );

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
                    'heading'    => __( 'Item Tabs', 'physc-builder' ),
                    'param_name' => 'ourteam_tab',
                    'value'      => '',
                    'params'     => array(
                        array(
                            'type'       => 'attach_image',
                            'heading'    => esc_html__( 'Upload Image', 'physc-builder' ),
                            'param_name' => 'thumbnail_image',
                            'value'      => '', // default value to backend editor admin_label
                        ),
                        array(
                            "type"       => "textarea",
                            "heading"    => esc_html__( "Name author", 'physc-builder' ),
                            "param_name" => "text_1",
                            "value"      => "",
                            "holder"     => "div"
                        ),
                        array(
                            "type"       => "textfield",
                            "heading"    => esc_html__( "Link Author", "physc-builder" ),
                            "param_name" => "link_author",
                            'std'        => '#',
                        ),
                        array(
                            'type'             => 'colorpicker',
                            'heading'          => esc_attr__( 'Name author color', 'physc-builder' ),
                            'param_name'       => 'text_1_color',
                            'value'            => '',
                            'edit_field_class' => 'vc_col-xs-6'
                        ),
                        array(
                            "type"       => "textarea",
                            "heading"    => esc_html__( "Infor Works", 'physc-builder' ),
                            "param_name" => "text_2",
                            "value"      => "",
                            "holder"     => "div"
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'heading'    => esc_attr__( 'Infor Works color', 'physc-builder' ),
                            'param_name' => 'text_2_color',
                            'value'      => '',
                        ),
                    ),
                ),
            );
		}
	}
}