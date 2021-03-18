<?php
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue child scripts
 */
if ( ! function_exists( 'minimog_child_enqueue_scripts' ) ) {
	function minimog_child_enqueue_scripts() {
		wp_enqueue_style( 'minimog-child-style', get_stylesheet_directory_uri() . '/style.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'minimog_child_enqueue_scripts', 15 );
