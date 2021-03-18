<?php
/**
 * Template part for displaying blog content in home.php, archive.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimog
 * @since   1.0
 */
$style   = Minimog::setting( 'blog_archive_style', 'grid' );
$blog_style   = Minimog::setting( 'blog_archive_post_style', 'none' );
$classes = [
	'minimog-main-post',
	'minimog-grid-wrapper',
	'minimog-blog',
	'minimog-animation-zoom-in',
	"minimog-blog-" . $style,
	'minimog-blog-overlay-style-float-02',
];

$lg_columns = $md_columns = $sm_columns = 1;

$sidebar_status = Minimog_Global::instance()->get_sidebar_status();

// Handle Columns
switch ( $style ) {
	case 'grid':
		$lg_columns = 3;
		$md_columns = 3;
		$sm_columns = 1;
		break;
	case 'grid-wide' :
		$lg_columns = 4;
		$md_columns = 3;
		$sm_columns = 1;
		break;
}

if ( 'both' == $sidebar_status) {
	$lg_columns--;
}

$grid_options = [
	'type'          => ( '1' === Minimog::setting( 'blog_archive_masonry' ) ) ? 'masonry' : 'grid',
	'columns'       => $lg_columns,
	'columnsTablet' => $md_columns,
	'columnsMobile' => $sm_columns,
	'gutter'        => 30,
];

$caption_style = Minimog::setting( 'blog_archive_caption_style' );
$classes[]     = 'minimog-blog-caption-style-' . $caption_style;

if ( have_posts() ) : ?>
	<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
	     data-grid="<?php echo esc_attr( wp_json_encode( $grid_options ) ); ?>"
	>
		<div class="minimog-grid">
			<?php if ( in_array( $style, array( 'grid', 'grid-02', 'grid-wide' ) ) ) : ?>
				<div class="grid-sizer"></div>
			<?php endif; ?>

			<?php while ( have_posts() ) : the_post();
				$classes = array( 'grid-item', 'post-item' );
				set_query_var('classes',$classes);
				?>
				<?php get_template_part('template-parts/blog/blog-layout',$blog_style); ?>
				<?php wp_reset_query(); ?>
			<?php endwhile; ?>


		</div>

		<div class="minimog-grid-pagination">
			<?php Minimog_Templates::paging_nav(); ?>
		</div>
	</div>

<?php else : get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>
