<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Widget_Banner_Categories extends Base {

	public function get_name() {
		return 'tm-banner-categories';
	}

	public function get_title() {
		return esc_html__( 'Banner Categories', 'minimog' );
	}

	public function get_icon_part() {
		return 'eicon-image-rollover';
	}

	public function get_keywords() {
		return [ 'banner' ];
	}

	protected function _register_controls() {
		$this->add_content_section();

		$this->add_box_style_section();

		$this->add_content_style_section();
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Content', 'minimog' ),
		] );

		$this->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'minimog' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'01' => '01',
			],
			'default' => '01',
		] );

		$this->add_control( 'cat_slugs', [
			'label'     => __( 'Select Categories', 'minimog' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => '',
			'multiple'  => true,
			'options'   => self::minimog_get_categories(),
		] );

		$this->add_control( 'hover_effect', [
			'label'        => esc_html__( 'Hover Effect', 'minimog' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				''         => esc_html__( 'None', 'minimog' ),
				'zoom-in'  => esc_html__( 'Zoom In', 'minimog' ),
				'zoom-out' => esc_html__( 'Zoom Out', 'minimog' ),
				'move-up'  => esc_html__( 'Move Up', 'minimog' ),
			],
			'default'      => '',
			'prefix_class' => 'minimog-animation-',
		] );

		$this->add_control( 'image', [
			'label'   => esc_html__( 'Choose Image', 'minimog' ),
			'type'    => Controls_Manager::MEDIA,
			'dynamic' => [
				'active' => true,
			],
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'image',
			// Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
			'default'   => 'full',
			'separator' => 'none',
		] );

		$this->add_control( 'view', [
			'label'   => esc_html__( 'View', 'minimog' ),
			'type'    => Controls_Manager::HIDDEN,
			'default' => 'traditional',
		] );

		$this->end_controls_section();
	}

	private function add_box_style_section() {
		$this->start_controls_section( 'box_style_section', [
			'label' => esc_html__( 'Box', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'text_align', [
			'label'     => esc_html__( 'Alignment', 'minimog' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align_full(),
			'selectors' => [
				'{{WRAPPER}} .minimog-box' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'box_radius', [
			'label'      => esc_html__( 'Border box radius', 'minimog' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => 'px',
			'selectors'  => [
				'{{WRAPPER}} .minimog-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'box_max_width', [
			'label'      => esc_html__( 'Max Width', 'minimog' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'unit' => 'px',
			],
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'%'  => [
					'min' => 1,
					'max' => 100,
				],
				'px' => [
					'min' => 1,
					'max' => 1600,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .minimog-box' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'box_horizontal_alignment', [
			'label'                => esc_html__( 'Horizontal Alignment', 'minimog' ),
			'label_block'          => true,
			'type'                 => Controls_Manager::CHOOSE,
			'options'              => Widget_Utils::get_control_options_horizontal_alignment(),
			'default'              => 'center',
			'toggle'               => false,
			'selectors_dictionary' => [
				'left'  => 'flex-start',
				'right' => 'flex-end',
			],
			'selectors'            => [
				'{{WRAPPER}} .elementor-widget-container' => 'display: flex; justify-content: {{VALUE}}',
			],
		] );

		$this->end_controls_section();
	}

	private function add_content_style_section() {
		$this->start_controls_section( 'content_style_section', [
			'label' => esc_html__( 'Content', 'minimog' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'heading_title', [
			'label'     => esc_html__( 'Title', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .categories-name' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'selector' => '{{WRAPPER}} .categories-name',
		] );

		$this->add_control( 'heading_button', [
			'label'     => esc_html__( 'Button', 'minimog' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->start_controls_tabs( 'button_skin_tabs' );

		$this->start_controls_tab( 'button_skin_normal_tab', [
			'label' => esc_html__( 'Normal', 'minimog' ),
		] );

		$this->add_control( 'button_color', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .button' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'button_background_color', [
			'label'     => esc_html__( 'Background Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .button' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'button_border_color', [
			'label'     => esc_html__( 'Border Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .button' => 'border-color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'button_skin_tab', [
			'label' => esc_html__( 'Hover', 'minimog' ),
		] );

		$this->add_control( 'button_color_hover', [
			'label'     => esc_html__( 'Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .button:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'button_background_color_hover', [
			'label'     => esc_html__( 'Background Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .button:hover' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'button_border_color_hover', [
			'label'     => esc_html__( 'Border Color', 'minimog' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .button:hover' => 'border-color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'minimog-banner-categories minimog-box' );
		$this->add_render_attribute( 'wrapper', 'class', 'style-' . $settings['style'] );

		$box_tag = 'div';
		?>
		<?php printf( '<%1$s %2$s>', $box_tag, $this->get_render_attribute_string( 'wrapper' ) ); ?>
		<div class="content-wrap">

			<?php if ( ! empty( $settings['image']['url'] ) ) : ?>
				<div class="minimog-image image">
					<?php echo \Minimog_Image::get_elementor_attachment( [
						'settings' => $settings,
					] ); ?>
					<?php
						$id = $settings['cat_slugs'];
						$args = '';
						$index_cats            = $settings['cat_slugs'];
						$array_cat             = self::minimog_get_categories();
						$array_cat_link              = self::minimog_get_link_categories();
						$array_cat_count             = self::minimog_get_categories_count();
						$count = $array_cat_count[$id];

						if ( 1 === $count ) {
							$text_after = esc_attr('item', 'minimog');
						} else {
							$text_after = esc_attr('items', 'minimog');
						}

						$text_btn = $count . ' ' . $text_after;
					?>
					<div class="text-wrap">
						<h3 class="categories-name"><?php echo esc_attr($array_cat[$id]); ?></h3>
						<a class="button" href="<?php echo esc_url($array_cat_link[$id]); ?>"><?php echo esc_attr($text_btn); ?></a>
					</div>
				</div>
			<?php endif; ?>

		</div>
		<?php printf( '</%1$s>', $box_tag ); ?>
		<?php
	}

	protected function _content_template() {
		// @formatter:off
		?>
		<#
		view.addRenderAttribute( 'wrapper', 'class', 'minimog-banner-categories minimog-box' );
		view.addRenderAttribute( 'wrapper', 'class', 'style-' + settings.style );

		var boxTag = 'div';

		var imageHTML = '';

		if ( settings.image.url ) {
			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.image_size,
				dimension: settings.image_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );
			view.addRenderAttribute( 'image', 'src', image_url );
			imageHTML = '<div class="minimog-image image"><img ' + view.getRenderAttributeString( 'image' ) + ' /></div>';
		}
		#>
		<{{{ boxTag }}} {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
			<div class="content-wrap">
				{{{ imageHTML }}}
			</div>
		</{{{ boxTag }}}>
		<?php
		// @formatter:off
	}

	protected function minimog_get_categories() {
		$orderby = 'name';
		$order = 'asc';
		$hide_empty = false ;
		$cat_args = array(
			'orderby'    => $orderby,
			'order'      => $order,
			'hide_empty' => $hide_empty,
		);

		$product_categories = get_terms( 'product_cat', $cat_args );
		$categories_name = [];
		if( !empty($product_categories) ){
			foreach ($product_categories as $key => $category) {
				$categories_name[] .= $category->name;
			}
		}

		return $categories_name;
	}

	protected function minimog_get_link_categories() {
		$orderby = 'name';
		$order = 'asc';
		$hide_empty = false ;
		$cat_args = array(
			'orderby'    => $orderby,
			'order'      => $order,
			'hide_empty' => $hide_empty,
		);

		$product_categories = get_terms( 'product_cat', $cat_args );
		$categories_link = [];
		if( !empty($product_categories) ){
			foreach ($product_categories as $key => $category) {
				$categories_link[] .= get_term_link($category);
			}
		}

		return $categories_link;
	}

	protected function minimog_get_categories_count() {
		$orderby = 'name';
		$order = 'asc';
		$hide_empty = false ;
		$cat_args = array(
			'orderby'    => $orderby,
			'order'      => $order,
			'hide_empty' => $hide_empty,
		);

		$product_categories = get_terms( 'product_cat', $cat_args );
		$categories_count = [];
		if( !empty($product_categories) ){
			foreach ($product_categories as $key => $category) {
				$categories_count[] .= $category->count;
			}
		}

		return $categories_count;
	}
}
