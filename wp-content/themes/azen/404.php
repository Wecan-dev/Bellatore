<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package azen
 */

get_header();

$bg_404 = azen_get_option( 'phys_404_bg_image' );
$style  = $bg_404 ? ' style="background-image:url(' . esc_url( $bg_404['url'] ) . ')"' : '';

echo '<section class="page-not-found" ' . $style . '><div class="page-detail">
			<div class="page-inner">
				<h2 class="special-heading title">' . esc_html__( '# 404 PAGE', 'azen' ) . '</h2>
				<p>' . esc_html__( 'Oops ! Page you are looking for does not exist.', 'azen' ) . '</p>';
echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="au-btn-white btn-small">' . esc_html__( 'Back to Home', 'azen' ) . '</a></div>
		</div>
	</section>';
?>

</div><!-- #content -->
</div><!--end wrapper-container-->
<?php
wp_footer();
?>
</body>
</html>