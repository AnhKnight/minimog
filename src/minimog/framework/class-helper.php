<?php
defined( 'ABSPATH' ) || exit;

/**
 * Helper functions
 */
if ( ! class_exists( 'Minimog_Helper' ) ) {
	class Minimog_Helper {

		static $preloader_style = array();

		function __construct() {
			self::$preloader_style = array(
				'rotating-plane'  => esc_attr__( 'Rotating Plane', 'minimog' ),
				'double-bounce'   => esc_attr__( 'Double Bounce', 'minimog' ),
				'three-bounce'    => esc_attr__( 'Three Bounce', 'minimog' ),
				'wave'            => esc_attr__( 'Wave', 'minimog' ),
				'wandering-cubes' => esc_attr__( 'Wandering Cubes', 'minimog' ),
				'pulse'           => esc_attr__( 'Pulse', 'minimog' ),
				'chasing-dots'    => esc_attr__( 'Chasing dots', 'minimog' ),
				'circle'          => esc_attr__( 'Circle', 'minimog' ),
				'cube-grid'       => esc_attr__( 'Cube Grid', 'minimog' ),
				'fading-circle'   => esc_attr__( 'Fading Circle', 'minimog' ),
				'folding-cube'    => esc_attr__( 'Folding Cube', 'minimog' ),
				'gif-image'       => esc_attr__( 'Gif Image', 'minimog' ),
			);
		}

		public static function e( $var = '' ) {
			echo "{$var}";
		}

		public static function get_preloader_list() {
			$list = self::$preloader_style + array( 'random' => esc_attr__( 'Random', 'minimog' ) );

			return $list;
		}

		public static function get_post_meta( $name, $default = false ) {
			global $minimog_page_options;

			if ( $minimog_page_options != false && isset( $minimog_page_options[ $name ] ) ) {
				return $minimog_page_options[ $name ];
			}

			return $default;
		}

		public static function get_the_post_meta( $options, $name, $default = false ) {
			if ( $options != false && isset( $options[ $name ] ) ) {
				return $options[ $name ];
			}

			return $default;
		}

		/**
		 * @return array
		 */
		public static function get_list_revslider() {
			global $wpdb;
			$revsliders = array(
				'' => esc_attr__( 'Select a slider', 'minimog' ),
			);

			if ( function_exists( 'rev_slider_shortcode' ) ) {

				$table_name = $wpdb->prefix . 'revslider_sliders';
				$query      = $wpdb->prepare( "SELECT * FROM $table_name WHERE type != %s ORDER BY title ASC", 'template' );
				$results    = $wpdb->get_results( $query );
				if ( ! empty( $results ) ) {
					foreach ( $results as $result ) {
						$revsliders[ $result->alias ] = $result->title;
					}
				}
			}

			return $revsliders;
		}

		/**
		 * @param bool $default_option
		 *
		 * @return array
		 */
		public static function get_registered_sidebars( $default_option = false, $empty_option = true ) {
			global $wp_registered_sidebars;
			$sidebars = array();
			if ( $empty_option === true ) {
				$sidebars['none'] = esc_html__( 'No Sidebar', 'minimog' );
			}
			if ( $default_option === true ) {
				$sidebars['default'] = esc_html__( 'Default', 'minimog' );
			}
			foreach ( $wp_registered_sidebars as $sidebar ) {
				$sidebars[ $sidebar['id'] ] = $sidebar['name'];
			}

			return $sidebars;
		}

		/**
		 * Get list sidebar positions
		 *
		 * @return array
		 */
		public static function get_list_sidebar_positions( $default = false ) {
			$positions = array(
				'left'  => esc_html__( 'Left', 'minimog' ),
				'right' => esc_html__( 'Right', 'minimog' ),
			);


			if ( $default === true ) {
				$positions['default'] = esc_html__( 'Default', 'minimog' );
			}

			return $positions;
		}

		/**
		 * Get content of file
		 *
		 * @param string $path
		 *
		 * @return mixed
		 */
		static function get_file_contents( $path = '' ) {
			$content = '';
			if ( $path !== '' ) {
				global $wp_filesystem;

				require_once ABSPATH . '/wp-admin/includes/file.php';
				WP_Filesystem();

				if ( file_exists( $path ) ) {
					$content = $wp_filesystem->get_contents( $path );
				}
			}

			return $content;
		}

		public static function strposa( $haystack, $needle, $offset = 0 ) {
			if ( ! is_array( $needle ) ) {
				$needle = array( $needle );
			}
			foreach ( $needle as $query ) {
				if ( strpos( $haystack, $query, $offset ) !== false ) {
					return true;
				} // stop on first true result
			}

			return false;
		}

		public static function w3c_iframe( $iframe ) {
			$iframe = str_replace( 'frameborder="0"', '', $iframe );
			$iframe = str_replace( 'frameborder="no"', '', $iframe );
			$iframe = str_replace( 'scrolling="no"', '', $iframe );
			$iframe = str_replace( 'gesture="media"', '', $iframe );
			$iframe = str_replace( 'allow="encrypted-media"', '', $iframe );

			return $iframe;
		}

		public static function get_md_media_query() {
			return '@media (max-width: 1199px)';
		}

		public static function get_sm_media_query() {
			return '@media (max-width: 991px)';
		}

		public static function get_xs_media_query() {
			return '@media (max-width: 767px)';
		}

		public static function get_body_font() {
			$font = Minimog::setting( 'typography_body' );

			if ( isset( $font['font-family'] ) ) {
				return "{$font['font-family']} Helvetica, Arial, sans-serif";
			}

			return 'Helvetica, Arial, sans-serif';
		}

		/**
		 * Check search page has results
		 *
		 * @return boolean true if has any results
		 */
		public static function is_search_has_results() {
			if ( is_search() ) {
				global $wp_query;
				$result = ( 0 != $wp_query->found_posts ) ? true : false;

				return $result;
			}

			return 0 != $GLOBALS['wp_query']->found_posts;
		}

		public static function get_button_typography_css_selector() {
			return '
				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.wp-block-button__link,
				.rev-btn,
				.tm-button,
				.button,
				.elementor-button
				';
		}

		public static function get_button_css_selector() {
			return '
				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.wp-block-button__link,
				.button,
				.elementor-button
				';
		}

		public static function get_button_hover_css_selector() {
			return '
				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				.wp-block-button__link:hover,
				.button:hover,
				.button:focus,
				.elementor-button:hover
				';
		}

		public static function get_form_input_css_selector() {
			return "
			input[type='text'],
			input[type='email'],
			input[type='url'],
			input[type='password'],
			input[type='search'],
			input[type='number'],
			input[type='tel'],
			select,
			textarea,
			.woocommerce .select2-container--default .select2-selection--single,
			.woocommerce .select2-container--default .select2-search--dropdown .select2-search__field,
			.elementor-field-group .elementor-field-textual
		";
		}

		public static function get_form_input_focus_css_selector() {
			return "
			input[type='text']:focus,
			input[type='email']:focus,
			input[type='url']:focus,
			input[type='password']:focus,
			input[type='search']:focus,
			input[type='number']:focus,
			input[type='tel']:focus,
			textarea:focus, select:focus,
			select:focus,
			textarea:focus,
			.woocommerce .select2-container--default .select2-search--dropdown .select2-search__field:focus,
			.woocommerce .select2-container--open.select2-container--default .select2-selection--single,
			.woocommerce .select2-container--open.select2-container--default .select2-dropdown,
			.elementor-field-group .elementor-field-textual:focus
		";
		}

		public static function is_page_template( $template_file ) {
			$template_full = 'templates/' . $template_file;

			return is_page_template( $template_full );
		}
	}

	new Minimog_Helper();
}
