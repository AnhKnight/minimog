<?php
$section  = 'navigation';
$priority = 1;
$prefix   = 'navigation_';

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu Dropdown', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'dropdown_link_typography',
	'label'       => esc_html__( 'Typography', 'minimog' ),
	'description' => esc_html__( 'Controls the typography for all dropdown menu items.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '400',
		'line-height'    => '1.38',
		'letter-spacing' => '0em',
		'text-transform' => 'none',
	),
	'output'      => array(
		array(
			'element' => '
			.sm-simple .children > li > a,
			.sm-simple .children > li > a .menu-item-title
			',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'dropdown_link_font_size',
	'label'       => esc_html__( 'Font Size', 'minimog' ),
	'description' => esc_html__( 'Controls the font size for dropdown menu items.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 16,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.sm-simple .children > li > a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Styling
--------------------------------------------------------------*/

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_bg_color',
	'label'       => esc_html__( 'Background', 'minimog' ),
	'description' => esc_html__( 'Controls the background color for dropdown menu', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .children',
				'.primary-menu-sub-visual',
			),
			'property' => 'background-color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'dropdown_box_shadow',
	'label'       => esc_html__( 'Box Shadow', 'minimog' ),
	'description' => esc_html__( 'Input valid box-shadow for dropdown menu. For e.g: "0 0 37px rgba(0, 0, 0, .07)"', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0 -3px 23px rgba(0, 0, 0, 0.06)',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .children',
				'.primary-menu-sub-visual',
			),
			'property' => 'box-shadow',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'dropdown_link_color',
	'label'       => esc_html__( 'Link Color', 'minimog' ),
	'description' => esc_html__( 'Controls the color for dropdown menu items.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'normal' => esc_attr__( 'Normal', 'minimog' ),
		'hover'  => esc_attr__( 'Hover', 'minimog' ),
	),
	'default'     => array(
		'normal' => '#777',
		'hover'  => Minimog::HEADING_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '.sm-simple .children > li > a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '
				.sm-simple .children > li:hover > a,
				.sm-simple .children > li:hover > a:after,
				.sm-simple .children > li.current-menu-item > a,
				.sm-simple .children > li.current-menu-ancestor > a
			',
			'property' => 'color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_link_hover_bg_color',
	'label'       => esc_html__( 'Hover Background', 'minimog' ),
	'description' => esc_html__( 'Controls the background color when hover for dropdown menu items.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(255, 255, 255, 0)',
	'output'      => array(
		array(
			'element'  => array(
				'.sm-simple .children > li:hover > a',
				'.sm-simple .children > li.current-menu-item > a',
				'.sm-simple .children > li.current-menu-ancestor > a',
			),
			'property' => 'background-color',
		),
	),
) );
