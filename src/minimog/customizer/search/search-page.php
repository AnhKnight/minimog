<?php
$section  = 'search_page';
$priority = 1;
$prefix   = 'search_page_';

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_filter',
	'label'       => esc_html__( 'Search Results Filter', 'minimog' ),
	'description' => esc_html__( 'Controls the type of content that displays in search results.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'product',
	'choices'     => array(
		'all'     => esc_html__( 'All Post Types and Pages', 'minimog' ),
		'page'    => esc_html__( 'Only Pages', 'minimog' ),
		'post'    => esc_html__( 'Only Blog Posts', 'minimog' ),
		'product' => esc_html__( 'Only Products', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'search_page_number_results',
	'label'       => esc_html__( 'Number of Search Results Per Page', 'minimog' ),
	'description' => esc_html__( 'Controls the number of search results per page.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 10,
	'choices'     => array(
		'min'  => 1,
		'max'  => 100,
		'step' => 1,
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'search_page_search_form_display',
	'label'       => esc_html__( 'Search Form Display', 'minimog' ),
	'description' => esc_html__( 'Controls the display of the search form on the search results page.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'disabled',
	'choices'     => array(
		'below'    => esc_html__( 'Below Result List', 'minimog' ),
		'above'    => esc_html__( 'Above Result List', 'minimog' ),
		'disabled' => esc_html__( 'Hide', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'search_page_no_results_text',
	'label'       => esc_html__( 'No Results Text', 'minimog' ),
	'description' => esc_html__( 'Enter the text that displays on search no results page.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'minimog' ),
) );
