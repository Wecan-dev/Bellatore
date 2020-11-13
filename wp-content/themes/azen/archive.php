<?php
/**
 * The template for displaying archive pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package azen
 */

get_header();

do_action( 'azen_banner_heading' );

do_action( 'azen_wrapper_loop_start' );
$class  = '';
$style  = azen_layout_blog();
$class  .= azen_layout_blog();
$layout = ( $style == 'standard' ) ? '' : $style;
if ( $style == 'masonry' ) {
	$class .= ' masonry-column-' . azen_column_masonry();
}

if ( have_posts() ) :
	?>
	<div class="wrapper-blog-content content-blog-<?php echo esc_attr( $class ); ?>">
		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', $layout );
		endwhile;
		?>
	</div>
	<?php

	azen_paging_nav();

else :

	get_template_part( 'template-parts/content', 'none' );

endif;


do_action( 'azen_wrapper_loop_end' );

get_footer();
