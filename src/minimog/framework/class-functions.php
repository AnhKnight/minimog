<?php
defined( 'ABSPATH' ) || exit;

/**
 * Helper functions.
 *
 * All functions don't need to name prefix because they checked with function_exists.
 */


/**
 * Returns '0'.
 *
 * Useful for returning 0 to filters easily.
 *
 * @return string '0'.
 */
if ( ! function_exists( '__return_zero_string' ) ) {
	function __return_zero_string() {
		return '0';
	}
}

if ( ! function_exists( 'html_class' ) ) {
	function html_class( $class = '' ) {
		$classes = array();

		if ( is_admin_bar_showing() ) {
			$classes[] = 'has-admin-bar';
		}

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'html_class', $classes, $class );

		if ( ! empty( $classes ) ) {
			echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
		}
	}
}

/**
 * Hook in wp 5.2
 * Backwards Compatibility with old versions.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
