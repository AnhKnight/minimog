<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || exit;

class Widget_Attribute_List extends Base {

	public function get_name() {
		return 'tm-attribute-list';
	}

	public function get_title() {
		return esc_html__( 'Attribute List', 'minimog' );
	}

	public function get_icon_part() {
		return 'eicon-columns';
	}

	public function get_keywords() {
		return [ 'list', 'attribute' ];
	}

	protected function _register_controls() {
		$this->start_controls_section( 'layout_section', [
			'label' => esc_html__( 'Layout', 'minimog' ),
		] );

		$this->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'minimog' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'01' => esc_html__( '01', 'minimog' ),
				'02' => esc_html__( '02', 'minimog' ),
			],
			'default' => '01',
		] );

		$this->add_control( 'layout', [
				'label'          => esc_html__( 'Layout', 'minimog' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'block',
				'options'        => [
					'block'   => [
						'title' => esc_html__( 'Default', 'minimog' ),
						'icon'  => 'eicon-editor-list-ul',
					],
					'inline'  => [
						'title' => esc_html__( 'Inline', 'minimog' ),
						'icon'  => 'eicon-ellipsis-h',
					],
					'columns' => [
						'title' => esc_html__( 'Columns', 'minimog' ),
						'icon'  => 'eicon-columns',
					],
				],
				'render_type'    => 'template',
				'classes'        => 'elementor-control-start-end',
				'label_block'    => false,
				'style_transfer' => true,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control( 'name', [
			'label'       => esc_html__( 'Name', 'minimog' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Name', 'minimog' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'value', [
			'label' => esc_html__( 'Value', 'minimog' ),
			'type'  => Controls_Manager::TEXTAREA,
		] );

		$this->add_control( 'items', [
			'label'       => esc_html__( 'Items', 'minimog' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'name'  => esc_html__( 'Attribute #1', 'minimog' ),
					'value' => esc_html__( 'Value #1', 'minimog' ),
				],
				[
					'name'  => esc_html__( 'Attribute #2', 'minimog' ),
					'value' => esc_html__( 'Value #2', 'minimog' ),
				],
			],
			'title_field' => '{{{ name }}}',
		] );

		$this->end_controls_section();

		$this->add_styling_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'tm-attribute-list' );

		if ( ! empty( $settings['style'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'style-' . $settings['style'] );
		}

		if ( ! empty( $settings['layout'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'layout-' . $settings['layout'] );
		}
		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<div class="inner">
				<div class="list">
					<?php if ( $settings['items'] && count( $settings['items'] ) > 0 ) {
						foreach ( $settings['items'] as $key => $attribute ) {
							?>
							<div class="item">
								<h6 class="name"><?php echo esc_html( $attribute['name'] ); ?></h6>
								<div class="value"><?php echo wp_kses( $attribute['value'], 'minimog-default' ); ?></div>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}

	private function add_styling_section() {
		$this->start_controls_section( 'styling_section', [
			'label' => esc_html__( 'Styling', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'items_vertical_spacing', [
			'label'      => esc_html__( 'Items Vertical Spacing', 'minimog' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'max'  => 200,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .layout-block .item + .item'                => 'margin-top: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .layout-columns .item:nth-child(2) ~ .item' => 'margin-top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_control( 'width', [
			'label'      => esc_html__( 'Width', 'minimog' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'%'  => [
					'max'  => 100,
					'step' => 1,
				],
				'px' => [
					'max'  => 1000,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .inner' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'alignment', [
			'label'     => esc_html__( 'Alignment', 'minimog' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_horizontal_alignment(),
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}}' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'text_align', [
			'label'     => esc_html__( 'Text Align', 'minimog' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align(),
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .item' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_control( 'name_heading', [
			'label'     => esc_html__( 'Name', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => esc_html__( 'Typography', 'minimog' ),
			'selector' => '{{WRAPPER}} .name',
		] );

		$this->add_control( 'name_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .name' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'value_heading', [
			'label'     => esc_html__( 'Value', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'value_typography',
			'label'    => esc_html__( 'Typography', 'minimog' ),
			'selector' => '{{WRAPPER}} .value',
		] );

		$this->add_control( 'value_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .value' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'separator_heading', [
			'label'     => esc_html__( 'Separator', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'separator_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .item + .item:before' => 'background: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}
}
