<?php
$section  = 'logo';
$priority = 1;
$prefix   = 'logo_';

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'logo',
	'label'       => esc_html__( 'Default Logo', 'minimog' ),
	'description' => esc_html__( 'Choose default logo.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'logo_dark',
	'choices'     => array(
		'logo_dark'  => esc_html__( 'Dark Logo', 'minimog' ),
		'logo_light' => esc_html__( 'Light Logo', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'logo_dark',
	'label'    => esc_html__( 'Dark Version', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => array(
		'url' => MINIMOG_THEME_IMAGE_URI . '/logo/dark-logo.png',
	),
	'choices'  => array(
		'save_as' => 'array',
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'logo_light',
	'label'    => esc_html__( 'Light Version', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => array(
		'url' => MINIMOG_THEME_IMAGE_URI . '/logo/light-logo.png',
	),
	'choices'  => array(
		'save_as' => 'array',
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'logo_width',
	'label'       => esc_html__( 'Logo Width', 'minimog' ),
	'description' => esc_html__( 'For e.g: 200', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '166',
	'output'      => array(
		array(
			'element'  => '.branding__logo img,
			.error404--header .branding__logo img
			',
			'property' => 'width',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => $prefix . 'padding',
	'label'       => esc_html__( 'Logo Padding', 'minimog' ),
	'description' => esc_html__( 'For e.g: 30px 0px 30px 0px', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'top'    => '15px',
		'right'  => '0px',
		'bottom' => '15px',
		'left'   => '0px',
	),
	'output'      => array(
		array(
			'element'  => '.branding__logo img',
			'property' => 'padding',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Sticky Logo', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'sticky_logo_width',
	'label'       => esc_html__( 'Logo Width', 'minimog' ),
	'description' => esc_html__( 'Controls the width of sticky header logo. For e.g: 120', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '166',
	'output'      => array(
		array(
			'element'  => '
			.header-sticky-both .headroom.headroom--not-top .branding img,
			.header-sticky-up .headroom.headroom--not-top.headroom--pinned .branding img,
			.header-sticky-down .headroom.headroom--not-top.headroom--unpinned .branding img
			',
			'property' => 'width',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => 'sticky_logo_padding',
	'label'       => esc_html__( 'Logo Padding', 'minimog' ),
	'description' => esc_html__( 'Controls the padding of sticky header logo.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'top'    => '0',
		'right'  => '0',
		'bottom' => '0',
		'left'   => '0',
	),
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .branding__logo .sticky-logo',
			'property' => 'padding',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Mobile Menu Logo', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => 'mobile_menu_logo',
	'label'       => esc_html__( 'Logo', 'minimog' ),
	'description' => esc_html__( 'Select an image file for mobile menu logo.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'url' => MINIMOG_THEME_IMAGE_URI . '/logo/dark-logo.png',
	),
	'choices'     => array(
		'save_as' => 'array',
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'mobile_logo_width',
	'label'       => esc_html__( 'Logo Width', 'minimog' ),
	'description' => esc_html__( 'Controls the width of mobile menu logo. For e.g: 120', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '166',
	'output'      => array(
		array(
			'element'  => '.page-mobile-popup-logo img',
			'property' => 'width',
			'units'    => 'px',
		),
	),
) );
