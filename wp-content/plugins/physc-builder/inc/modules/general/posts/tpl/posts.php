<?php
/**
 * Template for displaying default template Posts element.
 *
 * This template can be overridden by copying it to yourtheme/physc-builder/posts/categories.php.
 *
 * @author      Physcodes
 * @package     PhyscBuilders/Templates
 * @version     1.0.0
 * @author      Physcodes
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

/**
 * @var $params array - shortcode params
 */
$title           = $params['title'];
$element_tag     = $params['element_tag'];
$title_color     = $params['title_color'];
$category        = $params['category'];
$number          = $params['number'];
$item_on_row     = $params['item_on_row'];
$show_date       = $params['show_date'];
$show_author     = $params['show_author'];
if ( $show_date == 'yes' ) {
	$show_date = 'true';
}
if ( $show_author == 'yes' ) {
	$show_author = 'true';
}
$phys_builder_animation = $params['el_class'] ? ' ' . $params['el_class'] : '';

$sort_post  = !empty( $params['sort_post'] ) ? $params['sort_post'] : 'date';
$order_post = !empty( $params['order_post'] ) ? $params['order_post'] : 'DESC';

$query_atts['posts_per_page'] = $number;
if ( $category ) {
	$cats_id                 = explode( ',', $category );
	$query_atts['tax_query'] = array(
		array(
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => $cats_id
		)
	);
}
$query_atts['orderby'] = $sort_post;
$query_atts['order']   = $order_post;


$the_query = new WP_Query( apply_filters( 'builder-press/posts-query', $query_atts ) );

?>

<?php if ( $the_query->have_posts() ) {

	echo '<div class="sc-list-posts' . $phys_builder_animation . '">';
	$size_images = 'full';
	$style_title = $title_color ? ' style="color:' . $title_color . '"' : '';
	if ( $title ) {
		echo '<' . $element_tag . ' class="special-heading"' . $style_title . '>' . $title . '</' . $element_tag . '>';
	}
	echo '<div class="row inner-list-posts">';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$class = 'list-item col-xl-' . ( 12 / $item_on_row ) . ' col-lg-' . ( 12 / $item_on_row ) . ' col-md-' . ( 12 / $item_on_row ) . ' col-sm-12 col-12';
		?>
		<div <?php post_class( $class ); ?>>
			<div class="news-details">
				<?php
				if ( has_post_thumbnail() ) {
					echo '<div class="post-formats-wrapper"><a href="' . esc_url( get_permalink() ) . '" title="' . get_the_title() . '">';
					$link_image = bp_custom_image_size( 380, 450, get_the_post_thumbnail_url( get_the_ID(), 'full' ) );
					echo '<img src="' . $link_image . '" alt="' . get_the_title() . '">';
					echo '</a></div>';
				}
				echo '<div class="info">';
				if ( $show_date == 'true' || $show_author == 'true' ) {
					echo '<div class="date">';
					if ( $show_date == 'true' ) {
						echo '<div class="time"><i class="zmdi zmdi-alarm-check"></i> ' . get_the_date() . '</div>';
					}
					if ( $show_author == 'true' && get_the_author() ) {
						printf(
							'<div><a class="url fn n" href="%1$s"><i class="zmdi zmdi-account"></i>%2$s</a></div>',
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							get_the_author()
						);
					}
					echo '</div>';
				};
				the_title( sprintf( '<h4 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				echo '</div>';
				?>
			</div>
		</div>
		<?php
	}
	echo '</div>';
	echo '</div>';
	wp_reset_postdata();
	?>
<?php } ?>