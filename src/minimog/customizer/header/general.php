<?php
$section  = 'header';
$priority = 1;
$prefix   = 'header_';

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'global_header',
	'label'       => esc_html__( 'Global Header Style', 'minimog' ),
	'description' => esc_html__( 'Select default header style for your site.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '01',
	'choices'     => Minimog_Header::instance()->get_list(),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'global_header_overlay',
	'label'    => esc_html__( 'Global Header Overlay', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'No', 'minimog' ),
		'1' => esc_html__( 'Yes', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'global_header_skin',
	'label'    => esc_html__( 'Header Skin', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'dark',
	'choices'  => array(
		'dark'  => esc_html__( 'Dark', 'minimog' ),
		'light' => esc_html__( 'Light', 'minimog' ),
	),
) );
