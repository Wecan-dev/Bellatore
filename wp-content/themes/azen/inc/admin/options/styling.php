<?php
$pattern_url = get_template_directory_uri() . '/images/themeoptions/';

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Styling', 'azen' ),
	'icon'   => 'el el-icon-pencil',
	'fields' => array(
		array(
			"title" => esc_html__( "Preloading", "azen" ),
			"type"  => "switch",
			"id"    => "show_preload",
			"std"   => 1,
			"on"    => esc_html__( "show", "azen" ),
			"off"   => esc_html__( "hide", "azen" ),
		),
		array(
			'id'      => 'box_layout',
			'type'    => 'select',
			'title'   => esc_html__( 'Layout', 'azen' ),
			'options' => array(
				'boxed' => esc_html__( 'Boxed', 'azen' ),
				'wide'  => esc_html__( 'Wide', 'azen' ),
			),
			'default' => 'wide',
			'select2' => array( 'allowClear' => false )
		),
		array(
			'id'       => 'background_pattern',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Background Pattern', 'azen' ),
			'subtitle' => esc_html__( 'select background pattern', 'azen' ),
			'options'  => array(
				$pattern_url . 'pattern1.jpg'  => array(
					'alt' => 'pattern1',
					'img' => $pattern_url . 'pattern1.jpg'
				),
				$pattern_url . 'pattern2.png'  => array(
					'alt' => 'pattern2',
					'img' => $pattern_url . 'pattern2.png'
				),
				$pattern_url . 'pattern3.png'  => array(
					'alt' => 'pattern3',
					'img' => $pattern_url . 'pattern3.png'
				),
				$pattern_url . 'pattern4.png'  => array(
					'alt' => 'pattern4',
					'img' => $pattern_url . 'pattern4.png'
				),
				$pattern_url . 'pattern5.png'  => array(
					'alt' => 'pattern5',
					'img' => $pattern_url . 'pattern5.png'
				),
				$pattern_url . 'pattern6.png'  => array(
					'alt' => 'pattern6',
					'img' => $pattern_url . 'pattern6.png'
				),
				$pattern_url . 'pattern7.png'  => array(
					'alt' => 'pattern7',
					'img' => $pattern_url . 'pattern7.png'
				),
				$pattern_url . 'pattern8.png'  => array(
					'alt' => 'pattern8',
					'img' => $pattern_url . 'pattern8.png'
				),
				$pattern_url . 'pattern9.png'  => array(
					'alt' => 'pattern9',
					'img' => $pattern_url . 'pattern9.png'
				),
				$pattern_url . 'pattern10.png' => array(
					'alt' => 'pattern10',
					'img' => $pattern_url . 'pattern10.png'
				),
			),
		),
		array(
			'id'          => 'body_background',
			'type'        => 'background',
			'color'       => false,
			'title'       => esc_html__( 'Body Background', 'azen' ),
			'subtitle'    => esc_html__( 'Body background with image, color, etc.', 'azen' ),
			'transparent' => false,
			'default'     => array(
				'background-color' => '#fff'
			),
		),
		array(
			'id'          => 'body_color_primary',
			'type'        => 'color',
			'title'       => esc_html__( 'Theme Primary Color', 'azen' ),
			'default'     => '#111',
			'transparent' => false
		),
		array(
			'id'          => 'background_button',
			'type'        => 'color',
			'title'       => esc_html__( 'Background Button Color', 'azen' ),
			'default'     => '#000',
			'transparent' => false
		),
		array(
			'id'          => 'text_color_button',
			'type'        => 'color',
			'title'       => esc_html__( 'Text Color Button', 'azen' ),
			'default'     => '#fff',
			'transparent' => false
		),
//		array(
//			'id'          => 'background_button_hover',
//			'type'        => 'color',
//			'title'       => esc_html__( 'Background Button Color Hover', 'azen' ),
//			'default'     => '#000',
//			'transparent' => false
//		),
//		array(
//			'id'          => 'text_color_button_hover',
//			'type'        => 'color',
//			'title'       => esc_html__( 'Text Color Button Hover', 'azen' ),
//			'default'     => '#fff',
//			'transparent' => false
//		),
        array(
            'id'          => 'onsale_color_primary',
            'type'        => 'color',
            'title'       => esc_html__( 'Background Sale Color', 'azen' ),
            'default'     => '#ff4747',
            'transparent' => false
        ),
//        array(
//            'id'          => 'aside_color_primary',
//            'type'        => 'color',
//            'title'       => esc_html__( 'Aside Color Widgets', 'azen' ),
//            'default'     => '#777777',
//            'transparent' => false
//        ),

	)
) );