<?php
/*
Plugin Name: Physcode Builder
Plugin URI: http://physcode.com/
Description: Full of features for page builders: Visual Composer, Elementor
Author: Physcode
Version: 1.0.4
Text Domain: physc-builder
Author URI: http://physcode.com
*/

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( !class_exists( 'Physc_Builder' ) ) {
	/**
	 * Class Physc_Builder
	 */
	final class Physc_Builder {

		/**
		 * @var null
		 */
		private static $_instance = null;

		/**
		 * @var string
		 */
		public $_version = '1.0.0';

		/**
		 * Physc_Builder constructor.
		 */
		public function __construct() {

			if ( !function_exists( 'is_plugin_active' ) ) {
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			}

			$this->define_constants();
			$this->load_plugin_textdomain();

			// Depend on Visual Composer
			if ( !( is_plugin_active( 'js_composer/js_composer.php' ) || is_plugin_active( 'elementor/elementor.php' ) ) ) {
				add_action( 'admin_notices', array( $this, 'admin_notices' ) );
			} else {
				$this->includes();
				$this->init_hooks();
			}
			// include widgets
			require_once( PHYSC_BUILDER_INC . 'widgets/list-post.php' );
			require_once( PHYSC_BUILDER_INC . 'widgets/search.php' );
			require_once( PHYSC_BUILDER_INC . 'widgets/social.php' );
			require_once( PHYSC_BUILDER_INC . 'tax-meta-class/tax-meta-class.php' );
			require_once( PHYSC_BUILDER_INC . 'importer/radium-importer.php' );

			add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 10 );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_register_scripts' ), 10 );
			add_action( 'widgets_init', array( $this, 'physc_register_widgets' ) );
			add_filter( 'the_content', array( $this, 'physcode_shortcodes_formatter' ) );
		}

		/**
		 * Define constants.
		 */
		private function define_constants() {
			define( 'PHYSC_BUILDER_FILE', __FILE__ );
			define( 'PHYSC_BUILDER_PATH', dirname( __FILE__ ) . '/' );
			define( 'PHYSC_BUILDER_URL', plugins_url( '', __FILE__ ) . '/' );
			define( 'PHYSC_BUILDER_INC', PHYSC_BUILDER_PATH . 'inc/' );
			define( 'PHYSC_BUILDER_VER', $this->_version );
		}
		//////////////////////////////////////////////////////////////////
		// Remove extra P tags
		//////////////////////////////////////////////////////////////////
		public function physcode_shortcodes_formatter( $content ) {
			$block = join( "|", array(
				'banner-html',
				'testimonials',
				'posts',
				'countdown',
				'about-us',
				'social-links',
				'products',
				'products-cat',
				'products-tab',
				'products-showcase',
                'our-team'
			) );
			// opening tag
			$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );
			// closing tag
			$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)/", "[/$2]", $rep );

			return $rep;
		}

		/**
		 * Register scripts.
		 */
		public function register_scripts() {

			// slick slider
			wp_enqueue_script( 'physc-builder-slick', PHYSC_BUILDER_URL . 'assets/libs/slick/slick.min.js', array( 'jquery' ), '1.8.1' );
			wp_enqueue_style( 'physc-builder-slick', PHYSC_BUILDER_URL . 'assets/libs/slick/slick.css', '', '1.8.1' );
			// owl carousel
			wp_enqueue_script( 'physc-builder-owl', PHYSC_BUILDER_URL . 'assets/libs/owl/owl.carousel.min.js', array( 'jquery' ), '2.3.4' );
			wp_enqueue_script( 'physc-builder-owlThumbs', PHYSC_BUILDER_URL . 'assets/libs/owl/OwlCarousel2Thumbs.min.js', array( 'jquery' ), '2.3.4' );
			wp_enqueue_style( 'physc-builder-owl-carousel', PHYSC_BUILDER_URL . 'assets/libs/owl/owl.carousel.min.css', '', '2.3.4' );

			// countdown
			wp_register_script( 'physc-builder-jquery-plugin', PHYSC_BUILDER_URL . 'assets/libs/countdown/jquery.plugin.min.js', array(), '1.0.1' );
			wp_register_script( 'physc-builder-countdown', PHYSC_BUILDER_URL . 'assets/libs/countdown/jquery.countdown.min.js', array(), '2.0.2' );
			wp_register_style( 'physc-builder-countdown', PHYSC_BUILDER_URL . 'assets/libs/countdown/jquery.countdown.css', array(), '2.0.0' );

			// frontend script
			wp_enqueue_script( 'physc-builder-fontend', PHYSC_BUILDER_URL . 'assets/js/physc-builder.js', array( 'jquery' ), '1.0.4' );
		}


		/**
		 * Register scripts.
		 */
		public function admin_register_scripts() {

			// datetimepicker
			wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_style( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/' . wp_scripts()->registered['jquery-ui-core']->ver . '/themes/smoothness/jquery-ui.css' );

		}

		/**
		 * Load Localisation files.
		 *
		 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
		 */
		public function load_plugin_textdomain() {
			$locale = apply_filters( 'plugin_locale', get_locale(), 'physc-builder' );
			load_textdomain( 'physc-builder', WP_LANG_DIR . '/physc-builder/physc-builder-' . $locale . '.mo' );
			load_plugin_textdomain( 'physc-builder', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}

		/**
		 * Include files.
		 */
		private function includes() {


			require_once( PHYSC_BUILDER_INC . 'abstracts/abstract-config.php' );
			require_once( PHYSC_BUILDER_INC . 'abstracts/aq_resizer.php' );

			require_once( PHYSC_BUILDER_INC . 'builders/class-bp-builders.php' );

			// visual composer
			if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
				require_once( PHYSC_BUILDER_INC . 'builders/visual-composer/class-pb-vc.php' );
			}

			// elementor
			if ( is_plugin_active( 'elementor/elementor.php' ) ) {
				require_once( PHYSC_BUILDER_INC . 'builders/elementor/class-pb-el.php' );
			}

			require_once( PHYSC_BUILDER_INC . 'functions.php' );
		}

		public function physc_register_widgets() {
			register_widget( 'Physc_Widget_Posts' );
			register_widget( 'Physc_search_widget' );
			register_widget( 'Physc_Social_Widget' );
		}

		/**
		 * Init hook.
		 */
		public function init_hooks() {

			add_action( 'plugins_loaded', array( $this, 'init_modules' ) );
		}

		/**
		 * Init elements config.
		 */
		public function init_modules() {
			$modules = self::get_modules();
			if ( !is_array( $modules ) ) {
				return;
			}
			foreach ( $modules as $plugin => $group ) {
				foreach ( $group as $element ) {

					$file_config = PHYSC_BUILDER_INC . "modules/$plugin/$element/config.php";
					if ( file_exists( $file_config ) ) {
						require_once $file_config;
					}
				}
			}
		}

		/**
		 * Get all features.
		 *
		 * @return mixed
		 */
		public static function get_modules() {
			$modules = array(
				'general'     => array(
					'posts',
					'banner-html',
					'testimonials',
					'countdown',
					'about-us',
					'social-links',
                    'our-team',
				),
				'woocommerce' => array(
					'products',
					'products-cat',
					'products-showcase',
					'reviews',
					'products-tab',
					'flash-sale',
                    'flash-list-sale'
				),
			);

			// disable elements when depends plugin not active
			foreach ( $modules as $plugin => $_modules ) {

				if ( $plugin != 'general' && !is_plugin_active( "$plugin/$plugin.php" ) ) {
					unset( $modules[$plugin] );
				}
			}

			return apply_filters( 'physc-builder/modules', $modules );
		}

		/**
		 * Admin notice
		 */
		public function admin_notices() {
			?>
			<div class="notice notice-error">
				<p>
					<?php echo wp_kses(
						__( '<strong>PhyscBuilders</strong> plugin supports for <strong>Visual Composer, Elementor</strong>. Please install and activate one of the page builders.', 'physc-builder' ),
						array(
							'strong' => array()
						)
					); ?>
				</p>
			</div>
		<?php }

		/**
		 * @return null|Physc_Builder
		 */
		public static function instance() {
			if ( !self::$_instance ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}
	}
}

if ( !function_exists( 'Physc_Builder' ) ) {
	/**
	 * @return null|Physc_Builder
	 */
	function Physc_Builder() {
		return Physc_Builder::instance();
	}
}

$GLOBALS['Physc_Builder'] = Physc_Builder();


add_filter( 'widget_text', 'do_shortcode' );