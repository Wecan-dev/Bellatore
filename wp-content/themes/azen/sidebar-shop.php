<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package azen
 */

if ( !is_active_sidebar( 'sidebar-shop' ) ) {
	return;
}
?>
<div class="widget-area col-sm-3 alignleft">
	<?php dynamic_sidebar( 'sidebar-shop' ); ?>
</div><!-- #secondary -->