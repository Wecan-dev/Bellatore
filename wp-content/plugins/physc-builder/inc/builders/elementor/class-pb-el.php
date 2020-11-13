<?php
/**
 * PhyscBuilders Elementor class
 *
 * @version     1.0.0
 * @author      Physcode
 * @package     PhyscBuilders/Classes
 * @category    Classes
 * @author      Physcode
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'PhyscBuilder_El' ) ) {
	/**
	 * Class PhyscBuilder_El
	 */
	class PhyscBuilder_El {

		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * PhyscBuilder_El constructor.
		 */
		public function __construct() {

			// mapping params
			require_once( PHYSC_BUILDER_INC . 'builders/elementor/class-pb-el-mapping.php' );

			// register custom control
			add_action( 'elementor/controls/controls_registered', array( $this, 'register_controls' ) );

			// add widget categories
			add_action( 'elementor/init', array( $this, 'register_categories' ) );
			// load widget
			add_action( 'elementor/widgets/widgets_registered', array( $this, 'load_widgets' ) );
		}

		/**
		 * @param $Controls_Manager Elementor\Controls_Manager
		 */
		public function register_controls( $Controls_Manager ) {

			$fields = apply_filters( 'physc-builder/elementor/fields', array( 'link', 'radioimage_el' ) );

			if ( $fields ) {
				foreach ( $fields as $field ) {
					$file = apply_filters( 'physc-builder/el-widget-file', PHYSC_BUILDER_INC . "builders/elementor/fields/$field.php" );
					if ( file_exists( $file ) ) {
						include_once $file;
						//$class = "Control_" . ucfirst( $field );
						$class_name = __NAMESPACE__ . '\Control_' . ucwords( $field );
						if ( class_exists( $class_name ) ) {
							$Controls_Manager->register_control( $field, new $class_name() );
						}
					}
				}
			}
		}

		/**
		 * Add widget categories
		 */
		public function register_categories() {
			\Elementor\Plugin::instance()->elements_manager->add_category(
				'physc-builder',
				array(
					'title' => __( 'Physc Builder', 'physc-builder' ),
					'icon'  => 'fa fa-plug'
				)
			);
		}

		/**
		 * @param $widgets_manager Elementor\Widgets_Manager
		 *
		 * @throws Exception
		 */
		public function load_widgets( $widgets_manager ) {

			// parent class
			require_once( PHYSC_BUILDER_INC . 'builders/elementor/class-pb-el-widget.php' );

			$widgets = physc_builder_get_modules();
 			foreach ( $widgets as $group => $_widgets ) {
				foreach ( $_widgets as $widget ) {
					$file = apply_filters( 'physc-builder/el-widget-file', PHYSC_BUILDER_INC . "modules/$group/$widget/class-el-$widget.php", $widget );
					if ( file_exists( $file ) ) {
						include_once $file;

						$class = '\PhyscBuilder_El_' . str_replace( '-', '_', ucfirst( $widget ) );
 						if ( class_exists( $class ) ) {
							$widgets_manager->register_widget_type( new $class() );
						}
					}
				}
			}
		}

		/**
		 * Instance.
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
		}
	}
}

new PhyscBuilder_El();