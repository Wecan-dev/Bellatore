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

if ( !class_exists( 'PhyscBuilder_Config_Products_Showcase' ) ) {
	/**
	 * Class PhyscBuilder_Config_Products
	 */
	class PhyscBuilder_Config_Products_Showcase extends PhyscBuilder_Abstract_Config {

		/**
		 * PhyscBuilder_Config_Products constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'products-showcase';
			self::$name = __( 'Products showcase', 'physc-builder' );
			self::$desc = __( 'Display showcase products', 'physc-builder' );

			parent::__construct();
		}

		/**
		 * @return array
		 */
		public function get_options() {

			// options
			return array(

				array(
					"type"        => "dropdown",
					"heading"     => esc_html__( "Show", "physc-builder" ),
					"param_name"  => "show",
					"admin_label" => true,
					"value"       => array(
						esc_html__( "All Products", "physc-builder" )      => "",
						esc_html__( "Featured Products", "physc-builder" ) => "featured",
						esc_html__( "On-sale Products", "physc-builder" )  => "onsale",
						esc_html__( "Category Products", "physc-builder" ) => "product_cat",
					),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Category', 'physc-builder' ),
					'param_name' => 'product_cat',
					'value'      => $this->_post_type_categories( 'product_cat' ),
					"dependency" => Array( "element" => "show", "value" => array( "product_cat" ) ),
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
					'std'            => '5',
					'param_name'       => 'limit',
					"admin_label"      => true,
					'edit_field_class' => 'vc_col-xs-6'
				),

			);
		}
	}
}