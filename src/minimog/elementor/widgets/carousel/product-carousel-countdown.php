<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

defined('ABSPATH') || exit;

class Widget_Product_Carousel_Countdown extends Posts_Carousel_Base
{

	public function get_name()
	{
		return 'tm-product-carousel-countdown';
	}

	public function get_title()
	{
		return esc_html__('Product Carousel Countdown', 'minimog');
	}

	public function get_icon_part()
	{
		return 'eicon-posts-carousel';
	}

	public function get_keywords()
	{
		return ['product', 'carousel'];
	}

	protected function get_post_type()
	{
		return 'product';
	}

	public function get_script_depends()
	{
		return ['minimog-product-carousel-countdown'];
	}

	protected function _register_controls()
	{
		$this->add_layout_section();

		$this->add_countdown_section();

		$this->add_thumbnail_style_section();

		$this->add_caption_style_section();

		parent::_register_controls();

		$this->update_controls();
	}

	private function update_controls()
	{
		$this->update_responsive_control('swiper_items', [
				'default' => '5',
				'tablet_default' => '3',
				'mobile_default' => '1',
		]);

		$this->update_responsive_control('swiper_gutter', [
				'default' => 20,
		]);
	}

	private function add_layout_section()
	{
		$this->start_controls_section('layout_section', [
				'label' => esc_html__('Layout', 'minimog'),
		]);

		$this->add_control('style', [
				'label' => esc_html__('Style', 'minimog'),
				'type' => Controls_Manager::SELECT,
				'options' => array(
						'grid-01' => esc_html__('Style 01', 'minimog'),
						'grid-02' => esc_html__('Style 02', 'minimog'),
						'grid-03' => esc_html__('Style 03', 'minimog'),
				),
				'default' => 'grid-01',
				'render_type' => 'template',
		]);

		$this->add_control('thumbnail_default_size', [
				'label' => esc_html__('Use Default Thumbnail Size', 'minimog'),
				'type' => Controls_Manager::SWITCHER,
				'default' => '1',
				'return_value' => '1',
				'separator' => 'before',
		]);

		$this->add_group_control(Group_Control_Image_Size::get_type(), [
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
						'thumbnail_default_size!' => '1',
				],
		]);

		$this->end_controls_section();
	}

	private function add_countdown_section()
	{
		$this->start_controls_section('countdown_section', [
				'label' => esc_html__('Countdown', 'minimog'),
		]);

		$this->add_control('countdown_type', [
				'label' => esc_html__('Type', 'minimog'),
				'type' => Controls_Manager::SELECT,
				'options' => [
						'due_date' => esc_html__('Due Date', 'minimog'),
						'daily' => esc_html__('Daily', 'minimog'),
				],
				'default' => 'daily',
		]);

		$this->add_control('due_date', [
				'label' => esc_html__('Due Date', 'minimog'),
				'type' => Controls_Manager::DATE_TIME,
				'default' => gmdate('Y-m-d H:i', strtotime('+1 month') + (get_option('gmt_offset') * HOUR_IN_SECONDS)),
			/* translators: %s: Time zone. */
				'description' => sprintf(__('Date set according to your timezone: %s.', 'minimog'), Utils::get_timezone_string()),
				'condition' => [
						'countdown_type' => 'due_date',
				],
		]);

		$this->add_control('countdown_title', [
				'label' => esc_html__('Title', 'minimog'),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
						'active' => true,
				],
				'default' => esc_html__('Daily Deal Of The Day', 'minimog'),
		]);

		$this->add_control('product_carousel_countdown_style', [
				'label' => esc_html__('Countdown Style', 'minimog'),
				'type' => Controls_Manager::SELECT,
				'options' => array(
						'product-carousel-countdown-style-01' => esc_html__('Style 01', 'minimog'),
						'product-carousel-countdown-style-02' => esc_html__('Style 02', 'minimog'),
				),
				'default' => 'product-carousel-countdown-style-01',
				'render_type' => 'template',
		]);

		$this->end_controls_section();
	}

	private function add_thumbnail_style_section()
	{
		$this->start_controls_section('thumbnail_style_section', [
				'label' => esc_html__('Thumbnail', 'minimog'),
				'tab' => Controls_Manager::TAB_STYLE,
		]);

		$this->add_responsive_control('thumbnail_height', [
				'label' => esc_html__('Height', 'minimog'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
						'unit' => 'px',
				],
				'tablet_default' => [
						'unit' => 'px',
				],
				'mobile_default' => [
						'unit' => 'px',
				],
				'size_units' => ['px', '%', 'vw'],
				'range' => [
						'%' => [
								'min' => 1,
								'max' => 100,
						],
						'px' => [
								'min' => 1,
								'max' => 1600,
						],
						'vw' => [
								'min' => 1,
								'max' => 100,
						],
				],
				'selectors' => [
						'{{WRAPPER}} .post-thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template',
		]);

		$this->add_group_control(Group_Control_Css_Filter::get_type(), [
				'name' => 'thumbnail_css_filters',
				'selector' => '{{WRAPPER}} .post-thumbnail img',
		]);

		$this->end_controls_section();
	}

	private function add_caption_style_section()
	{
		$this->start_controls_section('caption_style_section', [
				'label' => esc_html__('Caption', 'minimog'),
				'tab' => Controls_Manager::TAB_STYLE,
		]);

		$this->add_responsive_control('caption_padding', [
				'label' => esc_html__('Padding', 'minimog'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
						'{{WRAPPER}} .product-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		]);

		$this->add_responsive_control('caption_text_align', [
				'label' => esc_html__('Text Align', 'minimog'),
				'type' => Controls_Manager::CHOOSE,
				'options' => Widget_Utils::get_control_options_text_align(),
				'selectors' => [
						'{{WRAPPER}} .product-info' => 'text-align: {{VALUE}};',
				],
		]);

		$this->add_control('title_style_heading', [
				'label' => esc_html__('Title', 'minimog'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
				'name' => 'title_typography',
				'label' => esc_html__('Typography', 'minimog'),
				'selector' => '{{WRAPPER}} .product-info .woocommerce-loop-product__title',
		]);

		$this->start_controls_tabs('title_color_tabs');

		$this->start_controls_tab('title_color_normal_tab', [
				'label' => esc_html__('Normal', 'minimog'),
		]);

		$this->add_control('title_color', [
				'label' => esc_html__('Color', 'minimog'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} .product-info .woocommerce-loop-product__title' => 'color: {{VALUE}};',
				],
		]);

		$this->end_controls_tab();

		$this->start_controls_tab('title_color_hover_tab', [
				'label' => esc_html__('Hover', 'minimog'),
		]);

		$this->add_control('title_hover_color', [
				'label' => esc_html__('Color', 'minimog'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} .product-info .woocommerce-loop-product__title:hover' => 'color: {{VALUE}};',
				],
		]);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control('category_style_heading', [
				'label' => esc_html__('Category', 'minimog'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
				'name' => 'category_typography',
				'label' => esc_html__('Typography', 'minimog'),
				'selector' => '{{WRAPPER}} .product-info .loop-product__category',
		]);

		$this->start_controls_tabs('category_color_tabs');

		$this->start_controls_tab('category_color_normal_tab', [
				'label' => esc_html__('Normal', 'minimog'),
		]);

		$this->add_control('category_color', [
				'label' => esc_html__('Color', 'minimog'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} .product-info .loop-product__category' => 'color: {{VALUE}};',
				],
		]);

		$this->end_controls_tab();

		$this->start_controls_tab('category_color_hover_tab', [
				'label' => esc_html__('Hover', 'minimog'),
		]);

		$this->add_control('category_hover_color', [
				'label' => esc_html__('Color', 'minimog'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} .product-info .loop-product__category a:hover' => 'color: {{VALUE}};',
				],
		]);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function print_slide(array $settings)
	{
		?>
		<div class="swiper-slide">
			<?php
			/**
			 * For some reasons Elementor ignore remove_action.
			 * Then we will do it again. Fix for duplicate content.
			 */
			remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash');
			remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
			remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
			remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

			set_query_var('settings', $settings);
			wc_get_template_part('content-product', $settings['style']);
			?>
		</div>
		<?php
	}

	public function before_slider()
	{
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(self::SLIDER_KEY, 'class', 'minimog-product style-' . $settings['style']);

		echo '<div class="minimog-product-carousel-countdown">';

		$this->print_countdown();
	}

	public function after_slider()
	{
		echo '</div> </div>';
	}

	private function print_countdown()
	{
		$settings = $this->get_settings_for_display();

		$days_text = isset($days) && $days !== '' ? $days : esc_html__('Days', 'minimog');
		$hours_text = isset($hours) && $hours !== '' ? $hours : esc_html__('Hours', 'minimog');
		$minutes_text = isset($minutes) && $minutes !== '' ? $minutes : esc_html__('Minutes', 'minimog');
		$seconds_text = isset($seconds) && $seconds !== '' ? $seconds : esc_html__('Seconds', 'minimog');

		switch ($settings['countdown_type']) {
			case 'due_date':
				$due_date = $settings['due_date'];
				// Handle timezone ( we need to set GMT time )
				$gmt = get_gmt_from_date($due_date . ':00');
				$datetime = date('m/d/Y H:i:s', strtotime($gmt));
				break;
			case 'daily':
				$now = strtotime(current_time('m/d/Y H:i:s'));
				$endOfDay = strtotime("tomorrow", $now) - 1;

				$datetime = date('m/d/Y H:i:s', $endOfDay);
				break;
		}

		$this->add_render_attribute('countdown', [
				'class' => 'countdown',
				'data-date' => $datetime,
				'data-days-text' => $days_text,
				'data-hours-text' => $hours_text,
				'data-minutes-text' => $minutes_text,
				'data-seconds-text' => $seconds_text,
		]);

		$this->add_render_attribute('countdown_style_wrap', 'class', $settings['product_carousel_countdown_style']);
		?>
		<div <?php $this->print_render_attribute_string('countdown_style_wrap') ?>>
		<div class="product-countdown-header  " >
			<?php if (!empty($settings['countdown_title'])) : ?>
				<h6 class="product-countdown-heading"><?php echo esc_html($settings['countdown_title']); ?></h6>
			<?php endif; ?>
			<div class="countdown-wrap">
				<div class="countdown-label"><?php esc_html_e('End in:', 'minimog'); ?></div>
				<div <?php $this->print_render_attribute_string('countdown'); ?>></div>
			</div>

		</div>
		<?php

	}
}
