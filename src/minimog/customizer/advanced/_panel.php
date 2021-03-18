<?php
$panel    = 'advanced';
$priority = 1;

Minimog_Kirki::add_section( 'advanced', array(
	'title'    => esc_html__( 'Advanced', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Minimog_Kirki::add_section( 'light_gallery', array(
	'title'    => esc_html__( 'Light Gallery', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
