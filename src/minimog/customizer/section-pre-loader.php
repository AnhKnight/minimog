<?php
$section  = 'pre_loader';
$priority = 1;
$prefix   = 'pre_loader_';

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'enable',
	'label'    => esc_html__( 'Enable Preloader', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'No', 'minimog' ),
		'1' => esc_html__( 'Yes', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => $prefix . 'style',
	'label'    => esc_html__( 'Style', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'circle',
	'choices'  => Minimog_Helper::get_preloader_list(),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'color-alpha',
	'settings'  => $prefix . 'background_color',
	'label'     => esc_html__( 'Background Color', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => '#fff',
	'output'    => array(
		array(
			'element'  => '.page-loading',
			'property' => 'background-color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'color-alpha',
	'settings'        => $prefix . 'shape_color',
	'label'           => esc_html__( 'Shape Color', 'minimog' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'default'         => Minimog::PRIMARY_COLOR,
	'output'          => array(
		array(
			'element'  => '.page-loading .sk-wrap',
			'property' => 'color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'pre_loader_style',
			'operator' => '!=',
			'value'    => 'gif-image',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'image',
	'settings'        => 'pre_loader_image',
	'label'           => esc_html__( 'Gif Image', 'minimog' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => MINIMOG_THEME_IMAGE_URI . '/main-preloader.gif',
	'active_callback' => array(
		array(
			'setting'  => 'pre_loader_style',
			'operator' => '==',
			'value'    => 'gif-image',
		),
	),
) );
