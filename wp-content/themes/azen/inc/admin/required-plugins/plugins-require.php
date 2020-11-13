<?php

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package       TGM-Plugin-Activation
 * @subpackage    Example
 * @version       2.3.6
 * @author        Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author        Gary Jones <gamajo@gamajo.com>
 * @copyright     Copyright (c) 2012, Thomas Griffin
 * @license       http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link          https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part( 'inc/admin/required-plugins/class-tgm-plugin-activation' );
add_action( 'tgmpa_register', 'azen_register_required_plugins', 0, 1 );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function azen_register_required_plugins() {
	$link_plugin = 'http://physcode.com/plugins/';
	$plugins     = array(
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false,
		),
		array(
			'name'     => 'Instagram Feed',
			// The plugin name
			'slug'     => 'instagram-feed',
			'required' => false,
		),
		array(
			'name'     => 'MailChimp for WordPress',
			'slug'     => 'mailchimp-for-wp',
			'required' => false,
		),
		array(
			'name'     => 'WooCommerce',
			'slug'     => 'woocommerce',
			'required' => true,
		),
		array(
			'name'     => 'YITH WooCommerce Wishlist',
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => true,
		),
		array(
			'name'     => 'Meta Box',
			'slug'     => 'meta-box',
			'required' => true,
		),

		array(
			'name'     => 'Redux Framework',
			'slug'     => 'redux-framework',
			'required' => true,
		),
		array(
			'name'     => 'Revolution Slider',
			'slug'     => 'revslider',
			'source'   => esc_url( $link_plugin ) . 'revslider.zip',
			'version'  => '6.2.22',
			'required' => true,
		),
        array(
            'name'     => 'Elementor',
            'slug'     => 'elementor',
            'required' => true,
        ),
		array(
			'name'     => 'Physcode Builder',
			'slug'     => 'physc-builder',
			'source'   => esc_url( $link_plugin ) . 'physc-builder.zip',
			'version'  => '1.0.4',
			'required' => true,
		),
	);


	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */

	$config = array(
		'id'           => 'azen',
		// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',
		// Default absolute path to pre-packaged plugins.
		'menu'         => 'install-required-plugins',
		// Menu slug.
		'parent_slug'  => 'themes.php',
		// Parent menu slug.
		'capability'   => 'edit_theme_options',
		// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,
		// Show admin notices or not.
		'dismissable'  => true,
		// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',
		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,
		// Automatically activate plugins after installation or not.
		'message'      => '',
		// Message to output right before the plugins table.
		// Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
	);
	tgmpa( $plugins, $config );
}