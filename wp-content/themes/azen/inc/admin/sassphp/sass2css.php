<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
get_template_part( 'inc/admin/sassphp/scss.inc' );

if ( is_multisite() ) {
	if ( !file_exists( trailingslashit( WP_CONTENT_DIR ) . 'uploads/sites/' . azen_current_blog()->blog_id . '/physcode' ) ) {
		wp_mkdir_p( trailingslashit( WP_CONTENT_DIR ) . 'uploads/sites/' . azen_current_blog()->blog_id . '/physcode', 0777, true );
	};
	define( 'AZEN_UPLOADS_FOLDER', trailingslashit( WP_CONTENT_DIR ) . 'uploads/sites/' . azen_current_blog()->blog_id . '/physcode/' );
	define( 'AZEN_UPLOADS_URL', trailingslashit( WP_CONTENT_URL ) . 'uploads/sites/' . azen_current_blog()->blog_id . '/physcode/' );
} else {
	if ( !file_exists( trailingslashit( WP_CONTENT_DIR ) . 'uploads/physcode' ) ) {
		wp_mkdir_p( trailingslashit( WP_CONTENT_DIR ) . 'uploads/physcode', 0777, true );
	}
	if ( !defined( 'AZEN_UPLOADS_FOLDER' ) ) {
		define( 'AZEN_UPLOADS_FOLDER', trailingslashit( WP_CONTENT_DIR ) . 'uploads/physcode/' );
	}

	if ( !defined( 'azen_UPLOADS_URL' ) ) {
		define( 'AZEN_UPLOADS_URL', trailingslashit( WP_CONTENT_URL ) . 'uploads/physcode/' );
	}
}

if ( !defined( 'AZEN_FILE_NAME' ) ) {
	define( 'AZEN_FILE_NAME', 'azen-options.css' );
}

class sass2css {
	function __construct() {
		add_action( 'redux/options/azen_theme_options/saved', array( $this, 'sass_to_css' ) );
	}

	function sass_to_css() {
		WP_Filesystem();
		global $wp_filesystem, $azen_theme_options; /* already initialised the Filesystem API previously */

		$scss    = new Leafo\ScssPhp\Compiler();
		$fileout = get_template_directory() . "/scss/getoption.scss";

		// put content
		$theme_options      = array(
			'bg_header_color'              => 'rgba',
			'text_menu_hover_color'        => '0',
			'bg_menu_hover_color'          => '0',
			'icon_color'                   => '0',
			'sub_menu_bg_color'            => '0',
			'sub_menu_text_hover_color'    => '0',
			'mobile_menu_bg_color'         => '0',
			'mobile_sub_menu_bg_color'     => '0',
			'mobile_menu_text_color'       => '0',
			'mobile_menu_text_hover_color' => '0',
			'mobile_border_item_color'     => '0',
			'top_bar_bg_color' => '0',
            'top_bar_text_color' => '0',
            'top_bar_text_hover_color' => '0',
			'font_size_text_top_bar' =>'0',
			'phys_archive_cate_heading_text_color' => '0',
			'phys_archive_single_heading_text_color' => '0',
			'phys_woo_single_heading_text_color' => '0',
			//styling
			'body_color_primary'           => '0',
			'background_button'            => '0',
//			'background_button_hover'      => '0',
			'text_color_button'            => '0',
//			'text_color_button_hover'      => '0',
			'onsale_color_primary'         => '0',
 			//typography
			'font_size_h1'                 => '0',
			'font_size_h2'                 => '0',
			'font_size_h3'                 => '0',
			'font_size_h4'                 => '0',
			'font_size_h5'                 => '0',
			'font_size_h6'                 => '0',
 			'font_size_title_home'         => '0',
			//footer
			'bg_footer'                    => '0',
			'text_color_footer'            => '0',
			'text_link_color_footer'       => '0',
			'title_color_footer'           => '0',
			'title_font_size_footer'       => '0',

            'phys_woo_cate_heading_text_color' => ' 0',
		);
		$theme_options_data = '';
		foreach ( $theme_options AS $key => $val ) {
			if ( $val == '0' ) {
				$data = $azen_theme_options[$key];
			} else {
				$data = $azen_theme_options[$key][$val];
			}
			$theme_options_data .= "\${$key}: {$data};\n";
		}
		// font body
		$theme_options_data .= $azen_theme_options['font_body']['color'] ? '$body_color:' . $azen_theme_options['font_body']['color'] . ';' : '$body_color:#1113;';
		$theme_options_data .= $azen_theme_options['font_body']['font-family'] ? '$body-font-family: ' . $azen_theme_options['font_body']['font-family'] . ',Helvetica,Arial,sans-serif;' : '$body-font-family:Helvetica,Arial,sans-serif;';
		$theme_options_data .= $azen_theme_options['font_body']['font-weight'] ? '$font_weight_body: ' . $azen_theme_options['font_body']['font-weight'] . ';' : '$font_weight_body:Normal;';
		$theme_options_data .= $azen_theme_options['font_body']['font-size'] ? '$body_font_size: ' . $azen_theme_options['font_body']['font-size'] . ';' : '$body_font_size:13px;';
		$theme_options_data .= $azen_theme_options['font_body']['line-height'] ? '$body_line_height: ' . $azen_theme_options['font_body']['line-height'] . ';' : '$body_line_height:24px';

		// font heading
		$theme_options_data .= $azen_theme_options['font_title']['font-family'] ? '$heading-font-family: ' . $azen_theme_options['font_title']['font-family'] . ',Helvetica,Arial,sans-serif;' : '$heading-font-family:Helvetica,Arial,sans-serif;';
		$theme_options_data .= $azen_theme_options['font_title']['color'] ? '$heading-color: ' . $azen_theme_options['font_title']['color'] . ';' : '$heading-color:#111;';
		$theme_options_data .= $azen_theme_options['font_title']['font-weight'] ? '$heading-font-weight: ' . $azen_theme_options['font_title']['font-weight'] . ';' : '$heading-font-weight:Normal;';
		// font Main Menu
 		$theme_options_data .= $azen_theme_options['font_main_menu']['color'] ? '$text_menu_color: ' . $azen_theme_options['font_main_menu']['color'] . ';' : '$text_menu_color:#111;';
		$theme_options_data .= $azen_theme_options['font_main_menu']['font-weight'] ? '$font_weight_main_menu: ' . $azen_theme_options['font_main_menu']['font-weight'] . ';' : '$font_weight_main_menu:500;';
		$theme_options_data .= $azen_theme_options['font_main_menu']['font-size'] ? '$font_size_main_menu: ' . $azen_theme_options['font_main_menu']['font-size'] . ';' : '$font_size_main_menu:14px;';
		$theme_options_data .= $azen_theme_options['font_main_menu']['text-transform'] ? '$text_transform_main_menu: ' . $azen_theme_options['font_main_menu']['text-transform'] . ';' : '$text_transform_main_menu:uppercase;';
		// font Sub Menu
 		$theme_options_data .= $azen_theme_options['font_sub_menu']['color'] ? '$sub_menu_text_color: ' . $azen_theme_options['font_sub_menu']['color'] . ';' : '$sub_menu_text_color:#111;';
		$theme_options_data .= $azen_theme_options['font_sub_menu']['font-weight'] ? '$font_weight_sub_menu: ' . $azen_theme_options['font_sub_menu']['font-weight'] . ';' : '$font_weight_sub_menu:500;';
		$theme_options_data .= $azen_theme_options['font_sub_menu']['font-size'] ? '$font_size_sub_menu: ' . $azen_theme_options['font_sub_menu']['font-size'] . ';' : '$font_size_sub_menu:14px;';


		// width logo
		$theme_options_data .= $azen_theme_options['width_logo']['width'] ? '$width_logo: ' . $azen_theme_options['width_logo']['width'] . ';' : '$width_logo:140px;';
		$theme_options_data .= $azen_theme_options['width_logo_mobile']['width'] ? '$width_logo_mobile: ' . $azen_theme_options['width_logo_mobile']['width'] . ';' : '$width_logo_mobile:100px;';

		$theme_options_data .= $wp_filesystem->get_contents( $fileout );

		$css              = '';
 		$css              .= $scss->compile( $theme_options_data );
		$background_color = $azen_theme_options['body_background']['background-color'] ? ' background-color: ' . $azen_theme_options['body_background']['background-color'] : '';

		if ( $background_color ) {
			$css .= '.wrapper-container {' . $background_color . '}';
		}
		if ( isset( $azen_theme_options['box_layout'] ) && $azen_theme_options['box_layout'] == 'boxed' ) {
			$background_image = '';
			if ( $azen_theme_options['body_background']['background-image'] ) {
				$background_image .= $azen_theme_options['body_background']['background-image'] ? 'background-image: url( ' . $azen_theme_options['body_background']['background-image'] . ');' : '';
			} elseif ( isset( $azen_theme_options['background_pattern'] ) ) {
				$background_image .= $azen_theme_options['background_pattern'] ? 'background-image: url( ' . $azen_theme_options['background_pattern'] . ');' : '';
			}
			$background_image .= $azen_theme_options['body_background']['background-repeat'] ? 'background-repeat: ' . $azen_theme_options['body_background']['background-repeat'] . ';' : '';
			$background_image .= $azen_theme_options['body_background']['background-size'] ? 'background-size: ' . $azen_theme_options['body_background']['background-size'] . ';' : '';
			$background_image .= $azen_theme_options['body_background']['background-attachment'] ? 'background-attachment: ' . $azen_theme_options['body_background']['background-attachment'] . ';' : '';
			$background_image .= $azen_theme_options['body_background']['background-position'] ? 'background-position: ' . $azen_theme_options['body_background']['background-position'] . ';' : '';
			if ( $background_image ) {
				$css .= 'body{' . $background_image . '}';
			}
		}
		// custom css
		$css .= $azen_theme_options['opt-ace-editor-css'];
		if ( !$wp_filesystem->put_contents( AZEN_UPLOADS_FOLDER . AZEN_FILE_NAME, $css, FS_CHMOD_FILE ) ) {
			$wp_filesystem->put_contents( AZEN_UPLOADS_FOLDER . AZEN_FILE_NAME, $css, FS_CHMOD_FILE );
		}
	}
}

new sass2css();