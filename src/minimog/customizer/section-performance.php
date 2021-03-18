<?php
$section  = 'performance';
$priority = 1;
$prefix   = 'performance_';

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'disable_emoji',
	'label'       => esc_html__( 'Disable Emojis', 'minimog' ),
	'description' => esc_html__( 'Remove Wordpress Emojis functionality.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'disable_embeds',
	'label'       => esc_html__( 'Disable Embeds', 'minimog' ),
	'description' => esc_html__( 'Remove Wordpress Embeds functionality.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );
