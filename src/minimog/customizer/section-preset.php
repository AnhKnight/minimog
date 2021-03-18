<?php
$section  = 'settings_preset';
$priority = 1;
$prefix   = 'settings_preset_';

Minimog_Kirki::add_field( 'theme', array(
	'type'     => 'preset',
	'settings' => 'settings_preset',
	'label'    => esc_html__( 'Settings Preset', 'minimog' ),
	'section'  => $section,
	'default'  => '-1',
	'priority' => $priority++,
	'multiple' => 0,
	'choices'  => array(
		'-1'  => array(
			'label'    => esc_html__( 'None', 'minimog' ),
			'settings' => [],
		),
		'rtl' => array(
			'label'    => esc_html__( 'RTL', 'minimog' ),
			'settings' => [
				'typography_body' => [
					'font-family'    => 'Cairo',
					'variant'        => '400',
					'font-size'      => '15px',
					'line-height'    => '1.74',
					'letter-spacing' => '0em',
				],
			],
		),
	),
) );
