<?php


if ( is_admin() && class_exists( 'Tax_Meta_Class' ) ) {
	$prefix = 'phys_';

	function azen_my_meta( $my_meta ) {
		$prefix = 'phys_';
		$my_meta->addSelect(
			$prefix . 'layout', array(
			''              => esc_html__( 'Using in Theme Option', 'azen' ),
			'full-content'  => esc_html__( 'No Sidebar', 'azen' ),
			'sidebar-left'  => esc_html__( 'Left Sidebar', 'azen' ),
			'sidebar-right' => esc_html__( 'Right Sidebar', 'azen' )
		),
			array( 'name' => esc_html__( 'Custom Layout ', 'azen' ), 'std' => array( '' ) )
		);

		$my_meta->addSelect(
			$prefix . 'custom_heading', array(
			''       => esc_html__( 'Using in Theme Option', 'azen' ),
			'custom' => esc_html__( 'Custom', 'azen' ),
		), array( 'name' => esc_html__( 'Custom Heading ', 'azen' ), 'std' => array( '' ), 'class' => 'toggle_custom' )
		);
		$my_meta->addImage( $prefix . 'cate_top_image', array( 'name' => esc_html__( 'Heading Background Image', 'azen' ), 'class' => 'show_custom' ) );
		$my_meta->addColor( $prefix . 'cate_heading_bg_color', array( 'name' => esc_html__( 'Heading Background Color', 'azen' ), 'class' => 'show_custom' ) );
		$my_meta->addColor( $prefix . 'cate_heading_text_color', array( 'name' => esc_html__( 'Heading Text Color', 'azen' ), 'class' => 'show_custom' ) );
		$my_meta->addCheckbox( $prefix . 'cate_hide_title', array( 'name' => esc_html__( 'Hide Title', 'azen' ), 'class' => 'show_custom' ) );
		$my_meta->addCheckbox( $prefix . 'cate_hide_desc', array( 'name' => esc_html__( 'Hide Description', 'azen' ), 'class' => 'show_custom' ) );
		$my_meta->addSelect(
			$prefix . 'layout_content', array(
			''         => esc_html__( 'Using in Theme Option', 'azen' ),
			'standard' => esc_html__( 'Standard', 'azen' ),
			'masonry'  => esc_html__( 'Masonry', 'azen' ),
		),
			array( 'name' => esc_html__( 'Layout', 'azen' ), 'std' => array( '' ), 'class' => 'toggle_gird_custom' )
		);
		$my_meta->addSelect(
			$prefix . 'layout_column', array(
			''  => esc_html__( 'Using in Theme Option', 'azen' ),
			'2' => '2',
			'3' => '3',
			'4' => '4',
		), array( 'name' => esc_html__( 'Column', 'azen' ), 'std' => array( '' ), 'class' => 'show_column_custom' )
		);
	}

	/*
		  * configure your meta box
		  */
	$config = array(
		'id'             => 'category__meta_box',
		// meta box id, unique per meta box
		'title'          => 'Category Meta Box',
		// meta box title
		'pages'          => array( 'category', 'post_tag' ),
		// taxonomy name, accept categories, post_tag and custom taxonomies
		'context'        => 'normal',
		// where the meta box appear: normal (default), advanced, side; optional
		'fields'         => array(),
		// list of meta fields (can be added by field arrays)
		'local_images'   => false,
		// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => false
		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	$my_meta_post = new Tax_Meta_Class( $config );
	azen_my_meta( $my_meta_post );
	/*Add custom style*/
	$my_meta_post->Finish();
}
if ( class_exists( 'Tax_Meta_Class' ) ) {
	if ( !function_exists( 'azen_get_tax_meta' ) ) {
		function azen_get_tax_meta( $term_id, $key, $multi = false ) {
			$t_id = ( is_object( $term_id ) ) ? $term_id->term_id : $term_id;
			$m    = get_option( 'tax_meta_' . $t_id );
			if ( isset( $m[$key] ) ) {
				return $m[$key];
			} else {
				return '';
			}
		}
	}
} else {
	if ( !function_exists( 'azen_get_tax_meta' ) ) {
		function azen_get_tax_meta( $term_id, $key, $multi = false ) {
 			return '';
		}
	}
}