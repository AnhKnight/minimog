<?php
$footer = Minimog_Global::instance()->get_footer();

if ( 'none' === $footer ) {
	return;
}
?>
<div id="page-footer-wrapper" class="page-footer-wrapper">
	<?php
	if ( ! function_exists( 'elementor_location_exits' ) || ! elementor_location_exits( 'footer', true ) ) {
		get_template_part( 'template-parts/footer/simple' );
	} else {
		if ( function_exists( 'elementor_theme_do_location' ) ) :
			get_template_part( 'template-parts/footer/elementor' );
		endif;
	}
	?>
</div>
