<?php
$type = Minimog_Global::instance()->get_header_type();

if ( 'none' === $type ) {
	return;
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
	get_template_part( 'template-parts/header/header', $type );
}
