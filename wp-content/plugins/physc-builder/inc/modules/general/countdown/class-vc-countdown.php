<?php
/**
 * PhyscBuilders Visual Composer Countdown shortcode
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

if ( ! class_exists( 'PhyscBuilder_VC_Countdown' ) ) {
	/**
	 * Class PhyscBuilder_VC_Countdown
	 */
	class PhyscBuilder_VC_Countdown extends PhyscBuilder_VC_Shortcode {

		/**
		 * PhyscBuilder_VC_Countdown constructor.
		 */
		public function __construct() {
			// set config class
			$this->config_class = 'PhyscBuilder_Config_Countdown';

			parent::__construct();
		}
	}
}

new PhyscBuilder_VC_Countdown();