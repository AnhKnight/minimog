<?php
$section  = 'header_more_options';
$priority = 1;
$prefix   = 'header_more_options_';

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'minimog' ),
	'description' => esc_html__( 'Controls the background of header more options.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#ffffff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.header-more-tools-opened .header-right-inner',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'icon_color',
	'label'       => esc_html__( 'Icon Color', 'minimog' ),
	'description' => esc_html__( 'Controls the color of icons on header.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'normal' => esc_attr__( 'Normal', 'minimog' ),
		'hover'  => esc_attr__( 'Hover', 'minimog' ),
	),
	'default'     => array(
		'normal' => '#333',
		'hover'  => Minimog::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '
			.header-more-tools-opened .header-right-inner .header-icon,
			.header-more-tools-opened .header-right-inner .wpml-ls-item-toggle
			',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-more-tools-opened .header-right-inner .header-icon:hover',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-more-tools-opened .header-right-inner .wpml-ls-slot-shortcode_actions:hover > .js-wpml-ls-item-toggle',
			'property' => 'color',
			'suffix'   => '!important',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'cart_badge_color',
	'label'       => esc_html__( 'Cart Badge Color', 'minimog' ),
	'description' => esc_html__( 'Controls the color of cart badge.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'color'      => esc_attr__( 'Color', 'minimog' ),
		'background' => esc_attr__( 'Background', 'minimog' ),
	),
	'default'     => array(
		'color'      => '#fff',
		'background' => Minimog::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-more-tools-opened .header-right-inner .mini-cart .mini-cart-icon:after',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-more-tools-opened .header-right-inner .mini-cart .mini-cart-icon:after',
			'property' => 'background-color',
			'suffix'   => '!important',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => $prefix . 'social_networks_color',
	'label'     => esc_html__( 'Social Networks Color', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'normal' => esc_attr__( 'Normal', 'minimog' ),
		'hover'  => esc_attr__( 'Hover', 'minimog' ),
	),
	'default'   => array(
		'normal' => '#333',
		'hover'  => Minimog::PRIMARY_COLOR,
	),
	'output'    => array(
		array(
			'choice'   => 'normal',
			'element'  => '.header-more-tools-opened .header-right-inner .header-social-networks a',
			'property' => 'color',
			'suffix'   => '!important',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-more-tools-opened .header-right-inner .header-social-networks a:hover',
			'property' => 'color',
			'suffix'   => '!important',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => $prefix . 'button_style',
	'label'    => esc_html__( 'Button Style', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'thick-border',
	'choices'  => Minimog_Header::instance()->get_button_style(),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'button_color',
	'label'    => esc_html__( 'Button Color', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '',
	'choices'  => array(
		''       => esc_html__( 'Default', 'minimog' ),
		'custom' => esc_html__( 'Custom', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'button_custom_color',
	'label'           => esc_html__( 'Button Color', 'minimog' ),
	'description'     => esc_html__( 'Controls the color of button.', 'minimog' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'minimog' ),
		'background' => esc_attr__( 'Background', 'minimog' ),
		'border'     => esc_attr__( 'Border', 'minimog' ),
	),
	'default'         => array(
		'color'      => Minimog::PRIMARY_COLOR,
		'background' => 'rgba(0, 0, 0, 0)',
		'border'     => Minimog::PRIMARY_COLOR,
	),
	'output'          => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-sticky-button .tm-button',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-sticky-button.tm-button',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-sticky-button.tm-button:before',
			'property' => 'background',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'button_color',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'button_hover_custom_color',
	'label'           => esc_html__( 'Button Hover Color', 'minimog' ),
	'description'     => esc_html__( 'Controls the color of button when hover.', 'minimog' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'minimog' ),
		'background' => esc_attr__( 'Background', 'minimog' ),
		'border'     => esc_attr__( 'Border', 'minimog' ),
	),
	'default'         => array(
		'color'      => '#fff',
		'background' => Minimog::PRIMARY_COLOR,
		'border'     => Minimog::PRIMARY_COLOR,
	),
	'output'          => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-sticky-button.tm-button:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'border',
			'element'  => '.header-sticky-button.tm-button:hover',
			'property' => 'border-color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-sticky-button.tm-button:after',
			'property' => 'background',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'button_color',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );
