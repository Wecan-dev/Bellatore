<?php
add_filter( 'physc-builder/modules-unset', 'azen_unset_modules' );

function azen_unset_modules() {
	return array(
		'products-showcase',
		'products-cat',
		'about-us',
		'flash-sale',
        'reviews',
        'banner-html',
	);
}

add_filter( 'physc-builder/posts/before-config-options', 'azen_custom_layout_posts_options' );
function azen_custom_layout_posts_options() {
	$posts_options = array(
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_attr__( 'Title color', 'azen' ),
			'param_name'       => 'title_color',
			'value'            => '',
			'edit_field_class' => 'vc_col-xs-6'
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_attr__( 'Layout', 'azen' ),
			'param_name'       => 'layout',
			'value'            => array(
				esc_attr__( 'Layout 1', 'azen' ) => 'layout_1',
				esc_attr__( 'Layout 2', 'azen' ) => 'layout_2',
			),
			'admin_label'      => true,
			'std'              => 'layout_1',
			'edit_field_class' => 'vc_col-xs-7'
		),
		array(
			'type'             => 'textfield',
			'heading'          => esc_html__( 'Length Desc', 'azen' ),
			'param_name'       => 'length',
			'value'            => '10',
			"dependency"       => Array( "element" => "layout", "value" => array( 'layout_2' ) ),
			'edit_field_class' => 'vc_col-xs-3'
		),
		array(
			'type'             => 'textfield',
			'heading'          => esc_html__( 'Speed', 'azen' ),
			'param_name'       => 'speed',
			'value'            => '3000',
			"dependency"       => Array( "element" => "layout", "value" => array( 'layout_2' ) ),
			'edit_field_class' => 'vc_col-xs-2'
		)
	);

	return $posts_options;
}


add_filter( 'physc-builder/products/layout-options', 'azen_custom_layout_product_options' );
function azen_custom_layout_product_options() {
	$layout_options = array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Layout', 'azen' ),
			'param_name'  => 'layout',
			'admin_label' => true,
			'value'       => array(
				esc_attr__( 'Layout 1', 'azen' ) => 'layout-1',
				esc_attr__( 'Layout 2', 'azen' ) => 'layout-2',
				esc_attr__( 'Layout 3', 'azen' ) => 'layout-3',
			),
			'std'         => 'layout-1'
		),
	);

	return $layout_options;
}
