<?php
 function azen_child_enqueue_styles() {
	wp_deregister_style( 'azen-style' );
	$parent_style = 'parent-style'; 
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array() ,  filemtime( get_template_directory() . '/style.css' ));
	wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( $parent_style ) ,'1.0.1');
	wp_deregister_style( 'azen-options' );
	if ( is_file( AZEN_UPLOADS_FOLDER . AZEN_FILE_NAME ) ) {
		wp_enqueue_style( 'azen-options-child', AZEN_UPLOADS_URL . AZEN_FILE_NAME, array(), filemtime( AZEN_UPLOADS_FOLDER . AZEN_FILE_NAME ) );
	}else{
		wp_enqueue_style( 'azen-options-child', get_template_directory_uri() . '/assets/css/azen-options.css', array(),  filemtime( get_template_directory() . '/assets/css/azen-options.css' ) );
	}
}

add_action( 'wp_enqueue_scripts', 'azen_child_enqueue_styles', 11 );

