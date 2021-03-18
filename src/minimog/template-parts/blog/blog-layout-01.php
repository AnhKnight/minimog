<?php
/**
 * The template for displaying all blog post style
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Minimog
 * @since   1.0
 */
$classes = get_query_var('classes');
?>
<div <?php post_class( implode( ' ', $classes ) ); ?>>
	<div class="post-wrapper minimog-box">

		<?php if ( has_post_thumbnail() ) { ?>
			<div class="post-feature post-thumbnail minimog-image">
				<a href="<?php the_permalink(); ?>">
					<?php Minimog_Image::the_post_thumbnail( array( 'size' => '533x700' ) ); ?>
				</a>
			</div>
		<?php } ?>

		<div class="post-caption">
			<?php Minimog_Post::instance()->the_categories( array(
					'classes'   => 'post-overlay-categories',
					'separator' => ' ',
			) ); ?>
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
		</div>

	</div>
</div>
