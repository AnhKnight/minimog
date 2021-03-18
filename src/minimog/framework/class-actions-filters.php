<?php
defined( 'ABSPATH' ) || exit;

/**
 * Custom filters that act independently of the theme templates
 */
if ( ! class_exists( 'Minimog_Actions_Filters' ) ) {
	class Minimog_Actions_Filters {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			/* Move post count inside the link */
			add_filter( 'wp_list_categories', array( $this, 'move_post_count_inside_link_category' ) );
			/* Move post count inside the link */
			add_filter( 'get_archives_link', array( $this, 'move_post_count_inside_link_archive' ) );

			// Change comment form fields order.
			add_filter( 'comment_form_fields', array( $this, 'move_comment_field_to_bottom' ) );

			add_filter( 'embed_oembed_html', array( $this, 'add_wrapper_for_video' ), 10, 3 );
			add_filter( 'video_embed_html', array( $this, 'add_wrapper_for_video' ) ); // Jetpack.

			add_filter( 'excerpt_length', array(
				$this,
				'custom_excerpt_length',
			), 999 ); // Change excerpt length is set to 55 words by default.

			// Adds custom classes to the array of body classes.
			add_filter( 'body_class', array( $this, 'body_classes' ) );

			// Adds custom attributes to body tag.
			add_filter( 'minimog_body_attributes', array( $this, 'add_attributes_to_body' ) );

			if ( ! is_admin() ) {
				add_action( 'pre_get_posts', array( $this, 'alter_search_loop' ), 1 );
				add_filter( 'pre_get_posts', array( $this, 'search_filter' ) );
				add_filter( 'pre_get_posts', array( $this, 'empty_search_filter' ) );
			}

			add_filter( 'insightcore_bmw_nav_args', array( $this, 'add_extra_params_to_insightcore_bmw' ) );

			add_filter( 'user_contactmethods', [ $this, 'add_extra_user_info' ] );

			add_filter( 'insight_core_breadcrumb_default', [ $this, 'change_breadcrumb_text' ] );
		}

		/**
		 * Override with text in theme.
		 *
		 * @param $args
		 *
		 * @return mixed
		 */
		function change_breadcrumb_text( $args ) {
			$args['home_label']   = esc_html__( 'Home', 'minimog' );
			$args['search_label'] = esc_html__( 'Search Result of &quot;%s&quot;', 'minimog' );
			$args['404_label']    = esc_html__( '404 Not Found', 'minimog' );

			return $args;
		}

		public function add_extra_user_info( $fields ) {
			$new_fields = array(
				array(
					'name'  => 'phone_number',
					'label' => esc_html__( 'Phone Number', 'minimog' ),
				),
				array(
					'name'  => 'career',
					'label' => esc_html__( 'Career', 'minimog' ),
				),
				array(
					'name'  => 'email_address',
					'label' => esc_html__( 'Email Address', 'minimog' ),
				),
				array(
					'name'  => 'facebook',
					'label' => esc_html__( 'Facebook', 'minimog' ),
				),
				array(
					'name'  => 'twitter',
					'label' => esc_html__( 'Twitter', 'minimog' ),
				),
				array(
					'name'  => 'instagram',
					'label' => esc_html__( 'Instagram', 'minimog' ),
				),
				array(
					'name'  => 'linkedin',
					'label' => esc_html__( 'Linkedin', 'minimog' ),
				),
				array(
					'name'  => 'pinterest',
					'label' => esc_html__( 'Pinterest', 'minimog' ),
				),
				array(
					'name'  => 'youtube',
					'label' => esc_html__( 'Youtube', 'minimog' ),
				),
			);

			foreach ( $new_fields as $new_field ) {
				if ( ! isset( $fields[ $new_field['name'] ] ) ) {
					$fields[ $new_field['name'] ] = $new_field['label'];
				}
			}

			return $fields;
		}

		function add_extra_params_to_insightcore_bmw( $args ) {
			$args['link_before'] = '<div class="menu-item-wrap"><span class="menu-item-title">';
			$args['link_after']  = '</span></div>';

			return $args;
		}

		function move_post_count_inside_link_category( $links ) {
			// First remove span that added by woocommerce.
			$links = str_replace( '<span class="count">', '', $links );
			$links = str_replace( '</span>', '', $links );

			// Then add span again for both blog & shop.

			$links = str_replace( '</a> ', ' <span class="count">', $links );
			$links = str_replace( ')', '</span></a>', $links );
			$links = str_replace( '(', '', $links );

			return $links;
		}

		function move_post_count_inside_link_archive( $links ) {
			$links = str_replace( '</a>&nbsp;(', ' (', $links );
			$links = str_replace( ')', ')</a>', $links );

			$links = str_replace( '(', ' <span class="count">(', $links );
			$links = str_replace( ')', ')</span>', $links );

			return $links;
		}

		function change_widget_tag_cloud_args( $args ) {
			$args['separator'] = ', ';

			return $args;
		}

		function move_comment_field_to_bottom( $fields ) {
			// Move comment field to bottom of fields.
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;

			// If comments cookies opt-in checkbox checked then move it below of comment field.
			if ( isset( $fields['cookies'] ) ) {
				$cookie_field = $fields['cookies'];
				unset( $fields['cookies'] );
				$fields['cookies'] = $cookie_field;
			}

			return $fields;
		}

		/**
		 * @param WP_Query $query Query instance.
		 */
		public function alter_search_loop( $query ) {
			if ( $query->is_main_query() && $query->is_search() ) {
				$number_results = Minimog::setting( 'search_page_number_results' );
				$query->set( 'posts_per_page', $number_results );
			}
		}

		/**
		 * @param WP_Query $query Query instance.
		 *
		 * @return WP_Query $query
		 *
		 * Apply filters to the search query.
		 * Determines if we only want to display posts/pages and changes the query accordingly
		 */
		public function search_filter( $query ) {
			if ( $query->is_main_query() && $query->is_search ) {
				$post_type = Minimog::setting( 'search_page_filter' );
				if ( $post_type !== 'all' ) {
					$query->set( 'post_type', $post_type );

					switch ( $post_type ) {
						case 'post':
							if ( isset( $_GET['category'] ) && ! empty( $_GET['category'] ) ) {
								$query->set( 'tax_query', array(
									array(
										'taxonomy' => 'category',
										'field'    => 'slug',
										'terms'    => array( $_GET['category'] ),
									),
								) );
							}

							break;
						case 'product':
							if ( isset( $_GET['product_cat'] ) && ! empty( $_GET['product_cat'] ) ) {
								$query->set( 'tax_query', array(
									array(
										'taxonomy' => 'product_cat',
										'field'    => 'slug',
										'terms'    => array( $_GET['product_cat'] ),
									),
								) );
							}
							break;
					}
				}
			}

			return $query;
		}

		/**
		 * Make wordpress respect the search template on an empty search
		 */
		public function empty_search_filter( $query ) {
			if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) && $query->is_main_query() ) {
				$query->is_search = true;
				$query->is_home   = false;
			}

			return $query;
		}

		public function custom_excerpt_length() {
			return 999;
		}

		/**
		 * Add responsive container to embeds
		 */
		public function add_wrapper_for_video( $html, $url ) {
			$array = array(
				'youtube.com',
				'wordpress.tv',
				'vimeo.com',
				'dailymotion.com',
				'hulu.com',
			);

			if ( Minimog_Helper::strposa( $url, $array ) ) {
				$html = '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
			}

			return $html;
		}

		public function add_attributes_to_body( $attrs ) {
			$site_width = Minimog_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Minimog::setting( 'site_width' );
			}
			$attrs['data-site-width']    = $site_width;
			$attrs['data-content-width'] = 1200;

			$font = Minimog_Helper::get_body_font();

			$attrs['data-font'] = $font;

			$header_sticky_height               = Minimog::setting( 'header_sticky_height' );
			$attrs['data-header-sticky-height'] = $header_sticky_height;

			return $attrs;
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 *
		 * @return array
		 */
		public function body_classes( $classes ) {
			// Adds a class for mobile device.
			if ( Minimog::is_mobile() ) {
				$classes[] = 'mobile';
			}

			// Adds a class for tablet device.
			if ( Minimog::is_tablet() ) {
				$classes[] = 'tablet';
			}

			// Adds a class for handheld device.
			if ( Minimog::is_handheld() ) {
				$classes[] = 'handheld mobile-menu';
			}

			// Adds a class for desktop device.
			if ( Minimog::is_desktop() ) {
				$classes[] = 'desktop desktop-menu';
			}

			$classes[] = 'primary-nav-rendering';

			if ( ! is_home() && ( function_exists( 'elementor_location_exits' ) && elementor_location_exits( 'archive', true ) ) ) {
				$classes[] = 'elementor-archive-page';
			}

			$mobile_menu_effect = Minimog::setting( 'mobile_menu_effect' );
			$classes[]          = "mobile-menu-{$mobile_menu_effect}";

			if ( '1' === Minimog::setting( 'top_bar_hide_on_mobile' ) ) {
				$classes[] = 'hide-top-bar-on-mobile';
			}

			if ( Minimog_Woo::instance()->is_activated() ) {
				$classes[] = 'woocommerce';

				if ( '1' === Minimog::setting( 'shop_archive_thumbnail_background' ) ) {
					$classes[] = 'woocommerce-loop-image-has-bg';
				}

				if ( Minimog_Woo::instance()->is_product_archive() ) {
					$classes[] = 'archive-shop';

					$archive_shop_layout = Minimog::setting( 'shop_archive_layout' );
					$classes[]           = "archive-shop-{$archive_shop_layout}";
				}

				if ( is_singular( 'product' ) ) {
					$product_feature_style = Minimog_Woo::instance()->get_single_product_style();
					$classes[]             = "single-product-{$product_feature_style}";
				}

				if ( '1' === Minimog::setting( 'shop_archive_hide_buttons_on_mobile' ) ) {
					$classes[] = 'woocommerce-loop-buttons-hide-on-mobile';
				}
			}

			if ( Minimog_Post::instance()->is_archive() ) {
				$blog_archive_style = Minimog::setting( 'blog_archive_style' );
				$classes[]          = "blog-archive-style-{$blog_archive_style}";
			}

			$one_page_enable = Minimog_Helper::get_post_meta( 'menu_one_page', '' );
			if ( $one_page_enable === '1' ) {
				$classes[] = 'one-page';
			}

			if ( is_singular( 'portfolio' ) ) {
				$skin = Minimog_Helper::get_post_meta( 'portfolio_site_skin', '' );
				if ( $skin === '' ) {
					$skin = Minimog::setting( 'single_portfolio_site_skin' );
				}
				$classes[] = "page-skin-$skin";

				$style = Minimog_Helper::get_post_meta( 'portfolio_layout_style', '' );
				if ( $style === '' ) {
					$style = Minimog::setting( 'single_portfolio_style' );
				}
				$classes[] = "single-portfolio-style-$style";
			}

			$header_sticky_behaviour = Minimog::setting( 'header_sticky_behaviour' );
			$classes[]               = "header-sticky-$header_sticky_behaviour";

			$site_layout = Minimog_Helper::get_post_meta( 'site_layout', '' );
			if ( $site_layout === '' ) {
				$site_layout = Minimog::setting( 'site_layout' );
			}
			$classes[] = $site_layout;

			$site_class = Minimog_Helper::get_post_meta( 'site_class', '' );
			if ( $site_class !== '' ) {
				$classes[] = $site_class;
			}

			$sidebar_status = Minimog_Global::instance()->get_sidebar_status();

			if ( $sidebar_status === 'one' ) {
				$classes[] = 'page-has-sidebar page-one-sidebar';
			} elseif ( $sidebar_status === 'both' ) {
				$classes[] = 'page-has-sidebar page-both-sidebar';
			} else {
				$classes[] = 'page-has-no-sidebar';
			}

			return $classes;
		}
	}

	Minimog_Actions_Filters::instance()->initialize();
}
