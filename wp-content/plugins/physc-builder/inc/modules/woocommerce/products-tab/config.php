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

if ( !class_exists( 'PhyscBuilder_Config_Products_Tab' ) ) {
	/**
	 * Class PhyscBuilder_Config_Products_Tab
	 */
	class PhyscBuilder_Config_Products_Tab extends PhyscBuilder_Abstract_Config {

		/**
		 * PhyscBuilder_Config_Products_Tab constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'products-tab';
			self::$name = __( 'Products Tab', 'physc-builder' );
			self::$desc = __( 'Display products tab', 'physc-builder' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {

			// options
			return array(

				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Number of products in tab", "physc-builder" ),
					"param_name"  => "limit",
					"std"       => '5',
					"admin_label" => true,
				),
				array(
					"type"        => "textfield",
					"heading"     => esc_html__( "Columns", "physc-builder" ),
					"param_name"  => "columns",
					"std"       => '4',
					"admin_label" => true,
				),
				array(
					'type'       => 'param_group',
					'heading'    => __( 'Item Tabs', 'physc-builder' ),
					'param_name' => 'items_tab',
					'value'      => '',
					'params'     => array(
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
							'type'             => 'dropdown',
							"heading"          => esc_html__( "Show View More", "physc-builder" ),
							"param_name"       => "show_view_more",
							'value'            => array(
								esc_attr__( 'Show', 'physc-builder' )   => 'true',
								esc_attr__( 'Hidden', 'physc-builder' ) => 'false',
							),
							'std'              => 'false',
							'edit_field_class' => 'vc_col-xs-2',
						),
						array(
							"type"             => "textfield",
							"heading"          => esc_html__( "Text View More", "physc-builder" ),
							"param_name"       => "text_view_more",
							"stf"            => esc_html__( "View More", "physc-builder" ),
							'edit_field_class' => 'vc_col-xs-4',
							"dependency"       => Array( "element" => "show_view_more", "value" => array( "true" ) ),
						),
						array(
							"type"             => "textfield",
							"heading"          => esc_html__( "Link View More", "physc-builder" ),
							"param_name"       => "link_view_more",
							"std"            => '#',
							'edit_field_class' => 'vc_col-xs-6',
							"dependency"       => Array( "element" => "show_view_more", "value" => array( "true" ) ),
						),
					),
				),
			);

		}

	}
}