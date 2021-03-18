<?php
defined('ABSPATH') || exit;

class Minimog_Child_Functions
{

	public function __construct()
	{
		add_action('wp_footer', array($this, 'demo_options_template'));

		//add_action( 'wp_head', array( $this, 'add_google_analytics' ) );

		add_action('wp_head', array($this, 'add_favicon_for_sites'));
		add_action('admin_head', array($this, 'add_favicon_for_sites'));
		add_action('login_head', array($this, 'add_favicon_for_sites'));
		//add_action( 'wp_footer', array( $this, 'add_sale_banner' ) );

		add_action('minimog_before_add_language_selector_top_bar', [
				$this,
				'add_language_switcher_to_top_bar',
		], 10);

		add_action('minimog_before_add_language_selector_header', [
				$this,
				'add_language_switcher_to_header',
		], 10, 2);

		// Change customize settings for demos purpose.
		add_filter('kirki_values_get_value', array($this, 'change_settings_value'), 11, 2);
	}

	public function add_login_demo_credentials()
	{
		?>
		<div class="credentials-demo-box">
			<div class="credentials-demo-left-box">
				<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/login-image.png' ?>" alt="Login">
			</div>
			<div class="credentials-demo-right-box">
				<p class="heading-color credentials-demo-description">You can use these credentials for demo
					testing:</p>
				<p class="credentials-demo-info">
					Login: <span class="heading-color">demo</span><br/>
					Password: <span class="heading-color">demo123</span>
				</p>
			</div>
		</div>
		<?php
	}

	public function add_google_analytics()
	{
		?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-158702943-2"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}

			gtag('js', new Date());

			gtag('config', 'UA-158702943-2');
		</script>
		<?php
	}

	public function add_sale_banner()
	{
		?>
		<div class="sale-special-intro-price">
			<a href="#" id="close-sale-special-intro-price"><span class="fal fa-times"></span></a>
			<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/first-sale-banner.png'; ?>"
				 alt="Special Intro Price">
		</div>
		<script>
			jQuery(document).ready(function ($) {
				'use strict';

				$('#close-sale-special-intro-price').on('click', function () {
					$(this).parents().first().addClass('hidden')
				});
			});
		</script>
		<?php
	}

	/**
	 *  Change settings per page. Avoid duplicate headers or anythings.
	 *
	 * @param $value
	 * @param $setting
	 *
	 * @return mixed New value.
	 */
	public function change_settings_value($value, $setting)
	{
		$post_id = get_the_ID();

		switch ($setting) {
			// Add background + overlay for mobile menu.
			/*case 'mobile_menu_background':
				if ( isset( $value['background-image'] ) ) {
					$value['background-image'] = MINIMOG_THEME_IMAGE_URI . '/mobile-bg.jpg';
				}
				break;
			case 'mobile_menu_background_overlay':
				$value = 'rgba(63, 58, 100, 0.9)';
				break;*/
			// Turn on cookie notice.
			case 'notice_cookie_enable':
				$value = '1';
				break;
			case 'shop_archive_thumbnail_background':
				$value = '0';
				break;
			case 'top_bar_style_01_text':
			case 'top_bar_style_02_text':
			case 'top_bar_style_03_text':
				$value = '<a href="#" class="top-bar-tag">COVID-19 UPDATE</a>We are open with limited hours and staff.';
				break;
			case 'top_bar_style_04_text':
				$value = '	<a href="#" class="top-bar-tag-04">COVID-19 UPDATE</a>
							<div class="text-04"> We are open with limited hours and staff.</div>';
				break;
			case 'top_bar_style_01_info_list':
			case 'top_bar_style_02_info_list':
				$value = array(
						array(
								'text' => '(+88) - 1990 - 6886',
								'url' => 'tel:+8819906886',
								'icon_class' => '',
						),
						array(
								'text' => esc_html__('Store location', 'minimog'),
								'url' => 'https://www.google.com/maps',
								'icon_class' => '',
						),
				);
				break;
			case 'top_bar_style_03_info_list':
				$value = array(
						array(
								'text' => esc_html__('Store location', 'minimog'),
								'url' => 'https://www.google.com/maps',
								'icon_class' => 'fas fa-map-marker-alt	',
						),
						array(
								'text' => '(+88) - 1990 - 6886',
								'url' => 'tel:+8819906886',
								'icon_class' => 'fas fa-phone',
						),
				);
				break;
			case 'header_style_03_phone_number_text':
				$value = '1800 - 1102';
				break;
			case 'header_style_03_phone_number_link':
				$value = 'tel:18001102';
				break;
			case 'title_bar_home_title':
				$value = 'Latest news are on top all times';
				break;
		}

		return $value;
	}

	/*
	 * Change all color fields in Customize if this page has other color.
	 */
	function change_color_fields($setting, $value, $new_primary_color, $new_secondary_color = '')
	{
		if (!empty($new_primary_color)) {
			switch ($setting) {
				// Color Control.
				case 'primary_color':
				case 'navigation_dropdown_border_bottom_color':
				case 'navigation_minimal_01_item_hover_color':
				case 'navigation_minimal_01_dropdown_link_hover_color':
				case 'pre_loader_shape_color':
					return $new_primary_color;
				// Multi Color Control.
				case 'link_color':
				case 'top_bar_style_01_link_color':
				case 'header_style_04_dark_navigation_link_color':
				case 'header_style_04_dark_header_icon_color':
					$value['hover'] = $new_primary_color;

					return $value;
				case 'button_color':
					$value['border'] = $new_primary_color;
					$value['background'] = $new_primary_color;

					return $value;
				case 'form_input_focus_color':
				case 'header_style_04_dark_search_form_focus_color':
					$value['border'] = $new_primary_color;

					return $value;
				case 'header_style_04_dark_button_custom_color':
					$value['border'] = $new_primary_color;
					$value['background'] = $new_primary_color;

				case 'header_style_04_dark_cart_badge_color':
					$value['background'] = $new_primary_color;

					return $value;
				case 'header_style_04_dark_button_hover_custom_color':
					$value['border'] = $new_primary_color;
					$value['color'] = $new_primary_color;

					return $value;
			}
		}

		if (!empty($new_secondary_color)) {
			switch ($setting) {
				// Color Control.
				case 'secondary_color':
					return $new_secondary_color;
				// Multi Color Control.
				case 'button_hover_color':
					$value['border'] = $new_secondary_color;
					$value['background'] = $new_secondary_color;

					return $value;
			}
		}


		return $value;
	}

	/**
	 * Add WPML language switcher template without install this plugin.
	 */
	function add_language_switcher_to_header($header_type, $enable)
	{
		if (defined('ICL_SITEPRESS_VERSION') || $enable !== '1') {
			return;
		}

		$image_dir = get_stylesheet_directory_uri() . '/assets/images/flags/';
		?>
		<div id="switcher-language-wrapper" class="switcher-language-wrapper">

			<div class="wpml-ls-statics-shortcode_actions wpml-ls wpml-ls-legacy-dropdown js-wpml-ls-legacy-dropdown">
				<ul>

					<li tabindex="0"
						class="wpml-ls-slot-shortcode_actions wpml-ls-item wpml-ls-item-en wpml-ls-current-language wpml-ls-first-item wpml-ls-item-legacy-dropdown">
						<a href="#" class="js-wpml-ls-item-toggle wpml-ls-item-toggle">
							<img class="wpml-ls-flag"
								 src="<?php echo $image_dir . 'en.png'; ?>"
								 alt="en"
								 title="English"><span
									class="wpml-ls-native">English</span>
						</a>

						<ul class="wpml-ls-sub-menu">

							<li class="wpml-ls-slot-shortcode_actions wpml-ls-item wpml-ls-item-fr">
								<a href="#" class="wpml-ls-link">
									<img class="wpml-ls-flag"
										 src="<?php echo $image_dir . 'fr.png'; ?>"
										 alt="fr"
										 title="Français"><span class="wpml-ls-native">Français</span>
								</a>
							</li>
							<li class="wpml-ls-slot-shortcode_actions wpml-ls-item wpml-ls-item-de wpml-ls-last-item">
								<a href="#" class="wpml-ls-link">
									<img class="wpml-ls-flag"
										 src="<?php echo $image_dir . 'de.png'; ?>"
										 alt="de"
										 title="Deutsch"><span class="wpml-ls-native">Deutsch</span>
								</a>
							</li>

						</ul>

					</li>

				</ul>
			</div>

			<script>
				jQuery(document).ready(function ($) {
					$('#switcher-language-wrapper').on('click', 'a', function (e) {
						e.preventDefault();
						alert('The language switcher requires WPML plugin to be installed and activated.');
					});
				});
			</script>
		</div>
		<?php
	}

	/**
	 * Add WPML language switcher template without install this plugin.
	 */
	function add_language_switcher_to_top_bar()
	{
		if (defined('ICL_SITEPRESS_VERSION')) {
			return;
		}

		$image_dir = get_stylesheet_directory_uri() . '/assets/images/flags/';
		?>
		<div id="switcher-language-wrapper" class="switcher-language-wrapper">

			<div class="wpml-ls-statics-shortcode_actions wpml-ls wpml-ls-legacy-dropdown js-wpml-ls-legacy-dropdown">
				<ul>

					<li tabindex="0"
						class="wpml-ls-slot-shortcode_actions wpml-ls-item wpml-ls-item-en wpml-ls-current-language wpml-ls-first-item wpml-ls-item-legacy-dropdown">
						<a href="#" class="js-wpml-ls-item-toggle wpml-ls-item-toggle">
							<span class="wpml-ls-native">English</span>
						</a>

						<ul class="wpml-ls-sub-menu">
							<li class="wpml-ls-slot-shortcode_actions wpml-ls-item wpml-ls-item-fr">
								<a href="#" class="wpml-ls-link">
									<span class="wpml-ls-native">Français</span>
								</a>
							</li>
							<li class="wpml-ls-slot-shortcode_actions wpml-ls-item wpml-ls-item-de wpml-ls-last-item">
								<a href="#" class="wpml-ls-link">
									<span class="wpml-ls-native">Deutsch</span>
								</a>
							</li>

						</ul>

					</li>

				</ul>
			</div>

			<script>
				jQuery(document).ready(function ($) {
					$('#switcher-language-wrapper').on('click', 'a', function (e) {
						e.preventDefault();
						alert('The language switcher requires WPML plugin to be installed and activated.');
					});
				});
			</script>
		</div>
		<?php
	}

	/**
	 * Add favicon for multi sites with select image from Customize.
	 */
	function add_favicon_for_sites()
	{
		$site_icon = get_option('site_icon');

		// Do nothing if site has favicon.
		if ($site_icon === '0') {
			$image_dir = get_stylesheet_directory_uri() . '/assets/images/favicon/';
			?>
			<link rel="icon" href="<?php echo $image_dir . 'favicon-32x32.png'; ?>" sizes="32x32">
			<link rel="icon" href="<?php echo $image_dir . 'favicon-192x192.png'; ?>" sizes="192x192">
			<link rel="apple-touch-icon-precomposed" href="<?php echo $image_dir . 'favicon-180x180.png'; ?>">
			<meta name="msapplication-TileImage" content="<?php echo $image_dir . 'favicon-270x270.png'; ?>">
			<?php
		}
	}

	function demo_options_template()
	{
		// Disable on editor mode.
		if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->preview->is_preview_mode()) {
			return;
		}

		$theme_title = 'Minimog - WooCommerce Theme';
		$theme_description = 'Minimog is our brand new Medical Store WooCommerce Theme with the specialized design for Hospital, Clinics, Medical Suppliers, Medical Stores, Pharmacy Stores, Medicine Store, Health Care Centers, Corona Virus Prevention, and Clinical Laboratory Equipment eCommerce Websites.';
		$support_link = 'https://thememove.ticksy.com/';
		$documentation_link = 'https://document.thememove.com/minimog/';

		$image_dir = get_stylesheet_directory_uri() . '/assets/images/';
		$links = array(
				array(
						'url' => site_url('medical-supplies'),
						'thumbnail' => $image_dir . 'home-medical-supplies.jpg',
						'title' => 'Medical Supplies',
				),
				array(
						'url' => site_url('mega-shop'),
						'thumbnail' => $image_dir . 'home-mega-shop.jpg',
						'title' => 'Mega Shop',
				),
				array(
						'url' => site_url('medical-equipment'),
						'thumbnail' => $image_dir . 'home-medical-equipment.jpg',
						'title' => 'Medical Equipment',
				),
				array(
						'url' => site_url('the-medical-kit'),
						'thumbnail' => $image_dir . 'home-the-medical-kit.jpg',
						'title' => 'The Meical Kit',
				),
				array(
						'url' => site_url('home-5-pharmacy'),
						'thumbnail' => $image_dir . 'home-pharmacy.jpg',
						'title' => 'Pharmacy',
				),
		);
		?>
		<div class="tm-demo-options-wrapper">
			<div class="tm-demo-options-toolbar">
				<?php $toolbar_link_classes = 'hint--bounce hint--left hint--black'; ?>
				<a href="#"
				   class="<?php echo esc_attr($toolbar_link_classes); ?>"
				   id="toggle-quick-options"
				   aria-label="<?php esc_attr_e('Select Demo', 'minimog'); ?>">
					<i class="far fa-ruler-triangle"></i>
				</a>
				<a href="<?php echo esc_url($support_link); ?>"
				   target="_blank"
				   rel="nofollow"
				   class="<?php echo esc_attr($toolbar_link_classes); ?>"
				   aria-label="<?php esc_attr_e('Support Channel', 'minimog'); ?>">
					<i class="far fa-life-ring"></i>
				</a>
				<a href="<?php echo esc_url($documentation_link); ?>"
				   target="_blank"
				   rel="nofollow"
				   class="<?php echo esc_attr($toolbar_link_classes); ?>"
				   aria-label="<?php esc_attr_e('Documentation', 'minimog'); ?>">
					<i class="far fa-book"></i>
				</a>
				<a href="<?php echo esc_url(MINIMOG_DEMO_BUTTON_LINK); ?>"
				   target="_blank"
				   rel="nofollow"
				   class="<?php echo esc_attr($toolbar_link_classes); ?>"
				   aria-label="<?php esc_attr_e('Purchase Minimog', 'minimog'); ?>">
					<i class="far fa-shopping-cart"></i>
				</a>
			</div>
			<div id="tm-demo-panel" class="tm-demo-panel">
				<div class="tm-demo-panel-header">
					<?php if ($theme_title !== ''): ?>
						<h5 class="demo-option-title">
							<?php echo $theme_title; ?>
						</h5>
					<?php endif; ?>

					<?php if ($theme_description !== ''): ?>
						<div class="demo-option-desc">
							<?php echo $theme_description; ?>
						</div>
					<?php endif; ?>

					<a class="tm-button style-flat tm-button-sm tm-button-primary tm-btn-purchase has-icon icon-left"
					   href="<?php echo esc_url(MINIMOG_DEMO_BUTTON_LINK); ?>" target="_blank">
						<span class="button-icon">
							<i class="far fa-shopping-cart"></i>
						</span>
						<span class="button-text">
							<?php esc_html_e('Buy Now', 'minimog'); ?>
						</span>
					</a>
				</div>

				<div class="quick-option-list">
					<?php foreach ($links as $link) : ?>
						<a href="<?php echo $link['url']; ?>"
						   class="hint--bounce hint--top"
						   aria-label="<?php echo esc_attr($link['title']); ?>"
						>
							<img src="<?php echo $link['thumbnail']; ?>"
								 alt="<?php echo $link['title']; ?>"
								 width="150" height="180">
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<script type='text/javascript'>
			jQuery(document).ready(function ($) {
				'use strict';
				$('#toggle-quick-options').on('click', function (e) {
					e.preventDefault();
					$(this).parents('.tm-demo-options-wrapper').toggleClass('open');
				});
			});
		</script>
		<?php
	}
}

new Minimog_Child_Functions();
