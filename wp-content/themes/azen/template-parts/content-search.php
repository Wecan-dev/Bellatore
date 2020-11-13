<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package azen
 */
$class[] = 'list-item';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
	<div class="inner-item">
		<?php
		if ( has_post_thumbnail() ) {
			echo '<div class="post-formats-wrapper"><a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '">';
			the_post_thumbnail( 'large', [ 'alt' => the_title_attribute( 'echo=0' ) ] );
			echo '</a></div>';
		}
		echo '<div class="content-inner">';
		azen_entry_archive();
		if ( has_post_format( 'link' ) ) {
			$url  = get_post_meta( get_the_ID(), 'url', true );
			$text = get_post_meta( get_the_ID(), 'text', true );
			if ( $url && $text ) {
				echo '<h2 class="entry-title"><a class="link" href="' . esc_url( $url ) . '">' . esc_html( $text ) . '</a></h2>';
			}
		} else {
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		}
		the_excerpt();

		wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'azen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );

		echo '<p class="read-more"><a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '">' . esc_attr__( 'Read More', 'azen' ) . '</a></p>';
		echo '</div>';
		?>
	</div>
</article><!-- #post-## -->