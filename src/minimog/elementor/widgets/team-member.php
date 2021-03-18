<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || exit;

class Widget_Team_Member extends Base {

	public function get_name() {
		return 'tm-team-member';
	}

	public function get_title() {
		return esc_html__( 'Team Member', 'minimog' );
	}

	public function get_icon_part() {
		return 'eicon-person';
	}

	public function get_keywords() {
		return [ 'team', 'member', 'avatar' ];
	}

	protected function _register_controls() {
		$this->add_content_section();

		$this->add_box_overlay_style_section();

		$this->add_content_style_section();
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Content', 'minimog' ),
		] );

		$this->add_control( 'style', [
			'label'        => esc_html__( 'Style', 'minimog' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => '01',
			'options'      => [
				'01' => esc_html__( '01', 'minimog' ),
				'02' => esc_html__( '02', 'minimog' ),
				'03' => esc_html__( '03', 'minimog' ),
			],
			'render_type'  => 'template',
			'prefix_class' => 'minimog-team-member-style-',
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

		$this->add_control( 'image', [
			'label' => esc_html__( 'Image', 'minimog' ),
			'type'  => Controls_Manager::MEDIA,
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'    => 'image',
			'default' => 'full',
		] );

		$this->add_control( 'name', [
			'label'   => esc_html__( 'Name', 'minimog' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'John Doe', 'minimog' ),
		] );

		$this->add_control( 'position', [
			'label'   => esc_html__( 'Position', 'minimog' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'CEO', 'minimog' ),
		] );

		$this->add_control( 'content', [
			'label' => esc_html__( 'Content', 'minimog' ),
			'type'  => Controls_Manager::TEXTAREA,
		] );

		$this->add_control( 'profile', [
			'label'         => esc_html__( 'Profile', 'minimog' ),
			'type'          => Controls_Manager::URL,
			'placeholder'   => esc_html__( 'https://your-link.com', 'minimog' ),
			'show_external' => true,
			'default'       => [
				'url'         => '',
				'is_external' => true,
				'nofollow'    => true,
			],
		] );

		$this->add_group_control( Group_Control_Tooltip::get_type(), [
			'name' => 'tooltip',
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'minimog' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Title', 'minimog' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'link', [
			'label'         => esc_html__( 'Link', 'minimog' ),
			'type'          => Controls_Manager::URL,
			'placeholder'   => esc_html__( 'https://your-link.com', 'minimog' ),
			'show_external' => true,
			'default'       => [
				'url'         => '',
				'is_external' => true,
				'nofollow'    => true,
			],
		] );

		$repeater->add_control( 'icon', [
			'label'       => esc_html__( 'Icon', 'minimog' ),
			'type'        => Controls_Manager::ICONS,
			'default'     => [
				'value'   => 'fab fa-facebook',
				'library' => 'fa-brands',
			],
			'recommended' => Widget_Utils::get_recommended_social_icons(),
		] );

		$this->add_control( 'social_networks', [
			'label'       => esc_html__( 'Social Networks', 'minimog' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'title' => esc_html__( 'Facebook', 'minimog' ),
					'link'  => [
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
					],
					'icon'  => [
						'value'   => 'fab fa-facebook-f',
						'library' => 'fa-brands',
					],
				],
				[
					'title' => esc_html__( 'Twitter', 'minimog' ),
					'link'  => [
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
					],
					'icon'  => [
						'value'   => 'fab fa-twitter',
						'library' => 'fa-brands',
					],
				],
				[
					'title' => esc_html__( 'Instagram', 'minimog' ),
					'link'  => [
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
					],
					'icon'  => [
						'value'   => 'fab fa-instagram',
						'library' => 'fa-brands',
					],
				],
				[
					'title' => esc_html__( 'Youtube Channel', 'minimog' ),
					'link'  => [
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
					],
					'icon'  => [
						'value'   => 'fab fa-youtube',
						'library' => 'fa-brands',
					],
				],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->end_controls_section();
	}

	private function add_box_overlay_style_section() {
		$this->start_controls_section( 'box_style_section', [
			'label' => esc_html__( 'Overlay', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'box',
			'selector' => '{{WRAPPER}} .overlay',
		] );

		$this->end_controls_section();
	}

	private function add_content_style_section() {
		$this->start_controls_section( 'content_style_section', [
			'label' => esc_html__( 'Content', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'text_align', [
			'label'        => esc_html__( 'Text Align', 'minimog' ),
			'type'         => Controls_Manager::CHOOSE,
			'options'      => Widget_Utils::get_control_options_text_align_full(),
			'prefix_class' => 'elementor%s-align-',
			'default'      => '',
		] );

		$this->add_control( 'text_heading', [
			'label'     => esc_html__( 'Text', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'text_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .text' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'text_typography',
			'label'    => esc_html__( 'Typography', 'minimog' ),
			'selector' => '{{WRAPPER}} .text',
		] );

		$this->add_control( 'name_heading', [
			'label'     => esc_html__( 'Name', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'name_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .name' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => esc_html__( 'Typography', 'minimog' ),
			'selector' => '{{WRAPPER}} .name',
		] );

		$this->add_control( 'position_heading', [
			'label'     => esc_html__( 'Position', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'position_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .position' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'label'    => esc_html__( 'Typography', 'minimog' ),
			'selector' => '{{WRAPPER}} .position',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'tm-team-member minimog-box' );
		?>
		<div <?php $this->print_attributes_string( 'wrapper' ); ?>>

			<div class="item">
				<?php if ( $settings['image']['url'] ) : ?>
					<div class="photo minimog-image">


						<?php echo \Minimog_Image::get_elementor_attachment( [
							'settings' => $settings,
						] ); ?>

						<div class="overlay"></div>

						<?php $this->print_social_networks(); ?>
					</div>

					<div class="info">
						<?php if ( in_array( $settings['style'], array( '03' ) ) ) : ?>
							<?php if ( ! empty( $settings['position'] ) ) : ?>
								<div class="position"><?php echo esc_html( $settings['position'] ); ?></div>
							<?php endif; ?>

							<?php $this->print_name(); ?>
						<?php else: ?>
							<?php $this->print_name(); ?>

							<?php if ( ! empty( $settings['position'] ) ) : ?>
								<div class="position"><?php echo esc_html( $settings['position'] ); ?></div>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( $settings['content'] !== '' ) : ?>
							<div class="description">
								<?php echo wp_kses( $settings['content'], 'minimog-default' ); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	private function print_name() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['name'] ) ) {
			return;
		}

		if ( ! empty( $settings['profile']['url'] ) ) {
			$this->add_link_attributes( 'profile', $settings['profile'] );
		}
		?>
		<div class="name-wrap">
			<h3 class="name">
				<?php
				if ( $settings['profile']['url'] !== '' ) {
					echo '<a ' . $this->get_render_attribute_string( 'profile' ) . '>';
					echo esc_html( $settings['name'] );
					echo '</a>';
				} else {
					echo esc_html( $settings['name'] );
				}
				?>
			</h3>
		</div>
		<?php
	}

	private function print_social_networks() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['social_networks'] ) ) {
			return;
		}

		$has_tooltip = ! empty( $settings['tooltip_enable'] ) && 'yes' === $settings['tooltip_enable'] ? true : false;
		?>
		<div class="social-networks">
			<div class="inner">
				<?php
				foreach ( $settings['social_networks'] as $item ) {
					$repeater_id = $item['_id'];
					$link_key    = 'link_' . $repeater_id;

					if ( $has_tooltip ) {
						$this->add_render_attribute( $link_key, 'aria-label', $item['title'] );

						$this->add_render_attribute( $link_key, 'class', "hint--bounce hint--{$settings['tooltip_position']}" );

						if ( ! empty( $settings['tooltip_skin'] ) ) {
							$this->add_render_attribute( $link_key, 'class', "hint--{$settings['tooltip_skin']}" );
						}
					}

					if ( ! empty( $item['link']['url'] ) ) {
						$this->add_link_attributes( $link_key, $item['link'] );
					}
					?>
					<a <?php $this->print_attributes_string( $link_key ); ?>>
						<?php Icons_Manager::render_icon( $item['icon'], [ 'class' => 'link-icon' ], 'span' ) ?>
					</a>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
}
