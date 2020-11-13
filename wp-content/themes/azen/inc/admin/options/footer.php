<?php

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Footer Area', 'azen' ),
	'id'     => 'footer_area',
	'icon'   => 'el el-graph',
	//	'subsection' => true,
	'fields' => array(
		array(
			'id'          => 'bg_footer',
			'type'        => 'color',
			'title'       => esc_html__( 'Background Color', 'azen' ),
			'default'     => '#111',
			'transparent' => false,
		),
		array(
			'id'          => 'text_color_footer',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Color', 'azen' ),
			'default'     => '#ebebeb',
			'transparent' => false,
		),
		array(
			'id'          => 'text_link_color_footer',
			'type'        => 'color',
			'title'       => esc_html__( 'Link Hover Color', 'azen' ),
			'default'     => '#fff',
			'transparent' => false,
		),
		array(
			'id'          => 'title_color_footer',
			'type'        => 'color',
			'title'       => esc_html__( 'Title Color', 'azen' ),
			'default'     => '#fff',
			'transparent' => false,
		),
		array(
			'id'      => 'title_font_size_footer',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Font Size Title (px)', 'azen' ),
			'default' => '24',
			'min'     => '1',
			'step'    => '1',
			'max'     => '50',
		),

		array(
			"title" => esc_html__( "Back To Top", "azen" ),
			"id"    => "totop_show",
			"std"   => 1,
			"folds" => 1,
			"on"    => esc_html__( "show", "azen" ),
			"off"   => esc_html__( "hide", "azen" ),
			"type"  => "switch"
		)
	)
) );