<?php
defined( 'ABSPATH' ) || exit;

/**
 * Plugin installation and activation for WordPress themes
 */
if ( ! class_exists( 'Minimog_Register_Plugins' ) ) {
	class Minimog_Register_Plugins {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			add_filter( 'insight_core_tgm_plugins', array( $this, 'register_required_plugins' ) );
		}

		public function register_required_plugins( $plugins ) {
			/*
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$new_plugins = array(
				array(
					'name'     => esc_html__( 'Insight Core', 'minimog' ),
					'slug'     => 'insight-core',
					'source'   => 'https://www.dropbox.com/s/wu2ppdzmhclh9af/insight-core-1.7.5.zip?dl=1',
					'version'  => '1.7.5',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'Elementor', 'minimog' ),
					'slug'     => 'elementor',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'Elementor Pro', 'minimog' ),
					'slug'     => 'elementor-pro',
					'source'   => 'https://www.dropbox.com/s/5p35vr85h9zost5/elementor-pro-3.0.8.zip?dl=1',
					'version'  => '3.0.8',
					'required' => true,
				),
				array(
					'name'    => esc_html__( 'Revolution Slider', 'minimog' ),
					'slug'    => 'revslider',
					'source'  => 'https://www.dropbox.com/s/hgen7cbw9zonskq/revslider-6.3.2.zip?dl=1',
					'version' => '6.3.2',
				),
				array(
					'name' => esc_html__( 'Contact Form 7', 'minimog' ),
					'slug' => 'contact-form-7',
				),
				array(
					'name' => esc_html__( 'MailChimp for WordPress', 'minimog' ),
					'slug' => 'mailchimp-for-wp',
				),
				array(
					'name' => esc_html__( 'WooCommerce', 'minimog' ),
					'slug' => 'woocommerce',
				),
				array(
					'name'    => esc_html__( 'Insight Swatches', 'minimog' ),
					'slug'    => 'insight-swatches',
					'source'  => 'https://www.dropbox.com/s/3mkswh3so7syfg3/insight-swatches-1.1.0.zip?dl=1',
					'version' => '1.1.0',
				),
				array(
					'name'    => esc_html__( 'WooCommerce Brands Pro', 'minimog' ),
					'slug'    => 'woo-brand',
					'source'  => 'https://www.dropbox.com/s/ho41w20iuuluh09/woo-brand-4.4.7.zip?dl=1',
					'version' => '4.4.7',
				),
				array(
					'name' => esc_html__( 'WPC Smart Compare for WooCommerce', 'minimog' ),
					'slug' => 'woo-smart-compare',
				),
				array(
					'name' => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'minimog' ),
					'slug' => 'woo-smart-wishlist',
				),
				array(
					'name' => esc_html__( 'WP-PostViews', 'minimog' ),
					'slug' => 'wp-postviews',
				),
				array(
					'name'    => esc_html__( 'Instagram Feed', 'minimog' ),
					'slug'    => 'elfsight-instagram-feed-cc',
					'source'  => 'https://www.dropbox.com/s/qirwa6skckzuea5/elfsight-instagram-feed-cc-4.0.1.zip?dl=1',
					'version' => '4.0.1',
				),
			);

			$plugins = array_merge( $plugins, $new_plugins );

			return $plugins;
		}

	}

	Minimog_Register_Plugins::instance()->initialize();
}
