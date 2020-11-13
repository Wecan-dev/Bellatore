<?php

class Physc_Social_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget-socials',
			'description' => esc_attr__( 'A widget that displays your social icons', 'physc-builder' )
		);
		parent::__construct( 'physc_social_widget', 'Physcode: Social Icons', $widget_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$facebook   = $instance['facebook'];
		$twitter    = $instance['twitter'];
		$googleplus = $instance['googleplus'];
		$instagram  = $instance['instagram'];
		$youtube    = $instance['youtube'];
		$tumblr     = $instance['tumblr'];
		$pinterest  = $instance['pinterest'];

		/* Before widget (defined by themes). */
		echo ent2ncr( $before_widget );
		echo '<div class="widget-social">';

		if ( $facebook ) {
			echo '<a href="' . esc_url( $facebook ) . '" target="_blank">
				<i class="zmdi zmdi-facebook"></i></a>';
		}
		if ( $twitter ) {
			echo '<a href="' . esc_url( $twitter ) . '" target="_blank">
				<i class="zmdi zmdi-twitter"></i></a>';
		}
		if ( $instagram ) {
			echo '<a href="' . esc_url( $instagram ) . '" target="_blank">
				<i class="zmdi zmdi-instagram"></i></a>';
		}
		if ( $pinterest ) {
			echo '<a href="' . esc_url( $pinterest ) . '" target="_blank">
				<i class="zmdi zmdi-pinterest"></i></a>';
		}

		if ( $googleplus ) {
			echo '<a href="' . esc_url( $googleplus ) . '" target="_blank">
				<i class="zmdi zmdi-google-plus"></i></a>';
		}
		if ( $tumblr ) {
			echo '<a href="' . esc_url( $tumblr ) . '" target="_blank">
				<i class="zmdi zmdi-tumblr"></i></a>';
		}
		if ( $youtube ) {
			echo '<a href="' . esc_url( $youtube ) . '" target="_blank">
				<i class="zmdi zmdi-youtube-play"></i></a>';
		}
		echo '</div>';
		/* After widget (defined by themes). */
		echo ent2ncr( $after_widget );
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */

		$instance['facebook']   = strip_tags( $new_instance['facebook'] );
		$instance['twitter']    = strip_tags( $new_instance['twitter'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		$instance['instagram']  = strip_tags( $new_instance['instagram'] );
		$instance['youtube']    = strip_tags( $new_instance['youtube'] );
		$instance['tumblr']     = strip_tags( $new_instance['tumblr'] );
		$instance['pinterest']  = strip_tags( $new_instance['pinterest'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'facebook'   => '',
			'twitter'    => '',
			'instagram'  => '',
			'googleplus' => '',
			'youtube'    => '',
			'pinterest'  => '',
			'tumblr'     => ''

		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_attr_e( 'Facebook Url:', 'physc-builder' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" value="<?php echo esc_attr( $instance['facebook'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_attr_e( 'Twitter Url:', 'physc-builder' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" value="<?php echo esc_attr( $instance['twitter'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_attr_e( 'Instagram Url:', 'physc-builder' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" value="<?php echo esc_attr( $instance['instagram'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_attr_e( 'Pinterest Url:', 'physc-builder' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" value="<?php echo esc_attr( $instance['pinterest'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>"><?php esc_attr_e( 'Google Plus Name:', 'physc-builder' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'googleplus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'googleplus' ) ); ?>" value="<?php echo esc_attr( $instance['googleplus'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>"><?php esc_attr_e( 'Tumblr Url:', 'physc-builder' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'tumblr' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tumblr' ) ); ?>" value="<?php echo esc_attr( $instance['tumblr'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_attr_e( 'Youtube Url:', 'physc-builder' ) ?></label>
			<input type="text" class="widefat" size="3" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" value="<?php echo esc_attr( $instance['youtube'] ); ?>" />
		</p>

		<?php
	}
}

?>