<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package azen
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 	<?php

	if ( has_post_format( 'quote' ) ) {
		echo '<div class="content-border">';
		$text_quote   = get_post_meta( get_the_ID(), 'quote', true ) ? get_post_meta( get_the_ID(), 'quote', true ) : the_title_attribute( 'echo=0' );
		$author_quote = get_post_meta( get_the_ID(), 'author', true ) ? get_post_meta( get_the_ID(), 'author', true ) : get_the_author();
		echo '<h1 class="entry-title">' . $text_quote . '</h1>';
		echo '<div class="calendar"><span><a href="' . esc_url( get_the_permalink( get_the_ID() ) ) . '"><i class="zmdi zmdi-account"></i>' . $author_quote . '</a></span></div>
			  <div class="link"><a href="' . esc_url( get_the_permalink( get_the_ID() ) ) . '"><i class="zmdi zmdi-quote"></i></a></div>';
		echo '</div>';
	} elseif ( has_post_format( 'link' ) ) {
		echo '<div class="content-border">';
		$url_link  = get_post_meta( get_the_ID(), 'url', true ) ? get_post_meta( get_the_ID(), 'url', true ) : get_the_permalink( get_the_ID() );
		$text_link = get_post_meta( get_the_ID(), 'text', true ) ? get_post_meta( get_the_ID(), 'text', true ) : the_title_attribute( 'echo=0' );
		echo '<h1 class="entry-title">' . $text_link . '</h1>';
		azen_entry_archive();
		echo '<div class="link"><a href="' . esc_url( $url_link ) . '"><i class="zmdi zmdi-link"></i></a></div>';
		echo '</div>';
	} else {
		do_action( 'azen_entry_top', 'full', false );
		azen_entry_archive();
		the_title( '<h1 class="entry-title">', '</h1>' );
	}
	echo '<div class="content-inner">';
	the_content();
	echo '</div>';
	wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'azen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );

	azen_entry_footer();
	?>

</article><!-- #post-## -->

