<?php
defined( 'ABSPATH' ) || exit;

/**
 * Initial OneClick import for this theme
 */
if ( ! class_exists( 'Minimog_Import' ) ) {
	class Minimog_Import {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			add_filter( 'insight_core_import_demos', array( $this, 'import_demos' ) );
			add_filter( 'insight_core_import_generate_thumb', array( $this, 'generate_thumbnail' ) );
		}

		public function import_demos() {
			$import_img_url = MINIMOG_THEME_URI . '/assets/import';

			return array(
				'main' => array(
					'screenshot' => MINIMOG_THEME_URI . '/screenshot.jpg',
					'name'       => esc_html__( 'Main', 'minimog' ),
					'url'        => 'https://www.dropbox.com/s/yv8s7jotcnq5ksy/minimog-insightcore-main-1.2.3.zip?dl=1',
				),
				'02' => array(
					'screenshot' => MINIMOG_THEME_URI . '/screenshot.jpg',
					'name'       => esc_html__( 'Minimog -Version-1.2.5', 'minimog' ),
					'url'        => 'https://www.dropbox.com/s/s7dr7bhf1dc51r9/minimog-insightcore-main-1.2.5.zip?dl=1',
				),
			);
		}

		/**
		 * Generate thumbnail while importing
		 */
		function generate_thumbnail() {
			return false;
		}
	}

	Minimog_Import::instance()->initialize();
}
