<?php
$section  = 'shop_archive';
$priority = 1;
$prefix   = 'shop_archive_';

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
	'settings'    => 'product_archive_header_type',
	'label'       => esc_html__( 'Header Style', 'minimog' ),
	'description' => esc_html__( 'Select default header style that displays on archive product page.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => Minimog_Header::instance()->get_list( true, esc_html__( 'Use Global Header Style', 'minimog' ) ),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_archive_header_overlay',
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
	'settings' => 'product_archive_header_skin',
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
	'settings'    => 'product_archive_title_bar_layout',
	'label'       => esc_html__( 'Title Bar Style', 'minimog' ),
	'description' => esc_html__( 'Select default Title Bar that displays on all archive product (included cart, checkout, my-account...) pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => Minimog_Title_Bar::instance()->get_list( true, esc_html__( 'Use Global Title Bar', 'minimog' ) ),
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
	'settings'    => 'product_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'minimog' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on product archive pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'shop_sidebar',
	'choices'     => $registered_sidebars,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'minimog' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on product archive pages.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'left',
	'choices'  => $sidebar_positions,
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'product_archive_single_sidebar_width',
	'label'       => esc_html__( 'Single Sidebar Width', 'minimog' ),
	'description' => esc_html__( 'Controls the width of the sidebar when only one sidebar is present. Input value as % unit. For e.g: 33.33333. Leave blank to use global setting.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '25',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'product_archive_single_sidebar_offset',
	'label'       => esc_html__( 'Single Sidebar Offset', 'minimog' ),
	'description' => esc_html__( 'Controls the offset of the sidebar when only one sidebar is present. Enter value including any valid CSS unit. For e.g: 70px. Leave blank to use global setting.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Others', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'preset',
	'settings' => 'shop_archive_preset',
	'label'    => esc_html__( 'Shop Layout Preset', 'minimog' ),
	'section'  => $section,
	'default'  => '-1',
	'priority' => $priority++,
	'multiple' => 0,
	'choices'  => array(
		'-1'            => array(
			'label'    => esc_html__( 'None', 'minimog' ),
			'settings' => array(),
		),
		'left-sidebar'  => array(
			'label'    => esc_html__( 'Shop Left Sidebar', 'minimog' ),
			'settings' => array(
				'product_archive_page_sidebar_1'        => 'shop_sidebar',
				'product_archive_page_sidebar_position' => 'left',
				'shop_archive_number_item'              => 20,
				'shop_archive_lg_columns'               => '4',
				'shop_archive_sorting'                  => '1',
				'shop_archive_filtering'                => '0',

			),
		),
		'right-sidebar' => array(
			'label'    => esc_html__( 'Shop Right Sidebar', 'minimog' ),
			'settings' => array(
				'product_archive_page_sidebar_1'        => 'shop_sidebar',
				'product_archive_page_sidebar_position' => 'right',
				'shop_archive_number_item'              => 20,
				'shop_archive_lg_columns'               => '4',
				'shop_archive_sorting'                  => '1',
				'shop_archive_filtering'                => '0',
			),
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'shop_archive_layout',
	'label'    => esc_html__( 'Layout', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'boxed',
	'choices'  => array(
		'boxed' => esc_html__( 'Boxed', 'minimog' ),
		'wide'  => esc_html__( 'Wide', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_sorting',
	'label'       => esc_html__( 'Sorting', 'minimog' ),
	'description' => esc_html__( 'Turn on to show sorting select options that displays above products list.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'minimog' ),
		'1' => esc_html__( 'Show', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_filtering',
	'label'       => esc_html__( 'Filtering', 'minimog' ),
	'description' => esc_html__( 'Turn on to show filtering button that displays above products list.', 'minimog' ),
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
	'settings'    => 'shop_archive_hover_image',
	'label'       => esc_html__( 'Hover Image', 'minimog' ),
	'description' => esc_html__( 'Turn on to show first gallery image when hover', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'None', 'minimog' ),
		'1' => esc_html__( 'Yes', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_thumbnail_background',
	'label'       => esc_html__( 'Product Image Has Background?', 'minimog' ),
	'description' => esc_html__( 'If your product\'s feature image has background then turn on this option to make little spacing between button, badges with the image.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'None', 'minimog' ),
		'1' => esc_html__( 'Yes', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop_archive_quick_view',
	'label'       => esc_html__( 'Quick View', 'minimog' ),
	'description' => esc_html__( 'Turn on to display quick view button', 'minimog' ),
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
	'settings'    => 'shop_archive_compare',
	'label'       => esc_html__( 'Compare', 'minimog' ),
	'description' => esc_html__( 'Turn on to display compare button', 'minimog' ),
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
	'settings'    => 'shop_archive_wishlist',
	'label'       => esc_html__( 'Wishlist', 'minimog' ),
	'description' => esc_html__( 'Turn on to display love button', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'minimog' ),
		'1' => esc_html__( 'On', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'shop_archive_hide_buttons_on_mobile',
	'label'    => esc_html__( 'Hide All Buttons on mobile', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'minimog' ),
		'1' => esc_html__( 'Yes', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'shop_archive_number_item',
	'label'       => esc_html__( 'Number items', 'minimog' ),
	'description' => esc_html__( 'Controls the number of products display on shop archive page', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 15,
	'choices'     => array(
		'min'  => 1,
		'max'  => 50,
		'step' => 1,
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Shop Columns', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'shop_archive_lg_columns',
	'label'     => esc_html__( 'Large Device', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 4,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 6,
		'step' => 1,
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'shop_archive_md_columns',
	'label'     => esc_html__( 'Medium Device', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 3,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 6,
		'step' => 1,
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'shop_archive_sm_columns',
	'label'     => esc_html__( 'Small Device', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 2,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 6,
		'step' => 1,
	),
) );
