<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

defined( 'ABSPATH' ) || exit;

class Widget_Product_Widget extends Posts_Carousel_Base {

	public function get_name() {
		return 'tm-product-widget';
	}

	public function get_title() {
		return esc_html__( 'Product Widget', 'minimog' );
	}

	public function get_icon_part() {
		return 'eicon-posts-carousel';
	}

	public function get_keywords() {
		return [ 'product', 'carousel' ];
	}

	protected function get_post_type() {
		return 'product';
	}

	protected function _register_controls() {
		$this->add_layout_section();

		$this->add_thumbnail_style_section();

		$this->add_caption_style_section();

		parent::_register_controls();

		$this->update_controls();
	}

	private function update_controls() {
		$this->update_responsive_control( 'swiper_items', [
			'default'        => '1',
			'tablet_default' => '1',
			'mobile_default' => '1',
		] );

		$this->update_responsive_control( 'swiper_gutter', [
			'default' => 20,
		] );
	}

	private function add_layout_section() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'minimog' ),
		] );

		$this->add_control( 'style', [
			'label'       => esc_html__( 'Style', 'minimog' ),
			'type'        => Controls_Manager::SELECT,
			'options'     => array(
				'01' => esc_html__( 'Style 01', 'minimog' ),
			),
			'default'     => '01',
			'render_type' => 'template',
			'placeholder' => esc_html__( 'This widget require least 10 products.', 'minimog' ),
		] );



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

		$this->add_control( 'title_text', [
			'label'       => esc_html__( 'Title', 'minimog' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [
				'active' => true,
			],
			'default'     => esc_html__( 'This is the heading', 'minimog' ),
			'placeholder' => esc_html__( 'Enter your title', 'minimog' ),
			'label_block' => true,
		] );

		$this->end_controls_section();
	}

	private function add_thumbnail_style_section() {
		$this->start_controls_section( 'thumbnail_style_section', [
			'label' => esc_html__( 'Thumbnail', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'thumbnail_height', [
			'label'          => esc_html__( 'Height', 'minimog' ),
			'type'           => Controls_Manager::SLIDER,
			'default'        => [
				'unit' => 'px',
			],
			'tablet_default' => [
				'unit' => 'px',
			],
			'mobile_default' => [
				'unit' => 'px',
			],
			'size_units'     => [ 'px', '%', 'vw' ],
			'range'          => [
				'%'  => [
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
			'selectors'      => [
				'{{WRAPPER}} .post-thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
			],
			'render_type'    => 'template',
		] );

		$this->add_group_control( Group_Control_Css_Filter::get_type(), [
			'name'     => 'thumbnail_css_filters',
			'selector' => '{{WRAPPER}} .post-thumbnail img',
		] );

		$this->end_controls_section();
	}

	private function add_caption_style_section() {
		$this->start_controls_section( 'caption_style_section', [
			'label' => esc_html__( 'Caption', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_style_heading', [
			'label'     => esc_html__( 'Title', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => esc_html__( 'Typography', 'minimog' ),
			'selector' => '{{WRAPPER}} .product-widget-title',
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .product-widget-title' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function print_slide( array $settings ) {
		?>
		<div class="swiper-slide">
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
			wc_get_template_part( 'content-product-widget', $settings['style'] );
			?>
		</div>
		<?php
	}

	protected function print_slider( array $settings = null ) {

		if ( null === $settings ) {
			$settings = $this->get_active_settings();
		}

		$slider_settings = $this->get_slider_settings( $settings );

		$this->add_render_attribute( self::SLIDER_KEY, $slider_settings );

		?>

		<div <?php $this->print_attributes_string( 'slider' ); ?>>
			<div class="swiper-inner">

				<?php $this->before_slider_container(); ?>

				<div class="swiper-container abcd">
					<div class="swiper-wrapper">
		<?php $this->print_slides( $settings ); ?>

					</div>
				</div>

				<?php $this->after_slider_container(); ?>

			</div>
		</div>
		<?php
	}

	protected function print_slides( array $settings ) {
		$settings = $this->get_settings_for_display();
		$this->query_posts();
		/**
		 * @var $query \WP_Query
		 */
		$query = $this->get_query();
		?>
		<?php if ( $query->have_posts() ) : ?>

			<?php $this->before_loop();
			$loop = 0;
			?>

			<?php while ( $query->have_posts() ) : $query->the_post();
				$loop++;
				if( $loop === 10 ) {
					break;
				}
				if( ( $loop ) %3 === 1 ) {
					echo '<div class="swiper-slide">';
				}

			?>
				<?php $this->print_slide( $settings ); ?>
			<?php
				if( $loop %3 === 0 ) {
					echo '</div>';
				}
			endwhile; ?>
			<?php $this->after_loop(); ?>

		<?php endif;
		wp_reset_postdata();
	}

	public function before_slider() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( self::SLIDER_KEY, 'class', 'minimog-product-widget style-' . $settings['style'] );

		echo '<h3 class="product-widget-title">' . $settings['title_text'] . '</h3>';

	}

	public function print_title(array $settings) {
		if( empty( $settings['title_text'] ) ) {
			return;
		}

		$this->add_render_attribute( 'title_text', 'class', 'title' );

		$this->add_inline_editing_attributes( 'title_text', 'none' );

		$title_html = $settings['title_text'];

		printf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_size'], $this->get_render_attribute_string( 'title_text' ), $title_html );
	}
}
