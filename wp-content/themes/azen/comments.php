<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package azen
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
			$comments_number = absint( get_comments_number() );
			if ( !have_comments() ) {
				_e( 'Leave a comment', 'azen' );
			} else {
				echo sprintf(
				/* translators: 1: number of comments*/
					_nx(
						'Comment (%1$s)',
						'Comments (%1$s)',
						$comments_number,
						'comments title',
						'azen'
					),
					number_format_i18n( $comments_number )
				);
			}
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above" class="navigation comment-navigation">
				<div class="nav-links">
					<div
						class="nav-previous"><?php previous_comments_link( esc_attr__( 'Older Comments', 'azen' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_attr__( 'Newer Comments', 'azen' ) ); ?></div>
				</div>
			</nav>
		<?php endif; ?>
		<div class="comment-list-inner">
			<ol class="comment-list">
				<?php wp_list_comments( 'avatar_size=90&callback=azen_comment' ); ?>
			</ol><!-- .comment-list -->
		</div>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-below" class="navigation comment-navigation">
				<div class="nav-links">
					<div
						class="nav-previous"><?php previous_comments_link( esc_attr__( 'Older Comments', 'azen' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_attr__( 'Newer Comments', 'azen' ) ); ?></div>
				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().

	if ( !comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_attr_e( 'Comments are closed.', 'azen' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->