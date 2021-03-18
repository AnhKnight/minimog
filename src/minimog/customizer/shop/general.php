<?php
$section  = 'shop_general';
$priority = 1;
$prefix   = 'shop_general_';

Minimog_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'shop_badge_new',
	'label'       => esc_html__( 'New Badge (Days)', 'minimog' ),
	'description' => esc_html__( 'If the product was published within the newness time frame display the new badge.', 'minimog' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '30',
	'choices'     => array(
		'0'  => esc_html__( 'None', 'minimog' ),
		'1'  => esc_html__( '1 day', 'minimog' ),
		'2'  => esc_html__( '2 days', 'minimog' ),
		'3'  => esc_html__( '3 days', 'minimog' ),
		'4'  => esc_html__( '4 days', 'minimog' ),
		'5'  => esc_html__( '5 days', 'minimog' ),
		'6'  => esc_html__( '6 days', 'minimog' ),
		'7'  => esc_html__( '7 days', 'minimog' ),
		'8'  => esc_html__( '8 days', 'minimog' ),
		'9'  => esc_html__( '9 days', 'minimog' ),
		'10' => esc_html__( '10 days', 'minimog' ),
		'15' => esc_html__( '15 days', 'minimog' ),
		'20' => esc_html__( '20 days', 'minimog' ),
		'25' => esc_html__( '25 days', 'minimog' ),
		'30' => esc_html__( '30 days', 'minimog' ),
		'60' => esc_html__( '60 days', 'minimog' ),
		'90' => esc_html__( '90 days', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'shop_badge_hot',
	'label'    => esc_html__( 'Hot Badge', 'minimog' ),
	'tooltip'  => esc_html__( 'Show a "hot" label when product set featured.', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'minimog' ),
		'1' => esc_html__( 'Show', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'shop_badge_sale',
	'label'    => esc_html__( 'Sale Badge', 'minimog' ),
	'tooltip'  => esc_html__( 'Show a "sale" or "sale percent" label when product on sale.', 'minimog' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'minimog' ),
		'1' => esc_html__( 'Show', 'minimog' ),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Colors', 'minimog' ) . '</div>',
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_badge_new_color',
	'label'     => esc_html__( 'New Badge Color', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'color'      => esc_attr__( 'Color', 'minimog' ),
		'background' => esc_attr__( 'Background', 'minimog' ),
	),
	'default'   => array(
		'color'      => '#fff',
		'background' => '#50D7E9',
	),
	'output'    => array(
		array(
			'choice'   => 'color',
			'element'  => '.woocommerce .product .product-badges .new',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.woocommerce .product .product-badges .new',
			'property' => 'background-color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_badge_hot_color',
	'label'     => esc_html__( 'Hot Badge Color', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'color'      => esc_attr__( 'Color', 'minimog' ),
		'background' => esc_attr__( 'Background', 'minimog' ),
	),
	'default'   => array(
		'color'      => '#fff',
		'background' => '#F6B500',
	),
	'output'    => array(
		array(
			'choice'   => 'color',
			'element'  => '.woocommerce .product .product-badges .hot',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.woocommerce .product .product-badges .hot',
			'property' => 'background-color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_badge_sale_color',
	'label'     => esc_html__( 'Sale Badge Color', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'color'      => esc_attr__( 'Color', 'minimog' ),
		'background' => esc_attr__( 'Background', 'minimog' ),
	),
	'default'   => array(
		'color'      => '#fff',
		'background' => '#E4573D',
	),
	'output'    => array(
		array(
			'choice'   => 'color',
			'element'  => '.woocommerce .product .product-badges .onsale',
			'property' => 'color',
		),
		array(
			'choice'   => 'background',
			'element'  => '.woocommerce .product .product-badges .onsale',
			'property' => 'background-color',
		),
	),
) );

Minimog_Kirki::add_field( 'theme', array(
	'type'      => 'multicolor',
	'settings'  => 'shop_price_color',
	'label'     => esc_html__( 'Price Color', 'minimog' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'choices'   => array(
		'regular' => esc_attr__( 'Regular Price', 'minimog' ),
		'old'     => esc_attr__( 'Old Price', 'minimog' ),
		'sale'    => esc_attr__( 'Sale Price', 'minimog' ),
		'onsale'  => esc_attr__( 'On Sale', 'minimog' ),
	),
	'default'   => array(
		'regular' => Minimog::PRIMARY_COLOR,
		'old'     => '#ccc',
		'sale'    => Minimog::PRIMARY_COLOR,
		'onsale'  => Minimog::SECONDARY_COLOR,
	),
	'output'    => array(
		array(
			'choice'   => 'regular',
			'element'  => '
			.price,
			.amount,
			.tr-price,
			.woosw-content-item--price
			',
			'property' => 'color',
		),
		array(
			'choice'   => 'old',
			'element'  => '
			.price del,
			del .amount,
			.tr-price del,
			.woosw-content-item--price del
			',
			'property' => 'color',
		),
		array(
			'choice'   => 'sale',
			'element'  => 'ins .amount',
			'property' => 'color',
		),
		array(
			'choice'   => 'onsale',
			'element'  => '
			.product.sale ins, .product.sale ins .amount,
			.single-product .product.sale .entry-summary > .price ins .amount
			',
			'property' => 'color',
		),
	),
) );
