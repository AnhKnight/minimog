<div class="post-caption">

	<?php if ( 'yes' === $settings['show_caption_category'] ) : ?>
		<?php Minimog_Post::instance()->the_category(); ?>
	<?php endif; ?>

	<h3 class="post-title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h3>


	<?php if ( ! empty( $settings['show_caption_meta'] ) ) : ?>
		<?php $meta = $settings['show_caption_meta']; ?>
		<div class="post-meta">
			<div class="inner">
				<?php if ( in_array( 'author', $meta, true ) ): ?>
					<?php Minimog_Post::instance()->meta_author_template(); ?>
				<?php endif; ?>

				<?php if ( in_array( 'date', $meta, true ) ): ?>
					<?php Minimog_Post::instance()->meta_date_template(); ?>
				<?php endif; ?>

				<?php if ( in_array( 'views', $meta, true ) ): ?>
					<?php Minimog_Post::instance()->meta_view_count_template(); ?>
				<?php endif; ?>

				<?php if ( in_array( 'comments', $meta, true ) ): ?>
					<?php Minimog_Post::instance()->meta_comment_count_template(); ?>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( 'yes' === $settings['show_caption_excerpt'] ) : ?>
		<?php
		if ( empty( $settings['excerpt_length'] ) ) {
			$settings['excerpt_length'] = 10;
		}
		?>
		<div class="post-excerpt">
			<?php Minimog_Templates::excerpt( array(
				'limit' => $settings['excerpt_length'],
				'type'  => 'word',
			) ); ?>
		</div>
	<?php endif; ?>

	<?php if ( 'yes' === $settings['show_caption_read_more'] || 'yes' === $settings['show_caption_share'] ): ?>
		<div class="post-footer">
			<?php if ( 'yes' === $settings['show_caption_read_more'] ): ?>
				<?php
				$read_more_text = ! empty( $settings['read_more_text'] ) ? $settings['read_more_text'] : esc_html__( 'Read more', 'minimog' );

				Minimog_Templates::render_button( [
					'text'          => $read_more_text,
					'link'          => [
						'url' => get_the_permalink(),
					],
					'size'          => 'lg',
					'wrapper_class' => 'post-read-more',
				] );
				?>
			<?php endif; ?>

			<?php if ( 'yes' === $settings['show_caption_share'] ): ?>
				<?php Minimog_Post::instance()->loop_share(); ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>

</div>
