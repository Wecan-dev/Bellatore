<?php
/**
 * Extension-Boilerplate
 * @link        https://github.com/ReduxFramework/extension-boilerplate
 *
 * Radium Importer - Modified For ReduxFramework
 * @link        https://github.com/FrankM1/radium-one-click-demo-install
 *
 * @package     demo_importer - Extension for Importing demo content
 * @author      Webcreations907
 * @version     1.0.1
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// Don't duplicate me!
if ( !class_exists( 'ReduxFramework_demo_importer' ) ) {

	/**
	 * Main ReduxFramework_demo_importer class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_demo_importer {

		/**
		 * Field Constructor.
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		function __construct( $field = array(), $value = '', $parent ) {
			$this->parent = $parent;
			$this->field  = $field;
			$this->value  = $value;

			$class = ReduxFramework_extension_demo_importer::get_instance();

			if ( !empty( $class->demo_data_dir ) ) {
				$this->demo_data_dir = $class->demo_data_dir;
				$this->demo_data_url = AZEN_THEME_URI. '/inc/admin/demo_importer/demo-data/';
			}

			if ( empty( $this->extension_dir ) ) {
				$this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
				$this->extension_url = AZEN_THEME_URI . '/inc/admin/demo_importer/inc';
			}
		}

		/**
		 * Field Render Function.
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function render() {

			echo '</fieldset></td></tr><tr><td colspan="2"><fieldset class="redux-field demo_importer">';

			$nonce = wp_create_nonce( "redux_{$this->parent->args['opt_name']}_demo_importer" );

			// No errors please
			$defaults = array(
				'id'        => '',
				'url'       => '',
				'width'     => '',
				'height'    => '',
				'thumbnail' => '',
			);

			$this->value = wp_parse_args( $this->value, $defaults );

			$imported = false;

			$this->field['demo_demo_imports'] = apply_filters( "redux/{$this->parent->args['opt_name']}/field/demo_importer_files", array() );

			echo '<div class="theme-browser"><div class="themes">';

			if ( !empty( $this->field['demo_demo_imports'] ) ) {

				foreach ( $this->field['demo_demo_imports'] as $section => $imports ) {

					if ( empty( $imports ) ) {
						continue;
					}

					if ( !array_key_exists( 'imported', $imports ) ) {
						$extra_class    = 'not-imported';
						$imported       = false;
						$import_message = esc_html__( 'Import Demo', 'azen' );
					} else {
						$imported       = true;
						$extra_class    = 'active imported';
						$import_message = esc_html__( 'Demo Imported', 'azen' );
					}
					echo '<div class="wrap-importer theme ' . $extra_class . '" data-demo-id="' . esc_attr( $section ) . '"  data-nonce="' . $nonce . '" id="' . $this->field['id'] . '-custom_imports">';

					echo '<div class="theme-screenshot">';

					if ( isset( $imports['image'] ) ) {
						echo '<img class="demo_image" src="' . esc_attr( esc_url( $this->demo_data_url . $imports['directory'] . '/' . $imports['image'] ) ) . '"/>';

					}
					echo '</div>';

					echo '<span class="more-details">' . $import_message . '</span>';
					echo '<h3 class="theme-name">' . esc_html( apply_filters( 'demo_importer_directory_title', $imports['directory'] ) ) . '</h3>';

					echo '<div class="theme-actions">';
					if ( false == $imported ) {
						echo '<div class="demo-importer-buttons"><span class="spinner">' . esc_html__( 'Please Wait...', 'azen' ) . '</span><span class="button-primary importer-button import-demo-data">' . esc_html__( 'Import Demo', 'azen' ) . '</span></div>';
					} else {
						echo '<div class="demo-importer-buttons button-secondary importer-button">' . esc_html__( 'Imported', 'azen' ) . '</div>';
						echo '<span class="spinner">' . esc_html__( 'Please Wait...', 'azen' ) . '</span>';
						echo '<div id="demo-importer-reimport" class="demo-importer-buttons button-primary import-demo-data importer-button">' . esc_html__( 'Re-Import', 'azen' ) . '</div>';
					}
					echo '</div>';
					echo '</div>';


				}

			} else {
				echo "<h5>" . esc_html__( 'No Demo Data Provided', 'azen' ) . "</h5>";
			}

			echo '</div></div>';
			echo '</fieldset></td></tr>';

		}

		/**
		 * Enqueue Function.
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function enqueue() {

			$min = Redux_Functions::isMin();

			wp_enqueue_script(
				'redux-field-demo-importer-js',
				$this->extension_url . '/assets/field_demo_importer' . $min . '.js',
				array( 'jquery' ),
				time(),
				true
			);

			wp_enqueue_style(
				'redux-field-demo-importer-css',
				$this->extension_url . '/assets/field_demo_importer.css',
				time(),
				true
			);
		}
	}
}
