<?php
$section  = 'typography';
$priority = 1;
$prefix   = 'typography_';

$font_weights = array(
	'200',
	'200italic',
	'300',
	'300italic',
	'regular',
	'italic',
	'500',
	'500italic',
	'600',
	'600italic',
	'700',
	'700italic',
	'800',
	'800italic',
	'900',
	'900italic',
);

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="desc"><strong class="insight-label insight-label-info">' . esc_html__( 'IMPORTANT NOTE: ', 'minimog' ) . '</strong>' . esc_html__( 'This section contains general typography options. Additional typography options for specific areas can be found within other sections. Example: For breadcrumb typography options go to the breadcrumb section.', 'minimog' ) . '</div>',
) );

/*--------------------------------------------------------------
# Body Typography
--------------------------------------------------------------*/
Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Body Typography', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'body',
	'label'       => esc_html__( 'Font family', 'minimog' ),
	'description' => esc_html__( 'These settings control the typography for all body text.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Minimog::PRIMARY_FONT,
		'variant'        => '400',
		'font-size'      => '15px',
		'line-height'    => '1.74',
		'letter-spacing' => '0em',
	),
	'choices'     => array(
		'variant' => $font_weights,
	),
	'output'      => array(
		array(
			'element' => 'body, .gmap-marker-wrap',
		),
	),
) );

/*--------------------------------------------------------------
# Heading typography
--------------------------------------------------------------*/
Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading Typography', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => $prefix . 'heading',
	'label'       => esc_html__( 'Font family', 'minimog' ),
	'description' => esc_html__( 'These settings control the typography for all heading text.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => 700,
		'line-height'    => '1.3',
		'letter-spacing' => '0em',
	),
	'choices'     => array(
		'variant' => $font_weights,
	),
	'output'      => array(
		array(
			'element' => 'h1,h2,h3,h4,h5,h6,th,[class*="hint--"]:after,
			.heading,
			.heading-typography,
			.elementor-accordion .elementor-tab-title a,
			.elementor-counter .elementor-counter-title
			',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h1_font_size',
	'label'       => esc_html__( 'Font size', 'minimog' ),
	'description' => esc_html__( 'H1', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 38,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h1',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h2_font_size',
	'description' => esc_html__( 'H2', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 34,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h2',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h3_font_size',
	'description' => esc_html__( 'H3', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 30,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h3',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h4_font_size',
	'description' => esc_html__( 'H4', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 26,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h4',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h5_font_size',
	'description' => esc_html__( 'H5', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 22,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h5',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h6_font_size',
	'description' => esc_html__( 'H6', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 18,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h6',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'strong_font_weight',
	'label'       => esc_html__( 'Strong Tag Weight', 'minimog' ),
	'description' => esc_html__( 'Controls font weight of &lt;strong&gt;, &lt;b&gt; tags', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '700',
	'transport'   => 'auto',
	'choices'     => array(
		'400' => esc_html__( '400 - Regular', 'minimog' ),
		'500' => esc_html__( '500 - Medium', 'minimog' ),
		'600' => esc_html__( '600 - Semi Bold', 'minimog' ),
		'700' => esc_html__( '700 - Bold', 'minimog' ),
		'800' => esc_html__( '800 - Extra Bold', 'minimog' ),
		'900' => esc_html__( '900 - Ultra Bold (Black)', 'minimog' ),
	),
	'output'      => array(
		array(
			'element'  => 'b, strong',
			'property' => 'font-weight',
		),
	),
) );

/*--------------------------------------------------------------
# Button
--------------------------------------------------------------*/
Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Buttons', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => 'button_typography',
	'label'       => esc_html__( 'Font family', 'minimog' ),
	'description' => esc_html__( 'These settings control the typography for buttons.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => 'inherit',
		'variant'        => '700',
		'font-size'      => '15px',
		'text-transform' => 'none',
		'letter-spacing' => '0em',
	),
	'choices'     => array(
		'variant' => $font_weights,
	),
	'output'      => array(
		array(
			'element' => Minimog_Helper::get_button_typography_css_selector(),
		),
	),
) );

/*--------------------------------------------------------------
# Form
--------------------------------------------------------------*/
Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Form Inputs', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'kirki_typography',
	'settings'    => 'form_typography',
	'label'       => esc_html__( 'Font family', 'minimog' ),
	'description' => esc_html__( 'These settings control the typography for form inputs.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => '',
		'variant'        => 'regular',
		'letter-spacing' => '0em',
		'font-size'      => '15px',
	),
	'choices'     => array(
		'variant' => $font_weights,
	),
	'output'      => array(
		array(
			'element' => Minimog_Helper::get_form_input_css_selector(),
		),
	),
) );
