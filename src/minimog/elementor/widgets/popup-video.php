<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;

defined( 'ABSPATH' ) || exit;

class Widget_Popup_Video extends Base {

	public function get_name() {
		return 'tm-popup-video';
	}

	public function get_title() {
		return esc_html__( 'Popup Video', 'minimog' );
	}

	public function get_icon_part() {
		return 'eicon-youtube';
	}

	public function get_keywords() {
		return [ 'popup', 'video', 'player', 'embed', 'youtube', 'vimeo' ];
	}

	protected function _register_controls() {
		$this->add_video_section();

		$this->add_image_style_section();

		$this->add_overlay_style_section();

		$this->add_button_style_section();
	}

	private function add_video_section() {
		$this->start_controls_section( 'video_section', [
			'label' => esc_html__( 'Video', 'minimog' ),
		] );

		$this->add_control( 'type', [
			'label'   => esc_html__( 'Type', 'minimog' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'poster',
			'options' => [
				'poster' => esc_html__( 'Poster', 'minimog' ),
				'button' => esc_html__( 'Button', 'minimog' ),
			],
		] );

		$this->add_control( 'video_url', [
			'label'       => esc_html__( 'Video Url', 'minimog' ),
			'description' => esc_html__( 'Input Youtube video url or Vimeo video url. For e.g: "https://www.youtube.com/watch?v=XHOmBV4js_E"', 'minimog' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
		] );

		$this->add_control( 'video_text', [
			'label'         => esc_html__( 'Video Text', 'minimog' ),
			'type'          => Controls_Manager::TEXT,
			'label  _block' => true,
			'condition'     => [
				'type' => 'button',
			],
		] );

		$this->add_control( 'video_text_animate', [
			'label'        => esc_html__( 'Text Animate', 'minimog' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				''             => esc_html__( 'None', 'minimog' ),
				'animate-line' => esc_html__( 'Animate Line', 'minimog' ),
			],
			'default'      => '',
			'prefix_class' => 'minimog-text-',
			'condition'    => [
				'type'        => 'button',
				'video_text!' => '',
			],
		] );

		$this->add_control( 'position', [
			'label'        => esc_html__( 'Icon Position', 'minimog' ),
			'type'         => Controls_Manager::CHOOSE,
			'default'      => 'top',
			'options'      => [
				'left'  => [
					'title' => esc_html__( 'Left', 'minimog' ),
					'icon'  => 'eicon-h-align-left',
				],
				'top'   => [
					'title' => esc_html__( 'Top', 'minimog' ),
					'icon'  => 'eicon-v-align-top',
				],
				'right' => [
					'title' => esc_html__( 'Right', 'minimog' ),
					'icon'  => 'eicon-h-align-right',
				],
			],
			'prefix_class' => 'minimog-popup-video-icon-position-',
			'toggle'       => false,
			'condition'    => [
				'type'        => 'button',
				'video_text!' => '',
			],
		] );

		$this->add_control( 'poster', [
			'label'     => esc_html__( 'Poster Image', 'minimog' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'type' => [ 'poster' ],
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'poster',
			'default'   => 'full',
			'condition' => [
				'type' => [ 'poster' ],
			],
		] );

		$this->add_control( 'poster_caption', [
			'label'         => esc_html__( 'Caption', 'minimog' ),
			'type'          => Controls_Manager::TEXTAREA,
			'label  _block' => true,
			'condition'     => [
				'type' => [ 'poster' ],
			],
		] );

		$this->add_control( 'hover_effect', [
			'label'        => esc_html__( 'Hover Effect', 'minimog' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				''         => esc_html__( 'None', 'minimog' ),
				'zoom-in'  => esc_html__( 'Zoom In', 'minimog' ),
				'zoom-out' => esc_html__( 'Zoom Out', 'minimog' ),
			],
			'default'      => '',
			'prefix_class' => 'minimog-animation-',
			'condition'    => [
				'type' => [ 'poster' ],
			],
		] );

		$this->add_responsive_control( 'align', [
			'label'        => esc_html__( 'Alignment', 'minimog' ),
			'type'         => Controls_Manager::CHOOSE,
			'options'      => Widget_Utils::get_control_options_horizontal_alignment(),
			'prefix_class' => 'elementor%s-align-',
			'default'      => '',
		] );

		$this->add_control( 'button_type', [
			'label'     => esc_html__( 'Button Type', 'minimog' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => '',
			'options'   => [
				''      => esc_html__( 'Default', 'minimog' ),
				'image' => esc_html__( 'Image', 'minimog' ),
			],
			'separator' => 'before',
		] );

		$this->add_control( 'button_image', [
			'label'     => esc_html__( 'Button Image', 'minimog' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => $this->get_default_play_icon(),
			],
			'condition' => [
				'button_type' => 'image',
			],
			'classes'   => 'minimog-control-media-auto',
		] );

		$this->end_controls_section();
	}

	private function add_image_style_section() {
		$this->start_controls_section( 'image_style_section', [
			'label'     => esc_html__( 'Image', 'minimog' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'type' => 'poster',
			],
		] );

		$this->add_responsive_control( 'image_border_width', [
			'label'     => esc_html__( 'Border Width', 'minimog' ),
			'type'      => Controls_Manager::SLIDER,
			'selectors' => [
				'{{WRAPPER}} .minimog-image' => 'border-width: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->add_responsive_control( 'image_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'minimog' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ '%', 'px' ],
			'range'      => [
				'%'  => [
					'max'  => 100,
					'step' => 1,
				],
				'px' => [
					'max'  => 200,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .minimog-image' => 'border-radius: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->start_controls_tabs( 'image_style_tabs' );

		$this->start_controls_tab( 'image_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'minimog' ),
		] );

		$this->add_control( 'image_border_color', [
			'label'     => esc_html__( 'Border Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .minimog-image' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'image_box_shadow',
			'selector' => '{{WRAPPER}} .minimog-image',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'image_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'minimog' ),
		] );

		$this->add_control( 'hover_image_border_color', [
			'label'     => esc_html__( 'Border Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .video-link:hover .minimog-image' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'hover_image_box_shadow',
			'selector' => '{{WRAPPER}} .video-link:hover .minimog-image',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_overlay_style_section() {
		$this->start_controls_section( 'overlay_style_section', [
			'label'     => esc_html__( 'Overlay', 'minimog' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'type' => 'poster',
			],
		] );

		$this->start_controls_tabs( 'overlay_style_tabs' );

		$this->start_controls_tab( 'overlay_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'minimog' ),
		] );

		$this->add_control( 'overlay_background', [
			'label'     => esc_html__( 'Background Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .video-overlay' => 'background: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'overlay_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'minimog' ),
		] );

		$this->add_control( 'overlay_hover_background', [
			'label'     => esc_html__( 'Background Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .video-link:hover .video-overlay' => 'background: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_button_style_section() {
		$this->start_controls_section( 'button_style_section', [
			'label' => esc_html__( 'Button', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$button_alignment_conditions = [
			'type' => 'poster',
		];

		$this->add_responsive_control( 'poster_button_h_align', [
			'label'                => esc_html__( 'Horizontal Align', 'minimog' ),
			'type'                 => Controls_Manager::CHOOSE,
			'options'              => Widget_Utils::get_control_options_horizontal_alignment(),
			'default'              => 'center',
			'toggle'               => false,
			'selectors_dictionary' => [
				'left'  => 'flex-start',
				'right' => 'flex-end',
			],
			'selectors'            => [
				'{{WRAPPER}} .video-button' => 'justify-content: {{VALUE}}',
			],
			'condition'            => $button_alignment_conditions,
		] );

		$this->add_responsive_control( 'poster_button_v_align', [
			'label'                => esc_html__( 'Vertical Align', 'minimog' ),
			'type'                 => Controls_Manager::CHOOSE,
			'options'              => Widget_Utils::get_control_options_vertical_alignment(),
			'default'              => 'middle',
			'toggle'               => false,
			'selectors_dictionary' => [
				'top'    => 'flex-start',
				'middle' => 'center',
				'bottom' => 'flex-end',
			],
			'selectors'            => [
				'{{WRAPPER}} .video-button' => 'align-items: {{VALUE}}',
			],
			'condition'            => $button_alignment_conditions,
		] );

		$this->add_responsive_control( 'poster_button_offset', [
			'label'      => esc_html__( 'Offset', 'minimog' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .video-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition'  => $button_alignment_conditions,
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow',
			'selector' => '{{WRAPPER}} .video-play',
		] );

		$this->add_responsive_control( 'button_size', [
			'label'     => esc_html__( 'Size', 'minimog' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 50,
					'max' => 200,
				],
			],
			'default'   => [
				'unit' => 'px',
			],
			'selectors' => [
				'{{WRAPPER}} .tm-popup-video-icon-play .video-play-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .tm-popup-video-image-play .video-play img'            => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'button_border_size', [
			'label'     => esc_html__( 'Border', 'minimog' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 1,
					'max' => 20,
				],
			],
			'default'   => [
				'unit' => 'px',
			],
			'selectors' => [
				'{{WRAPPER}} .video-play-icon' => 'border-width: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'button_type!' => 'image',
			],
		] );

		$this->start_controls_tabs( 'button_style_tabs', [
			'condition' => [
				'button_type!' => 'image',
			],
		] );

		$this->start_controls_tab( 'button_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'minimog' ),
		] );

		$this->add_control( 'button_text_color', [
			'label'     => esc_html__( 'Icon Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .icon:before' => 'border-left-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'button_background_color', [
			'label'     => esc_html__( 'Background Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .video-play' => 'background: {{VALUE}};',
			],
		] );

		$this->add_control( 'button_border_color', [
			'label'     => esc_html__( 'Border Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .video-play' => 'border-color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'button_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'minimog' ),
		] );

		$this->add_control( 'button_hover_text_color', [
			'label'     => esc_html__( 'Icon Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .video-link:hover .icon:before' => 'border-left-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'button_hover_background_color', [
			'label'     => esc_html__( 'Background Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .video-link:hover .video-play' => 'background: {{VALUE}};',
			],
		] );

		$this->add_control( 'button_hover_border_color', [
			'label'     => esc_html__( 'Border Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .video-link:hover .video-play' => 'border-color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		/**
		 * Video Text
		 */
		$text_conditions = [
			'type'        => 'button',
			'video_text!' => '',
		];

		$this->add_control( 'video_text_heading', [
			'label'     => esc_html__( 'Text', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => $text_conditions,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'video_text_typography',
			'selector'  => '{{WRAPPER}} .video-text',
			'condition' => $text_conditions,
		] );

		$this->add_group_control( Group_Control_Text_Gradient::get_type(), [
			'name'      => 'video_text_color',
			'selector'  => '{{WRAPPER}} .video-text',
			'condition' => $text_conditions,
		] );

		/**
		 * Video Text Animate Line
		 */
		$text_line_conditions = [
			'type'               => 'button',
			'video_text!'        => '',
			'video_text_animate' => 'animate-line',
		];

		$this->add_control( 'video_text_line_heading', [
			'label'     => esc_html__( 'Line', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => $text_line_conditions,
		] );

		$this->start_controls_tabs( 'video_text_line_style_tabs', [
			'condition' => $text_line_conditions,
		] );

		$this->start_controls_tab( 'video_text_line_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'minimog' ),
		] );

		$this->add_control( 'video_text_line_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .video-text:before' => 'background: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'video_text_line_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'minimog' ),
		] );

		$this->add_control( 'hover_video_text_line_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .video-text:after' => 'background: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'tm-popup-video' );
		$this->add_render_attribute( 'wrapper', 'class', 'type-' . $settings['type'] );

		if ( ! empty( $settings['button_type'] ) && 'image' === $settings['button_type'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'tm-popup-video-image-play' );
		} else {
			$this->add_render_attribute( 'wrapper', 'class', 'tm-popup-video-icon-play' );
		}

		$this->add_render_attribute( 'link', 'class', 'video-link minimog-box link-secret' );
		$this->add_render_attribute( 'link', 'href', esc_url( $settings['video_url'] ) );
		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<a <?php $this->print_attributes_string( 'link' ); ?>>

				<?php if ( 'button' === $settings['type'] ) : ?>
					<?php $this->print_video_button( $settings ); ?>
				<?php else: ?>
					<?php $this->print_video_poster( $settings ); ?>
				<?php endif; ?>

			</a>
		</div>
		<?php
	}

	private function print_video_poster( array $settings ) {
		?>
		<div class="video-poster">
			<div class="minimog-image">
				<?php echo \Minimog_Image::get_elementor_attachment( [
					'settings'  => $settings,
					'image_key' => 'poster',
				] ); ?>
			</div>

			<div class="video-overlay"></div>

			<?php $this->print_video_button( $settings ); ?>
		</div>

		<?php if ( ! empty( $settings['poster_caption'] ) ) : ?>
			<div class="video-poster-caption">
				<?php echo esc_html( $settings['poster_caption'] ); ?>
			</div>
		<?php endif; ?>
		<?php
	}

	private function print_video_button( array $settings ) {
		?>
		<div class="video-button">
			<?php if ( 'image' === $settings['button_type'] ) { ?>
				<?php $this->print_button_image( $settings ); ?>
			<?php } else { ?>
				<div class="video-play video-play-icon">
					<span class="icon"></span>
				</div>
			<?php } ?>

			<?php if ( ! empty( $settings['video_text'] ) ) : ?>
				<div class="video-text"><?php echo esc_html( $settings['video_text'] ); ?></div>
			<?php endif; ?>
		</div>
		<?php
	}

	private function print_button_image( array $settings ) {
		if ( empty( $settings['button_image']['url'] ) ) {
			return;
		}
		?>
		<div class="video-play video-play-image">
			<?php echo \Minimog_Image::get_elementor_attachment( [
				'settings'   => $settings,
				'image_key'  => 'button_image',
				'attributes' => [
					'alt' => esc_attr__( 'Play Icon', 'minimog' ),
				],
			] ); ?>
		</div>
		<?php
	}

	private function get_default_play_icon() {
		$icon_url = MINIMOG_ELEMENTOR_ASSETS . '/images/video-play-light.png';

		return $icon_url;
	}
}
