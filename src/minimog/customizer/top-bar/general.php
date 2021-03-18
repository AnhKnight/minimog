<?php
$section  = 'top_bar';
$priority = 1;
$prefix   = 'top_bar_';

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'global_top_bar',
	'label'    => esc_html__( 'Default Top Bar', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '01',
	'choices'  => Minimog_Top_Bar::instance()->get_list(),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'top_bar_hide_on_mobile',
	'label'    => esc_html__( 'Hide On Mobile', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'minimog' ),
		'1' => esc_html__( 'Yes', 'minimog' ),
	),
) );
