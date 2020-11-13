<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package azen
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php

		the_content();

		wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'azen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );

		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->