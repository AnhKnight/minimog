<?php
$number_post = Minimog::setting( 'single_post_related_number' );
$results     = Minimog_Post::instance()->get_related_posts( array(
	'post_id'      => get_the_ID(),
	'number_posts' => $number_post,
) );

if ( $results !== false && $results->have_posts() ) : ?>
	<div
		class="related-posts minimog-blog minimog-animation-zoom-in minimog-blog-caption-style-01">
		<h3 class="related-title">
			<?php esc_html_e( 'Related Articles', 'minimog' ); ?>
		</h3>
		<div class="swiper-container">
			<div class="row">
				<?php while ( $results->have_posts() ) : $results->the_post(); ?>
					<div class="col-lg-4">
						<div <?php post_class( 'related-post-item' ); ?>>

							<div class="post-wrapper minimog-box">

								<?php if ( has_post_thumbnail() ) { ?>
									<div class="post-feature post-thumbnail minimog-image">
										<a href="<?php the_permalink(); ?>">
											<?php Minimog_Image::the_post_thumbnail( array( 'size' => '480x325' ) ); ?>
										</a>
									</div>
								<?php } ?>

								<div class="post-caption">
									<div class="post-categories">
										<?php Minimog_Post::instance()->entry_categories() ?>
									</div>
									<h3 class="post-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
								</div>

							</div>

						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
<?php endif;
wp_reset_postdata();
