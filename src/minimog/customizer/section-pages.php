<?php
$section  = 'pages';
$priority = 1;
$prefix   = 'pages_';

$sidebar_positions   = Minimog_Helper::get_list_sidebar_positions();
$registered_sidebars = Minimog_Helper::get_registered_sidebars();

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Header', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_header_type',
	'label'       => esc_html__( 'Header Style', 'minimog' ),
	'description' => esc_html__( 'Select default header style that displays on all single pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => Minimog_Header::instance()->get_list( true, esc_html__( 'Use Global Header Style', 'minimog' ) ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'page_header_overlay',
	'label'    => esc_html__( 'Header Overlay', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '',
	'choices'  => array(
		''  => esc_html__( 'Use Global', 'minimog' ),
		'0' => esc_html__( 'No', 'minimog' ),
		'1' => esc_html__( 'Yes', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'page_header_skin',
	'label'    => esc_html__( 'Header Skin', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '',
	'choices'  => array(
		''      => esc_html__( 'Use Global', 'minimog' ),
		'dark'  => esc_html__( 'Dark', 'minimog' ),
		'light' => esc_html__( 'Light', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Page Title Bar', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_title_bar_layout',
	'label'       => esc_html__( 'Title Bar Style', 'minimog' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all single pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'choices'     => Minimog_Title_Bar::instance()->get_list( true, esc_html__( 'Use Global Title Bar', 'minimog' ) ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Sidebar', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'minimog' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on all pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'minimog' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on all pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );
