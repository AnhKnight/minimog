<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || exit;

class Widget_List extends Base {

	public function get_name() {
		return 'tm-list';
	}

	public function get_title() {
		return esc_html__( 'Modern Icon List', 'minimog' );
	}

	public function get_icon_part() {
		return 'eicon-bullet-list';
	}

	public function get_keywords() {
		return [ 'modern', 'icon list', 'icon', 'list' ];
	}

	protected function _register_controls() {
		$this->add_list_section();

		$this->add_styling_section();

		$this->add_text_style_section();

		$this->add_icon_style_section();
	}

	private function add_list_section() {
		$this->start_controls_section( 'list_section', [
			'label' => esc_html__( 'Icon List', 'minimog' ),
		] );

		$this->add_control( 'style', [
			'label'        => esc_html__( 'Style', 'minimog' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => '',
			'options'      => [
				''            => esc_html__( 'Normal', 'minimog' ),
				'icon-border' => esc_html__( 'Icon Border', 'minimog' ),
			],
			'prefix_class' => 'minimog-list-style-',
		] );

		$this->add_control( 'layout', [
			'label'        => esc_html__( 'Layout', 'minimog' ),
			'label_block'  => false,
			'type'         => Controls_Manager::CHOOSE,
			'default'      => 'block',
			'options'      => [
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
			'prefix_class' => 'minimog-list-layout-',
		] );

		$this->add_control( 'icon', [
			'label'       => esc_html__( 'Default Icon', 'minimog' ),
			'description' => esc_html__( 'Choose default icon for all items.', 'minimog' ),
			'type'        => Controls_Manager::ICONS,
		] );

		$this->add_control( 'icon_vertical_alignment', [
			'label'                => esc_html__( 'Icon Alignment', 'minimog' ),
			'type'                 => Controls_Manager::CHOOSE,
			'options'              => Widget_Utils::get_control_options_vertical_alignment(),
			'default'              => 'middle',
			'selectors_dictionary' => [
				'top'    => 'flex-start',
				'middle' => 'center',
				'bottom' => 'flex-end',
			],
			'selectors'            => [
				'{{WRAPPER}} .list-header' => 'align-items: {{VALUE}}',
			],
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'text', [
			'label'       => esc_html__( 'Text', 'minimog' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'Text', 'minimog' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'icon', [
			'label' => esc_html__( 'Icon', 'minimog' ),
			'type'  => Controls_Manager::ICONS,
		] );

		$repeater->add_control( 'link', [
			'label'       => esc_html__( 'Link', 'minimog' ),
			'type'        => Controls_Manager::URL,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_html__( 'https://your-link.com', 'minimog' ),
		] );

		$this->add_control( 'items', [
			'label'       => esc_html__( 'Items', 'minimog' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'text' => esc_html__( 'List Item #1', 'minimog' ),
				],
				[
					'text' => esc_html__( 'List Item #2', 'minimog' ),
				],
				[
					'text' => esc_html__( 'List Item #3', 'minimog' ),
				],
			],
			'title_field' => '{{{ elementor.helpers.renderIcon( this, icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
		] );

		$this->end_controls_section();
	}

	private function add_styling_section() {
		$this->start_controls_section( 'styling_section', [
			'label' => esc_html__( 'Styling', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'items_vertical_spacing', [
			'label'      => esc_html__( 'Items Spacing', 'minimog' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'max'  => 200,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}}.minimog-list-layout-block .item + .item, {{WRAPPER}}.minimog-list-layout-columns .item:nth-child(2) ~ .item' => 'margin-top: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}}.minimog-list-layout-inline .item'                                                                             => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
				'{{WRAPPER}} .minimog-list' => 'width: {{SIZE}}{{UNIT}};',
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

		$this->end_controls_section();
	}

	private function add_text_style_section() {
		$this->start_controls_section( 'text_style_section', [
			'label' => esc_html__( 'Text', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'text_typography',
			'label'    => esc_html__( 'Typography', 'minimog' ),
			'selector' => '{{WRAPPER}} .text',
		] );

		$this->start_controls_tabs( 'text_style_tabs' );

		$this->start_controls_tab( 'text_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'minimog' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'text',
			'selector' => '{{WRAPPER}} .text',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'text_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'minimog' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'hover_text',
			'selector' => '{{WRAPPER}} .link:hover .text',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_icon_style_section() {
		$this->start_controls_section( 'icon_style_section', [
			'label' => esc_html__( 'Icon', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'icon_space', [
			'label'     => esc_html__( 'Spacing', 'minimog' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .icon' => 'margin-right: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'icon_size', [
			'label'     => esc_html__( 'Size', 'minimog' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 3,
					'max' => 20,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'min_width', [
			'label'          => esc_html__( 'Min Width', 'minimog' ),
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
			'size_units'     => [ 'px', '%' ],
			'range'          => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} .icon' => 'min-width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'icon_style_tabs' );

		$this->start_controls_tab( 'icon_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'minimog' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'icon',
			'selector' => '{{WRAPPER}} .icon',
		] );

		$this->add_control( 'icon_marker_color', [
			'label'     => esc_html__( 'Icon Marker', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}}.minimog-list-style-icon-border .icon' => 'border-color: {{VALUE}};',
			],
			'condition' => [
				'style' => [
					'icon-border',
				],
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'icon_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'minimog' ),
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'     => 'hover_icon',
			'selector' => '{{WRAPPER}} .link:hover .icon',
		] );

		$this->add_control( 'hover_icon_marker_color', [
			'label'     => esc_html__( 'Icon Marker', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}}.minimog-list-style-icon-border .link:hover .icon' => 'border-color: {{VALUE}};',
			],
			'condition' => [
				'style' => [
					'icon-border',
				],
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'minimog-list' );

		$global_icon_html = '';
		if ( ! empty ( $settings['icon']['value'] ) ) {
			$global_icon_html = '<div class="minimog-icon icon">' . $this->get_render_icon( $settings, $settings['icon'], [ 'aria-hidden' => 'true' ], false, 'icon' ) . '</div>';
		}
		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<?php if ( $settings['items'] && count( $settings['items'] ) > 0 ) {
				foreach ( $settings['items'] as $key => $item ) {
					$item_key = 'item_' . $item['_id'];
					$this->add_render_attribute( $item_key, 'class', 'item' );

					$link_tag = 'div';

					$item_link_key = 'item_link_' . $item['_id'];

					$this->add_render_attribute( $item_link_key, 'class', 'link' );

					if ( ! empty( $item['link']['url'] ) ) {
						$link_tag = 'a';
						$this->add_link_attributes( $item_link_key, $item['link'] );
					}
					?>
					<div <?php $this->print_attributes_string( $item_key ); ?>>

						<?php printf( '<%1$s %2$s>', $link_tag, $this->get_render_attribute_string( $item_link_key ) ); ?>

						<div class="list-header">
							<?php if ( ! empty( $item['icon']['value'] ) ) { ?>
								<div class="minimog-icon icon">
									<?php $this->render_icon( $settings, $item['icon'], [ 'aria-hidden' => 'true' ], false, 'icon' ); ?>
								</div>
							<?php } else { ?>
								<?php echo '' . $global_icon_html; ?>
							<?php } ?>

							<div class="text-wrap">
								<?php if ( isset( $item['text'] ) ) { ?>
									<div class="text">
										<?php echo wp_kses_post( $item['text'] ); ?>
									</div>
								<?php } ?>
							</div>
						</div>

						<?php printf( '</%1$s>', $link_tag ); ?>

					</div>
					<?php
				}
			}
			?>
		</div>
		<?php
	}

	protected function _content_template() {
		// @formatter:off
		?>
		<#
		var global_icon_html = '';
		if ( '' !== settings.icon.value ) {
			var globalIconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' );
			global_icon_html += '<div class="minimog-icon icon">' + globalIconHTML.value + '</div>';
		}
		#>
		<div class="minimog-list">
			<# _.each( settings.items, function( item, index ) { #>
				<#
				var item_link_key = 'item_link_' + item._id;
				var link_tag = 'div';
				view.addRenderAttribute( item_link_key, 'class', 'link' );

				if ( '' !== item.link.url ) {
					link_tag = 'a';

					view.addRenderAttribute( item_link_key, 'href', '#' );
				}
				#>
				<div class="item">

					<{{{ link_tag }}} {{{ view.getRenderAttributeString( item_link_key ) }}}>

					<div class="list-header">
						<#
						var iconHTML = elementor.helpers.renderIcon( view, item.icon, { 'aria-hidden': true }, 'i' , 'object' );
						#>
						<# if ( '' !== item.icon.value ) { #>
							<div class="minimog-icon icon">
								{{{ iconHTML.value }}}
							</div>
						<# } else { #>
							{{{ global_icon_html }}}
						<# } #>

						<div class="text-wrap">
							<#	if ( '' !== item.text ) { #>
								<span class="text">{{{ item.text }}}</span>
							<# } #>
						</div>
					</div>

					</{{{ link_tag }}}>

				</div>
			<# }); #>
		</div>
		<?php
		// @formatter:off
	}
}
