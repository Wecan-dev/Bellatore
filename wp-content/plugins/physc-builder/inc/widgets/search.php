<?php

class Physc_search_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'physc_search',
			'description' => esc_attr__( 'A search form for your site.', 'physc-builder' )
		);
		parent::__construct( 'physc_search_widget', 'Physcode: Search', $widget_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		/* Before widget (defined by themes). */

		echo ent2ncr( $before_widget );

		?>

		<div class="wrapper-search">
			<div class="search-toggler">
				<span class="zmdi zmdi-search"></span>
			</div>
			<div class="search-menu search-overlay search-hidden">
				<div class="closeicon"></div>
				<div class="modal-search-content">
					<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
						<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search Here ...', 'physc-builder' ) ?>" value="" name="s" title="<?php esc_attr_e( 'Search for:', 'physc-builder' ) ?>">
						<button type="submit" class="search-submit"><span class="zmdi zmdi-search"></span></button>
					</form>
				</div>
				<div class="background-overlay"></div>
			</div>
		</div>
		<?php

		/* After widget (defined by themes). */
		echo ent2ncr( $after_widget );
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		return $instance;
	}


	function form( $instance ) {
	}
}

