<?php
$panel    = 'blog';
$priority = 1;

Minimog_Kirki::add_section( 'blog_archive', array(
	'title'    => esc_html__( 'Blog Archive', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'blog_single', array(
	'title'    => esc_html__( 'Blog Single Post', 'minimog' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
