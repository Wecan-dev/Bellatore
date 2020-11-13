<?php
/**
 * PhyscBuilders Visual Composer Products_Cat shortcode
 *
 * @version     1.0.0
 * @author      Physcode
 * @package     PhyscBuilders/Classes
 * @category    Classes
 * @author      Physcodes
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'PhyscBuilder_VC_Products_Cat' ) ) {
	/**
	 * Class PhyscBuilder_VC_Products_Cat
	 */
	class PhyscBuilder_VC_Products_Cat extends PhyscBuilder_VC_Shortcode {

		/**
		 * PhyscBuilder_VC_Products_Cat constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'PhyscBuilder_Config_Products_Cat';

			parent::__construct();
		}
	}
}

new PhyscBuilder_VC_Products_Cat();