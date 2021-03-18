<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Minimog_Notices' ) ) {

	class Minimog_Notices {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			// Notice Cookie Confirm.
			add_action( 'wp_ajax_notice_cookie_confirm', array( $this, 'notice_cookie_confirm' ) );
			add_action( 'wp_ajax_nopriv_notice_cookie_confirm', array( $this, 'notice_cookie_confirm' ) );
		}

		public function notice_cookie_confirm() {
			setcookie( 'notice_cookie_confirm', 'yes', time() + 365 * 86400, COOKIEPATH, COOKIE_DOMAIN );

			wp_die();
		}

		function get_notice_cookie_messages() {
			$messages    = Minimog::setting( 'notice_cookie_messages' );
			$button_text = Minimog::setting( 'notice_cookie_button_text' );

			$messages .= '<a id="tm-button-cookie-notice-ok" class="tm-button tm-button-xs tm-button-full-wide style-flat">' . $button_text . '</a>';

			return $messages;
		}
	}

	Minimog_Notices::instance()->initialize();
}
