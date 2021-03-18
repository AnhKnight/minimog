<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Minimog_Widgets' ) ) {
	class Minimog_Widgets {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			// Register widget areas.
			add_action( 'widgets_init', array(
				$this,
				'register_sidebars',
			) );

			add_action( 'widgets_init', array(
				$this,
				'register_widgets',
			) );

			add_filter( 'insight_core_dynamic_sidebar_args', [ $this, 'change_sidebar_args' ] );
		}

		public function require_widgets() {

		}

		public function register_widgets() {
			require_once MINIMOG_WIDGETS_DIR . '/posts.php';

			register_widget( 'Minimog_WP_Widget_Posts' );

			if ( Minimog_Woo::instance()->is_activated() ) {
				require_once MINIMOG_WIDGETS_DIR . '/product-badge.php';
				require_once MINIMOG_WIDGETS_DIR . '/product-banner.php';
				require_once MINIMOG_WIDGETS_DIR . '/product-sorting.php';
				require_once MINIMOG_WIDGETS_DIR . '/product-price-filter.php';
				require_once MINIMOG_WIDGETS_DIR . '/product-layered-nav.php';

				register_widget( 'Minimog_WP_Widget_Product_Badge' );
				register_widget( 'Minimog_WP_Widget_Product_Banner' );
				register_widget( 'Minimog_WP_Widget_Product_Sorting' );
				register_widget( 'Minimog_WP_Widget_Product_Price_Filter' );
				register_widget( 'Minimog_WP_Widget_Product_Layered_Nav' );

				if ( class_exists( 'woo_brands' ) ) {
					require_once MINIMOG_WIDGETS_DIR . '/product-brand-nav.php';
					register_widget( 'Minimog_WP_Widget_Product_Brand_Nav' );
				}
			}
		}

		public function change_sidebar_args( $args ) {
			$args['before_title'] = '<p class="widget-title heading">';
			$args['after_title']  = '</p>';

			return $args;
		}

		/**
		 * Register widget area.
		 *
		 * @access public
		 * @link   https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function register_sidebars() {
			$defaults = array(
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<p class="widget-title heading">',
				'after_title'   => '</p>',
			);

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'blog_sidebar',
				'name'        => esc_html__( 'Blog Sidebar', 'minimog' ),
				'description' => esc_html__( 'Add widgets here.', 'minimog' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'page_sidebar',
				'name'        => esc_html__( 'Page Sidebar', 'minimog' ),
				'description' => esc_html__( 'Add widgets here.', 'minimog' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'shop_filters',
				'name'        => esc_html__( 'Shop Filters', 'minimog' ),
				'description' => esc_html__( 'Add widgets here.', 'minimog' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'shop_sidebar',
				'name'        => esc_html__( 'Shop Sidebar', 'minimog' ),
				'description' => esc_html__( 'Add widgets here.', 'minimog' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'single_shop_sidebar',
				'name'        => esc_html__( 'Single Shop Sidebar', 'minimog' ),
				'description' => esc_html__( 'Add widgets here.', 'minimog' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'off_sidebar',
				'name'        => esc_html__( 'Off Sidebar', 'minimog' ),
				'description' => esc_html__( 'Add widgets here.', 'minimog' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'top_bar_widgets',
				'name'        => esc_html__( 'Top Bar Widgets', 'minimog' ),
				'description' => esc_html__( 'Add widgets here.', 'minimog' ),
			) ) );
		}
	}

	Minimog_Widgets::instance()->initialize();
}
