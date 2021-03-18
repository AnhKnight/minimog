<?php
/**
 * Template part for displaying search result loop item for all other content post types.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimog
 * @since   1.0
 */

$classes = array( 'grid-item', 'post-item' );
?>
<div <?php post_class( implode( ' ', $classes ) ); ?>>
	<div class="post-wrapper minimog-box">

		<?php if ( has_post_thumbnail() ) { ?>
			<div class="post-feature post-thumbnail minimog-image">
				<a href="<?php the_permalink(); ?>">
					<?php Minimog_Image::the_post_thumbnail( array( 'size' => '480x285' ) ); ?>
				</a>

				<?php Minimog_Post::instance()->the_categories( array(
					'classes'   => 'post-overlay-categories',
					'separator' => ' ',
				) ); ?>

			</div>
		<?php } ?>

		<div class="post-caption">
			<div class="post-meta">
				<div class="inner">
					<?php Minimog_Post::instance()->meta_date_template(); ?>
					<?php Minimog_Post::instance()->meta_view_count_template(); ?>
				</div>
			</div>

			<?php $post_title = get_the_title(); ?>
			<?php if ( empty( $post_title ) ) : ?>
				<div class="post-excerpt">
					<a href="<?php the_permalink(); ?>">
						<?php Minimog_Templates::excerpt( array(
							'limit' => 24,
							'type'  => 'word',
						) ); ?>
					</a>
				</div>
			<?php else: ?>
				<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
			<?php endif; ?>

			<?php
			$read_more_text = esc_html__( 'Read more', 'minimog' );

			Minimog_Templates::render_button( [
				'style'         => 'text',
				'text'          => $read_more_text,
				'icon'          => 'far fa-long-arrow-right',
				'icon_align'    => 'right',
				'link'          => [
					'url' => get_the_permalink(),
				],
				'size'          => 'nm',
				'wrapper_class' => 'post-read-more',
			] );
			?>
		</div>

	</div>
</div>
