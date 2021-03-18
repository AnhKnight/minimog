<?php
$colored_bg = Minimog_Portfolio::instance()->get_the_post_meta( 'portfolio_overlay_colored_faded_background' );
$style      = '';

$overlay_content_extra_class = '';
if ( ! empty( $colored_bg ) ) {
	$colored_text_skin = Minimog_Portfolio::instance()->get_the_post_meta( 'portfolio_overlay_colored_faded_text_skin' );

	$style                       = 'style="background: ' . $colored_bg . ';"';
	$overlay_content_extra_class .= ' overlay-content-skin-' . $colored_text_skin;
}
?>

<div class="post-overlay" <?php echo '' . $style; ?>></div>
<div class="post-overlay-content<?php echo esc_attr( $overlay_content_extra_class ); ?>">
	<div class="post-overlay-content-inner">
		<div class="post-overlay-info">
			<?php
			Minimog_Portfolio::instance()->the_categories_no_link( array(
				'classes' => 'portfolio-overlay-categories',
			) );
			?>

			<h3 class="portfolio-overlay-title"><?php the_title(); ?></h3>
		</div>
	</div>
</div>
