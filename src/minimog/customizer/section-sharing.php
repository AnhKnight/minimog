<?php
$section  = 'social_sharing';
$priority = 1;
$prefix   = 'social_sharing_';

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'multicheck',
	'settings'    => $prefix . 'item_enable',
	'label'       => esc_attr__( 'Sharing Links', 'minimog' ),
	'description' => esc_html__( 'Check to the box to enable social share links.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array( 'facebook', 'twitter', 'linkedin', 'tumblr', 'email' ),
	'choices'     => array(
		'facebook' => esc_attr__( 'Facebook', 'minimog' ),
		'twitter'  => esc_attr__( 'Twitter', 'minimog' ),
		'linkedin' => esc_attr__( 'Linkedin', 'minimog' ),
		'tumblr'   => esc_attr__( 'Tumblr', 'minimog' ),
		'email'    => esc_attr__( 'Email', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'sortable',
	'settings'    => $prefix . 'order',
	'label'       => esc_attr__( 'Order', 'minimog' ),
	'description' => esc_html__( 'Controls the order of social share links.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'facebook',
		'twitter',
		'linkedin',
		'tumblr',
		'email',
	),
	'choices'     => array(
		'facebook' => esc_attr__( 'Facebook', 'minimog' ),
		'twitter'  => esc_attr__( 'Twitter', 'minimog' ),
		'linkedin' => esc_attr__( 'Linkedin', 'minimog' ),
		'tumblr'   => esc_attr__( 'Tumblr', 'minimog' ),
		'email'    => esc_attr__( 'Email', 'minimog' ),
	),
) );
