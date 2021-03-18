<?php
$section  = 'title_bar_01';
$priority = 1;
$prefix   = 'title_bar_01_';

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'background_type',
	'label'    => esc_html__( 'Background Type', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'normal',
	'choices'  => array(
		'normal'   => esc_html__( 'Normal', 'minimog' ),
		'gradient' => esc_html__( 'Gradient', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'background',
	'settings'        => $prefix . 'background',
	'label'           => esc_html__( 'Background', 'minimog' ),
	'description'     => esc_html__( 'Controls the background of title bar.', 'minimog' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => array(
		'background-color'      => '',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'          => array(
		array(
			'element' => '.page-title-bar-01 .page-title-bar-bg',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'background_type',
			'operator' => '==',
			'value'    => 'normal',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'background_gradient',
	'label'           => esc_html__( 'Background Gradient', 'minimog' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color_1' => esc_attr__( 'Color 1', 'minimog' ),
		'color_2' => esc_attr__( 'Color 2', 'minimog' ),
	),
	'default'         => array(
		'color_1' => '#fff',
		'color_2' => '#eceefa',
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'background_type',
			'operator' => '==',
			'value'    => 'gradient',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_overlay_color',
	'label'       => esc_html__( 'Background Overlay Color', 'minimog' ),
	'description' => esc_html__( 'Controls the background overlay color of title bar.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(0, 0, 0, 0)',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-bg:before',
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
			'element'  => '.page-title-bar-01 .page-title-bar-inner',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Color', 'minimog' ),
	'description' => esc_html__( 'Controls the border bottom color of the page title bar.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(0, 0, 0, 0)',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-inner',
			'property' => 'border-bottom-color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 85,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-inner',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-01 .page-title-bar-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'margin_bottom',
	'label'     => esc_html__( 'Margin Bottom', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-01',
			'property' => 'margin-bottom',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'heading_typography',
	'label'       => esc_html__( 'Font Family', 'minimog' ),
	'description' => esc_html__( 'Controls the font family for the page title heading.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '500',
		'font-size'      => '40px',
		'line-height'    => '1.2',
		'letter-spacing' => '',
		'text-transform' => '',
		'color'          => Minimog::HEADING_COLOR,
	),
	'output'      => array(
		array(
			'element' => '.page-title-bar-01 .heading',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Breadcrumb', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'breadcrumb_typography',
	'label'       => esc_html__( 'Typography', 'minimog' ),
	'description' => esc_html__( 'Controls the typography for the breadcrumb text.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '400',
		'line-height'    => '1.67',
		'letter-spacing' => '',
		'text-transform' => '',
		'font-size'      => '15px',
	),
	'output'      => array(
		array(
			'element' => '.page-title-bar-01 .insight_core_breadcrumb li, .page-title-bar-01 .insight_core_breadcrumb li a',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_text_color',
	'label'       => esc_html__( 'Text Color', 'minimog' ),
	'description' => esc_html__( 'Controls the color of text on breadcrumb.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Minimog::HEADING_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .insight_core_breadcrumb li',
			'property' => 'color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'breadcrumb_link_color',
	'label'       => esc_html__( 'Link Color', 'minimog' ),
	'description' => esc_html__( 'Controls the color of links on breadcrumb.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'normal' => esc_attr__( 'Normal', 'minimog' ),
		'hover'  => esc_attr__( 'Hover', 'minimog' ),
	),
	'default'     => array(
		'normal' => Minimog::TEXT_LIGHTEN_COLOR,
		'hover'  => Minimog::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '.page-title-bar-01 .insight_core_breadcrumb a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.page-title-bar-01 .insight_core_breadcrumb a:hover',
			'property' => 'color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_separator_color',
	'label'       => esc_html__( 'Separator Color', 'minimog' ),
	'description' => esc_html__( 'Controls the color of separator on breadcrumb.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => Minimog::TEXT_LIGHTEN_COLOR,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-01 .insight_core_breadcrumb li + li:before',
			'property' => 'color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Responsive Options', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Medium Device', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Minimog_Helper::get_md_media_query(),
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Minimog_Helper::get_md_media_query(),
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'md_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 34,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Minimog_Helper::get_md_media_query(),
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Small Device', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Minimog_Helper::get_sm_media_query(),
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Minimog_Helper::get_sm_media_query(),
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'sm_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 28,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Minimog_Helper::get_sm_media_query(),
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Extra Small Device', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => Minimog_Helper::get_xs_media_query(),
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => Minimog_Helper::get_xs_media_query(),
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'xs_heading_font_size',
	'label'     => esc_html__( 'Heading Font Size', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-title-bar-01 .page-title-bar-inner .heading',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => Minimog_Helper::get_xs_media_query(),
		),
	),
) );
