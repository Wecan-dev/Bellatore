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

if ( !class_exists( 'PhyscBuilder_Config_Social_Links' ) ) {
	/**
	 * Class PhyscBuilder_Config_Posts
	 */
	class PhyscBuilder_Config_Social_Links extends PhyscBuilder_Abstract_Config {

		/**
		 * PhyscBuilder_Config_Posts constructor.
		 */
		public function __construct() {
			// info
			self::$base = 'social-links';
			self::$name = __( 'Social Links', 'physc-builder' );
			self::$desc = __( 'Display list social', 'physc-builder' );

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
						"type"       => "textfield",
						"heading"    => esc_html__( "Face Url", "physc-builder" ),
						"param_name" => "face_url",
					),
					array(
						"type"       => "textfield",
						"heading"    => esc_html__( "Twitter Url", "physc-builder" ),
						"param_name" => "twitter_url",
					),
					array(
						"type"       => "textfield",
						"heading"    => esc_html__( "Google Url", "physc-builder" ),
						"param_name" => "google_url",
					),
					array(
						"type"       => "textfield",
						"heading"    => esc_html__( "Dribble Url", "physc-builder" ),
						"param_name" => "dribble_url",
					),
					array(
						"type"       => "textfield",
						"heading"    => esc_html__( "Linkedin Url", "physc-builder" ),
						"param_name" => "linkedin_url",
					),
					array(
						"type"       => "textfield",
						"heading"    => esc_html__( "Instagram Url", "physc-builder" ),
						"param_name" => "instagram_url",
					),
					array(
						"type"       => "textfield",
						"heading"    => esc_html__( "Youtube Url", "physc-builder" ),
						"param_name" => "youtube_url",
					),
					array(
						"type"       => "textfield",
						"heading"    => esc_html__( "Behance Url", "physc-builder" ),
						"param_name" => "behance_url",
					),
				)
			);
		}
	}
}