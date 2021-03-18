<?php
/**
 * Template part for displaying search product content
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimog
 * @since   1.0
 */

$products_output = '';
$rest_output     = '';

if ( have_posts() ) : ?>
	<?php
	while ( have_posts() ) {
		the_post();

		$post_type = get_post_type();

		ob_start();

		if ( 'product' === $post_type ) {
			get_template_part( 'template-parts/content-search-product' );

			$products_output .= ob_get_clean();
		} else {
			get_template_part( 'template-parts/content-search-rest' );

			$rest_output .= ob_get_clean();
		}
	}
	?>

	<?php if ( ! empty( $products_output ) ): ?>
		<div class="search-results-section product-search-results">
			<h2 class="search-results-heading"><?php esc_html_e( 'We found some products for you.', 'minimog' ); ?></h2>
			<?php
			$classes = [
				'minimog-main-post',
				'minimog-grid-wrapper',
				'minimog-product',
				'style-grid-01',
			];

			$grid_class = 'minimog-grid';
			$lg_columns = intval( Minimog::setting( 'shop_archive_lg_columns' ) );
			$md_columns = Minimog::setting( 'shop_archive_md_columns' );
			$sm_columns = Minimog::setting( 'shop_archive_sm_columns' );

			if ( 'none' === Minimog_Global::instance()->get_sidebar_status() ) {
				$lg_columns++;
			}

			$grid_class .= " grid-lg-{$lg_columns}";
			$grid_class .= " grid-md-{$md_columns}";
			$grid_class .= " grid-sm-{$sm_columns}";

			$grid_options = [
				'type'          => 'grid',
				'columns'       => $lg_columns,
				'columnsTablet' => $md_columns,
				'columnsMobile' => $sm_columns,
				'gutter'        => 30,
			];
			?>
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
			     data-grid="<?php echo esc_attr( wp_json_encode( $grid_options ) ); ?>"
			>
				<div class="<?php echo esc_attr( $grid_class ); ?>">
					<div class="grid-sizer"></div>

					<?php echo $products_output; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $rest_output ) ) : ?>
		<div class="search-results-section all-search-results">
			<h2 class="search-results-heading"><?php esc_html_e( 'We found other results for you.', 'minimog' ); ?></h2>

			<?php
			$style   = 'grid-wide';
			$classes = [
				'minimog-main-post',
				'minimog-grid-wrapper',
				'minimog-blog',
				'minimog-animation-zoom-in',
				"minimog-blog-" . $style,
				'minimog-blog-overlay-style-float-02',
			];

			$lg_columns = $md_columns = $sm_columns = 1;

			// Handle Columns
			switch ( $style ) {
				case 'grid':
					$lg_columns = 3;
					$md_columns = 2;
					$sm_columns = 1;
					break;
				case 'grid-wide' :
					$lg_columns = 4;
					$md_columns = 2;
					$sm_columns = 1;
					break;
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
			?>
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
			     data-grid="<?php echo esc_attr( wp_json_encode( $grid_options ) ); ?>"
			>
				<div class="minimog-grid">
					<?php if ( in_array( $style, array( 'grid', 'grid-02', 'grid-wide' ) ) ) : ?>
						<div class="grid-sizer"></div>
					<?php endif; ?>

					<?php echo $rest_output; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="minimog-grid-pagination">
		<?php Minimog_Templates::paging_nav(); ?>
	</div>
<?php else : get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>
