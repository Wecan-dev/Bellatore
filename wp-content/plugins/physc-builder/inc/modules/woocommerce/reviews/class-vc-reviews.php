<?php
/**
 * PhyscBuilders Visual Composer Reviews shortcode
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

if ( ! class_exists( 'PhyscBuilder_VC_Reviews' ) ) {
	/**
	 * Class PhyscBuilder_VC_Reviews
	 */
	class PhyscBuilder_VC_Reviews extends PhyscBuilder_VC_Shortcode {

		/**
		 * PhyscBuilder_VC_Reviews constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'PhyscBuilder_Config_Reviews';

			parent::__construct();
		}
	}
}

new PhyscBuilder_VC_Reviews();