<?php
if ( has_nav_menu( 'primary' ) ) {
	wp_nav_menu( array(
		'theme_location' => 'primary',
		'container'      => false,
		'menu_class'     => 'navmenu',
 	) );
} else {
	wp_nav_menu( array(
		'theme_location' => '',
		'container'      => false,
		'menu_class'     => 'navmenu',
 	) );
}
?>
