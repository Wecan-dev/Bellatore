<?php
/**
 * PhyscBuilders Testimonials config class
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

if ( !class_exists( 'PhyscBuilder_Config_Testimonials' ) ) {
	/**
	 * Class PhyscBuilder_Config_Testimonials
	 */
	class PhyscBuilder_Config_Testimonials extends PhyscBuilder_Abstract_Config {
		/**
		 * PhyscBuilder_Config_Testimonials constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'testimonials';
			self::$name = __( 'Testimonials', 'physc-builder' );
			self::$desc = __( 'Display a testimonials box.', 'physc-builder' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {
			// options
			return array_merge(
				apply_filters( 'physc-builder/testimonials/before-config-options', array(
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
                            'type'             => 'dropdown',
                            "heading"          => esc_html__( "Show Arrows Slide", "physc-builder" ),
                            "param_name"       => "show_arrows_testimonials",
                            'value'            => array(
                                esc_attr__( 'Show', 'physc-builder' )   => 'true',
                                esc_attr__( 'Hidden', 'physc-builder' ) => 'false',
                            ),
                            'std'              => 'true',
                            'edit_field_class' => 'vc_col-xs-2',
                        ),
                        array(
                            'type'             => 'dropdown',
                            "heading"          => esc_html__( "Show Dots Slider", "physc-builder" ),
                            "param_name"       => "show_dots_testimonials",
                            'value'            => array(
                                esc_attr__( 'Show', 'physc-builder' )   => 'true',
                                esc_attr__( 'Hidden', 'physc-builder' ) => 'false',
                            ),
                            'std'              => 'false',
                            'edit_field_class' => 'vc_col-xs-2',
                        )
					)
				),
				array(
 					array(
						'type'       => 'param_group',
						'value'      => '',
						'heading'    => __( 'Testimonials', 'physc-builder' ),
						'param_name' => 'testimonials',
						'params'     => array(
 							array(
								'type'        => 'textfield',
								'heading'     => __( 'Name', 'physc-builder' ),
								'param_name'  => 'name',
								'std'         => __( 'John Doe', 'physc-builder' ),
								'admin_label' => true,
							),
							array(
								'type'             => 'attach_image',
								'heading'          => __( 'Image', 'physc-builder' ),
								'param_name'       => 'image',
								'edit_field_class' => 'vc_col-sm-6'
							),

							array(
								'type'             => 'textfield',
								'heading'          => __( 'Website', 'physc-builder' ),
								'param_name'       => 'website',
								'std'              => '#',
								'edit_field_class' => 'vc_col-sm-6'
							),

							array(
								'type'       => 'textfield',
								'heading'    => __( 'Info', 'physc-builder' ),
								'param_name' => 'works',
								'std'        => __( 'Founder', 'physc-builder' )
							),

							array(
								'type'       => 'textarea',
								'heading'    => __( 'Content', 'physc-builder' ),
								'param_name' => 'content',
								'value'      => '',
								'std'        => __( 'This is my first time to consult in this hospital and I’m lucky I got a perfect doctor who takes care of me since day one of my consultation, until the day of my surgery.', 'physc-builder' )
							),
						)
					),
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'testimonials' => array(
					'src'  => 'testimonials.js',
					'deps' => array( 'jquery', 'physc-builder-owlCarousel' )
				)
			);
		}
	}
}