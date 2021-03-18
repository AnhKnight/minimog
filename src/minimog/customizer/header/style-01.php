<?php
$section  = 'header_style_01';
$priority = 1;
$prefix   = 'header_style_01_';

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Header Style', 'minimog' ) . '</div>',
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
			'element'  => '.header-01 .page-header-inner',
			'property' => 'border-bottom-width',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Header Components', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'account_enable',
	'label'    => esc_html__( 'Account', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'minimog' ),
		'1' => esc_html__( 'Show', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'search_enable',
	'label'    => esc_html__( 'Search', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'popup',
	'choices'  => array(
		'0'      => esc_html__( 'Hide', 'minimog' ),
		'inline' => esc_html__( 'Inline Form', 'minimog' ),
		'popup'  => esc_html__( 'Popup Search', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'login_enable',
	'label'    => esc_html__( 'Login', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'minimog' ),
		'1' => esc_html__( 'Show', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'wishlist_enable',
	'label'    => esc_html__( 'Wishlist', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'minimog' ),
		'1' => esc_html__( 'Show', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'cart_enable',
	'label'    => esc_html__( 'Mini Cart', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0'             => esc_html__( 'Hide', 'minimog' ),
		'1'             => esc_html__( 'Show', 'minimog' ),
		'hide_on_empty' => esc_html__( 'Hide On Empty', 'minimog' ),
	),
) );

Minimog_Customize::instance()->field_social_networks_enable( array(
	'settings' => $prefix . 'social_networks_enable',
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
) );

Minimog_Customize::instance()->field_language_switcher_enable( array(
	'settings' => $prefix . 'language_switcher_enable',
	'section'  => $section,
	'priority' => $priority++,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Header Button', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'button_text',
	'label'    => esc_html__( 'Button Text', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'button_link',
	'label'    => esc_html__( 'Button Link', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'button_link_rel',
	'label'    => esc_html__( 'Button Link Relationship (XFN)', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'button_link_target',
	'label'    => esc_html__( 'Open link in a new tab.', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'No', 'minimog' ),
		'1' => esc_html__( 'Yes', 'minimog' ),
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
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Header Navigation (Level 1)', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'navigation_typography',
	'label'       => esc_html__( 'Typography', 'minimog' ),
	'description' => esc_html__( 'These settings control the typography for menu items.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => '500',
		'font-size'      => '16px',
		'line-height'    => '1.4',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output'      => array(
		array(
			'element' => '.header-01 .menu--primary a',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'navigation_item_padding',
	'label'     => esc_html__( 'Item Padding', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '29px',
		'bottom' => '29px',
		'left'   => '18px',
		'right'  => '18px',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.desktop-menu .header-01 .menu--primary .menu__container > li > a',
			),
			'property' => 'padding',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Header Dark Skin', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Header Style', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'background',
	'settings' => $prefix . 'dark_background',
	'label'    => esc_html__( 'Background', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => array(
		'background-color'      => '#fff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'fixed',
		'background-position'   => 'center center',
	),
	'output'   => array(
		array(
			'element' => '.header-01.header-dark .page-header-inner',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dark_border_color',
	'label'       => esc_html__( 'Border Color', 'minimog' ),
	'description' => esc_html__( 'Controls the border color of header.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#eee',
	'output'      => array(
		array(
			'element'  => '.header-01.header-dark .page-header-inner',
			'property' => 'border-color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'dark_box_shadow',
	'label'       => esc_html__( 'Box Shadow', 'minimog' ),
	'description' => esc_html__( 'Input box shadow for header. For e.g: 0 0 5px #ccc', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0 1px 20px rgba(0, 0, 0, 0.05)',
	'output'      => array(
		array(
			'element'  => '.header-01.header-dark .page-header-inner',
			'property' => 'box-shadow',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Header Icon', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'dark_header_icon_color',
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
			.header-01.header-dark .header-icon,
			.header-01.header-dark .wpml-ls-item-toggle',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-01.header-dark .header-icon:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-01.header-dark .wpml-ls-slot-shortcode_actions:hover > .js-wpml-ls-item-toggle',
			'property' => 'color',
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
	'settings'    => $prefix . 'dark_cart_badge_color',
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
			'element'  => '.header-01.header-dark .mini-cart .mini-cart-icon:after',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-01.header-dark .mini-cart .mini-cart-icon:after',
			'property' => 'background-color',
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
	'settings'    => $prefix . 'dark_navigation_link_color',
	'label'       => esc_html__( 'Link Color', 'minimog' ),
	'description' => esc_html__( 'Controls the color for main menu items.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'choices'     => array(
		'normal' => esc_attr__( 'Normal', 'minimog' ),
		'hover'  => esc_attr__( 'Hover', 'minimog' ),
	),
	'default'     => array(
		'normal' => Minimog::TEXT_COLOR,
		'hover'  => Minimog::PRIMARY_COLOR,
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '.header-01.header-dark .menu--primary > ul > li > a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '
			.header-01.header-dark .menu--primary > ul > li:hover > a,
            .header-01.header-dark .menu--primary > ul > li > a:hover,
            .header-01.header-dark .menu--primary > ul > li > a:focus,
            .header-01.header-dark .menu--primary > ul > .current-menu-ancestor > a,
            .header-01.header-dark .menu--primary > ul > .current-menu-item > a',
			'property' => 'color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Header Search Form', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'dark_search_form_color',
	'label'           => esc_html__( 'Normal', 'minimog' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'minimog' ),
		'background' => esc_attr__( 'Background', 'minimog' ),
		'border'     => esc_attr__( 'Border', 'minimog' ),
	),
	'default'         => array(
		'color'      => '#696969',
		'background' => '#f5f5f5',
		'border'     => '#f5f5f5',
	),
	'output'          => Minimog_Header::instance()->get_search_form_kirki_output( '01', 'dark', false ),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'search_enable',
			'operator' => '==',
			'value'    => 'inline',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'dark_search_form_focus_color',
	'label'           => esc_html__( 'Hover', 'minimog' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'minimog' ),
		'background' => esc_attr__( 'Background', 'minimog' ),
		'border'     => esc_attr__( 'Border', 'minimog' ),
	),
	'default'         => array(
		'color'      => '#333',
		'background' => '#fff',
		'border'     => Minimog::PRIMARY_COLOR,
	),
	'output'          => Minimog_Header::instance()->get_search_form_kirki_output( '01', 'dark', true ),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'search_enable',
			'operator' => '==',
			'value'    => 'inline',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Header Button', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'dark_button_color',
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
	'settings'        => $prefix . 'dark_button_custom_color',
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
		'color'      => '#fff',
		'background' => Minimog::PRIMARY_COLOR,
		'border'     => Minimog::PRIMARY_COLOR,
	),
	'output'          => Minimog_Header::instance()->get_button_kirki_output( '01', 'dark', false ),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'dark_button_color',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'dark_button_hover_custom_color',
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
		'color'      => Minimog::PRIMARY_COLOR,
		'background' => 'rgba(0, 0, 0, 0)',
		'border'     => Minimog::PRIMARY_COLOR,
	),
	'output'          => Minimog_Header::instance()->get_button_kirki_output( '01', 'dark', true ),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'dark_button_color',
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
	'default'  => '<div class="group_title">' . esc_html__( 'Header Social Networks', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => $prefix . 'dark_social_networks_color',
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
		'hover'  => Minimog::PRIMARY_COLOR,
	),
	'output'    => array(
		array(
			'choice'   => 'normal',
			'element'  => '.header-01.header-dark .header-social-networks a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-01.header-dark .header-social-networks a:hover',
			'property' => 'color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Header Light Skin', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Header Style', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'light_border_color',
	'label'       => esc_html__( 'Border Color', 'minimog' ),
	'description' => esc_html__( 'Controls the border color of header.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(255, 255, 255, 0.2)',
	'output'      => array(
		array(
			'element'  => '.header-01.header-light .page-header-inner',
			'property' => 'border-color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'light_box_shadow',
	'label'       => esc_html__( 'Box Shadow', 'minimog' ),
	'description' => esc_html__( 'Input box shadow for header. For e.g: 0 0 5px #ccc', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0 1px 20px rgba(255, 255, 255, 0.05)',
	'output'      => array(
		array(
			'element'  => '.header-01.header-light .page-header-inner',
			'property' => 'box-shadow',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Header Icon', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'multicolor',
	'settings'    => $prefix . 'light_header_icon_color',
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
		'normal' => '#fff',
		'hover'  => '#fff',
	),
	'output'      => array(
		array(
			'choice'   => 'normal',
			'element'  => '
			.header-01.header-light .header-icon,
			.header-01.header-light .wpml-ls-item-toggle',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-01.header-light .header-icon:hover',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-01.header-light .wpml-ls-slot-shortcode_actions:hover > .js-wpml-ls-item-toggle',
			'property' => 'color',
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
	'settings'    => $prefix . 'light_cart_badge_color',
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
		'color'      => Minimog::PRIMARY_COLOR,
		'background' => '#fff',
	),
	'output'      => array(
		array(
			'choice'   => 'color',
			'element'  => '.header-01.header-light .mini-cart .mini-cart-icon:after',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.header-01.header-light .mini-cart .mini-cart-icon:after',
			'property' => 'background-color',
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
	'settings'    => $prefix . 'light_navigation_link_color',
	'label'       => esc_html__( 'Navigation Link Color', 'minimog' ),
	'description' => esc_html__( 'Controls the color for main menu items.', 'minimog' ),
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
			'element'  => '.header-01.header-light .menu--primary > ul > li > a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '
            .header-01.header-light .menu--primary > ul > li:hover > a,
            .header-01.header-light .menu--primary > ul > li > a:hover,
            .header-01.header-light .menu--primary > ul > li > a:focus,
            .header-01.header-light .menu--primary > ul > .current-menu-ancestor > a,
            .header-01.header-light .menu--primary > ul > .current-menu-item > a',
			'property' => 'color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Header Search Form', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'light_search_form_color',
	'label'           => esc_html__( 'Normal', 'minimog' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'minimog' ),
		'background' => esc_attr__( 'Background', 'minimog' ),
		'border'     => esc_attr__( 'Border', 'minimog' ),
	),
	'default'         => array(
		'color'      => '#696969',
		'background' => '#fff',
		'border'     => '#fff',
	),
	'output'          => Minimog_Header::instance()->get_search_form_kirki_output( '01', 'light', false ),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'search_enable',
			'operator' => '==',
			'value'    => 'inline',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'light_search_form_focus_color',
	'label'           => esc_html__( 'Hover', 'minimog' ),
	'section'         => $section,
	'priority'        => $priority++,
	'transport'       => 'auto',
	'choices'         => array(
		'color'      => esc_attr__( 'Color', 'minimog' ),
		'background' => esc_attr__( 'Background', 'minimog' ),
		'border'     => esc_attr__( 'Border', 'minimog' ),
	),
	'default'         => array(
		'color'      => '#333',
		'background' => '#fff',
		'border'     => Minimog::PRIMARY_COLOR,
	),
	'output'          => Minimog_Header::instance()->get_search_form_kirki_output( '01', 'light', true ),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'search_enable',
			'operator' => '==',
			'value'    => 'inline',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Header Button', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'light_button_color',
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
	'settings'        => $prefix . 'light_button_custom_color',
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
		'color'      => '#fff',
		'background' => 'rgba(255, 255, 255, 0)',
		'border'     => 'rgba(255, 255, 255, 0.3)',
	),
	'output'          => Minimog_Header::instance()->get_button_kirki_output( '01', 'light', false ),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'light_button_color',
			'operator' => '==',
			'value'    => 'custom',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'multicolor',
	'settings'        => $prefix . 'light_button_hover_custom_color',
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
		'color'      => Minimog::HEADING_COLOR,
		'background' => '#fff',
		'border'     => '#fff',
	),
	'output'          => Minimog_Header::instance()->get_button_kirki_output( '01', 'light', true ),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'light_button_color',
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
	'default'  => '<div class="group_title">' . esc_html__( 'Header Social Networks', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => $prefix . 'light_social_networks_color',
	'label'     => esc_html__( 'Normal Color', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'normal' => esc_attr__( 'Normal', 'minimog' ),
		'hover'  => esc_attr__( 'Hover', 'minimog' ),
	),
	'default'   => array(
		'normal' => '#fff',
		'hover'  => '#fff',
	),
	'output'    => array(
		array(
			'choice'   => 'normal',
			'element'  => '.header-01.header-light .header-social-networks a',
			'property' => 'color',
		),
		array(
			'choice'   => 'hover',
			'element'  => '.header-01.header-light .header-social-networks a:hover',
			'property' => 'color',
		),
	),
) );
