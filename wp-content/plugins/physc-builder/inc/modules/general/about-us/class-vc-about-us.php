<?php
/**
 * PhyscBuilders Visual Composer About Us shortcode
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

if ( !class_exists( 'PhyscBuilder_VC_About_Us' ) ) {
	/**
	 * Class PhyscBuilder_VC_Icon_Box
	 */
	class PhyscBuilder_VC_About_Us extends PhyscBuilder_VC_Shortcode {

		protected $config_class = 'PhyscBuilder_Config_About_Us';
	}
}

new PhyscBuilder_VC_About_Us();