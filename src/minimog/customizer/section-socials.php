<?php
$section  = 'socials';
$priority = 1;
$prefix   = 'social_';

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'social_link_target',
	'label'    => esc_html__( 'Open link in a new tab.', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'minimog' ),
		'1' => esc_html__( 'Yes', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'         => 'repeater',
	'settings'     => 'social_link',
	'section'      => $section,
	'priority'     => $priority++,
	'button_label' => esc_html__( 'Add new social network', 'minimog' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'tooltip',
	),
	'default'      => array(
		array(
			'tooltip'    => esc_html__( 'Twitter', 'minimog' ),
			'icon_class' => 'fab fa-twitter',
			'link_url'   => 'https://twitter.com',
		),
		array(
			'tooltip'    => esc_html__( 'Facebook', 'minimog' ),
			'icon_class' => 'fab fa-facebook-f',
			'link_url'   => 'https://facebook.com',
		),
		array(
			'tooltip'    => esc_html__( 'Instagram', 'minimog' ),
			'icon_class' => 'fab fa-instagram',
			'link_url'   => 'https://instagram.com',
		),
		array(
			'tooltip'    => esc_html__( 'Linkedin', 'minimog' ),
			'icon_class' => 'fab fa-linkedin',
			'link_url'   => 'https://linkedin.com',
		),
	),
	'fields'       => array(
		'tooltip'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Tooltip', 'minimog' ),
			'description' => esc_html__( 'Enter your hint text for your icon', 'minimog' ),
			'default'     => '',
		),
		'icon_class' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Icon Class', 'minimog' ),
			'description' => esc_html__( 'This will be the icon class for your link', 'minimog' ),
			'default'     => '',
		),
		'link_url'   => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Link URL', 'minimog' ),
			'description' => esc_html__( 'This will be the link URL', 'minimog' ),
			'default'     => '',
		),
	),
) );
