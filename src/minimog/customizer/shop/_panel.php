<?php
$panel    = 'shop';
$priority = 1;

Minimog_Kirki::add_section( 'shop_general', array(
	'title'    => esc_html__( 'General', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'shop_archive', array(
	'title'    => esc_html__( 'Shop Archive', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'shop_single', array(
	'title'    => esc_html__( 'Shop Single', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'shopping_cart', array(
	'title'    => esc_html__( 'Shopping Cart', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
