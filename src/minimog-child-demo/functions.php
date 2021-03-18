<?php
defined( 'ABSPATH' ) || exit;

define( 'MINIMOG_DEMO_BUTTON_TEXT', 'Purchase $49' );
define( 'MINIMOG_DEMO_BUTTON_LINK', 'https://themeforest.net/item/minimog-medical-woocommerce-theme/26538545' );
define( 'MINIMOG_DEMO_BUTTON_LINK_TARGET', '1' );

/**
 * Enqueue scripts for child theme
 */
function minimog_child_demo_enqueue_scripts() {
	wp_enqueue_style( 'minimog-child-demo-style', get_stylesheet_directory_uri() . '/style.css' );

	// Enqueue BS Script for Dev.
	$domain = wp_parse_url( get_stylesheet_directory_uri() );
	$host   = $domain['host'];

	if ( ( $host === 'localhost'||strpos($host ,'.local')!==false) && ( ! class_exists( '\Elementor\Plugin' ) || ( class_exists( '\Elementor\Plugin' ) && ! \Elementor\Plugin::$instance->preview->is_preview_mode() ) ) ) {
		//if ( $host === 'dungnv.local' ) {
		$url = sprintf( 'http://%s:3000/browser-sync/browser-sync-client.js', $host );
		$ch  = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		$header = curl_exec( $ch );
		curl_close( $ch );
		if ( $header && strpos( $header[0], '400' ) === false ) {
			wp_enqueue_script( '__bs_script__', $url, array(), null, true );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'minimog_child_demo_enqueue_scripts', 15 );

require_once get_stylesheet_directory() . '/inc/class-functions.php';

remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'wp_generator' );

// Remove https://api.w.org/
remove_action( 'wp_head', 'rest_output_link_header', 10 );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

add_filter( 'revslider_meta_generator', 'minimog_child_demo_remove_revslider_meta_tag' );
function minimog_child_demo_remove_revslider_meta_tag() {
	return '';
}

// Remove type attribute from script and style tags added by WordPress.
add_action( 'wp_loaded', 'minimog_child_demo_output_buffer_start' );
function minimog_child_demo_output_buffer_start() {
	ob_start( 'minimog_child_demo_output_callback' );
}

add_action( 'shutdown', 'minimog_child_demo_output_buffer_end' );
function minimog_child_demo_output_buffer_end() {
	if ( ob_get_length() ) {
		ob_end_flush();
	}
}

function minimog_child_demo_output_callback( $buffer ) {
	return preg_replace( "%[ ]type=[\'\"]text\/(javascript|css)[\'\"]%", '', $buffer );
}

// Remove Recent Comments wp_head CSS
add_action( 'widgets_init', 'minimog_child_demo_remove_recent_comments_style' );
function minimog_child_demo_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style',
	) );
}

add_filter( 'insight_core_tgm_plugins', 'minimog_child_demo_register_required_plugins', 11 );

function minimog_child_demo_register_required_plugins( $plugins ) {
	$new_plugins = array(
		array(
			'name' => esc_html__( 'Debug Bar', 'minimog' ),
			'slug' => 'debug-bar',
		),
		array(
			'name' => esc_html__( 'Kint Debugger', 'minimog' ),
			'slug' => 'kint-debugger',
		),
		array(
			'name' => esc_html__( 'Quick Featured Images', 'minimog' ),
			'slug' => 'quick-featured-images',
		),
		array(
			'name' => esc_html__( 'Duplicate Post', 'minimog' ),
			'slug' => 'duplicate-post',
		),
		array(
			'name' => esc_html__( 'Customizer Reset', 'minimog' ),
			'slug' => 'customizer-reset-by-wpzoom',
		),
		array(
			'name'    => esc_html__( 'WP Sync DB', 'minimog' ),
			'slug'    => 'wp-sync-db',
			'source'  => get_stylesheet_directory() . '/plugins/wp-sync-db.zip',
			'version' => '1.5',
		),
	);

	$plugins = array_merge( $plugins, $new_plugins );

	return $plugins;
}

add_filter( 'jpeg_quality', 'minimog_child_demo_change_image_quality' );

function minimog_child_demo_change_image_quality() {
	return 80;
}
