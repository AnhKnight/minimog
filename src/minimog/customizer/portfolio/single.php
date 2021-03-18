<?php
$section  = 'single_portfolio';
$priority = 1;
$prefix   = 'single_portfolio_';

$sidebar_positions   = Minimog_Helper::get_list_sidebar_positions();
$registered_sidebars = Minimog_Helper::get_registered_sidebars();

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Header', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_single_header_type',
	'label'       => esc_html__( 'Header Style', 'minimog' ),
	'description' => esc_html__( 'Select default header style that displays on all single portfolio pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => Minimog_Header::instance()->get_list( true, esc_html__( 'Use Global Header Style', 'minimog' ) ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_single_header_overlay',
	'label'    => esc_html__( 'Header Overlay', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '',
	'choices'  => array(
		''  => esc_html__( 'Use Global', 'minimog' ),
		'0' => esc_html__( 'No', 'minimog' ),
		'1' => esc_html__( 'Yes', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_single_header_skin',
	'label'    => esc_html__( 'Header Skin', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '',
	'choices'  => array(
		''      => esc_html__( 'Use Global', 'minimog' ),
		'dark'  => esc_html__( 'Dark', 'minimog' ),
		'light' => esc_html__( 'Light', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Page Title Bar', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_single_title_bar_layout',
	'label'       => esc_html__( 'Page Title Bar', 'minimog' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all single portfolio pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'choices'     => Minimog_Title_Bar::instance()->get_list( true, esc_html__( 'Use Global Title Bar', 'minimog' ) ),
	'default'     => 'none',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Sidebar', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'minimog' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single portfolio pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'minimog' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single portfolio pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Others', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_sticky_detail_enable',
	'label'       => esc_html__( 'Sticky Detail Column', 'minimog' ),
	'description' => esc_html__( 'Turn on to enable sticky of detail column.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'minimog' ),
		'1' => esc_html__( 'On', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_site_skin',
	'label'       => esc_html__( 'Site Skin', 'minimog' ),
	'description' => esc_html__( 'Select skin of all single portfolio post pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'light',
	'choices'     => array(
		'dark'  => esc_html__( 'Dark', 'minimog' ),
		'light' => esc_html__( 'Light', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_style',
	'label'       => esc_html__( 'Single Portfolio Style', 'minimog' ),
	'description' => esc_html__( 'Select style of all single portfolio post pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'image-list',
	'choices'     => array(
		'blank'           => esc_html__( 'Blank (Build with Elementor)', 'minimog' ),
		'image-list'      => esc_html__( 'Image List', 'minimog' ),
		'image-list-wide' => esc_html__( 'Image List - Wide', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_video_enable',
	'label'       => esc_html__( 'Video', 'minimog' ),
	'description' => esc_html__( 'Controls the video visibility on portfolio post pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => array(
		'none'  => esc_html__( 'Hide', 'minimog' ),
		'above' => esc_html__( 'Show Above Feature Image', 'minimog' ),
		'below' => esc_html__( 'Show Below Feature Image', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_feature_caption',
	'label'       => esc_html__( 'Image Caption', 'minimog' ),
	'description' => esc_html__( 'Turn on to display comments on single portfolio posts.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'minimog' ),
		'1' => esc_html__( 'Show', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_comment_enable',
	'label'       => esc_html__( 'Comments', 'minimog' ),
	'description' => esc_html__( 'Turn on to display comments on single portfolio posts.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'minimog' ),
		'1' => esc_html__( 'On', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_categories_enable',
	'label'       => esc_html__( 'Categories', 'minimog' ),
	'description' => esc_html__( 'Turn on to display categories on single portfolio posts.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'minimog' ),
		'1' => esc_html__( 'On', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_tags_enable',
	'label'       => esc_html__( 'Tags', 'minimog' ),
	'description' => esc_html__( 'Turn on to display tags on single portfolio posts.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'minimog' ),
		'1' => esc_html__( 'On', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_share_enable',
	'label'       => esc_html__( 'Share', 'minimog' ),
	'description' => esc_html__( 'Turn on to display Share list on single portfolio posts.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'minimog' ),
		'1' => esc_html__( 'On', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_related_enable',
	'label'       => esc_html__( 'Related Portfolio', 'minimog' ),
	'description' => esc_html__( 'Turn on this option to display related portfolio section.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'minimog' ),
		'1' => esc_html__( 'On', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'text',
	'settings'        => 'portfolio_related_title',
	'label'           => esc_html__( 'Related Title Section', 'minimog' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => esc_html__( 'Related Projects', 'minimog' ),
	'active_callback' => array(
		array(
			'setting'  => 'single_portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'multicheck',
	'settings'        => 'portfolio_related_by',
	'label'           => esc_attr__( 'Related By', 'minimog' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => array( 'portfolio_category' ),
	'choices'         => array(
		'portfolio_category' => esc_html__( 'Portfolio Category', 'minimog' ),
		'portfolio_tags'     => esc_html__( 'Portfolio Tags', 'minimog' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'single_portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'            => 'number',
	'settings'        => 'portfolio_related_number',
	'label'           => esc_html__( 'Number related portfolio', 'minimog' ),
	'description'     => esc_html__( 'Controls the number of related portfolio', 'minimog' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 5,
	'choices'         => array(
		'min'  => 3,
		'max'  => 30,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'single_portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_pagination',
	'label'       => esc_html__( 'Previous/Next Pagination', 'minimog' ),
	'description' => esc_html__( 'Select type of previous/next portfolio pagination on single portfolio posts.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '01',
	'choices'     => array(
		'none' => esc_html__( 'None', 'minimog' ),
		'01'   => esc_html__( 'Style 01', 'minimog' ),
		'02'   => esc_html__( 'Style 02', 'minimog' ),
		'03'   => esc_html__( 'Style 03', 'minimog' ),
	),
) );
