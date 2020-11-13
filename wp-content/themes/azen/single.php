<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package azen
 */

get_header();

do_action( 'azen_banner_heading' );

do_action( 'azen_wrapper_loop_start' );

while ( have_posts() ) : the_post();
	echo '<div class="wrapper-blog-content single-blog-content">';
	get_template_part( 'template-parts/content', 'single' );
	azen_the_posts_navigation();
	if ( get_the_author_meta( 'description' ) ) { ?>
		<div class="single-post-author">
			<div class="author-image">
				<?php echo get_avatar( get_the_author_meta( 'email' ), '260' ); ?>
			</div>
			<div class="author-info">
				<h5><?php
					echo the_author_posts_link(); ?>
				</h5>
				<p><?php the_author_meta( 'description' ); ?></p>
			</div>
		</div>
	<?php }
	if ( azen_get_option( 'show_related_post' ) == 1 ) {
		get_template_part( 'inc/related-posts' );
	}
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	echo '</div>';
endwhile; // End of the loop.

do_action( 'azen_wrapper_loop_end' );

get_footer();
?>
