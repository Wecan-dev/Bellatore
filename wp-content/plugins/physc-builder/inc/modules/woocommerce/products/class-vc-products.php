<?php
/**
 * PhyscBuilders Visual Composer Products shortcode
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

if ( ! class_exists( 'PhyscBuilder_VC_Products' ) ) {
	/**
	 * Class PhyscBuilder_VC_Products
	 */
	class PhyscBuilder_VC_Products extends PhyscBuilder_VC_Shortcode {

		/**
		 * PhyscBuilder_VC_Products constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'PhyscBuilder_Config_Products';

			parent::__construct();
		}
	}
}

new PhyscBuilder_VC_Products();