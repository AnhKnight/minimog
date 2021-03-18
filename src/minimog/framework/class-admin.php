<?php
defined( 'ABSPATH' ) || exit;

// Do nothing if not an admin page.
if ( ! is_admin() ) {
	return;
}

/**
 * Hook & filter that run only on admin pages.
 */
if ( ! class_exists( 'Minimog_Admin' ) ) {
	class Minimog_Admin {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			add_action( 'after_switch_theme', array( $this, 'count_switch_time' ), 1 );

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			add_action( 'enqueue_block_editor_assets', array( $this, 'gutenberg_editor' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_widgets_scripts' ) );
		}

		/**
		 * Enqueue scrips & styles.
		 *
		 * @access public
		 */
		public function enqueue_widgets_scripts() {
			$screen = get_current_screen();

			if ( $screen->id === 'widgets' ) {
				wp_enqueue_media();
				wp_enqueue_script( 'minimog-media', MINIMOG_THEME_URI . '/assets/admin/js/attach.js', array( 'jquery' ), null, true );
			}
		}

		public function gutenberg_editor() {
			/**
			 * Enqueue fonts for gutenberg editor.
			 */
			wp_enqueue_style( 'font-cerebrisans', Minimog::PRIMARY_FONT_URL, null, null );
		}

		public function count_switch_time() {
			$count = get_option( 'minimog_switch_theme_count' );

			if ( $count ) {
				$count++;
			} else {
				$count = 1;
			}

			update_option( 'minimog_switch_theme_count', $count );
		}

		/**
		 * Enqueue scrips & styles.
		 *
		 * @access public
		 */
		function enqueue_scripts() {
			$this->enqueue_fonts_for_rev_slider_page();

			wp_enqueue_style( 'minimog-admin', MINIMOG_THEME_URI . '/assets/admin/css/style.min.css' );
		}

		/**
		 * Enqueue fonts for Rev Slider edit page.
		 */
		function enqueue_fonts_for_rev_slider_page() {
			$screen = get_current_screen();

			if ( 'toplevel_page_revslider' !== $screen->base ) {
				return;
			}

			$typo_fields = array(
				'typography_body',
				'typography_heading',
				'button_typography',
			);

			if ( ! is_array( $typo_fields ) || empty( $typo_fields ) ) {
				return;
			}

			foreach ( $typo_fields as $field ) {
				$value = Minimog::setting( $field );

				if ( is_array( $value ) && ! empty( $value['font-family'] ) ) {
					switch ( $value['font-family'] ) {
						case Minimog::PRIMARY_FONT:
							wp_enqueue_style( 'font-cerebrisans', Minimog::PRIMARY_FONT_URL, null, null );
							break;
						case Minimog::SECONDARY_FONT:
							wp_enqueue_style( 'font-circular-std', Minimog::SECONDARY_FONT_URL, null, null );
							break;
						default:
							do_action( 'minimog_enqueue_custom_font', $value['font-family'] ); // hook to custom do enqueue fonts
							break;
					}
				}
			}
		}
	}

	Minimog_Admin::instance()->initialize();
}
