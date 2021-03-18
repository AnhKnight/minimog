<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Widget_Modern_Carousel extends Carousel_Base {

	public function get_name() {
		return 'tm-modern-carousel';
	}

	public function get_title() {
		return esc_html__( 'Modern Carousel', 'minimog' );
	}

	public function get_icon_part() {
		return 'eicon-posts-carousel';
	}

	public function get_keywords() {
		return [ 'modern', 'carousel' ];
	}

	protected function _register_controls() {
		$this->add_content_section();

		$this->add_style_section();

		parent::_register_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'minimog-modern-carousel' );
		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>
			<?php $this->print_slider( $settings ); ?>
		</div>
		<?php
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Content', 'minimog' ),
		] );

		$this->add_control( 'style', [
			'label'        => esc_html__( 'Style', 'minimog' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => array(
				'01' => '01',
				'02' => '02',
				'03' => '03',
			),
			'default'      => '01',
			'prefix_class' => 'minimog-modern-carousel-style-',
			'render_type'  => 'template',
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
		] );

		$this->add_responsive_control( 'height', [
			'label'          => esc_html__( 'Height', 'minimog' ),
			'type'           => Controls_Manager::SLIDER,
			'default'        => [
				'size' => 470,
				'unit' => 'px',
			],
			'tablet_default' => [
				'unit' => 'px',
			],
			'mobile_default' => [
				'unit' => 'px',
			],
			'size_units'     => [ 'px', '%', 'vh' ],
			'range'          => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1600,
				],
				'vh' => [
					'min' => 1,
					'max' => 100,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} .swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
			],
			'render_type'    => 'template',
			'condition'      => [
				'style' => [ '01' ],
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'label'     => esc_html__( 'Image Size', 'minimog' ),
			'name'      => 'image',
			'default'   => 'full',
			'separator' => 'before',
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'image', [
			'label'   => esc_html__( 'Image', 'minimog' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'minimog' ),
			'type'        => Controls_Manager::TEXTAREA,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_html__( 'Enter your title', 'minimog' ),
			'default'     => esc_html__( 'Add Your Heading Text Here', 'minimog' ),
		] );

		$repeater->add_control( 'tags', [
			'label'       => esc_html__( 'Tags', 'minimog' ),
			'type'        => Controls_Manager::TEXTAREA,
			'placeholder' => esc_html__( 'One tag per line', 'minimog' ),
		] );

		$repeater->add_control( 'description', [
			'label' => esc_html__( 'Description', 'minimog' ),
			'type'  => Controls_Manager::TEXTAREA,
		] );

		$repeater->add_control( 'button_text', [
			'label' => esc_html__( 'Button Text', 'minimog' ),
			'type'  => Controls_Manager::TEXT,
		] );

		$repeater->add_control( 'link', [
			'label'       => esc_html__( 'Link', 'minimog' ),
			'type'        => Controls_Manager::URL,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_html__( 'https://your-link.com', 'minimog' ),
		] );

		$this->add_control( 'slides', [
			'label'       => esc_html__( 'Slides', 'minimog' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'title'       => 'Automatic Updates',
					'tags'        => 'Design',
					'description' => 'Lorem ipsum dolor sit amet, consect etur elit. Suspe ndisse suscipit',
				],
				[
					'title'       => 'Flexible Options',
					'tags'        => 'Strategy',
					'description' => 'Lorem ipsum dolor sit amet, consect etur elit. Suspe ndisse suscipit',
				],
				[
					'title'       => 'Lifetime Use',
					'tags'        => 'Testing',
					'description' => 'Lorem ipsum dolor sit amet, consect etur elit. Suspe ndisse suscipit',
				],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->end_controls_section();
	}

	private function add_style_section() {
		$this->start_controls_section( 'style_section', [
			'label' => esc_html__( 'Style', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'slide_wrapper_heading', [
			'label' => esc_html__( 'Wrapper', 'minimog' ),
			'type'  => Controls_Manager::HEADING,
		] );

		$this->add_responsive_control( 'text_align', [
			'label'       => esc_html__( 'Text Align', 'minimog' ),
			'label_block' => true,
			'type'        => Controls_Manager::CHOOSE,
			'options'     => Widget_Utils::get_control_options_text_align(),
			'default'     => '',
			'selectors'   => [
				'{{WRAPPER}} .slide-content' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'slide_wrapper_padding', [
			'label'      => esc_html__( 'Padding', 'minimog' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .slide-layers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'box_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'minimog' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .minimog-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'image_style_heading', [
			'label'     => esc_html__( 'Image', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_responsive_control( 'image_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'minimog' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .minimog-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'title_style_heading', [
			'label'     => esc_html__( 'Title', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'title_margin', [
			'label'      => esc_html__( 'Margin', 'minimog' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => esc_html__( 'Typography', 'minimog' ),
			'selector' => '{{WRAPPER}} .title',
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'title_hover_color', [
			'label'     => esc_html__( 'Hover Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .title:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'description_style_heading', [
			'label'     => esc_html__( 'Description', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'     => 'desc_typography',
				'label'    => esc_html__( 'Typography', 'minimog' ),
				'selector' => '{{WRAPPER}} .description',
		] );

		$this->add_control( 'description_color', [
			'label'     => esc_html__( 'Description Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .description' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'tags_style_heading', [
				'label'     => esc_html__( 'Tag', 'minimog' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
				'name'     => 'tag_typography',
				'label'    => esc_html__( 'Typography', 'minimog' ),
				'selector' => '{{WRAPPER}} .slide-tag',
		] );

		$this->add_control( 'tag_color', [
				'label'     => esc_html__( 'Tag Color', 'minimog' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} .slide-tag' => 'color: {{VALUE}};',
				],
		] );

		$this->end_controls_section();
	}

	protected function print_slides( array $settings ) {

		foreach ( $settings['slides'] as $slide ) :
			$slide_id = $slide['_id'];
			$item_key = 'item_' . $slide_id;
			$box_key = 'box_' . $slide_id;
			$box_tag = 'div';

			$this->add_render_attribute( $item_key, 'class', [
				'swiper-slide',
				'elementor-repeater-item-' . $slide_id,
			] );

			$this->add_render_attribute( $box_key, 'class', 'minimog-box slide-wrapper' );

			if ( ! empty( $slide['link']['url'] ) ) {
				$box_tag = 'a';
				$this->add_render_attribute( $box_key, 'class', 'link-secret' );
				$this->add_link_attributes( $box_key, $slide['link'] );
			}
			?>
			<div <?php $this->print_attributes_string( $item_key ); ?>>
				<?php printf( '<%1$s %2$s>', $box_tag, $this->get_render_attribute_string( $box_key ) ); ?>

				<?php if ( '02' === $settings['style'] ): ?>
					<div class="slide-image minimog-image">
						<?php echo \Minimog_Image::get_elementor_attachment( [
							'settings'      => $slide,
							'size_settings' => $settings,
						] ); ?>

						<div class="slide-overlay"></div>
					</div>

					<div class="slide-content">
						<div class="slide-layers">
							<?php if ( ! empty( $slide['tags'] ) ) : ?>
								<?php
								$tags = explode( "\n", str_replace( "\r", "", $slide['tags'] ) );
								?>
								<div class="slide-tags">
									<?php foreach ( $tags as $tag ) : ?>
										<span class="slide-tag"><?php echo esc_html( $tag ); ?></span>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $slide['title'] ) ) : ?>
								<div class="slide-layer-wrap title-wrap">
									<div class="slide-layer">
										<h3 class="title"><?php echo wp_kses( $slide['title'], 'minimog-default' ); ?></h3>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $slide['description'] ) ) : ?>
								<div class="slide-layer-wrap description-wrap">
									<div class="slide-layer">
										<div
											class="description"><?php echo esc_html( $slide['description'] ); ?></div>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $slide['button_text'] ) ) : ?>
								<div class="slide-layer-wrap button-wrap">
									<div class="slide-layer">
										<div class="slide-button right-icon">
											<div class="button-content-wrapper">
												<span class="button-text">
													<?php echo esc_html( $slide['button_text'] ); ?>
												</span>
												<span class="button-icon">
													<i class="far fa-long-arrow-right"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php else: ?>
					<div class="slide-image minimog-image">
						<?php echo \Minimog_Image::get_elementor_attachment( [
							'settings'      => $slide,
							'size_settings' => $settings,
						] ); ?>

						<div class="slide-overlay"></div>

						<div class="slide-content">
							<div class="slide-layers">

								<?php if ( ! empty( $slide['tags'] ) ) : ?>
									<?php
									$tags = explode( "\n", str_replace( "\r", "", $slide['tags'] ) );
									?>
									<div class="slide-tags">
										<?php foreach ( $tags as $tag ) : ?>
											<span class="slide-tag"><?php echo esc_html( $tag ); ?></span>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $slide['title'] ) ) : ?>
									<div class="slide-layer-wrap title-wrap">
										<div class="slide-layer">
											<h3 class="title"><?php echo wp_kses( $slide['title'], 'minimog-default' ); ?></h3>
										</div>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $slide['description'] ) ) : ?>
									<div class="slide-layer-wrap description-wrap">
										<div class="slide-layer">
											<div
												class="description"><?php echo esc_html( $slide['description'] ); ?></div>
										</div>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $slide['button_text'] ) ) : ?>
									<div class="slide-layer-wrap button-wrap">
										<div class="slide-layer">
											<div class="slide-button right-icon">
												<div class="button-content-wrapper">
												<span class="button-text">
													<?php echo esc_html( $slide['button_text'] ); ?>
												</span>
													<span class="button-icon">
													<i class="far fa-long-arrow-right"></i>
												</span>
												</div>
											</div>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<?php printf( '</%1$s>', $box_tag ); ?>
			</div>
		<?php endforeach;
	}
}
