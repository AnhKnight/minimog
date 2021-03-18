<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Minimog_Global;
use Minimog_Templates;

defined( 'ABSPATH' ) || exit;

class Widget_Product_Shop extends Products_Base {

	public function get_name() {
		return 'tm-product-shop';
	}

	public function get_title() {
		return esc_html__( 'Product Shop', 'minimog' );
	}

	public function get_icon_part() {
		return 'eicon-products';
	}

	public function get_keywords() {
		return [ 'woocommerce', 'product', 'shop', 'catalog' ];
	}

	protected function get_post_type() {
		return 'product';
	}

	protected function get_post_category() {
		return 'product_cat';
	}

	public function get_script_depends() {
		return [
			'minimog-grid-query',
			'minimog-widget-grid-post',
		];
	}

	protected function _register_controls() {
		$this->add_layout_section();

		$this->add_grid_options_section();

		$this->add_grid_section();

		$this->add_pagination_section();

		$this->add_caption_style_section();

		$this->add_pagination_style_section();

		parent::_register_controls();
	}

	private function add_layout_section() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'minimog' ),
		] );

		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'minimog' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'grid-11'              => esc_html__( 'Shop Page 11', 'minimog' ),
				'grid-12'              => esc_html__( 'Shop Page 12', 'minimog' ),
				'grid-13'              => esc_html__( 'Shop Page 13', 'minimog' ),
				'grid-14'              => esc_html__( 'Shop Page 14', 'minimog' ),
				'grid-15'              => esc_html__( 'Shop Page 15', 'minimog' ),
				'grid-16'              => esc_html__( 'Shop Page 16', 'minimog' ),
				'grid-17'              => esc_html__( 'Shop Page 17', 'minimog' ),
				'grid-18'              => esc_html__( 'Shop Page 18', 'minimog' ),
				'grid-19'              => esc_html__( 'Shop Page 19', 'minimog' ),
				'grid-20'              => esc_html__( 'Shop Page 20', 'minimog' ),
			],
			'default' => 'grid-11',
		] );

		$this->add_control( 'shop_archive', [
			'label'   => esc_html__( 'Archive', 'minimog' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'none'              => esc_html__( 'None', 'minimog' ),
				'filter'            => esc_html__( 'Filter', 'minimog' ),
				'sidebar_left'      => esc_html__( 'Sidebar Left', 'minimog' ),
				'sidebar_right'     => esc_html__( 'Sidebar Right', 'minimog' ),
			],
			'default' => 'none',
		] );


		$this->add_caption_popover();

		$this->add_overlay_popover();

		$this->add_control( 'thumbnail_default_size', [
			'label'        => esc_html__( 'Use Default Thumbnail Size', 'minimog' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '1',
			'return_value' => '1',
			'separator'    => 'before',
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'thumbnail_default_size!' => '1',
			],
		] );

		$this->end_controls_section();
	}

	private function add_grid_options_section() {
		$this->start_controls_section( 'grid_options_section', [
			'label' => esc_html__( 'Grid Options', 'minimog' ),
		] );

		$this->add_responsive_control( 'grid_columns', [
			'label'          => esc_html__( 'Columns', 'minimog' ),
			'type'           => Controls_Manager::NUMBER,
			'min'            => 1,
			'max'            => 12,
			'step'           => 1,
			'default'        => 3,
			'tablet_default' => 2,
			'mobile_default' => 1,
			'selectors'      => [
				'{{WRAPPER}} .modern-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
			],
		] );

		$this->add_responsive_control( 'grid_column_gutter', [
			'label'     => esc_html__( 'Column Gutter', 'minimog' ),
			'type'      => Controls_Manager::NUMBER,
			'min'       => 0,
			'max'       => 200,
			'step'      => 1,
			'default'   => 30,
			'selectors' => [
				'{{WRAPPER}} .modern-grid' => 'grid-column-gap: {{VALUE}}px;',
			],
		] );

		$this->add_responsive_control( 'grid_row_gutter', [
			'label'     => esc_html__( 'Row Gutter', 'minimog' ),
			'type'      => Controls_Manager::NUMBER,
			'min'       => 0,
			'max'       => 200,
			'step'      => 1,
			'default'   => 30,
			'selectors' => [
				'{{WRAPPER}} .modern-grid' => 'grid-row-gap: {{VALUE}}px;',
			],
		] );

		$this->end_controls_section();
	}

	private function add_caption_popover() {
		$this->add_control( 'show_caption', [
				'label'        => esc_html__( 'Caption', 'minimog' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => esc_html__( 'Default', 'minimog' ),
				'label_on'     => esc_html__( 'Custom', 'minimog' ),
				'return_value' => 'yes',
				'condition'    => [
						'layout!' => [ 'zigzag' ],
				],
		] );

		$this->start_popover();

		$this->add_control( 'show_caption_category', [
				'label'     => esc_html__( 'Category', 'minimog' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'minimog' ),
				'label_off' => esc_html__( 'Hide', 'minimog' ),
				'default'   => 'yes',
				'separator' => 'before',
		] );

		$this->end_popover();
	}

	private function add_overlay_popover() {
		$this->add_control( 'show_overlay', [
				'label'        => esc_html__( 'Overlay', 'minimog' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => esc_html__( 'Default', 'minimog' ),
				'label_on'     => esc_html__( 'Custom', 'minimog' ),
				'return_value' => 'yes',
				'condition'    => [
						'layout!' => [
								'zigzag',
								'list-03',
								'one-left-featured',
						],
				],
		] );

		$this->start_popover();

		$this->add_control( 'show_overlay_countdown', [
				'label'     => esc_html__( 'Countdown', 'minimog' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'minimog' ),
				'label_off' => esc_html__( 'Hide', 'minimog' ),
				'default'   => 'yes',
				'separator' => 'before',
		] );

		$this->add_control( 'show_overlay_cart', [
				'label'     => esc_html__( 'Cart', 'minimog' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'minimog' ),
				'label_off' => esc_html__( 'Hide', 'minimog' ),
				'default'   => 'yes',
				'separator' => 'before',
		] );

		$this->add_control( 'show_overlay_wishlist', [
				'label'     => esc_html__( 'Wishlist', 'minimog' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'minimog' ),
				'label_off' => esc_html__( 'Hide', 'minimog' ),
				'default'   => 'yes',
				'separator' => 'before',
		] );

		$this->add_control( 'show_overlay_compare', [
				'label'     => esc_html__( 'Compare', 'minimog' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'minimog' ),
				'label_off' => esc_html__( 'Hide', 'minimog' ),
				'default'   => 'yes',
				'separator' => 'before',
		] );

		$this->add_control( 'show_overlay_quick_view', [
				'label'     => esc_html__( 'Quick View', 'minimog' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'minimog' ),
				'label_off' => esc_html__( 'Hide', 'minimog' ),
				'default'   => 'yes',
				'separator' => 'before',
		] );


		$this->end_popover();
	}

	private function add_grid_section() {
		$this->start_controls_section( 'grid_options_section', [
				'label'     => esc_html__( 'Grid Options', 'minimog' ),
				'condition' => [
						'layout' => [
								'grid',
								'masonry',
								'metro',
						],
				],
		] );

		$this->add_responsive_control( 'grid_columns', [
				'label'          => esc_html__( 'Columns', 'minimog' ),
				'type'           => Controls_Manager::NUMBER,
				'min'            => 1,
				'max'            => 12,
				'step'           => 1,
				'default'        => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
		] );

		$this->add_responsive_control( 'grid_gutter', [
				'label'   => esc_html__( 'Gutter', 'minimog' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 200,
				'step'    => 1,
				'default' => 30,
		] );

		$metro_layout_repeater = new Repeater();

		$metro_layout_repeater->add_control( 'size', [
				'label'   => esc_html__( 'Item Size', 'minimog' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1:1',
				'options' => Widget_Utils::get_grid_metro_size(),
		] );

		$this->add_control( 'grid_metro_layout', [
				'label'       => esc_html__( 'Metro Layout', 'minimog' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $metro_layout_repeater->get_controls(),
				'default'     => [
						[ 'size' => '2:2' ],
						[ 'size' => '1:1' ],
						[ 'size' => '1:1' ],
						[ 'size' => '1:1' ],
						[ 'size' => '2:2' ],
						[ 'size' => '1:1' ],
				],
				'title_field' => '{{{ size }}}',
				'condition'   => [
						'layout' => 'metro',
				],
		] );

		$this->end_controls_section();
	}

	protected function add_pagination_section() {
		$this->start_controls_section( 'pagination_section', [
				'label' => esc_html__( 'Pagination', 'minimog' ),
		] );

		$this->add_control( 'pagination_type', [
				'label'   => esc_html__( 'Pagination', 'minimog' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
						''              => esc_html__( 'None', 'minimog' ),
						'numbers'       => esc_html__( 'Numbers', 'minimog' ),
						'navigation'    => esc_html__( 'Navigation', 'minimog' ),
						'load-more'     => esc_html__( 'Button', 'minimog' ),
						'load-more-alt' => esc_html__( 'Custom Button', 'minimog' ),
						'infinite'      => esc_html__( 'Infinite Scroll', 'minimog' ),
				),
				'default' => '',
		] );

		$this->add_control( 'pagination_custom_button_id', [
				'label'       => esc_html__( 'Custom Button ID', 'minimog' ),
				'description' => esc_html__( 'Input id of custom button to load more posts when click. For e.g: #product-load-more-btn', 'minimog' ),
				'type'        => Controls_Manager::TEXT,
				'condition'   => [
						'pagination_type' => 'load-more-alt',
				],
		] );

		$this->end_controls_section();
	}

	private function add_caption_style_section() {
		$this->start_controls_section( 'caption_style_section', [
			'label' => esc_html__( 'Caption', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'caption_text_align', [
			'label'     => esc_html__( 'Alignment', 'minimog' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align(),
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .product-info' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'caption_padding', [
			'label'      => esc_html__( 'Padding', 'minimog' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .product-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'caption_title_heading', [
			'label'     => esc_html__( 'Product Name', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'caption_title_typography',
			'label'    => esc_html__( 'Typography', 'minimog' ),
			'selector' => '{{WRAPPER}} .product-info .woocommerce-loop-product__title',
		] );

		$this->start_controls_tabs( 'caption_title_tabs' );

		$this->start_controls_tab( 'caption_title_normal_tab', [
			'label' => esc_html__( 'Normal', 'minimog' ),
		] );

		$this->add_control( 'caption_title_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .product-info .woocommerce-loop-product__title' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'caption_title_hover_tab', [
			'label' => esc_html__( 'Hover', 'minimog' ),
		] );

		$this->add_control( 'caption_title_hover_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .product-info .woocommerce-loop-product__title a:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control( 'caption_price_heading', [
			'label'     => esc_html__( 'Product Price', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'caption_price_typography',
			'label'    => esc_html__( 'Typography', 'minimog' ),
			'selector' => '{{WRAPPER}} .product-info .price',
		] );

		$this->start_controls_tabs( 'caption_price_tabs' );

		$this->start_controls_tab( 'caption_regular_price_tab', [
			'label' => esc_html__( 'Regular', 'minimog' ),
		] );

		$this->add_control( 'caption_regular_price_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .product-info .price del' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'caption_sale_price_tab', [
			'label' => esc_html__( 'Sale', 'minimog' ),
		] );

		$this->add_control( 'caption_sale_price_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .product-info .price' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function add_pagination_style_section() {
		$this->start_controls_section( 'pagination_style_section', [
				'label'     => esc_html__( 'Pagination', 'minimog' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
						'pagination_type!' => '',
				],
		] );

		$this->add_responsive_control( 'pagination_alignment', [
				'label'     => esc_html__( 'Alignment', 'minimog' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => Widget_Utils::get_control_options_horizontal_alignment(),
				'default'   => 'center',
				'selectors' => [
						'{{WRAPPER}} .minimog-grid-pagination' => 'text-align: {{VALUE}};',
				],
		] );

		$this->add_responsive_control( 'pagination_spacing', [
				'label'       => esc_html__( 'Spacing', 'minimog' ),
				'type'        => Controls_Manager::SLIDER,
				'placeholder' => '70',
				'range'       => [
						'px' => [
								'min' => 0,
								'max' => 200,
						],
				],
				'selectors'   => [
						'{{WRAPPER}} .minimog-grid-pagination' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'      => 'pagination_typography',
				'selector'  => '{{WRAPPER}} .nav-link',
				'condition' => [
						'pagination_type' => 'navigation',
				],
		] );

		$this->start_controls_tabs( 'pagination_style_tabs' );

		$this->start_controls_tab( 'pagination_style_normal_tab', [
				'label' => esc_html__( 'Normal', 'minimog' ),
		] );

		$this->add_control( 'pagination_link_color', [
				'label'     => esc_html__( 'Link Color', 'minimog' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} .navigation-buttons' => 'color: {{VALUE}};',
						'{{WRAPPER}} .page-pagination'    => 'color: {{VALUE}};',
				],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'pagination_style_hover_tab', [
				'label' => esc_html__( 'Hover', 'minimog' ),
		] );

		$this->add_control( 'pagination_link_hover_color', [
				'label'     => esc_html__( 'Link Color', 'minimog' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} .nav-link:hover'           => 'color: {{VALUE}};',
						'{{WRAPPER}} .page-pagination .current' => 'color: {{VALUE}};',
						'{{WRAPPER}} .page-pagination a:hover'  => 'color: {{VALUE}};',
				],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control( 'pagination_loading_heading', [
				'label'     => esc_html__( 'Loading Icon', 'minimog' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
		] );

		$this->add_control( 'pagination_loading_color', [
				'label'     => esc_html__( 'Color', 'minimog' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} .minimog-infinite-loader .sk-wrap' => 'color: {{VALUE}};',
				],
				'condition' => [
						'pagination_type!' => 'numbers',
				],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->query_posts();
		/**
		 * @var $query \WP_Query
		 */
		$query     = $this->get_query();
		$post_type = $this->get_post_type();

		$view = $_GET['view'];
		if (isset($view) && $view == 'list') {
			$settings['layout'] = 'list';
		}

		//minimog-grid-wrapper
		$this->add_render_attribute( 'wrapper', 'class', [
				'minimog-grid-wrapper minimog-product-shop col-md-12',
				'minimog-product-' . $settings['layout'],
		] );

		if ( $settings['pagination_type'] !== '' && $query->found_posts > $settings['query_number'] ) {
			$this->add_render_attribute( 'wrapper', 'data-pagination', $settings['pagination_type'] );
		}

		if ( $settings['pagination_custom_button_id'] !== '' ) {
			$this->add_render_attribute( 'wrapper', 'data-pagination-custom-button-id', $settings['pagination_custom_button_id'] );
		}
		$page_sidebar1 = Minimog_Global::instance()->get_sidebar_1();

		$category_per_page = 4;

		if ( $page_sidebar1 !== 'none' ) {
			$category_per_page = 3;
		}


		?>
		<div class="row">
			<?php
				if ($settings['shop_archive'] == 'sidebar_left') {
					Minimog_Templates::shop_render_sidebar('left');
				}
			?>
		<div class="page-main-content">

			<?php
				do_action( 'woocommerce_archive_description' );
			?>

			<?php
			$shop_page_display = get_option( 'woocommerce_shop_page_display', '' );

			if ( function_exists( 'is_shop' ) && $query->is_shop() && $shop_page_display !== '' ) {
				woocommerce_output_product_categories( array(
						'before' => '<div class="cats tm-swiper tm-slider" data-lg-items="' . $category_per_page . '" data-sm-items="1" data-lg-gutter="30" data-nav="1" data-loop="1"><div class="swiper-inner"><div class="swiper-container"><div class="swiper-wrapper">',
						'after'  => '</div></div></div></div>',
				) );
			}
			?>

			<?php if ( $query->have_posts() ) : ?>

				<?php if ( ! $query->is_shop() || $shop_page_display !== 'subcategories' ) : ?>
					<?php
						if ($settings['shop_archive'] != 'none') {
							\Minimog_Woo::instance()->archive_product($query, $settings);
						}
					?>

					<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
						<?php if ( $query->have_posts() ) : ?>

							<?php
							$minimog_grid_query['source']        = $settings['query_source'];
							$minimog_grid_query['action']        = "{$post_type}_infinite_load";
							$minimog_grid_query['max_num_pages'] = $query->max_num_pages;
							$minimog_grid_query['found_posts']   = $query->found_posts;
							$minimog_grid_query['count']         = $query->post_count;
							$minimog_grid_query['query_vars']    = $this->get_query_args();
							$minimog_grid_query['settings']      = $settings;
							$minimog_grid_query                  = htmlspecialchars( wp_json_encode( $minimog_grid_query ) );
							?>
							<input type="hidden" class="minimog-query-input" <?php echo 'value="' . $minimog_grid_query . '"'; ?>/>

							<div class="modern-grid modern-<?php echo $settings['layout'] ?>">
								<?php while ( $query->have_posts() ) : $query->the_post(); ?>
									<?php
									/**
									 * For some reasons Elementor ignore remove_action.
									 * Then we will do it again. Fix for duplicate content.
									 */
									remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );
									remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );
									remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
									remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

									set_query_var( 'settings', $settings );
									//						wc_get_template_part( 'content', 'product' );

									set_query_var( 'position', $query->current_post );

									get_template_part( 'loop/widgets/products/style', $settings['layout'] );
									?>
								<?php endwhile; ?>
							</div>

							<?php $this->print_pagination( $query, $settings ); ?>

							<?php wp_reset_postdata(); ?>
						<?php endif; ?>
					</div>

				<?php endif; ?>

			<?php else : ?>

				<?php
					do_action( 'woocommerce_no_products_found' );
				?>

			<?php endif; ?>


		</div>

			<?php if ($settings['shop_archive'] == 'sidebar_right') { ?>
				<?php Minimog_Templates::shop_render_sidebar( 'right' ); ?>
			<?php } ?>

		</div>
		<?php
	}
}
