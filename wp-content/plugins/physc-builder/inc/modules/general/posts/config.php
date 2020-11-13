<?php
/**
 * PhyscBuilders Posts config class
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

if ( !class_exists( 'PhyscBuilder_Config_Posts' ) ) {
	/**
	 * Class PhyscBuilder_Config_Posts
	 */
	class PhyscBuilder_Config_Posts extends PhyscBuilder_Abstract_Config {

		/**
		 * PhyscBuilder_Config_Posts constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'posts';
			self::$name = __( 'Posts', 'physc-builder' );
			self::$desc = __( 'Display list posts', 'physc-builder' );

			parent::__construct();

		}

		/**
		 * @return array
		 */
		public function get_options() {
			// options
			return array_merge(
				array(
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
 				),
				apply_filters( 'physc-builder/posts/before-config-options', array(
						array(
							'type'             => 'colorpicker',
							'heading'          => esc_attr__( 'Title color', 'physc-builder' ),
							'param_name'       => 'title_color',
							'value'            => '',
							'edit_field_class' => 'vc_col-xs-6'
						),
					)
				),
				array(
					array(
						'type'             => 'dropdown',
						'heading'          => esc_html__( 'Category', 'physc-builder' ),
						'param_name'       => 'category',
						'value'            => $this->_post_type_categories( 'category' ),
						'edit_field_class' => 'vc_col-xs-6'
					),
					array(
						'type'             => 'number',
						'heading'          => esc_html__( 'Number of posts', 'physc-builder' ),
						'param_name'       => 'number',
						'std'              => '5',
						'edit_field_class' => 'vc_col-xs-3'
					),
					array(
						'type'             => 'textfield',
						'heading'          => esc_attr__( 'Item on row', 'physc-builder' ),
						'param_name'       => 'item_on_row',
						'std'              => '3',
						'edit_field_class' => 'vc_col-xs-3'

					),
					array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Show post date', 'physc-builder' ),
						'param_name'       => 'show_date',
						'std'              => true,
						'edit_field_class' => 'vc_col-xs-6'
					),
					array(
						'type'             => 'checkbox',
						'heading'          => esc_html__( 'Show author', 'physc-builder' ),
						'param_name'       => 'show_author',
						'std'              => true,
						'edit_field_class' => 'vc_col-xs-6'
					),
					array(
						'type'             => 'dropdown',
						'heading'          => __( 'Sort', 'physc-builder' ),
						'param_name'       => 'sort_post',
						'value'            => array(
							__( 'Date', 'physc-builder' )   => 'date',
							__( 'Random', 'physc-builder' ) => 'rand',
							__( 'Title', 'physc-builder' )  => 'title',
						),
						'description'      => __( 'Choose Sort', 'physc-builder' ),
						'edit_field_class' => 'vc_col-xs-6'
					),
					array(
						'type'             => 'dropdown',
						'heading'          => __( 'Order By', 'physc-builder' ),
						'param_name'       => 'order_post',
						'value'            => array(
							__( 'ASC', 'physc-builder' )  => 'asc',
							__( 'DESC', 'physc-builder' ) => 'desc',
						),
						'description'      => __( 'Choose Order By', 'physc-builder' ),
						'edit_field_class' => 'vc_col-xs-6'
					),
				)
			);
		}
	}
}