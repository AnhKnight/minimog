<?php
/**
 * Template part for displaying blog content in home.php, archive.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimog
 * @since   1.0
 */
$wrapper_classes = [
	'minimog-main-post',
	'minimog-grid-wrapper',
	'tm-portfolio',
	'minimog-animation-zoom-in',
	'portfolio-overlay-group-01',
	'portfolio-overlay-faded',
	'style-grid',
];

$grid_options = [
	'type'          => 'masonry',
	'columns'       => 3,
	'columnsTablet' => 2,
	'columnsMobile' => 1,
	'gutter'        => 30,
];

if ( have_posts() ) : ?>

	<div class="<?php echo esc_attr( implode( ' ', $wrapper_classes ) ); ?>"
	     data-grid="<?php echo esc_attr( wp_json_encode( $grid_options ) ); ?>"
	>
		<div class="minimog-grid">
			<div class="grid-sizer"></div>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				$classes = array( 'portfolio-item grid-item' );
				?>

				<div <?php post_class( implode( ' ', $classes ) ); ?>>
					<div class="post-wrapper minimog-box">
						<div class="post-thumbnail-wrapper minimog-image">
							<a href="<?php Minimog_Portfolio::instance()->the_permalink(); ?>"
							   class="post-permalink link-secret">
								<div class="post-thumbnail">
									<?php if ( has_post_thumbnail() ) { ?>
										<?php Minimog_Image::the_post_thumbnail( array( 'size' => '480x480' ) ); ?>
									<?php } else { ?>
										<?php Minimog_Templates::image_placeholder( 480, 480 ); ?>
									<?php } ?>
								</div>

								<div class="post-overlay"></div>
								<div class="post-overlay-content">
									<div class="post-overlay-content-inner">
										<div class="post-overlay-info">
											<h3 class="portfolio-overlay-title"><?php the_title(); ?></h3>

											<?php
											Minimog_Portfolio::instance()->the_categories_no_link( array(
												'classes' => 'portfolio-overlay-categories',
											) );
											?>
										</div>
									</div>
								</div>

							</a>
						</div>
					</div>
				</div>

			<?php endwhile; ?>
		</div>

		<div class="minimog-grid-pagination">
			<?php Minimog_Templates::paging_nav(); ?>
		</div>

	</div>

<?php else :
	get_template_part( 'template-parts/content', 'none' );
endif; ?>
