<?php
add_action( 'azen_logo', 'azen_logo', 10 );
add_action( 'azen_logo_header_v1', 'azen_logo', 10 );
// logo
if ( !function_exists( 'azen_logo' ) ) :
	function azen_logo() {
		global $azen_theme_options;
		if ( isset( $azen_theme_options['azen_logo'] ) && $azen_theme_options['azen_logo']['url'] <> '' ) {
			$url        = $azen_theme_options['azen_logo']['url'];
			$site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
			echo '<div class="logo"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">';
			echo '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $site_title ) . '"/>';
			echo '</a></div>';

		} else {
			echo '<div class="logo-area-title"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">';
 			echo esc_attr( get_bloginfo( 'name' ) );
			echo '</a></div>';
 		}
 	}
endif;

if ( !function_exists( 'azen_logo_404' ) ) :
    function azen_logo_404() {
        global $azen_theme_options;
        if ( isset( $azen_theme_options['azen_logo_404'] ) && $azen_theme_options['azen_logo_404']['url'] <> '' ) {
            $url        = $azen_theme_options['azen_logo_404']['url'];
            $site_title = esc_attr( get_bloginfo( 'name', 'display' ) );
            echo '<div class="logo"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">';
            echo '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $site_title ) . '"/>';
            echo '</a></div>';

        } else {
            echo '<div class="logo-area-title"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">';
            echo esc_attr( get_bloginfo( 'name' ) );
            echo '</a></div>';
        }
    }
endif;
add_action( 'azen_logo_404', 'azen_logo_404', 10 );