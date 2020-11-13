<?php
/**
 * PhyscBuilders Visual Composer Banner Html shortcode
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

if ( !class_exists( 'PhyscBuilder_VC_Banner_Html' ) ) {
	/**
	 * Class PhyscBuilder_VC_Icon_Box
	 */
	class PhyscBuilder_VC_Banner_Html extends PhyscBuilder_VC_Shortcode {

		protected $config_class = 'PhyscBuilder_Config_Banner_Html';
	}
}

new PhyscBuilder_VC_Banner_Html();