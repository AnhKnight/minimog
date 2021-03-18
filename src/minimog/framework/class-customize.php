<?php
defined( 'ABSPATH' ) || exit;

/**
 * Setup for customizer of this theme
 */
if ( ! class_exists( 'Minimog_Customize' ) ) {
	class Minimog_Customize {

		protected static $instance = null;

		protected static $override_settings = array();

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			// Build URL for customizer.
			add_filter( 'kirki_values_get_value', array( $this, 'kirki_db_get_theme_mod_value' ), 10, 2 );

			add_filter( 'kirki_theme_stylesheet', array( $this, 'change_inline_stylesheet' ), 10, 3 );

			add_filter( 'kirki_load_fontawesome', '__return_false' );

			// Disable Telemetry module.
			add_filter( 'kirki_telemetry', '__return_false' );

			// Remove unused native sections and controls.
			add_action( 'customize_register', array( $this, 'remove_customizer_sections' ) );

			// Add custom font to font select
			add_filter( 'kirki_fonts_standard_fonts', array( $this, 'add_custom_font' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_custom_font_css' ) );

			// Load customizer sections when all widgets init.
			add_action( 'init', array( $this, 'load_customizer' ), 99 );

			add_action( 'customize_controls_init', array(
				$this,
				'customize_preview_css',
			) );

			/**
			 * Override kirki settings with url preset or post meta preset.
			 * Used priority 11 to wait global variables loaded.
			 *
			 * @see Minimog_Global->init_global_variable()
			 */
			add_action( 'wp', array( $this, 'setup_override_settings' ), 11 );
		}

		function setup_override_settings() {
			// Make preset in meta box.
			if ( ! is_customize_preview() ) {
				$presets = apply_filters( 'minimog_page_meta_box_presets', array() );

				if ( ! empty( $presets ) ) {
					foreach ( $presets as $preset ) {
						$page_preset_value = Minimog_Helper::get_post_meta( $preset );
						if ( $page_preset_value !== false ) {
							$_GET[ $preset ] = $page_preset_value;
						}
					}
				}
			}

			// Setup url.
			if ( empty( self::$override_settings ) ) {

				/**
				 * Use child theme selected preset for any demos.
				 */
				$selected_presets = apply_filters( 'minimog_settings_preset', array() );
				if ( ! empty( $selected_presets ) ) {
					foreach ( $selected_presets as $key => $selected_preset ) {
						$_GET[ $key ] = $selected_preset;
					}
				}

				if ( ! empty( $_GET ) ) {

					foreach ( $_GET as $key => $query_value ) {
						if ( class_exists( 'Kirki' ) && ! empty( Kirki::$fields[ $key ] ) ) {

							if ( is_array( Kirki::$fields[ $key ] ) &&
							     ( in_array( Kirki::$fields[ $key ]['type'], [
								     'kirki-preset',
								     'kirki-select',
							     ] ) ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'] ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'][ $query_value ] ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'][ $query_value ]['settings'] )
							) {
								$field_choice = Kirki::$fields[ $key ]['args']['choices'];
								foreach ( $field_choice[ $query_value ]['settings'] as $kirki_setting => $kirki_value ) {
									self::$override_settings[ $kirki_setting ] = $kirki_value;
								}
							} else {
								self::$override_settings[ $key ] = $query_value;
							}
						}
					}
				}
			}
		}

		/**
		 * Build URL for customizer
		 *
		 * @param $value
		 * @param $setting
		 *
		 * @return mixed
		 */
		public function kirki_db_get_theme_mod_value( $value, $setting ) {
			if ( ! is_customize_preview() && ! empty( self::$override_settings ) && isset( self::$override_settings["{$setting}"] ) ) {
				return self::$override_settings["{$setting}"];
			}

			return $value;
		}

		public function change_inline_stylesheet() {
			return 'minimog-style';
		}

		function add_custom_font( $fonts ) {
			$fonts['CerebriSans'] = [
				'label'    => 'CerebriSans',
				'variants' => [
					'regular',
					500,
					600,
					700,
				],
				'stack'    => 'CerebriSans, sans-serif',
			];

			return $fonts;
		}

		function add_custom_font_css() {
			$typo_fields = Minimog_Kirki::get_typography_fields_id();

			if ( ! is_array( $typo_fields ) || empty( $typo_fields ) ) {
				return;
			}

			foreach ( $typo_fields as $field ) {
				$value = Minimog::setting( $field );

				if ( is_array( $value ) && isset( $value['font-family'] ) && $value['font-family'] !== '' ) {
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

		/**
		 * Add customize preview css
		 */
		public function customize_preview_css() {
			wp_enqueue_style( 'kirki-custom-css', MINIMOG_THEME_URI . '/assets/admin/css/customizer.min.css' );
		}

		/**
		 * Load Customizer.
		 */
		public function load_customizer() {
			require_once MINIMOG_CUSTOMIZER_DIR . '/customizer.php';
		}

		/**
		 * Remove unused native sections and controls
		 *
		 * @param WP_Customize_Manager $wp_customize
		 */
		public function remove_customizer_sections( $wp_customize ) {
			$wp_customize->remove_section( 'nav' );
			$wp_customize->remove_section( 'colors' );
			$wp_customize->remove_section( 'background_image' );
			$wp_customize->remove_section( 'header_image' );

			$wp_customize->get_section( 'title_tagline' )->priority = '100';

			$wp_customize->remove_control( 'blogdescription' );
			$wp_customize->remove_control( 'display_header_text' );
		}

		function field_social_networks_enable( $args = array() ) {
			$defaults = array(
				'type'        => 'radio-buttonset',
				'label'       => esc_html__( 'Social Networks', 'minimog' ),
				'description' => '<a href="javascript:wp.customize.section( \'socials\' ).focus();">' . esc_html__( 'Edit social network links', 'minimog' ) . '</a>',
				'default'     => '0',
				'choices'     => array(
					'0' => esc_html__( 'Hide', 'minimog' ),
					'1' => esc_html__( 'Show', 'minimog' ),
				),
			);

			$args = wp_parse_args( $args, $defaults );

			Minimog_Kirki::add_field( 'theme', $args );
		}

		function field_social_sharing_enable( $args = array() ) {
			$defaults = array(
				'type'        => 'radio-buttonset',
				'label'       => esc_html__( 'Sharing', 'minimog' ),
				'description' => '<a href="javascript:wp.customize.section( \'social_sharing\' ).focus();">' . esc_html__( 'Edit social sharing list', 'minimog' ) . '</a>',
				'choices'     => array(
					'0' => esc_html__( 'Hide', 'minimog' ),
					'1' => esc_html__( 'Show', 'minimog' ),
				),
			);

			$args = wp_parse_args( $args, $defaults );

			Minimog_Kirki::add_field( 'theme', $args );
		}

		function field_language_switcher_enable( $args = array() ) {
			$defaults = array(
				'type'        => 'radio-buttonset',
				'label'       => esc_html__( 'Language Switcher', 'minimog' ),
				'description' => '',
				'choices'     => array(
					'0' => esc_html__( 'Hide', 'minimog' ),
					'1' => esc_html__( 'Show', 'minimog' ),
				),
				'default'     => '0',
			);

			$args = wp_parse_args( $args, $defaults );

			Minimog_Kirki::add_field( 'theme', $args );
		}
	}

	Minimog_Customize::instance()->initialize();
}
