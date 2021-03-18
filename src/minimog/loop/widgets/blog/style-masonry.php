<?php
$banners = [];
if ( ! empty( $settings['banners'] ) ) {
	foreach ( $settings['banners'] as $banner ) {
		if ( empty( $banner['template_id'] ) ) {
			continue;
		}

		$banners[ $banner['position'] ] [] = $banner['template_id'];
	}
}

$loop_count = 1;

while ( $minimog_query->have_posts() ) :
	$minimog_query->the_post();
	$classes = array( 'grid-item', 'post-item' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-wrapper minimog-box">

			<?php if ( has_post_thumbnail() ) { ?>
				<div class="post-feature post-thumbnail minimog-image">
					<a href="<?php the_permalink(); ?>">
						<?php
						$size = Minimog_Image::elementor_parse_image_size( $settings, '480x9999' );
						Minimog_Image::the_post_thumbnail( array( 'size' => $size ) );
						?>
					</a>

					<?php if ( 'yes' === $settings['show_overlay'] ) : ?>
						<?php get_template_part( 'loop/blog/overlay', $settings['overlay_style'] ); ?>
					<?php endif; ?>
				</div>
			<?php } ?>

			<?php if ( 'yes' === $settings['show_caption'] ) : ?>
				<?php get_template_part( 'loop/blog/caption', $settings['caption_style'] ); ?>
			<?php endif; ?>
		</div>
	</div>

	<?php
	if ( isset( $banners[ $loop_count ] ) ) {
		foreach ( $banners[ $loop_count ] as $template_id ) {
			if ( 'publish' !== get_post_status( $template_id ) ) {
				continue;
			}
			?>
			<div class="grid-item" data-width="2">
				<?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template_id ); ?>
			</div>
			<?php
		}
	}
	?>

	<?php $loop_count++; ?>
<?php endwhile;
