<?php
/**
 * PhyscBuilders Products config class
 *
 * @version     1.0.0
 * @author      Physcode
 * @package     PhyscBuilders/Classes
 * @category    Classes
 * @author      Physcodes
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'PhyscBuilder_Config_Products' ) ) {
	/**
	 * Class PhyscBuilder_Config_Products
	 */
	class PhyscBuilder_Config_Products extends PhyscBuilder_Abstract_Config {

		/**
		 * PhyscBuilder_Config_Products constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'products';
			self::$name = __( 'Products', 'physc-builder' );
			self::$desc = __( 'Display products', 'physc-builder' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {

			// options
			return array_merge(
				apply_filters( 'physc-builder/products/layout-options', array( array(
					'type'       => 'dropdown',
					'heading'    => __( 'Layout', 'physc-builder' ),
					'param_name' => 'layout',
					'value'      => array(
						esc_attr__( 'Layout 1', 'physc-builder' ) => 'layout-1',
						esc_attr__( 'Layout 2', 'physc-builder' ) => 'layout-2',
						esc_attr__( 'Layout 3', 'physc-builder' ) => 'layout-3',
						esc_attr__( 'Layout 4', 'physc-builder' ) => 'layout-4',
					),
					'std'        => 'layout-1'
				) ) ),
				array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_attr__( 'Title', 'physc-builder' ),
						'param_name'  => 'title',
						'admin_label' => true,
						"dependency"  => Array( "element" => "layout", "value" => array( "layout-1", "layout-2", "layout-3" ) ),
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
						'edit_field_class' => 'vc_col-xs-6',
						"dependency"       => Array( "element" => "layout", "value" => array( "layout-1", "layout-2", "layout-3" ) ),

					),
					array(
						'type'             => 'colorpicker',
						'heading'          => esc_attr__( 'Title color', 'physc-builder' ),
						'param_name'       => 'title_color',
						'value'            => '',
						'edit_field_class' => 'vc_col-xs-6',
						"dependency"       => Array( "element" => "layout", "value" => array( "layout-1", "layout-2", "layout-3" ) ),

					),
					array(
						"type"        => "dropdown",
						"heading"     => esc_html__( "Show", "physc-builder" ),
						"param_name"  => "show",
						"admin_label" => true,
						"value"       => array(
							esc_html__( "All Products", "physc-builder" )      => "",
							esc_html__( "Featured Products", "physc-builder" ) => "featured",
							esc_html__( "On-sale Products", "physc-builder" )  => "onsale",
							esc_html__( "Category Products", "physc-builder" ) => "cats",
						),
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Category', 'physc-builder' ),
						'param_name' => 'product_cat',
						'value'      => $this->_post_type_categories( 'product_cat' ),
						"dependency" => Array( "element" => "show", "value" => array( "cats" ) ),
					),

					array(
						"type"             => "dropdown",
						"heading"          => esc_attr__( "Order by", "physc-builder" ),
						"param_name"       => "orderby",
						"admin_label"      => true,
						"value"            => array(
							esc_attr__( "Date", "physc-builder" )   => "date",
							esc_attr__( "Price", "physc-builder" )  => "price",
							esc_attr__( "Random", "physc-builder" ) => "rand",
							esc_attr__( "Sales", "physc-builder" )  => "sales"
						),
						'edit_field_class' => 'vc_col-xs-6'
					),

					array(
						"type"             => "dropdown",
						"heading"          => esc_attr__( "Order", "physc-builder" ),
						"param_name"       => "order",
						"admin_label"      => true,
						"value"            => array(
							esc_attr__( "ASC", "physc-builder" )  => "asc",
							esc_attr__( "DESC", "physc-builder" ) => "desc"
						),
						'edit_field_class' => 'vc_col-xs-6'
					),

					array(
						'type'             => 'textfield',
						'heading'          => esc_attr__( 'Number of products to show', 'physc-builder' ),
						'std'              => '5',
						'param_name'       => 'limit',
						"admin_label"      => true,
						'edit_field_class' => 'vc_col-xs-6'
					),

					array(
						"type"             => "textfield",
						"heading"          => esc_html__( "Number of products on row", "physc-builder" ),
						"param_name"       => "column",
						"std"              => '5',
						'edit_field_class' => 'vc_col-xs-6',
						"dependency"       => Array( "element" => "layout", "value" => array( "layout-1", "layout-2", "layout-3" ) ),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_attr__( 'Speed Slider', 'physc-builder' ),
						'std'        => '3000',
						'param_name' => 'speed_slider',
						"dependency" => Array( "element" => "layout", "value" => array( "layout-2", "layout-3" ) ),
					),
                    array(
                        'type'             => 'dropdown',
                        "heading"          => esc_html__( "Show Arrows Slide", "physc-builder" ),
                        "param_name"       => "show_arrows",
                        'value'            => array(
                            esc_attr__( 'Show', 'physc-builder' )   => 'true',
                            esc_attr__( 'Hidden', 'physc-builder' ) => 'false',
                        ),
                        'std'              => 'false',
                        'edit_field_class' => 'vc_col-xs-2',
                        "dependency"       => Array( "element" => "layout", "value" => array( "layout-2" ) ),
                    ),
                    array(
                        'type'             => 'dropdown',
                        "heading"          => esc_html__( "Show Dots Slider", "physc-builder" ),
                        "param_name"       => "show_dots",
                        'value'            => array(
                            esc_attr__( 'Show', 'physc-builder' )   => 'true',
                            esc_attr__( 'Hidden', 'physc-builder' ) => 'false',
                        ),
                        'std'              => 'true',
                        'edit_field_class' => 'vc_col-xs-2',
                        "dependency"       => Array( "element" => "layout", "value" => array( "layout-2" ) ),
                    ),
					array(
						'type'             => 'dropdown',
						"heading"          => esc_html__( "Show View More", "physc-builder" ),
						"param_name"       => "show_view_more",
						'value'            => array(
							esc_attr__( 'Show', 'physc-builder' )   => 'true',
							esc_attr__( 'Hidden', 'physc-builder' ) => 'false',
						),
						'std'              => 'false',
						'edit_field_class' => 'vc_col-xs-6',
						"dependency"       => Array( "element" => "layout", "value" => array( "layout-1", "layout-4" ) ),
					),
					array(
						"type"             => "textfield",
						"heading"          => esc_html__( "Text View More", "physc-builder" ),
						"param_name"       => "text_view_more",
						"std"              => esc_html__( "View More", "physc-builder" ),
						'edit_field_class' => 'vc_col-xs-6',
						"dependency"       => Array( "element" => "show_view_more", "value" => array( "true" ) ),
					),
				)
			);
		}

		/**
		 * @return array|mixed
		 */
		public function get_scripts() {
			return array(
				'products' => array(
					'src'  => 'products.js',
					'deps' => array(
						'jquery'
					)
				)
			);
		}
	}
}