<?php
$section  = 'title_bar';
$priority = 1;
$prefix   = 'title_bar_';

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'layout',
	'label'       => esc_html__( 'Global Title Bar', 'minimog' ),
	'description' => esc_html__( 'Select default title bar that displays on all pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '01',
	'choices'     => Minimog_Title_Bar::instance()->get_list(),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'search_title',
	'label'       => esc_html__( 'Search Heading', 'minimog' ),
	'description' => esc_html__( 'Enter text prefix that displays on search results page.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Search results for: ', 'minimog' ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'home_title',
	'label'       => esc_html__( 'Home Heading', 'minimog' ),
	'description' => esc_html__( 'Enter text that displays on front latest posts page.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Blog', 'minimog' ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_category_title',
	'label'       => esc_html__( 'Archive Category Heading', 'minimog' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive category page.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Category: ', 'minimog' ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_tag_title',
	'label'       => esc_html__( 'Archive Tag Heading', 'minimog' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive tag page.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Tag: ', 'minimog' ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_author_title',
	'label'       => esc_html__( 'Archive Author Heading', 'minimog' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive author page.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Author: ', 'minimog' ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_year_title',
	'label'       => esc_html__( 'Archive Year Heading', 'minimog' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive year page.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Year: ', 'minimog' ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_month_title',
	'label'       => esc_html__( 'Archive Month Heading', 'minimog' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive month page.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Month: ', 'minimog' ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_day_title',
	'label'       => esc_html__( 'Archive Day Heading', 'minimog' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive day page.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Day: ', 'minimog' ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_blog_title',
	'label'       => esc_html__( 'Single Blog Heading', 'minimog' ),
	'description' => esc_html__( 'Enter text that displays on single blog posts. Leave blank to use post title.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Blog', 'minimog' ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_portfolio_title',
	'label'       => esc_html__( 'Archive Portfolio Heading', 'minimog' ),
	'description' => esc_html__( 'Enter text that displays on archive portfolio pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Portfolios', 'minimog' ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_portfolio_title',
	'label'       => esc_html__( 'Single Portfolio Heading', 'minimog' ),
	'description' => esc_html__( 'Enter text that displays on single portfolio pages. Leave blank to use portfolio title.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Portfolio', 'minimog' ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_product_title',
	'label'       => esc_html__( 'Single Product Heading', 'minimog' ),
	'description' => esc_html__( 'Enter text that displays on single product pages. Leave blank to use product title.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Our Shop', 'minimog' ),
) );
