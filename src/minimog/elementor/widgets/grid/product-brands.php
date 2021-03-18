<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Widget_Product_Brands extends Grid_Base {

	const PRODUCT_BRANDS = 'product_brand';
	private $terms = [];

	public function get_name() {
		return 'tm-product-brands';
	}

	public function get_title() {
		return esc_html__( 'Product Brands', 'minimog' );
	}

	public function get_icon_part() {
		return 'eicon-logo';
	}

	public function get_keywords() {
		return [ 'product', 'logo', 'brand' ];
	}

	protected function _register_controls() {
		$this->add_content_section();

		parent::_register_controls();

		$this->add_query_section();

		$this->update_controls();
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Content', 'minimog' ),
		] );

		$this->add_control( 'hover', [
			'label'   => esc_html__( 'Hover Type', 'minimog' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				''           => esc_html__( 'None', 'minimog' ),
				'grayscale'  => esc_html__( 'Grayscale to normal', 'minimog' ),
				'opacity'    => esc_html__( 'Opacity to normal', 'minimog' ),
				'blackwhite' => esc_html__( 'Normal to grayscale', 'minimog' ),
				'faded'      => esc_html__( 'Normal to opacity', 'minimog' ),
			],
			'default' => '',
		] );

		$this->end_controls_section();
	}

	private function add_query_section() {
		$this->start_controls_section( 'query_section', [
			'label' => esc_html__( 'Query', 'minimog' ),
		] );

		$this->add_control( 'source', [
			'label'       => esc_html__( 'Source', 'minimog' ),
			'type'        => Controls_Manager::SELECT,
			'options'     => [
				''                  => esc_html__( 'Show All', 'minimog' ),
				'by_id'             => esc_html__( 'Manual Selection', 'minimog' ),
				'by_parent'         => esc_html__( 'By Parent', 'minimog' ),
				'current_subbrands' => esc_html__( 'Current Sub brands', 'minimog' ),
			],
			'label_block' => true,
		] );

		$brands = get_terms( [
			'taxonomy'   => self::PRODUCT_BRANDS,
			'hide_empty' => false,
		] );

		$options = [];
		foreach ( $brands as $brand ) {
			$options[ $brand->term_id ] = $brand->name;
		}

		$this->add_control( 'brands', [
			'label'       => esc_html__( 'Brands', 'minimog' ),
			'type'        => Controls_Manager::SELECT2,
			'options'     => $options,
			'default'     => [],
			'label_block' => true,
			'multiple'    => true,
			'condition'   => [
				'source' => 'by_id',
			],
		] );

		$parent_options = [ '0' => esc_html__( 'Only Top Level', 'minimog' ) ] + $options;
		$this->add_control(
			'parent', [
			'label'     => esc_html__( 'Parent', 'minimog' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => '0',
			'options'   => $parent_options,
			'condition' => [
				'source' => 'by_parent',
			],
		] );

		$this->add_control( 'hide_empty', [
			'label'     => esc_html__( 'Hide Empty', 'minimog' ),
			'type'      => Controls_Manager::SWITCHER,
			'default'   => 'yes',
			'label_on'  => 'Hide',
			'label_off' => 'Show',
		] );

		$this->add_control( 'number', [
			'label'     => esc_html__( 'Brands Count', 'minimog' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => '6',
			'condition' => [
				'source!' => 'by_id',
			],
		] );

		$this->add_control( 'orderby', [
			'label'     => esc_html__( 'Order By', 'minimog' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'name',
			'options'   => [
				'name'        => esc_html__( 'Name', 'minimog' ),
				'slug'        => esc_html__( 'Slug', 'minimog' ),
				'description' => esc_html__( 'Description', 'minimog' ),
				'count'       => esc_html__( 'Count', 'minimog' ),
			],
			'condition' => [
				'source!' => 'by_id',
			],
		] );

		$this->add_control( 'order', [
			'label'     => esc_html__( 'Order', 'minimog' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'desc',
			'options'   => [
				'asc'  => esc_html__( 'ASC', 'minimog' ),
				'desc' => esc_html__( 'DESC', 'minimog' ),
			],
			'condition' => [
				'source!' => 'by_id',
			],
		] );

		$this->end_controls_section();
	}

	private function update_controls() {
		$this->update_responsive_control( 'grid_columns', [
			'default'        => 6,
			'tablet_default' => 3,
			'mobile_default' => 2,
		] );

		$this->update_responsive_control( 'grid_content_position', [
			'default' => 'middle',
		] );

		$this->update_responsive_control( 'grid_content_alignment', [
			'default' => 'center',
		] );
	}

	private function query_terms() {
		$settings = $this->get_settings_for_display();

		$attributes = [
			'taxonomy'   => self::PRODUCT_BRANDS,
			'number'     => $settings['number'],
			'hide_empty' => ( 'yes' === $settings['hide_empty'] ) ? true : false,
		];

		switch ( $settings['source'] ) {
			case 'by_id':
				$attributes['include'] = $settings['brands'];
				$attributes['orderby'] = 'include';
				break;
			case 'by_parent' :
				$attributes['parent']  = $settings['parent'];
				$attributes['orderby'] = $settings['orderby'];
				$attributes['order']   = $settings['order'];
				break;
			case 'current_subbrands':
				$attributes['parent']  = get_queried_object_id();
				$attributes['orderby'] = $settings['orderby'];
				$attributes['order']   = $settings['order'];
				break;
			default:
				$attributes['orderby'] = $settings['orderby'];
				$attributes['order']   = $settings['order'];
				break;
		}

		$this->terms = get_terms( $attributes );
	}

	protected function print_grid_items( array $settings ) {
		if ( empty( $this->terms ) ) {
			return;
		}

		foreach ( $this->terms as $term ) {
			$term_link_key = 'brand-term-' . $term->term_id;
			$link          = get_term_link( $term );
			$thumbnail_id  = get_term_meta( $term->term_id, 'thumbnail_id', true );

			$this->add_render_attribute( $term_link_key, 'class', 'item' );
			$this->add_render_attribute( $term_link_key, 'href', $link );
			?>
			<div class="grid-item">
				<a <?php $this->print_render_attribute_string( $term_link_key ); ?>>
					<div class="minimog-image image">
						<?php if ( ! empty( $thumbnail_id ) ) : ?>
							<?php \Minimog_Image::the_attachment_by_id( array(
								'id'   => $thumbnail_id,
								'size' => '200x9999',
							) ); ?>
						<?php else: ?>
							<?php echo wc_placeholder_img(); ?>
						<?php endif; ?>
					</div>
				</a>
			</div>
			<?php
		}
	}

	protected function before_grid() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'tm-product-brands' );

		if ( ! empty( $settings['hover'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'hover-' . $settings['hover'] );
		}

		$this->query_terms();
	}
}
