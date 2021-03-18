<?php

namespace Minimog_Elementor;

use Elementor\Plugin;

defined( 'ABSPATH' ) || exit;

class Widget_Init {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function initialize() {
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

		// Registered Widgets.
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		//add_action( 'elementor/widgets/widgets_registered', [ $this, 'remove_unwanted_widgets' ], 15 );

		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'after_register_scripts' ] );
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'after_register_styles' ] );

		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );

		add_filter( 'elementor/utils/get_the_archive_title', [ $this, 'change_portfolio_archive_title' ] );

		// Modify original widgets settings.
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/original/modify-base.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/original/section.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/original/column.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/original/accordion.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/original/animated-headline.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/original/counter.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/original/form.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/original/heading.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/original/icon-box.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/original/progress.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/original/countdown.php';
	}

	/**
	 * Register scripts for widgets.
	 */
	public function after_register_scripts() {
		// Fix Wordpress old version not registered this script.
		if ( ! wp_script_is( 'imagesloaded', 'registered' ) ) {
			wp_register_script( 'imagesloaded', MINIMOG_THEME_URI . '/assets/libs/imagesloaded/imagesloaded.min.js', array( 'jquery' ), null, true );
		}

		wp_register_script( 'circle-progress', MINIMOG_THEME_URI . '/assets/libs/circle-progress/circle-progress.min.js', array( 'jquery' ), null, true );
		wp_register_script( 'minimog-widget-circle-progress', MINIMOG_ELEMENTOR_URI . '/assets/js/widgets/widget-circle-progress.js', array(
			'jquery',
			'circle-progress',
		), null, true );

		wp_register_script( 'minimog-swiper-wrapper', MINIMOG_THEME_URI . '/assets/js/swiper-wrapper.js', array( 'swiper' ), MINIMOG_THEME_VERSION, true );
		wp_register_script( 'minimog-group-widget-carousel', MINIMOG_ELEMENTOR_URI . '/assets/js/widgets/group-widget-carousel.js', array(
			'jquery',
			'swiper',
			'minimog-swiper-wrapper',
		), null, true );
		$minimog_swiper_js = array(
			'prevText' => esc_html__( 'Prev', 'minimog' ),
			'nextText' => esc_html__( 'Next', 'minimog' ),
		);
		wp_localize_script( 'minimog-swiper-wrapper', '$minimogSwiper', $minimog_swiper_js );

		wp_register_script( 'isotope-masonry', MINIMOG_THEME_URI . '/assets/libs/isotope/js/isotope.pkgd.js', array( 'jquery' ), MINIMOG_THEME_VERSION, true );
		wp_register_script( 'isotope-packery', MINIMOG_THEME_URI . '/assets/libs/packery-mode/packery-mode.pkgd.js', array( 'jquery' ), MINIMOG_THEME_VERSION, true );

		wp_register_script( 'minimog-grid-layout', MINIMOG_THEME_ASSETS_URI . '/js/grid-layout.js', array(
			'jquery',
			'imagesloaded',
			'matchheight',
			'isotope-masonry',
			'isotope-packery',
		), null, true );
		wp_register_script( 'minimog-grid-query', MINIMOG_ELEMENTOR_URI . '/assets/js/widgets/grid-query.js', array( 'jquery' ), null, true );

		wp_register_script( 'minimog-widget-grid-post', MINIMOG_ELEMENTOR_URI . '/assets/js/widgets/widget-grid-post.js', array( 'minimog-grid-layout' ), null, true );
		wp_register_script( 'minimog-group-widget-grid', MINIMOG_ELEMENTOR_URI . '/assets/js/widgets/group-widget-grid.js', array( 'minimog-grid-layout' ), null, true );

		wp_register_script( 'minimog-widget-google-map', MINIMOG_ELEMENTOR_URI . '/assets/js/widgets/widget-google-map.js', array( 'jquery' ), null, true );

		wp_register_script( 'vivus', MINIMOG_ELEMENTOR_URI . '/assets/libs/vivus/vivus.js', array( 'jquery' ), null, true );
		wp_register_script( 'minimog-widget-icon-box', MINIMOG_ELEMENTOR_URI . '/assets/js/widgets/widget-icon-box.js', array(
			'jquery',
			'vivus',
		), null, true );

		wp_register_script( 'minimog-widget-flip-box', MINIMOG_ELEMENTOR_URI . '/assets/js/widgets/widget-flip-box.js', array(
			'jquery',
			'imagesloaded',
		), null, true );

		wp_register_script( 'minimog-widget-accordion', MINIMOG_ELEMENTOR_URI . '/assets/js/widgets/widget-accordion.js', array(
			'jquery',
		), null, true );

		wp_register_script( 'minimog-widget-gallery-justified-content', MINIMOG_ELEMENTOR_URI . '/assets/js/widgets/widget-gallery-justified-content.js', array(
			'justifiedGallery',
		), null, true );

		wp_register_script( 'countdown', MINIMOG_ELEMENTOR_URI . '/assets/libs/jquery.countdown/js/jquery.countdown.min.js', array( 'jquery' ), MINIMOG_THEME_VERSION, true );
		wp_register_script( 'minimog-product-carousel-countdown', MINIMOG_ELEMENTOR_URI . '/assets/js/widgets/widget-product-carousel-countdown.js', array(
			'jquery',
			'swiper',
			'minimog-swiper-wrapper',
			'countdown',
		), null, true );
	}

	/**
	 * enqueue scripts in editor mode.
	 */
	public function enqueue_editor_scripts() {
		wp_enqueue_script( 'minimog-elementor-editor', MINIMOG_ELEMENTOR_URI . '/assets/js/editor.js', array( 'jquery' ), null, true );
	}

	/**
	 * Register styles for widgets.
	 */
	public function after_register_styles() {

	}

	/**
	 * @param \Elementor\Elements_Manager $elements_manager
	 *
	 * Add category.
	 */
	function add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category( 'minimog', [
			'title' => esc_html__( 'By Minimog', 'minimog' ),
			'icon'  => 'fa fa-plug',
		] );
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since  1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files.
		require_once MINIMOG_ELEMENTOR_DIR . '/module-query.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/base.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/form/form-base.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/posts/posts-base.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/products/products-base.php';

		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/carousel/carousel-base.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/carousel/posts-carousel-base.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/carousel/static-carousel.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/carousel/product-widget.php';

		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/accordion.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/button.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/circle-progress-chart.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/google-map.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/heading.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/icon.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/icon-box.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/image-box.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/image-layers.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/image-gallery.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/gallery-justified-content.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/banner.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/banner-categories.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/shapes.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/flip-box.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/attribute-list.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/gradation.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/timeline.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/list.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/pricing-table.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/twitter.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/team-member.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/social-networks.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/popup-video.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/separator.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/table.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/full-page.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/portfolio-details.php';

		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/grid/grid-base.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/grid/static-grid.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/grid/client-logo.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/grid/view-demo.php';

		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/posts/blog.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/posts/portfolio.php';

		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/testimonial-grid.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/carousel/testimonial-carousel.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/testimonial-advanced.php';

		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/carousel/team-member-carousel.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/carousel/portfolio-carousel.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/carousel/image-carousel.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/carousel/modern-carousel.php';
		require_once MINIMOG_ELEMENTOR_DIR . '/widgets/carousel/modern-slider.php';

		// Register Widgets.
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Accordion() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Button() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Client_Logo() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Circle_Progress_Chart() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Google_Map() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Heading() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Icon() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Icon_Box() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Image_Box() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Image_Layers() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Image_Gallery() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Image_Carousel() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Gallery_Justified_Content() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Banner() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Banner_Categories() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Product_Widget() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Shapes() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Modern_Carousel() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Modern_Slider() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Flip_Box() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Blog() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Portfolio() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Portfolio_Carousel() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Portfolio_Details() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Attribute_List() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_List() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Gradation() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Timeline() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Pricing_Table() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Twitter() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Team_Member() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Team_Member_Carousel() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Testimonial_Carousel() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Testimonial_Grid() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Testimonial_Advanced() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Social_Networks() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Popup_Video() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Separator() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Table() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_Full_Page() );
		Plugin::instance()->widgets_manager->register_widget_type( new Widget_View_Demo() );

		/**
		 * Include & Register Dependency Widgets.
		 */

		if ( \Minimog_Woo::instance()->is_activated() ) {
			require_once MINIMOG_ELEMENTOR_DIR . '/widgets/posts/product.php';
			require_once MINIMOG_ELEMENTOR_DIR . '/widgets/posts/product-list.php';
			require_once MINIMOG_ELEMENTOR_DIR . '/widgets/carousel/product-carousel.php';
			require_once MINIMOG_ELEMENTOR_DIR . '/widgets/carousel/product-carousel-countdown.php';
			require_once MINIMOG_ELEMENTOR_DIR . '/widgets/product-banner.php';
			require_once MINIMOG_ELEMENTOR_DIR . '/widgets/product-categories.php';
			require_once MINIMOG_ELEMENTOR_DIR . '/widgets/grid/product-brands.php';

			require_once MINIMOG_ELEMENTOR_DIR . '/widgets/products/product-shop.php';

			Plugin::instance()->widgets_manager->register_widget_type( new Widget_Product_Banner() );
			Plugin::instance()->widgets_manager->register_widget_type( new Widget_Product() );
			Plugin::instance()->widgets_manager->register_widget_type( new Widget_Product_List() );
			Plugin::instance()->widgets_manager->register_widget_type( new Widget_Product_Carousel() );
			Plugin::instance()->widgets_manager->register_widget_type( new Widget_Product_Carousel_Countdown() );
			Plugin::instance()->widgets_manager->register_widget_type( new Widget_Product_Categories() );
			Plugin::instance()->widgets_manager->register_widget_type( new Widget_Product_Brands() );

			Plugin::instance()->widgets_manager->register_widget_type( new Widget_Product_Shop() );
		}

		if ( function_exists( 'mc4wp_get_forms' ) ) {
			require_once MINIMOG_ELEMENTOR_DIR . '/widgets/form/mailchimp-form.php';

			Plugin::instance()->widgets_manager->register_widget_type( new Widget_Mailchimp_Form() );
		}

		if ( defined( 'WPCF7_VERSION' ) ) {
			require_once MINIMOG_ELEMENTOR_DIR . '/widgets/form/contact-form-7.php';

			Plugin::instance()->widgets_manager->register_widget_type( new Widget_Contact_Form_7() );
		}
	}

	/**
	 * @param \Elementor\Widgets_Manager $widgets_manager
	 *
	 * Remove unwanted widgets
	 */
	function remove_unwanted_widgets( $widgets_manager ) {
		$elementor_widget_blacklist = array(
			'theme-site-logo',
		);

		foreach ( $elementor_widget_blacklist as $widget_name ) {
			$widgets_manager->unregister_widget_type( $widget_name );
		}
	}

	public function change_portfolio_archive_title( $title ) {
		if ( \Minimog_Portfolio::instance()->is_archive() ) {
			$title = \Minimog::setting( 'title_bar_archive_portfolio_title' );
		}

		if ( '' === $title ) {
			$title = 'Archive Title';
		}

		return $title;
	}
}

Widget_Init::instance()->initialize();
