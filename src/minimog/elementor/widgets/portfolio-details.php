<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || exit;

class Widget_Portfolio_Details extends Base {

	public function get_name() {
		return 'tm-portfolio-details';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Details', 'minimog' );
	}

	public function get_icon_part() {
		return 'eicon-image-rollover';
	}

	public function get_keywords() {
		return [ 'portfolio', 'details' ];
	}

	protected function _register_controls() {
		$this->add_content_style_section();
	}

	private function add_content_style_section() {
		$this->start_controls_section( 'content_style_section', [
			'label' => esc_html__( 'Content', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'align', [
			'label'     => esc_html__( 'Text Align', 'minimog' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align_full(),
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}}' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_control( 'label_heading', [
			'label'     => esc_html__( 'Label', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'label_typography',
			'selector' => '{{WRAPPER}} .label',
		] );

		$this->add_control( 'label_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .label' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'value_heading', [
			'label'     => esc_html__( 'Value', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'value_typography',
			'selector' => '{{WRAPPER}} .value',
		] );

		$this->start_controls_tabs( 'value_colors_tabs' );

		$this->start_controls_tab( 'value_colors_normal_tab', [
			'label' => esc_html__( 'Normal', 'minimog' ),
		] );

		$this->add_control( 'value_text_color', [
			'label'     => esc_html__( 'Text', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .value' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'value_link_color', [
			'label'     => esc_html__( 'Link', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .value a' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'value_colors_hover_tab', [
			'label' => esc_html__( 'Hover', 'minimog' ),
		] );

		$this->add_control( 'value_link_hover_color', [
			'label'     => esc_html__( 'Link', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .value a:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'minimog-portfolio-details' );
		?>
		<div <?php $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php \Minimog_Portfolio::instance()->entry_details(); ?>

			<?php \Minimog_Portfolio::instance()->entry_share(); ?>
		</div>
		<?php
	}
}
