<?php
/**
 * The template for displaying all single portfolio posts.
 *
 * @package Minimog
 * @since   1.0
 */
get_header();
?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Minimog_Templates::render_sidebar( 'left' ); ?>

				<div class="page-main-content">
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<h2 class="screen-reader-text"><?php echo esc_html( get_the_title() ); ?></h2>

							<?php the_content(); ?>
						</article>

						<?php if ( Minimog::setting( 'single_portfolio_related_enable' ) === '1' ) : ?>
							<?php get_template_part( 'template-parts/portfolio/related' ); ?>
						<?php endif; ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( Minimog::setting( 'single_portfolio_comment_enable' ) === '1' && ( comments_open() || get_comments_number() ) ) :
							comments_template();
						endif;
						?>
					<?php endwhile; ?>
				</div>

				<?php Minimog_Templates::render_sidebar( 'right' ); ?>

			</div>
		</div>

		<?php Minimog_Portfolio::instance()->entry_navigation_links(); ?>
	</div>
<?php
get_footer();
