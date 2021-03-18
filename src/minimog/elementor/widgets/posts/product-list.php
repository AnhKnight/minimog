<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || exit;

class Widget_Product_List extends Posts_Base {

	public function get_name() {
		return 'tm-product-list';
	}

	public function get_title() {
		return esc_html__( 'Product List', 'minimog' );
	}

	public function get_icon_part() {
		return 'eicon-woocommerce';
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

	protected function _register_controls() {
		$this->add_layout_section();

		$this->add_style_section();

		parent::_register_controls();
	}

	private function add_layout_section() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'minimog' ),
		] );

		$this->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'minimog' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'01' => '01',
				'02' => '02',
			],
			'default' => '01',
			'prefix_class' => 'minimog-product-list-style-',
		] );

		$this->end_controls_section();
	}

	private function add_style_section() {
		$this->start_controls_section( 'style_section', [
			'label' => esc_html__( 'Style', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => esc_html__( 'Typography', 'minimog' ),
			'selector' => '{{WRAPPER}} .product-title',
		] );

		$this->start_controls_tabs( 'color_tabs' );

		$this->start_controls_tab( 'color_normal_tab', [
			'label' => esc_html__( 'Normal', 'minimog' ),
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Title', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .product-title' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'color_hover_tab', [
			'label' => esc_html__( 'Hover', 'minimog' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'hover_title',
			'selector' => '{{WRAPPER}} .link:hover .product-title',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

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

		$this->add_render_attribute( 'wrapper', 'class', 'minimog-product-list' );
		?>
		<?php if ( $query->have_posts() ) : ?>
			<ul <?php $this->print_attributes_string( 'wrapper' ); ?>>
				<?php
				while ( $query->have_posts() ) : $query->the_post();
					$classes = [ 'product-item' ];
					?>
					<li <?php post_class( implode( ' ', $classes ) ); ?>>
						<a href="<?php the_permalink(); ?>" class="link">
							<h2 class="product-title">
								<?php the_title(); ?>
							</h2>
						</a>
					</li>
				<?php endwhile; ?>

				<?php wp_reset_postdata(); ?>
			</ul>
		<?php endif; ?>
		<?php
	}
}
