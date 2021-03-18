<?php
$panel    = 'search';
$priority = 1;

Minimog_Kirki::add_section( 'search_page', array(
	'title'    => esc_html__( 'Search Page', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Minimog_Kirki::add_section( 'search_popup', array(
	'title'    => esc_html__( 'Search Popup', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
