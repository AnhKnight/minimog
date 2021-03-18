<?php
$section  = 'error404_page';
$priority = 1;
$prefix   = 'error404_page_';

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => 'error404_page_background_body',
	'label'       => esc_html__( 'Background', 'minimog' ),
	'description' => esc_html__( 'Controls outer background area in boxed mode.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '#fff',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'fixed',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.error404',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'error404_page_image',
	'label'    => esc_html__( 'Image', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => MINIMOG_THEME_IMAGE_URI . '/page-404-image.jpg',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'error404_page_title',
	'label'       => esc_html__( 'Title', 'minimog' ),
	'description' => esc_html__( 'Controls the title that display on error 404 page.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Oops! That page can’t be found.', 'minimog' ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'error404_page_text',
	'label'       => esc_html__( 'Text', 'minimog' ),
	'description' => esc_html__( 'Controls the text that display below title', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'minimog' ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'error404_page_search_enable',
	'label'    => esc_html__( 'Show Search Form', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'minimog' ),
		'1' => esc_html__( 'Yes', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'error404_page_buttons_enable',
	'label'    => esc_html__( 'Show Buttons', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'No', 'minimog' ),
		'1' => esc_html__( 'Yes', 'minimog' ),
	),
) );
