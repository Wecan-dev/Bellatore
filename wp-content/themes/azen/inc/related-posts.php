<?php

$orig_post = $post;
global $post;

$categories = get_the_category($post->ID);

if ($categories) {

	$category_ids = array();

	foreach($categories as $individual_category) {$category_ids[] = $individual_category->term_id;}

	$args = array(
		'category__in'     => $category_ids,
		'post__not_in'     => array($post->ID),
		'posts_per_page'   => 3, // Number of related posts that will be shown.
		'ignore_sticky_posts' => 1,
		'orderby' => 'rand'
	);

	$related_posts = new wp_query( $args );
	if( $related_posts->have_posts() ) { ?>
		<div class="wrapper-related-posts"><h3 class="related-title"><?php esc_html_e('# RELATED POSTS', 'azen'); ?></h3>
  		<div class="related-posts">
		<?php while( $related_posts->have_posts() ) {
			$related_posts->the_post();?>
				<div class="post-inner col-sm-4">
					<?php
 						if ( has_post_thumbnail() ) {
						echo '<div class="post-formats-wrapper"><a class="post-image" href="' . esc_url( get_permalink() ) . '">';
						echo  get_the_post_thumbnail( get_the_ID(), 'medium' );
						echo '<div class="overlay"></div></a></div>';
						}
 					?>
					<div class="entry-content">
					<?php
					if ( has_post_format( 'link' ) ) {
						$url  = get_post_meta( get_the_ID(), 'url', true );
						$text = get_post_meta( get_the_ID(), 'text', true );
						if ( $url && $text ) {
							echo '<h5 class="entry-title"><a class="link" href="' . esc_url( $url ) . '">' . esc_html( $text ) . '</a></h5>';
						}
						} else {
							the_title( sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
						}
						?>
						<?php
						 echo '<span class="date">' . get_the_date() . '</span>';
						?>
 					</div>
				</div><!-- #post-## -->
		<?php
		}
		echo '</div></div>';
	}
}
$post = $orig_post;
 wp_reset_postdata();

?>