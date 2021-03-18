<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Minimog
 * @since   1.0
 */
?>
<div id="page-content" class="page-content">
	<div class="container">
		<div class="row">

			<?php Minimog_Templates::render_sidebar( 'left' ); ?>

			<div class="page-main-content">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content-rich-snippet' ); ?>

					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>

			<?php Minimog_Templates::render_sidebar( 'right' ); ?>

		</div>
	</div>
</div>
