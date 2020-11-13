<?php

/**
 * Class Physc_Widget_Posts
 * List  posts
 */
class Physc_Widget_Posts extends WP_Widget {
	public function __construct() {
		$widget_ops = array( 'classname' => 'Widget_Posts', 'description' => 'Show list posts' );
		parent::__construct( 'Physc_Widget_Posts', 'Physcode: List Posts', $widget_ops );
	}

	public function form( $instance ) {
		$defaults = array(
			'title'   => '',
			'limit'   => 3,
			'order'   => 'DESC',
			'orderby' => 'post_date',
			'col'     => 3
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title    = $instance['title'];
		$limit    = $instance['limit'];
		$order    = $instance['order'];
		$orderby  = $instance['orderby'];
		?>

		<p>
			<label><?php esc_attr_e( 'Title', 'physc-builder' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label><?php esc_attr_e( 'Limit', 'physc-builder' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>" />
		</p>

		<p>
			<label><?php esc_attr_e( 'Order', 'physc-builder' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
				<option value="DESC" <?php selected( $order, 'DESC' ) ?>><?php esc_attr_e( 'DESC', 'physc-builder' ) ?></option>
				<option value="ASC" <?php selected( $order, 'ASC' ) ?>><?php esc_attr_e( 'ASC', 'physc-builder' ) ?></option>
			</select>
		</p>
		<p>
			<label><?php esc_attr_e( 'Display', 'physc-builder' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
				<option value="rand" <?php selected( $orderby, 'rand' ) ?>><?php esc_attr_e( 'Random', 'physc-builder' ) ?></option>
				<option value="comment_count" <?php selected( $orderby, 'comment_count' ) ?>><?php esc_attr_e( 'Popular', 'physc-builder' ) ?></option>
				<option value="post_date" <?php selected( $orderby, 'post_date' ) ?>><?php esc_attr_e( 'Date', 'physc-builder' ) ?></option>
			</select>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance            = $old_instance;
		$instance['title']   = sanitize_text_field( $new_instance['title'] );
		$instance['limit']   = sanitize_text_field( $new_instance['limit'] );
		$instance['order']   = sanitize_text_field( $new_instance['order'] );
		$instance['orderby'] = sanitize_text_field( $new_instance['orderby'] );

		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		echo ent2ncr( $before_widget );
		$title   = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$limit   = isset( $instance['limit'] ) ? $instance['limit'] : 3;
		$order   = isset( $instance['order'] ) ? $instance['order'] : 'DESC';
		$orderby = isset( $instance['orderby'] ) ? $instance['orderby'] : 'post_date';
		if ( $title ) {
			echo ent2ncr( $before_title . $title . $after_title );
		}

		$args = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'posts_per_page' => $limit,
			'order'          => $order,
			'orderby'        => $orderby
		);

		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			?>
			<div class="widget-list-posts">
				<ul class="list-unstyled">
					<?php while ( $the_query->have_posts() ) {
						$the_query->the_post();
						?>
						<li>
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="feature-image">
									<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>" class="post-thumbnail">
										<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ) ?>
									</a>
								</div>
							<?php } ?>
							<div class="post-description">
								<?php
								echo '<span class="day">' . get_the_date() . '</span>';
								?>
								<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>" class="post-link"><span><?php the_title() ?></span></a>
							</div>
						</li>
					<?php } ?>
				</ul>
			</div>

		<?php }
		wp_reset_postdata();
		echo ent2ncr( $after_widget );
	}
}

?>