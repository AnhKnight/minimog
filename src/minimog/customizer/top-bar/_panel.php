<?php
$panel    = 'top_bar';
$priority = 1;

Minimog_Kirki::add_section( 'top_bar', array(
	'title'    => esc_html__( 'General', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'top_bar_style_01', array(
	'title'    => esc_html__( 'Top Bar Style', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
//
//Minimog_Kirki::add_section( 'top_bar_style_02', array(
//	'title'    => esc_html__( 'Top Bar Style 02', 'minimog' ),
//	'panel'    => $panel,
//	'priority' => $priority++,
//) );
//
//Minimog_Kirki::add_section( 'top_bar_style_03', array(
//	'title'    => esc_html__( 'Top Bar Style 03', 'minimog' ),
//	'panel'    => $panel,
//	'priority' => $priority++,
//) );
//
//Minimog_Kirki::add_section( 'top_bar_style_03', array(
//	'title'    => esc_html__( 'Top Bar Style 03', 'minimog' ),
//	'panel'    => $panel,
//	'priority' => $priority++,
//) );
//Minimog_Kirki::add_section( 'top_bar_style_04', array(
//	'title'    => esc_html__( 'Top Bar Style 04', 'minimog' ),
//	'panel'    => $panel,
//	'priority' => $priority++,
//) );
