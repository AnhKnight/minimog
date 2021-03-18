<?php
/**
 * Theme Customizer
 *
 * @package Minimog
 * @since   1.0
 */

/**
 * Setup configuration
 */
Minimog_Kirki::add_config( 'theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

/**
 * Add sections
 */
$priority = 1;

Minimog_Kirki::add_section( 'layout', array(
	'title'    => esc_html__( 'Site Layout & Background', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'color_', array(
	'title'    => esc_html__( 'Colors', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'typography', array(
	'title'    => esc_html__( 'Typography', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_panel( 'top_bar', array(
	'title'    => esc_html__( 'Top bar', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_panel( 'header', array(
	'title'    => esc_html__( 'Header', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'logo', array(
	'title'       => esc_html__( 'Logo', 'minimog' ),
	'description' => '<div class="desc">
			<strong class="insight-label insight-label-info">' . esc_html__( 'IMPORTANT NOTE: ', 'minimog' ) . '</strong>
			<p>' . esc_html__( 'These settings can be overridden by settings from Page Options Box in separator page.', 'minimog' ) . '</p>
			<p><img src="' . esc_url( MINIMOG_THEME_IMAGE_URI . '/customize/logo-settings.jpg' ) . '" alt="' . esc_attr__( 'logo-settings', 'minimog' ) . '"/></p>
		</div>',
	'priority'    => $priority++,
) );

Minimog_Kirki::add_panel( 'navigation', array(
	'title'    => esc_html__( 'Navigation', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_panel( 'title_bar', array(
	'title'    => esc_html__( 'Page Title Bar & Breadcrumb', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'sidebars', array(
	'title'    => esc_html__( 'Sidebars', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'footer', array(
	'title'    => esc_html__( 'Footer', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'pages', array(
	'title'    => esc_html__( 'Pages', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_panel( 'blog', array(
	'title'    => esc_html__( 'Blog', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_panel( 'portfolio', array(
	'title'    => esc_html__( 'Portfolio', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_panel( 'shop', array(
	'title'    => esc_html__( 'Shop', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'socials', array(
	'title'    => esc_html__( 'Social Networks', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'social_sharing', array(
	'title'    => esc_html__( 'Social Sharing', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_panel( 'search', array(
	'title'    => esc_html__( 'Search & Popup Search', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'error404_page', array(
	'title'    => esc_html__( 'Error 404 Page', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_panel( 'shortcode', array(
	'title'    => esc_html__( 'Shortcodes', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'pre_loader', array(
	'title'    => esc_html__( 'Pre Loader', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_panel( 'advanced', array(
	'title'    => esc_html__( 'Advanced', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'notices', array(
	'title'    => esc_html__( 'Notices', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'settings_preset', array(
	'title'    => esc_html__( 'Preset', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'performance', array(
	'title'    => esc_html__( 'Performance', 'minimog' ),
	'priority' => $priority++,
) );

Minimog_Kirki::add_section( 'custom_js', array(
	'title'    => esc_html__( 'Additional JS', 'minimog' ),
	'priority' => 200,
) );

/**
 * Load panel & section files
 */
require_once MINIMOG_CUSTOMIZER_DIR . '/section-color.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/top-bar/_panel.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/top-bar/general.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/top-bar/style-01.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/header/_panel.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/header/general.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/header/sticky.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/header/more-options.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/header/style-01.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/header/style-02.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/header/style-03.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/header/style-04.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/navigation/_panel.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/navigation/desktop-menu.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/navigation/off-canvas-menu.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/navigation/mobile-menu.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/title-bar/_panel.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/title-bar/general.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/title-bar/style-01.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/section-footer.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/advanced/_panel.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/advanced/advanced.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/advanced/light-gallery.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/section-notices.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/section-pre-loader.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/section-custom-js.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/section-error404.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/section-layout.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/section-logo.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/section-pages.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/blog/_panel.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/blog/archive.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/blog/single.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/portfolio/_panel.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/portfolio/archive.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/portfolio/single.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/shop/_panel.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/shop/general.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/shop/archive.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/shop/single.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/shop/cart.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/search/_panel.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/search/search-page.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/search/search-popup.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/section-preset.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/section-sharing.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/section-sidebars.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/section-socials.php';
require_once MINIMOG_CUSTOMIZER_DIR . '/section-typography.php';

require_once MINIMOG_CUSTOMIZER_DIR . '/section-performance.php';
