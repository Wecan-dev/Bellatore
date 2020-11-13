<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Reduxinc/admin Sample Config File
 * For full documentation, please visit: http://docs.reduxinc/admin.com/
 */

if ( !class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = 'azen_theme_options';


/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/Reduxinc/admin/Reduxinc/admin/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	// TYPICAL -> Change these values as you need/desire
	'disable_tracking'     => true,
	'opt_name'             => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'         => $theme->get( 'Name' ),
	// Name that appears at the top of your panel
	'display_version'      => $theme->get( 'Version' ),
	// Version that appears at the top of your panel
	'menu_type'            => 'menu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'       => true,
	// Show the sections below the admin menu item or not
	'menu_title'           => esc_attr__( 'Theme Options', 'azen' ),
	'page_title'           => esc_attr__( 'Theme Options', 'azen' ),
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key'       => '',
	// Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false,
	// Must be defined to add google fonts to the typography module
	'async_typography'     => false,
	// Use a asynchronous font on the front end or font string
	//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
	'admin_bar'            => true,
	// Show the panel pages on the admin bar
	'admin_bar_icon'       => 'dashicons-portfolio',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'   => 50,
	// Choose an priority for the admin bar menu
	'global_variable'      => '',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'             => false,
	//
	//'forced_dev_mode_off'  => true,
	// Show the time the page took to load, etc
	'update_notice'        => false,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'           => false,
	// Enable basic customizer support
	//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
	//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

	// OPTIONAL -> Give you extra features
	'page_priority'        => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'          => 'themes.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'     => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon'            => '',
	// Specify a custom URL to an icon
	'last_tab'             => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'            => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'            => '',
	// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults'        => false,
	// On load save the defaults to DB before user clicks save or not
	'default_show'         => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'         => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'   => true,
	// Shows the Import/Export panel when not used as a field.

	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'           => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'             => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'use_cdn'              => true,
	// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
	'show_options_object'  => false,
	// HINTS
	'hints'                => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	)
);
Redux::setArgs( $opt_name, $args );

include AZEN_THEME_DIR . "/inc/admin/options/header.php";
include AZEN_THEME_DIR . "/inc/admin/options/display.php";
if ( class_exists( 'WooCommerce' ) ) {
	include AZEN_THEME_DIR . "/inc/admin/options/woocommerce.php";
}
include AZEN_THEME_DIR . "/inc/admin/options/styling.php";
include AZEN_THEME_DIR . "/inc/admin/options/typography.php";
include AZEN_THEME_DIR . "/inc/admin/options/social-share.php";
include AZEN_THEME_DIR . "/inc/admin/options/footer.php";
include AZEN_THEME_DIR . "/inc/admin/options/custom-css.php";

/************************************************************************
 * WBC Importer Extension
 *************************************************************************/
if ( !function_exists( 'azen_custom_extension_loader' ) ) {
	function azen_custom_extension_loader( $ReduxFramework ) {
		require_once AZEN_THEME_DIR . '/inc/admin/demo_importer/extension_demo_importer.php';
		new ReduxFramework_extension_demo_importer( $ReduxFramework );
	}

	add_action( "redux/extensions/azen_theme_options/before", 'azen_custom_extension_loader', 0 );
}

if ( !function_exists( 'azen_data_after_content_import' ) ) {
	function azen_data_after_content_import( $demo_active_import, $demo_directory_path ) {
		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		//Import Sliders
		if ( class_exists( 'RevSlider' ) ) {
			$data_sliders_array = array(
				'Demo 1' => 'slider-homepage-1.zip',
                'Demo 2' => 'slider-homepage2.zip',
                'Demo 3' => 'slider-homepage3.zip',
                'Demo 4' => 'slider-homepage4.zip',
                'Demo 5' => 'slider-homepage5.zip',
                'Demo 6' => 'slider-homepage-6.zip',
			);

			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $data_sliders_array ) ) {
				$data_slider_import = $data_sliders_array[$demo_active_import[$current_key]['directory']];
				if ( file_exists( $demo_directory_path . $data_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path . $data_slider_import );
				}
			}
		}

		//Set Menus
		$data_menu_array = array(
			'Demo 1' => 'main-menu',
            'Demo 2' => 'main-menu',
            'Demo 3' => 'main-menu',
            'Demo 4' => 'main-menu',
            'Demo 5' => 'main-menu',
            'Demo 6' => 'main-menu',
		);

		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $data_menu_array ) ) {
			$top_menu = get_term_by( 'name', $data_menu_array[$demo_active_import[$current_key]['directory']], 'nav_menu' );
			if ( isset( $top_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'primary' => $top_menu->term_id,
					)
				);
			}
		}

		//Set Home Page
		$data_home_pages = array(
			'Demo 1' => 'Home classic v1',
            'Demo 2' => 'Home classic v2',
            'Demo 3' => 'Home classic v3',
            'Demo 4' => 'Home classic v4',
            'Demo 5' => 'Home classic v5',
            'Demo 6' => 'Home classic v6',
		);

		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $data_home_pages ) ) {
			$page = get_page_by_title( $data_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
			$blog = get_page_by_title( 'Blog masonry' );
			update_option( 'page_for_posts', $blog->ID );
		}
		// update woo setting after import demo data
		update_option( 'woocommerce_shop_page_id', '35' );
		update_option( 'woocommerce_cart_page_id', '28' );
		update_option( 'woocommerce_checkout_page_id', '31' );
		update_option( 'woocommerce_terms_page_id', '3' );
		update_option( 'woocommerce_myaccount_page_id', '33' );

	}

	add_action( 'demo_importer_after_content_import', 'azen_data_after_content_import', 10, 2 );
}

function azen_demo_importer_description( $output ) {
	$output = esc_html__( 'Works best to import on a new install of WordPress', 'azen' );
	$output .= '<br/>';
	$output .= esc_html__( 'Before click button import demo please config image size of ', 'azen' ) . '<a href="' . esc_url( home_url( '/' ) ) . 'wp-admin/customize.php" target="_blank">' . esc_html__( 'WooCommerce', 'azen' ) . '</a>';
	$output .= esc_html__( ' with Main image width (600), Thumbnail width (380)', 'azen' );
	$output .= esc_html__( ' and of ', 'azen' ) . '<a href="' . esc_url( home_url( '/' ) ) . 'wp-admin/options-media.php" target="_blank">' . esc_html__( 'Media', 'azen' ) . '</a>';
	$output .= esc_html__( ' with Medium size (380x280)', 'azen' );

	return $output;
}

add_filter( 'demo_importer_description', 'azen_demo_importer_description' );


