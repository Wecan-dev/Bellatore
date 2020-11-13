<?php
/**
 * Template for displaying global default template Reviews element.
 *
 * This template can be overridden by copying it to yourtheme/physc-builder/reviews/reviews.php.
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

if ( !$params['number'] ) {
	return;
}

// global params

$number          = $params['number'];
$order           = $params['order'];
$phys_builder_animation = $params['el_class'] ? ' ' . $params['el_class'] : '';

echo '<div class="reviews-product' . esc_attr( $phys_builder_animation ) . '"><div class="reviews-content woocommerce">';
echo '<div class="sc-reviews owl-carousel owl-theme">';

$reviews = get_comments(
	array(
		'number'      => $number,
		'status'      => 'approve',
		'post_status' => 'publish',
		'post_type'   => array( 'product' ),
		'orderby'     => 'comment_date_gmt',
		'order'       => $order,
	)
);
foreach ( $reviews as $review ) {
	?>
	<div class="item">
		<?php
		echo '<div class="avatar-author">' . get_avatar( $review->user_id > 0 ? $review->user_id : $review->comment_author_email, 160 ) . '</div>';
		echo '<div class="entry-content">';
 		echo '<h2 class="author-name">' . $review->comment_author . '</h2>';
		physc_renders_stars_rating( $review->comment_ID, 'rating', true );
		echo '<div class="des"><p>' . $review->comment_content . '</p></div>';
		echo '</div>';
		?>
	</div>
	<?php

}

echo '</div></div>';
echo '</div>';

?>
