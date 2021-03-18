<?php
/**
 * The template for displaying archive pages.
 *
 * @link     https://codex.wordpress.org/Template_Hierarchy
 *
 * @package  Minimog
 * @since    1.0
 */
get_header();

?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Minimog_Templates::render_sidebar( 'left' ); ?>

				<div class="page-main-content">

					<?php
					if ( ! function_exists( 'elementor_location_exits' ) || ! elementor_location_exits( 'archive', true ) ) {

						if ( 'portfolio' === get_post_type() ) {
							get_template_part( 'template-parts/content', 'portfolio' );
						} else {
							get_template_part( 'template-parts/content', 'blog' );
						}

					} else {
						if ( function_exists( 'elementor_theme_do_location' ) ) :
							elementor_theme_do_location( 'archive' );
						endif;
					}
					?>

				</div>

				<?php Minimog_Templates::render_sidebar( 'right' ); ?>

			</div>
		</div>
	</div>
<?php get_footer();
