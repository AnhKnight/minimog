<?php
$section  = 'header_sticky';
$priority = 1;
$prefix   = 'header_sticky_';

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => $prefix . 'enable',
	'label'       => esc_html__( 'Enable', 'minimog' ),
	'description' => esc_html__( 'Enable this option to turn on header sticky feature.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio',
	'settings'    => $prefix . 'behaviour',
	'label'       => esc_html__( 'Behaviour', 'minimog' ),
	'description' => esc_html__( 'Controls the behaviour of header sticky when you scroll down to page', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'both',
	'choices'     => array(
		'both' => esc_html__( 'Sticky on scroll up/down', 'minimog' ),
		'up'   => esc_html__( 'Sticky on scroll up', 'minimog' ),
		'down' => esc_html__( 'Sticky on scroll down', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'height',
	'label'     => esc_html__( 'Height', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 80,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner .header-wrap',
			'property' => 'min-height',
			'units'    => 'px',
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
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'padding-top',
			'units'    => 'px',
			'suffix'   => '!important',
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
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
			'suffix'   => '!important',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'logo',
	'label'    => esc_html__( 'Logo', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'dark',
	'choices'  => array(
		'light' => esc_html__( 'Light', 'minimog' ),
		'dark'  => esc_html__( 'Dark', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'minimog' ),
	'description' => esc_html__( 'Controls the background of header when sticky.', 'minimog' ),
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
			'element' => '#page-header.headroom--not-top .page-header-inner',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Header Icons', 'minimog' ) . '</div>',
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
		'normal' => Minimog::HEADING_COLOR,
		'hover'  => Minimog::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '
			.page-header.headroom--not-top .header-icon,
			.page-header.headroom--not-top .wpml-ls-item-toggle
			',
			'property' => 'color',
			'suffix'   => ' !important',
		),
		array(
			'choice'   => 'hover',
			'element'  => '
			.page-header.headroom--not-top .header-icon:hover
			',
			'property' => 'color',
			'suffix'   => ' !important',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.page-header.headroom--not-top .wpml-ls-slot-shortcode_actions:hover > .js-wpml-ls-item-toggle',
			'property' => 'color',
			'suffix'   => '!important',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Cart Badge', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'cart_badge_color',
	'label'       => esc_html__( 'Color', 'minimog' ),
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
			'element'  => '.page-header.headroom--not-top .mini-cart .mini-cart-icon:after',
			'property' => 'color',
			'suffix'   => ' !important',
		),
		array(
			'choice'   => 'background',
			'element'  => '.page-header.headroom--not-top .mini-cart .mini-cart-icon:after',
			'property' => 'background-color',
			'suffix'   => ' !important',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Social Networks', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => $prefix . 'social_networks_color',
	'label'     => esc_html__( 'Color', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'normal' => esc_attr__( 'Normal', 'minimog' ),
		'hover'  => esc_attr__( 'Hover', 'minimog' ),
	),
	'default'   => array(
		'normal' => Minimog::HEADING_COLOR,
		'hover'  => Minimog::HEADING_COLOR,
	),
	'output'    => array(
		array(
			'choice'   => 'normal',
			'element'  => '.page-header.headroom--not-top .header-social-networks a',
			'property' => 'color',
			'suffix'   => ' !important',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.page-header.headroom--not-top .header-social-networks a:hover',
			'property' => 'color',
			'suffix'   => ' !important',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Navigation', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'navigation_link_color',
	'label'       => esc_html__( 'Color', 'minimog' ),
	'description' => esc_html__( 'Controls the color for main menu items.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'normal' => esc_attr__( 'Normal', 'minimog' ),
		'hover'  => esc_attr__( 'Hover', 'minimog' ),
	),
	'default'     => array(
		'normal' => Minimog::HEADING_COLOR,
		'hover'  => Minimog::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '.page-header.headroom--not-top .menu--primary > ul > li > a',
			'property' => 'color',
			'suffix'   => ' !important',
		),
		array(
			'choice'   => 'hover',
			'element'  => '
            .page-header.headroom--not-top .menu--primary > li:hover > a,
            .page-header.headroom--not-top .menu--primary > ul > li > a:hover,
            .page-header.headroom--not-top .menu--primary > ul > li > a:focus,
            .page-header.headroom--not-top .menu--primary > ul > .current-menu-ancestor > a,
            .page-header.headroom--not-top .menu--primary > ul > .current-menu-item > a',
			'property' => 'color',
			'suffix'   => ' !important',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Button', 'minimog' ) . '</div>',
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
	'default'  => 'custom',
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
		'color'      => Minimog::HEADING_COLOR,
		'background' => 'rgba(17, 17, 17, 0)',
		'border'     => '#eee',
	),
	'output'          => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-sticky-button.tm-button',
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
		'background' => Minimog::HEADING_COLOR,
		'border'     => Minimog::HEADING_COLOR,
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


Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Search Form', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => $prefix . 'search_form_color',
	'label'     => esc_html__( 'Normal', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'color'      => esc_attr__( 'Color', 'minimog' ),
		'background' => esc_attr__( 'Background', 'minimog' ),
		'border'     => esc_attr__( 'Border', 'minimog' ),
	),
	'default'   => array(
		'color'      => '#696969',
		'background' => '#f5f5f5',
		'border'     => '#f5f5f5',
	),
	'output'    => array(
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => '#page-header.headroom--not-top .search-field',
		),
		array(
			'choice'   => 'border',
			'property' => 'border-color',
			'element'  => '#page-header.headroom--not-top .search-field',
		),
		array(
			'choice'   => 'background',
			'property' => 'background',
			'element'  => '#page-header.headroom--not-top .search-field',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => $prefix . 'search_form_focus_color',
	'label'     => esc_html__( 'Hover', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'color'      => esc_attr__( 'Color', 'minimog' ),
		'background' => esc_attr__( 'Background', 'minimog' ),
		'border'     => esc_attr__( 'Border', 'minimog' ),
	),
	'default'   => array(
		'color'      => '#333',
		'background' => '#fff',
		'border'     => Minimog::PRIMARY_COLOR,
	),
	'output'    => array(
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => '#page-header.headroom--not-top .search-field:focus',
		),
		array(
			'choice'   => 'border',
			'property' => 'border-color',
			'element'  => '#page-header.headroom--not-top .search-field:focus',
		),
		array(
			'choice'   => 'background',
			'property' => 'background',
			'element'  => '#page-header.headroom--not-top .search-field:focus',
		),
	),
) );
