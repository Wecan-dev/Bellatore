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

if ( !class_exists( 'PhyscBuilder_Config_About_Us' ) ) {
	/**
	 * Class PhyscBuilder_Config_Banner_Html
	 */
	class PhyscBuilder_Config_About_Us extends PhyscBuilder_Abstract_Config {

		/**
		 * PhyscBuilder_Config_Banner_Html constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'about-us';
			self::$name = __( 'About Us', 'physc-builder' );
			self::$desc = __( 'Display an about us html', 'physc-builder' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {

			// options
			return array(
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Upload Image Left', 'physc-builder' ),
					'param_name' => 'thumbnail_image',
					'value'      => '', // default value to backend editor admin_label
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
					'type'       => 'textarea',
					'heading'    => __( 'Content', 'physc-builder' ),
					'param_name' => 'desc',
					'value'      => '',
					'std'        => __( 'This is my first time to consult in this hospital and I’m lucky I got a perfect doctor who takes care of me since day one of my consultation, until the day of my surgery.', 'physc-builder' )
				),
				array(
					'type'             => 'attach_image',
					'heading'          => esc_html__( 'Signature Image', 'physc-builder' ),
					'param_name'       => 'signature_image',
					'value'            => '', // default value to backend editor admin_label
					'edit_field_class' => 'vc_col-xs-4'
				),
				array(
					'type'             => 'textfield',
					'heading'          => __( 'Name', 'physc-builder' ),
					'param_name'       => 'name',
					'std'              => __( 'Catherine Shaw', 'physc-builder' ),
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-xs-4'
				),
				array(
					'type'             => 'textfield',
					'heading'          => __( 'Info', 'physc-builder' ),
					'param_name'       => 'works',
					'std'              => __( 'Director', 'physc-builder' ),
					'edit_field_class' => 'vc_col-xs-4'
				),
			);
		}

	}
}