<?php
Redux::setSection( 'azen_theme_options', array(
	'title'  => esc_html__( 'Social Sharing', 'azen' ),
	'id'     => 'social_sharing',
	'icon'   => 'el el-group',
	'fields' => array(
		array(
			'id'      => 'sharing_facebook',
			'type'    => 'checkbox',
			'title'   => esc_html__( 'Facebook', 'azen' ),
			'default' => '0'// 1 = on | 0 = off
		),
		array(
			'id'      => 'sharing_twitter',
			'type'    => 'checkbox',
			'title'   => esc_html__( 'Twitter', 'azen' ),
			'default' => '0'// 1 = on | 0 = off
		),
		array(
			'id'      => 'sharing_google',
			'type'    => 'checkbox',
			'title'   => esc_html__( 'Google Plus', 'azen' ),
			'default' => '0'// 1 = on | 0 = off
		),
		array(
			'id'      => 'sharing_pinterset',
			'type'    => 'checkbox',
			'title'   => esc_html__( 'Pinterest', 'azen' ),
			'default' => '0'// 1 = on | 0 = off
		),
		array(
			'id'      => 'sharing_instagram',
			'type'    => 'checkbox',
			'title'   => esc_html__( 'Instagram', 'azen' ),
			'default' => '0'// 1 = on | 0 = off
		),
	)
) );