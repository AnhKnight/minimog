<?php

namespace Minimog_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Widget_Client_Logo extends Static_Grid {

	public function get_name() {
		return 'tm-client-logo';
	}

	public function get_title() {
		return esc_html__( 'Client Logo', 'minimog' );
	}

	public function get_icon_part() {
		return 'eicon-logo';
	}

	public function get_keywords() {
		return [ 'client', 'logo', 'brand' ];
	}

	protected function _register_controls() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Content', 'minimog' ),
		] );

		$this->add_control( 'hover', [
			'label'   => esc_html__( 'Hover Type', 'minimog' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				''          => esc_html__( 'None', 'minimog' ),
				'grayscale' => esc_html__( 'Grayscale to normal', 'minimog' ),
				'opacity'   => esc_html__( 'Opacity to normal', 'minimog' ),
				'faded'     => esc_html__( 'Normal to opacity', 'minimog' ),
			],
			'default' => '',
		] );

		$this->end_controls_section();

		parent::_register_controls();

		$this->update_responsive_control( 'grid_columns', [
			'default' => 4,
		] );

		$this->update_responsive_control( 'grid_content_position', [
			'default' => 'middle',
		] );

		$this->update_responsive_control( 'grid_content_alignment', [
			'default' => 'center',
		] );
	}

	protected function add_repeater_controls( Repeater $repeater ) {
		$repeater->add_control( 'logo', [
			'label'   => esc_html__( 'Logo', 'minimog' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
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
	}

	protected function get_repeater_defaults() {
		$placeholder_image_src = Utils::get_placeholder_image_src();

		return [
			[
				'logo' => [ 'url' => $placeholder_image_src ],
			],
			[
				'logo' => [ 'url' => $placeholder_image_src ],
			],
		];
	}

	protected function print_grid_item() {
		$item          = $this->get_current_item();
		$item_key      = $this->get_current_key();
		$item_link_key = $item_key . '_link';

		if ( ! empty( $item['link']['url'] ) ) {
			$this->add_link_attributes( $item_link_key, $item['link'] );
		}
		?>
		<div class="item">

			<?php if ( ! empty( $item['link']['url'] ) ) { ?>
			<a <?php $this->print_render_attribute_string( $item_link_key ); ?>>
				<?php } ?>

				<div class="image">
					<img src="<?php echo esc_url( $item['logo']['url'] ); ?>"
					     alt="<?php esc_attr_e( 'Client Logo', 'minimog' ); ?>">
				</div>

				<?php if ( ! empty( $item['link']['url'] ) ) { ?>
			</a>
		<?php } ?>
		</div>
		<?php
	}

	protected function before_grid() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'tm-client-logo' );

		if ( ! empty( $settings['hover'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'hover-' . $settings['hover'] );
		}
	}
}
