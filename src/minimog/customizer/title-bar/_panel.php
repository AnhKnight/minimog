<?php
$panel    = 'title_bar';
$priority = 1;

Minimog_Kirki::add_section( 'title_bar', array(
	'title'    => esc_html__( 'General', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
