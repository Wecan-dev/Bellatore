<?php
// -> START Typography
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Typography', 'azen' ),
	'id'     => 'typography',
	'icon'   => 'el el-fontsize',
	'fields' => array(
		array(
			'id'             => 'font_body',
			'type'           => 'typography',
			'title'          => esc_html__( 'Body Font', 'azen' ),
			'subtitle'       => esc_html__( 'Specify the body font properties.', 'azen' ),
			'text-align'     => false,
			'google'         => true,
//			'letter-spacing' => true,
			'all_styles'     => true,
			'default'        => array(
				'color'       => '#777',
				'font-size'   => '15px',
				'line-height' => '26px',
				'font-family' => 'Muli',
 			),
		),

		array(
			'id'          => 'font_title',
			'type'        => 'typography',
			'title'       => esc_html__( 'Title Font', 'azen' ),
			'line-height' => false,
			'text-align'  => false,
			'font-style'  => false,
			'font-size'   => false,
			'google'      => true,
			'default'     => array(
				'color'       => '#111',
				'font-family' => 'Muli',
 				'font-weight' => '700',
			),
		),

		array(
			'id'      => 'font_size_h1',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Font Size H1 (px)', 'azen' ),
			'default' => '36',
			'min'     => '1',
			'step'    => '1',
			'max'     => '90',
		),

		array(
			'id'      => 'font_size_h2',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Font Size H2 (px)', 'azen' ),
			'default' => '24',
			'min'     => '1',
			'step'    => '1',
			'max'     => '80',
		),

		array(
			'id'      => 'font_size_h3',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Font Size H3 (px)', 'azen' ),
			'default' => '22',
			'min'     => '1',
			'step'    => '1',
			'max'     => '50',
		),

		array(
			'id'      => 'font_size_h4',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Font Size H4 (px)', 'azen' ),
			'default' => '20',
			'min'     => '1',
			'step'    => '1',
			'max'     => '50',
		),

		array(
			'id'      => 'font_size_h5',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Font Size H5 (px)', 'azen' ),
			'default' => '18',
			'min'     => '1',
			'step'    => '1',
			'max'     => '50',
		),

		array(
			'id'      => 'font_size_h6',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Font Size H6 (px)', 'azen' ),
			'default' => '16',
			'min'     => '1',
			'step'    => '1',
			'max'     => '50',
		),


		array(
			'id'      => 'font_size_title_home',
			'type'    => 'spinner',
			'title'   => esc_html__( 'Font Size Title Home Page', 'azen' ),
			'default' => '60',
			'min'     => '20',
			'step'    => '1',
			'max'     => '100',
		),
	)
) );