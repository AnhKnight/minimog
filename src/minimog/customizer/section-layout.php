<?php
$section  = 'layout';
$priority = 1;
$prefix   = 'site_';

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'layout',
	'label'       => esc_html__( 'Layout', 'minimog' ),
	'description' => esc_html__( 'Controls the site layout.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'wide',
	'choices'     => array(
		'boxed' => esc_html__( 'Boxed', 'minimog' ),
		'wide'  => esc_html__( 'Wide', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'width',
	'label'       => esc_html__( 'Site Width', 'minimog' ),
	'description' => esc_html__( 'Controls the overall site width. Enter value including any valid CSS unit. For e.g: 1200px.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1200px',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Boxed Mode Background', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => 'site_background_body',
	'label'       => esc_html__( 'Background', 'minimog' ),
	'description' => esc_html__( 'Controls outer background area in boxed mode.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#ffffff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'fixed',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => 'body',
		),
	),
) );
