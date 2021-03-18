<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Minimog_Metabox' ) ) {
	class Minimog_Metabox {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			add_filter( 'insight_core_meta_boxes', array( $this, 'register_meta_boxes' ) );
		}

		/**
		 * Register Metabox
		 *
		 * @param $meta_boxes
		 *
		 * @return array
		 */
		public function register_meta_boxes( $meta_boxes ) {
			$page_registered_sidebars = Minimog_Helper::get_registered_sidebars( true );

			$general_options = array(
				array(
					'title'  => esc_attr__( 'Layout', 'minimog' ),
					'fields' => array(
						array(
							'id'      => 'site_layout',
							'type'    => 'select',
							'title'   => esc_html__( 'Layout', 'minimog' ),
							'desc'    => esc_html__( 'Controls the layout of this page.', 'minimog' ),
							'options' => array(
								''      => esc_attr__( 'Default', 'minimog' ),
								'boxed' => esc_attr__( 'Boxed', 'minimog' ),
								'wide'  => esc_attr__( 'Wide', 'minimog' ),
							),
							'default' => '',
						),
						array(
							'id'    => 'site_width',
							'type'  => 'text',
							'title' => esc_html__( 'Site Width', 'minimog' ),
							'desc'  => esc_html__( 'Controls the site width for this page. Enter value including any valid CSS unit. For e.g: 1200px. Leave blank to use global setting.', 'minimog' ),
						),
						array(
							'id'    => 'site_top_spacing',
							'type'  => 'text',
							'title' => esc_html__( 'Site Top Spacing', 'minimog' ),
							'desc'  => esc_html__( 'Controls the top spacing of this page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'minimog' ),
						),
						array(
							'id'    => 'site_bottom_spacing',
							'type'  => 'text',
							'title' => esc_html__( 'Site Bottom Spacing', 'minimog' ),
							'desc'  => esc_html__( 'Controls the bottom spacing of this page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'minimog' ),
						),
						array(
							'id'    => 'site_class',
							'type'  => 'text',
							'title' => esc_html__( 'Body Class', 'minimog' ),
							'desc'  => esc_html__( 'Add a class name to body then refer to it in custom CSS.', 'minimog' ),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Background', 'minimog' ),
					'fields' => array(
						array(
							'id'      => 'site_background_message',
							'type'    => 'message',
							'title'   => esc_html__( 'Info', 'minimog' ),
							'message' => esc_html__( 'These options controls the background on boxed mode.', 'minimog' ),
						),
						array(
							'id'    => 'site_background_color',
							'type'  => 'color',
							'title' => esc_html__( 'Background Color', 'minimog' ),
							'desc'  => esc_html__( 'Controls the background color of the outer background area in boxed mode of this page.', 'minimog' ),
						),
						array(
							'id'    => 'site_background_image',
							'type'  => 'media',
							'title' => esc_html__( 'Background Image', 'minimog' ),
							'desc'  => esc_html__( 'Controls the background image of the outer background area in boxed mode of this page.', 'minimog' ),
						),
						array(
							'id'      => 'site_background_repeat',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Repeat', 'minimog' ),
							'desc'    => esc_html__( 'Controls the background repeat of the outer background area in boxed mode of this page.', 'minimog' ),
							'options' => array(
								'no-repeat' => esc_attr__( 'No repeat', 'minimog' ),
								'repeat'    => esc_attr__( 'Repeat', 'minimog' ),
								'repeat-x'  => esc_attr__( 'Repeat X', 'minimog' ),
								'repeat-y'  => esc_attr__( 'Repeat Y', 'minimog' ),
							),
						),
						array(
							'id'      => 'site_background_attachment',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Attachment', 'minimog' ),
							'desc'    => esc_html__( 'Controls the background attachment of the outer background area in boxed mode of this page.', 'minimog' ),
							'options' => array(
								''       => esc_attr__( 'Default', 'minimog' ),
								'fixed'  => esc_attr__( 'Fixed', 'minimog' ),
								'scroll' => esc_attr__( 'Scroll', 'minimog' ),
							),
						),
						array(
							'id'    => 'site_background_position',
							'type'  => 'text',
							'title' => esc_html__( 'Background Position', 'minimog' ),
							'desc'  => esc_html__( 'Controls the background position of the outer background area in boxed mode of this page.', 'minimog' ),
						),
						array(
							'id'    => 'site_background_size',
							'type'  => 'text',
							'title' => esc_html__( 'Background Size', 'minimog' ),
							'desc'  => esc_html__( 'Controls the background size of the outer background area in boxed mode of this page.', 'minimog' ),
						),
						array(
							'id'      => 'content_background_message',
							'type'    => 'message',
							'title'   => esc_html__( 'Info', 'minimog' ),
							'message' => esc_html__( 'These options controls the background of main content on this page.', 'minimog' ),
						),
						array(
							'id'    => 'content_background_color',
							'type'  => 'color',
							'title' => esc_html__( 'Background Color', 'minimog' ),
							'desc'  => esc_html__( 'Controls the background color of main content on this page.', 'minimog' ),
						),
						array(
							'id'    => 'content_background_image',
							'type'  => 'media',
							'title' => esc_html__( 'Background Image', 'minimog' ),
							'desc'  => esc_html__( 'Controls the background image of main content on this page.', 'minimog' ),
						),
						array(
							'id'      => 'content_background_repeat',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Repeat', 'minimog' ),
							'desc'    => esc_html__( 'Controls the background repeat of main content on this page.', 'minimog' ),
							'options' => array(
								'no-repeat' => esc_attr__( 'No repeat', 'minimog' ),
								'repeat'    => esc_attr__( 'Repeat', 'minimog' ),
								'repeat-x'  => esc_attr__( 'Repeat X', 'minimog' ),
								'repeat-y'  => esc_attr__( 'Repeat Y', 'minimog' ),
							),
						),
						array(
							'id'    => 'content_background_position',
							'type'  => 'text',
							'title' => esc_html__( 'Background Position', 'minimog' ),
							'desc'  => esc_html__( 'Controls the background position of main content on this page.', 'minimog' ),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Header', 'minimog' ),
					'fields' => array(
						array(
							'id'      => 'top_bar_type',
							'type'    => 'select',
							'title'   => esc_html__( 'Top Bar Type', 'minimog' ),
							'desc'    => esc_html__( 'Select top bar type that displays on this page.', 'minimog' ),
							'default' => '',
							'options' => Minimog_Top_Bar::instance()->get_list( true ),
						),
						array(
							'id'      => 'header_type',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Type', 'minimog' ),
							'desc'    => wp_kses(
								sprintf(
									__( 'Select header type that displays on this page. When you choose Default, the value in %s will be used.', 'minimog' ),
									'<a href="' . admin_url( '/customize.php?autofocus[section]=header' ) . '">Customize</a>'
								), 'minimog-a' ),
							'default' => '',
							'options' => Minimog_Header::instance()->get_list( true ),
						),
						array(
							'id'      => 'header_overlay',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Overlay', 'minimog' ),
							'default' => '',
							'options' => array(
								''  => esc_html__( 'Default', 'minimog' ),
								'0' => esc_html__( 'No', 'minimog' ),
								'1' => esc_html__( 'Yes', 'minimog' ),
							),
						),
						array(
							'id'      => 'header_skin',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Skin', 'minimog' ),
							'default' => '',
							'options' => array(
								''      => esc_html__( 'Default', 'minimog' ),
								'dark'  => esc_html__( 'Dark', 'minimog' ),
								'light' => esc_html__( 'Light', 'minimog' ),
							),
						),
						array(
							'id'      => 'menu_display',
							'type'    => 'select',
							'title'   => esc_html__( 'Primary menu', 'minimog' ),
							'desc'    => esc_html__( 'Select which menu displays on this page.', 'minimog' ),
							'default' => '',
							'options' => Minimog_Nav_Menu::get_all_menus(),
						),
						array(
							'id'      => 'menu_one_page',
							'type'    => 'switch',
							'title'   => esc_attr__( 'One Page Menu', 'minimog' ),
							'default' => '0',
							'options' => array(
								'0' => esc_attr__( 'Disable', 'minimog' ),
								'1' => esc_attr__( 'Enable', 'minimog' ),
							),
						),
						array(
							'id'      => 'custom_dark_logo',
							'type'    => 'media',
							'title'   => esc_html__( 'Custom Dark Logo', 'minimog' ),
							'desc'    => esc_html__( 'Select custom dark logo for this page.', 'minimog' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_light_logo',
							'type'    => 'media',
							'title'   => esc_html__( 'Custom Light Logo', 'minimog' ),
							'desc'    => esc_html__( 'Select custom light logo for this page.', 'minimog' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_logo_width',
							'type'    => 'text',
							'title'   => esc_html__( 'Custom Logo Width', 'minimog' ),
							'desc'    => esc_html__( 'Controls the width of logo. For e.g: 150px', 'minimog' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_sticky_logo_width',
							'type'    => 'text',
							'title'   => esc_html__( 'Custom Sticky Logo Width', 'minimog' ),
							'desc'    => esc_html__( 'Controls the width of sticky logo. For e.g: 150px', 'minimog' ),
							'default' => '',
						),
					),
				),
				array(
					'title'  => esc_html__( 'Page Title Bar', 'minimog' ),
					'fields' => array(
						array(
							'id'      => 'page_title_bar_layout',
							'type'    => 'select',
							'title'   => esc_html__( 'Layout', 'minimog' ),
							'default' => '',
							'options' => Minimog_Title_Bar::instance()->get_list( true ),
						),
						array(
							'id'    => 'page_title_bar_bottom_spacing',
							'type'  => 'text',
							'title' => esc_html__( 'Spacing', 'minimog' ),
							'desc'  => esc_html__( 'Controls the bottom spacing of title bar of this page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'minimog' ),
						),
						array(
							'id'      => 'page_title_bar_background_color',
							'type'    => 'color',
							'title'   => esc_html__( 'Background Color', 'minimog' ),
							'default' => '',
						),
						array(
							'id'      => 'page_title_bar_background',
							'type'    => 'media',
							'title'   => esc_html__( 'Background Image', 'minimog' ),
							'default' => '',
						),
						array(
							'id'      => 'page_title_bar_background_overlay',
							'type'    => 'color',
							'title'   => esc_html__( 'Background Overlay', 'minimog' ),
							'default' => '',
						),
						array(
							'id'    => 'page_title_bar_custom_heading',
							'type'  => 'text',
							'title' => esc_html__( 'Custom Heading Text', 'minimog' ),
							'desc'  => esc_html__( 'Insert custom heading for the page title bar. Leave blank to use default.', 'minimog' ),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Sidebars', 'minimog' ),
					'fields' => array(
						array(
							'id'      => 'page_sidebar_1',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar 1', 'minimog' ),
							'desc'    => esc_html__( 'Select sidebar 1 that will display on this page.', 'minimog' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
						array(
							'id'      => 'page_sidebar_2',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar 2', 'minimog' ),
							'desc'    => esc_html__( 'Select sidebar 2 that will display on this page.', 'minimog' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
						array(
							'id'      => 'page_sidebar_position',
							'type'    => 'switch',
							'title'   => esc_html__( 'Sidebar Position', 'minimog' ),
							'desc'    => wp_kses(
								sprintf(
									__( 'Select position of Sidebar 1 for this page. If sidebar 2 is selected, it will display on the opposite side. If you set as "Default" then the value in %s will be used.', 'minimog' ),
									'<a href="' . admin_url( '/customize.php?autofocus[section]=sidebars' ) . '">Customize -> Sidebar</a>'
								), 'minimog-a' ),
							'default' => 'default',
							'options' => Minimog_Helper::get_list_sidebar_positions( true ),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Sliders', 'minimog' ),
					'fields' => array(
						array(
							'id'      => 'revolution_slider',
							'type'    => 'select',
							'title'   => esc_html__( 'Revolution Slider', 'minimog' ),
							'desc'    => esc_html__( 'Select the unique name of the slider.', 'minimog' ),
							'options' => Minimog_Helper::get_list_revslider(),
						),
						array(
							'id'      => 'slider_position',
							'type'    => 'select',
							'title'   => esc_html__( 'Slider Position', 'minimog' ),
							'default' => 'below',
							'options' => array(
								'above' => esc_attr__( 'Above Header', 'minimog' ),
								'below' => esc_attr__( 'Below Header', 'minimog' ),
							),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Footer', 'minimog' ),
					'fields' => array(
						array(
							'id'      => 'footer_enable',
							'type'    => 'select',
							'title'   => esc_html__( 'Footer Enable', 'minimog' ),
							'default' => '',
							'options' => array(
								''     => esc_html__( 'Yes', 'minimog' ),
								'none' => esc_html__( 'No', 'minimog' ),
							),
						),
					),
				),
			);

			// Page
			$meta_boxes[] = array(
				'id'         => 'insight_page_options',
				'title'      => esc_html__( 'Page Options', 'minimog' ),
				'post_types' => array( 'page' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => $general_options,
					),
				),
			);

			// Post
			$meta_boxes[] = array(
				'id'         => 'insight_post_options',
				'title'      => esc_html__( 'Page Options', 'minimog' ),
				'post_types' => array( 'post' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_html__( 'Post', 'minimog' ),
								'fields' => array(
									array(
										'id'    => 'post_gallery',
										'type'  => 'gallery',
										'title' => esc_html__( 'Gallery Format', 'minimog' ),
									),
									array(
										'id'    => 'post_video',
										'type'  => 'text',
										'title' => esc_html__( 'Video URL', 'minimog' ),
										'desc'  => esc_html__( 'Input the url of video vimeo or youtube. For e.g: https://www.youtube.com/watch?v=9No-FiEInLA', 'minimog' ),
									),
									array(
										'id'    => 'post_audio',
										'type'  => 'textarea',
										'title' => esc_html__( 'Audio Format', 'minimog' ),
									),
									array(
										'id'    => 'post_description_text',
										'type'  => 'text',
										'title' => esc_html__( 'Description Format - Source Text', 'minimog' ),
									),
									array(
										'id'    => 'post_description_name',
										'type'  => 'text',
										'title' => esc_html__( 'Description Format - Source Name', 'minimog' ),
									),
									array(
										'id'    => 'post_description_url',
										'type'  => 'text',
										'title' => esc_html__( 'Description Format - Source Url', 'minimog' ),
									),
									array(
										'id'    => 'post_link',
										'type'  => 'text',
										'title' => esc_html__( 'Link Format', 'minimog' ),
									),
									array(
										'id'      => 'post_thumbnail_show',
										'type'    => 'switch',
										'title'   => esc_attr__( 'Post thumbnail', 'minimog' ),
										'default' => '1',
										'options' => array(
											'0' => esc_attr__( 'Disable', 'minimog' ),
											'1' => esc_attr__( 'Enable', 'minimog' ),
										),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			// Product
			$meta_boxes[] = array(
				'id'         => 'insight_product_options',
				'title'      => esc_html__( 'Page Options', 'minimog' ),
				'post_types' => array( 'product' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_html__( 'Product', 'minimog' ),
								'fields' => array(
									array(
										'id'      => 'single_product_layout_style',
										'type'    => 'select',
										'title'   => esc_html__( 'Single Product Style', 'minimog' ),
										'desc'    => esc_html__( 'Select style of this single product page.', 'minimog' ),
										'default' => '',
										'options' => array(
											''       => esc_html__( 'Delivery Time', 'minimog' ),
											'discount-saved'   => esc_html__( 'Discount Save', 'minimog' ),
											'sidebar-full-height'   => esc_html__( 'Sidebar Full Height', 'minimog' ),
										),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			// Portfolio
			$meta_boxes[] = array(
				'id'         => 'insight_portfolio_options',
				'title'      => esc_html__( 'Page Options', 'minimog' ),
				'post_types' => array( 'portfolio' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_html__( 'Portfolio', 'minimog' ),
								'fields' => array(
									array(
										'id'      => 'portfolio_site_skin',
										'type'    => 'select',
										'title'   => esc_html__( 'Site Skin', 'minimog' ),
										'desc'    => esc_html__( 'Select skin of this single portfolio page.', 'minimog' ),
										'default' => '',
										'options' => array(
											''      => esc_html__( 'Default', 'minimog' ),
											'dark'  => esc_html__( 'Dark', 'minimog' ),
											'light' => esc_html__( 'Light', 'minimog' ),
										),
									),
									array(
										'id'      => 'portfolio_layout_style',
										'type'    => 'select',
										'title'   => esc_html__( 'Single Portfolio Style', 'minimog' ),
										'desc'    => esc_html__( 'Select style of this single portfolio page.', 'minimog' ),
										'default' => '',
										'options' => array(
											''                => esc_html__( 'Default', 'minimog' ),
											'blank'           => esc_html__( 'Blank (Build with Elementor)', 'minimog' ),
											'image-list'      => esc_html__( 'Image List', 'minimog' ),
											'image-list-wide' => esc_html__( 'Image List - Wide', 'minimog' ),
										),
									),
									array(
										'id'      => 'portfolio_pagination_style',
										'type'    => 'select',
										'title'   => esc_html__( 'Pagination Style', 'minimog' ),
										'desc'    => esc_html__( 'Select style of pagination for this single portfolio page.', 'minimog' ),
										'default' => '',
										'options' => array(
											''     => esc_html__( 'Default', 'minimog' ),
											'none' => esc_html__( 'None', 'minimog' ),
											'01'   => esc_html__( '01', 'minimog' ),
											'02'   => esc_html__( '02', 'minimog' ),
											'03'   => esc_html__( '03', 'minimog' ),
										),
									),
									array(
										'id'    => 'portfolio_gallery',
										'type'  => 'gallery',
										'title' => esc_html__( 'Gallery', 'minimog' ),
									),
									array(
										'id'    => 'portfolio_video_url',
										'type'  => 'text',
										'title' => esc_html__( 'Video URL', 'minimog' ),
										'desc'  => esc_html__( 'Input the url of video vimeo or youtube. For e.g: https://www.youtube.com/watch?v=9No-FiEInLA', 'minimog' ),
									),
									array(
										'id'    => 'portfolio_client',
										'type'  => 'text',
										'title' => esc_html__( 'Client', 'minimog' ),
									),
									array(
										'id'    => 'portfolio_date',
										'type'  => 'text',
										'title' => esc_html__( 'Date', 'minimog' ),
									),
									array(
										'id'    => 'portfolio_url',
										'type'  => 'text',
										'title' => esc_html__( 'Url', 'minimog' ),
									),
									array(
										'id'      => 'portfolio_overlay_colored_faded_message',
										'type'    => 'message',
										'title'   => esc_html__( 'Info', 'minimog' ),
										'message' => esc_html__( 'These settings for Overlay Colored Faded Style.', 'minimog' ),
									),
									array(
										'id'    => 'portfolio_overlay_colored_faded_background',
										'type'  => 'color',
										'title' => esc_html__( 'Background Color', 'minimog' ),
										'desc'  => esc_html__( 'Controls the background color of overlay colored faded style.', 'minimog' ),
									),
									array(
										'id'      => 'portfolio_overlay_colored_faded_text_skin',
										'type'    => 'select',
										'title'   => esc_html__( 'Text Skin', 'minimog' ),
										'desc'    => esc_html__( 'Controls the text skin of overlay colored faded style.', 'minimog' ),
										'default' => 'light',
										'options' => array(
											'dark'  => esc_html__( 'Dark', 'minimog' ),
											'light' => esc_html__( 'Light', 'minimog' ),
										),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			return $meta_boxes;
		}

	}

	Minimog_Metabox::instance()->initialize();
}
