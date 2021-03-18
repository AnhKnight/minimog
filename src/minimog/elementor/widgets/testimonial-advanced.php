<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;

defined('ABSPATH') || exit;

class Widget_Testimonial_Advanced extends Base
{

	public function get_name()
	{
		return 'tm-testimonial-advanced';
	}

	public function get_title()
	{
		return esc_html__('Testimonial Advanced', 'minimog');
	}

	public function get_icon_part()
	{
		return 'eicon-testimonial-advanced';
	}

	public function get_keywords()
	{
		return ['testimonial', 'commment', 'advanced'];
	}

	protected function _register_controls()
	{

		$this->add_avatar_section();

		$this->add_title_section();

		$this->add_description_section();

		$this->add_cite_section();

		$this->add_wrapper_style_section();

		$this->add_title_style_section();

		$this->add_description_style_section();

	}

	private function add_avatar_section()
	{
		$this->start_controls_section('image_section', [
				'label' => esc_html__('Avatar', 'minimog'),
		]);


		$this->add_control('image_heading', [
				'label' => esc_html__('Image', 'minimog'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$this->add_control('image', [
				'label' => esc_html__('Choose Image', 'minimog'),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
						'active' => true,
				],
				'default' => [
						'url' => Utils::get_placeholder_image_src(),
				],
		]);

		$this->add_group_control(Group_Control_Image_Size::get_type(), [
				'name' => 'image',
			// Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
				'condition' => [
						'image[url]!' => '',
				],
		]);


		$this->add_control('view', [
				'label' => esc_html__('View', 'minimog'),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
		]);

		$this->end_controls_section();
	}


	private function add_title_section()
	{
		$this->start_controls_section('title_section', [
				'label' => esc_html__('Title', 'minimog'),
		]);
		$this->add_control('title', [
				'label' => esc_html__('Text', 'minimog'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter your title', 'minimog'),
				'default' => esc_html__('Great quality', 'minimog'),
		]);

		$this->add_control('title_link', [
				'label' => esc_html__('Link', 'minimog'),
				'type' => Controls_Manager::URL,
				'dynamic' => [
						'active' => true,
				],
				'default' => [
						'url' => '',
				],
				'separator' => 'before',
		]);

		$this->add_control('view', [
				'label' => esc_html__('View', 'minimog'),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
		]);


		$this->end_controls_section();
	}

	private function add_description_section()
	{
		$this->start_controls_section('description_section', [
				'label' => esc_html__('Description', 'minimog'),
		]);

		$this->add_control('description', [
				'label' => esc_html__('Text', 'minimog'),
				'type' => Controls_Manager::WYSIWYG,
				'dynamic' => [
						'active' => true,
				],
				'default' => esc_html__('Thanks for always keeping your WP themes up to date. Your level of support and dedication is second to none. ', 'minimog'),
		]);

		$this->end_controls_section();
	}

	private function add_cite_section()
	{
		$this->start_controls_section('cite_section', [
				'label' => esc_html__('Cite ', 'minimog'),
		]);

		$this->add_control('cite_name', [
				'label' => esc_html__('Name', 'minimog'),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
						'active' => true,
				],
				'default' => esc_html__('Jean Phelps', 'minimog'),
		]);

		$this->add_control('cite_position', [
				'label' => esc_html__('Position', 'minimog'),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
						'active' => true,
				],
				'default' => esc_html__('/Reporter', 'minimog'),
		]);

		$this->add_control('view', [
				'label' => esc_html__('View', 'minimog'),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
		]);
		$this->add_control('view', [
				'label' => esc_html__('View', 'minimog'),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
		]);

		$this->end_controls_section();
	}


	private function add_wrapper_style_section()
	{
		$this->start_controls_section('wrapper_style_section', [
				'tab' => Controls_Manager::TAB_STYLE,
				'label' => esc_html__('Wrapper', 'minimog'),
		]);

		$this->add_responsive_control('align', [
				'label' => esc_html__('Text Align', 'minimog'),
				'type' => Controls_Manager::CHOOSE,
				'options' => Widget_Utils::get_control_options_text_align_full(),
				'default' => '',
				'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
		]);

		$this->add_responsive_control('max_width', [
				'label' => esc_html__('Max Width', 'minimog'),
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
				'size_units' => ['px', '%'],
				'range' => [
						'%' => [
								'min' => 1,
								'max' => 100,
						],
						'px' => [
								'min' => 1,
								'max' => 1600,
						],
				],
				'selectors' => [
						'{{WRAPPER}} .tm-testimonial-advanced' => 'width: {{SIZE}}{{UNIT}};',
				],
		]);

		$this->add_responsive_control('alignment', [
				'label' => esc_html__('Alignment', 'minimog'),
				'type' => Controls_Manager::CHOOSE,
				'options' => Widget_Utils::get_control_options_horizontal_alignment(),
				'selectors_dictionary' => [
						'left' => 'flex-start',
						'right' => 'flex-end',
				],
				'selectors' => [
						'{{WRAPPER}} .elementor-widget-container' => 'display: flex; justify-content: {{VALUE}}',
				],
		]);


		$this->add_responsive_control('height_box', [
				'label' => esc_html__('Height Box', 'minimog'),
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
				'size_units' => ['px', '%'],
				'range' => [
						'%' => [
								'min' => 1,
								'max' => 100,
						],
						'px' => [
								'min' => 1,
								'max' => 1600,
						],
				],
				'selectors' => [
						'{{WRAPPER}} .testimonial-content' => 'height: {{SIZE}}{{UNIT}};',
				],
		]);

		$this->add_responsive_control('cite_space', [
				'label' => esc_html__('Space Cite', 'minimog'),
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
				'size_units' => ['px', '%'],
				'range' => [
						'%' => [
								'min' => 1,
								'max' => 100,
						],
						'px' => [
								'min' => 1,
								'max' => 1600,
						],
				],
				'selectors' => [
						'{{WRAPPER}} .cite-space' => 'height: {{SIZE}}{{UNIT}};',
				],
		]);

		$this->end_controls_section();
	}

	private function add_title_style_section()
	{
		$this->start_controls_section('title_style_section', [
				'label' => esc_html__('Title', 'minimog'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
						'title!' => '',
				],
		]);

		$this->add_responsive_control('heading_max_width', [
				'label' => esc_html__('Max Width', 'minimog'),
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
				'size_units' => ['px', '%'],
				'range' => [
						'%' => [
								'min' => 1,
								'max' => 100,
						],
						'px' => [
								'min' => 1,
								'max' => 1600,
						],
				],
				'selectors' => [
						'{{WRAPPER}} .title' => 'max-width: {{SIZE}}{{UNIT}};',
				],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
				'name' => 'title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .title',
		]);

		$this->add_group_control(Group_Control_Text_Shadow::get_type(), [
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .title',
		]);

		$this->add_control('blend_mode', [
				'label' => esc_html__('Blend Mode', 'minimog'),
				'type' => Controls_Manager::SELECT,
				'options' => [
						'' => esc_html__('Normal', 'minimog'),
						'multiply' => 'Multiply',
						'screen' => 'Screen',
						'overlay' => 'Overlay',
						'darken' => 'Darken',
						'lighten' => 'Lighten',
						'color-dodge' => 'Color Dodge',
						'saturation' => 'Saturation',
						'color' => 'Color',
						'difference' => 'Difference',
						'exclusion' => 'Exclusion',
						'hue' => 'Hue',
						'luminosity' => 'Luminosity',
				],
				'selectors' => [
						'{{WRAPPER}} .title' => 'mix-blend-mode: {{VALUE}}',
				],
				'separator' => 'none',
		]);

		$this->start_controls_tabs('title_style_tabs');

		$this->start_controls_tab('title_style_normal_tab', [
				'label' => esc_html__('Normal', 'minimog'),
		]);

		$this->add_group_control(Group_Control_Text_Gradient::get_type(), [
				'name' => 'title',
				'selector' => '{{WRAPPER}} .title',
		]);

		$this->end_controls_tab();

		$this->start_controls_tab('title_style_hover_tab', [
				'label' => esc_html__('Hover', 'minimog'),
		]);

		$this->add_group_control(Group_Control_Text_Gradient::get_type(), [
				'name' => 'title_hover',
				'selector' => '{{WRAPPER}} .title > a:hover',
		]);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();
	}

	private
	function add_description_style_section()
	{
		$this->start_controls_section('description_style_section', [
				'label' => esc_html__('Description', 'minimog'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
						'description!' => '',
				],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
				'name' => 'description',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .description',
		]);

		$this->add_group_control(Group_Control_Text_Gradient::get_type(), [
				'name' => 'description',
				'selector' => '{{WRAPPER}} .description',
		]);

		$this->add_responsive_control('description_spacing', [
				'label' => esc_html__('Spacing', 'minimog'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
						'unit' => 'px',
				],
				'size_units' => ['px', '%', 'em'],
				'range' => [
						'%' => [
								'min' => 0,
								'max' => 100,
						],
						'px' => [
								'min' => 0,
								'max' => 200,
						],
				],
				'selectors' => [
						'{{WRAPPER}} .description-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
		]);

		$this->add_responsive_control('description_max_width', [
				'label' => esc_html__('Max Width', 'minimog'),
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
				'size_units' => ['px', '%'],
				'range' => [
						'%' => [
								'min' => 1,
								'max' => 100,
						],
						'px' => [
								'min' => 1,
								'max' => 1600,
						],
				],
				'selectors' => [
						'{{WRAPPER}} .description' => 'max-width: {{SIZE}}{{UNIT}};',
				],
		]);

		$this->add_control( 'name_style', [
				'label'     => esc_html__( 'Name', 'minimog' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
		] );

		$this->add_group_control(Group_Control_Typography::get_type(), [
				'name' => 'cite_name',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cite-name',
		]);

		$this->add_control( 'name_color', [
				'label'     => esc_html__( 'Color', 'minimog' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} .cite-name' => 'color: {{VALUE}};',
				],
		] );

		$this->add_control( 'position_style', [
				'label'     => esc_html__( 'Position', 'minimog' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
		] );

		$this->add_group_control(Group_Control_Typography::get_type(), [
				'name' => 'cite_position',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cite-position',
		]);

		$this->add_control( 'position_color', [
				'label'     => esc_html__( 'Color', 'minimog' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} .cite-position' => 'color: {{VALUE}};',
				],
		] );
		$this->end_controls_section();
	}




	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('wrapper', 'class', 'tm-testimonial-advanced');
		?>
		<div <?php $this->print_attributes_string('wrapper'); ?>>
			<div class="testimonial-content">

				<?php $this->print_avatar() ?>

				<?php $this->print_title($settings); ?>

				<?php $this->print_description($settings); ?>
				<div class="cite-space"></div>

				<?php $this->print_cite($settings); ?>
			</div>
		</div>
		<?php
	}

	private function print_avatar()
	{
		$settings = $this->get_settings_for_display();
		if (empty($settings['image']['url'])) {
			return;
		}
		?>
		<div class="testimonial-avatar">
			<?php echo \Minimog_Image::get_elementor_attachment([
					'settings' => $settings,
			]); ?>
		</div>
		<?php

	}

	private function print_title(array $settings)
	{
		if (empty($settings['title'])) {
			return;
		}

		$this->add_render_attribute('title', 'class', 'testimonial-title');


		$title = $settings['title'];

		if (!empty($settings['title_link']['url'])) {
			$this->add_link_attributes('url', $settings['title_link']);

			$title = sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), $title);
		}
		?>
		<div class="title-wrap">
			<a class="title" <?php $this->print_render_attribute_string('url') ?>><?php echo $title; ?></a>
		</div>
		<?php
	}

	private function print_cite(array $settings)
	{
		if (empty($settings['cite_name']) && empty($settings['cite_position'])) {
			return;
		}

		// .elementor-heading-title -> Default color from section + column.
		$this->add_render_attribute('sub_title', 'class', 'cite ');
		?>
		<div class="cite-wrap">
			<div class="cite-name"><?php echo $settings['cite_name']; ?></div>
			<div class="cite-position"><?php echo $settings['cite_position']; ?></div>
		</div>
		<?php
	}

	private function print_description(array $settings)
	{
		if (empty($settings['description'])) {
			return;
		}

		$this->add_render_attribute('description', 'class', 'description');
		?>
		<div class="description-wrap">
			<div <?php $this->print_attributes_string('description'); ?>>
				<?php echo wp_kses_post($settings['description']); ?>
			</div>
		</div>
		<?php
	}

}






