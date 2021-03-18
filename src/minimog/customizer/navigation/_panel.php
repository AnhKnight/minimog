<?php
$panel    = 'navigation';
$priority = 1;

Minimog_Kirki::add_section( 'navigation', array(
	'title'    => esc_html__( 'Desktop Menu', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Minimog_Kirki::add_section( 'navigation_minimal_01', array(
	'title'    => esc_html__( 'Off Canvas Menu', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Minimog_Kirki::add_section( 'navigation_mobile', array(
	'title'    => esc_html__( 'Mobile Menu', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
