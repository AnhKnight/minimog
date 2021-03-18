<?php
$panel    = 'portfolio';
$priority = 1;

Minimog_Kirki::add_section( 'archive_portfolio', array(
	'title'    => esc_html__( 'Archive', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'single_portfolio', array(
	'title'    => esc_html__( 'Single', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
