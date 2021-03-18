<?php
$section  = 'top_bar_style_02';
$priority = 1;
$prefix   = 'top_bar_style_02_';

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'multicheck',
	'settings' => $prefix . 'left_components',
	'label'    => esc_html__( 'Left Components', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => [ 'info_list' ],
	'choices'  => Minimog_Top_Bar::instance()->get_support_components(),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'multicheck',
	'settings' => $prefix . 'center_components',
	'label'    => esc_html__( 'Center Components', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => [ 'text' ],
	'choices'  => Minimog_Top_Bar::instance()->get_support_components(),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'multicheck',
	'settings' => $prefix . 'right_components',
	'label'    => esc_html__( 'Right Components', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => [ 'language_switcher', 'user_link' ],
	'choices'  => Minimog_Top_Bar::instance()->get_support_components(),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'textarea',
	'settings' => $prefix . 'text',
	'label'    => esc_html__( 'Text', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'         => 'repeater',
	'settings'     => $prefix . 'info_list',
	'label'        => esc_html__( 'Info List', 'minimog' ),
	'section'      => $section,
	'priority'     => $priority++,
	'button_label' => esc_html__( 'Add new info', 'minimog' ),
	'row_label'    => array(
		'type'  => 'field',
		'field' => 'text',
	),
	'fields'       => array(
		'text'       => array(
			'type'    => 'textarea',
			'label'   => esc_html__( 'Title', 'minimog' ),
			'default' => '',
		),
		'url'        => array(
			'type'    => 'text',
			'label'   => esc_html__( 'Link', 'minimog' ),
			'default' => '',
		),
		'icon_class' => array(
			'type'    => 'text',
			'label'   => esc_html__( 'Icon Class', 'minimog' ),
			'default' => '',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding top', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.top-bar-02',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.top-bar-02',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_color',
	'label'       => esc_html__( 'Background', 'minimog' ),
	'description' => esc_html__( 'Controls the background color of top bar.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.top-bar-02',
			'property' => 'background-color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'border_width',
	'label'     => esc_html__( 'Border Bottom Width', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.top-bar-02',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Bottom Color', 'minimog' ),
	'description' => esc_html__( 'Controls the border bottom color of top bar.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#eee',
	'output'      => array(
		array(
			'element'  => '.top-bar-02',
			'property' => 'border-bottom-color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'text_typography',
	'label'       => esc_html__( 'Text Typography', 'minimog' ),
	'description' => esc_html__( 'These settings control the typography of text', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '400',
		'line-height'    => '1.78',
		'letter-spacing' => '',
		'font-size'      => '14px',
	),
	'output'      => array(
		array(
			'element' => '.top-bar-02',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'text_color',
	'label'       => esc_html__( 'Text', 'minimog' ),
	'description' => esc_html__( 'Controls the color of text on top bar.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#696969',
	'output'      => array(
		array(
			'element'  => '.top-bar-02',
			'property' => 'color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'link_typography',
	'label'       => esc_html__( 'Link Typography', 'minimog' ),
	'description' => esc_html__( 'These settings control the typography of link', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '500',
		'line-height'    => '1.78',
		'letter-spacing' => '',
		'font-size'      => '14px',
	),
	'output'      => array(
		array(
			'element' => '.top-bar-02 a',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'minimog' ),
	'description' => esc_html__( 'Controls the color of links on top bar.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'normal' => esc_attr__( 'Normal', 'minimog' ),
		'hover'  => esc_attr__( 'Hover', 'minimog' ),
	),
	'default'     => array(
		'normal' => Minimog::TEXT_LIGHTEN_COLOR,
		'hover'  => Minimog::HEADING_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '.top-bar-02 a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.top-bar-02 a:hover, .top-bar-02 a:focus',
			'property' => 'color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'tag_color',
	'label'       => esc_html__( 'Tag Color', 'minimog' ),
	'description' => esc_html__( 'Controls the color of text tags.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'normal' => esc_attr__( 'Normal', 'minimog' ),
		'hover'  => esc_attr__( 'Hover', 'minimog' ),
	),
	'default'     => array(
		'normal' => '#fff',
		'hover'  => '#fff',
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '.top-bar-02 .top-bar-tag',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.top-bar-02 .top-bar-tag:hover',
			'property' => 'color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'tag_bg_color',
	'label'       => esc_html__( 'Tag Background Color', 'minimog' ),
	'description' => esc_html__( 'Controls the background color of text tags.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'normal' => esc_attr__( 'Normal', 'minimog' ),
		'hover'  => esc_attr__( 'Hover', 'minimog' ),
	),
	'default'     => array(
		'normal' => '#3751EE',
		'hover'  => Minimog::SECONDARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '.top-bar-02 .top-bar-tag',
			'property' => 'background-color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.top-bar-02 .top-bar-tag:hover',
			'property' => 'background-color',
		),
	),
) );

