<?php
$section  = 'advanced';
$priority = 1;
$prefix   = 'advanced_';

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'smooth_scroll_enable',
	'label'       => esc_html__( 'Smooth Scroll', 'minimog' ),
	'description' => esc_html__( 'Smooth scrolling experience for websites.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 0,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'scroll_top_enable',
	'label'       => esc_html__( 'Go To Top Button', 'minimog' ),
	'description' => esc_html__( 'Turn on to show go to top button.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'retina_display_enable',
	'label'       => esc_html__( 'Retina Display?', 'minimog' ),
	'description' => esc_html__( 'Turn on to make images retina on high screen revolution.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 0,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'google_api_key',
	'label'       => esc_html__( 'Google Api Key', 'minimog' ),
	'description' => sprintf( wp_kses( __( 'Follow <a href="%s" target="_blank">this link</a> and click <strong>GET A KEY</strong> button.', 'minimog' ), array(
		'a'      => array(
			'href'   => array(),
			'target' => array(),
		),
		'strong' => array(),
	) ), esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ) ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'AIzaSyCWKTDAs65xUb7bZnFGCVxxIxuJDw4XOwo',
	'transport'   => 'postMessage',
) );
