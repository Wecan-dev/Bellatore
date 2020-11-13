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

if ( !class_exists( 'PhyscBuilder_VC_Our_Team' ) ) {
	/**
	 * Class PhyscBuilder_VC_Icon_Box
	 */
	class PhyscBuilder_VC_Our_Team extends PhyscBuilder_VC_Shortcode {

		protected $config_class = 'PhyscBuilder_Our_Team';
	}
}

new PhyscBuilder_VC_Our_Team();