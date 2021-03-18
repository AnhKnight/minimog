<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Minimog_WP_Widget_Product_Banner' ) ) {
	class Minimog_WP_Widget_Product_Banner extends Minimog_Widget {

		public function __construct() {
			$this->widget_id          = 'minimog-wp-widget-product-banner';
			$this->widget_cssclass    = 'minimog-wp-widget-product-banner';
			$this->widget_name        = esc_html__( '[Minimog] Product Banner', 'minimog' );
			$this->widget_description = esc_html__( 'Product Banner', 'minimog' );
			$this->settings           = array(
				'title'         => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Title', 'minimog' ),
				),
				'product_id'    => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Product ID', 'minimog' ),
				),
				'background'    => array(
					'type'  => 'image',
					'std'   => '',
					'label' => esc_html__( 'Background', 'minimog' ),
				),
				'image'         => array(
					'type'  => 'image',
					'std'   => '',
					'label' => esc_html__( 'Image', 'minimog' ),
				),
				'show_category' => array(
					'type'  => 'checkbox',
					'std'   => 1,
					'label' => esc_html__( 'Show Category', 'minimog' ),
				),
			);

			parent::__construct();
		}

		public function widget( $args, $instance ) {
			$product_id    = isset( $instance['product_id'] ) ? $instance['product_id'] : $this->settings['product_id']['std'];
			$image         = isset( $instance['image'] ) ? $instance['image'] : $this->settings['image']['std'];
			$background    = isset( $instance['background'] ) ? $instance['background'] : $this->settings['background']['std'];
			$show_category = isset( $instance['show_category'] ) ? $instance['show_category'] : $this->settings['show_category']['std'];
			/**
			 * @var WC_Product $product
			 */
			$product = false;
			if ( ! empty( $product_id ) ) {
				$product = wc_get_product( $product_id );
			}

			if ( ! $product ) {
				return;
			}

			$background_url = '';

			if ( $background ):
				$background_url = Minimog_Image::get_attachment_url_by_id( [
					'id' => $background,
				] );
			endif;


			$this->widget_start( $args, $instance );
			?>
			<?php if ( $product ): ?>

				<div class="banner-product-wrapper"
					<?php if ( ! empty( $background_url ) ): ?>
						style="background-image: url( <?php echo esc_url( $background_url ); ?> )"
					<?php endif; ?>
				>
					<?php if ( $show_category ) : ?>
						<?php
						$cats = $product->get_category_ids();
						if ( ! empty( $cats ) ) {
							$first_cat = $cats[0];
							$cat       = get_term_by( 'id', $first_cat, 'product_cat' );

							if ( $cat instanceof \WP_Term ) {
								echo '<div class="banner-product-category">' . $cat->name . '</div>';
							}
						}
						?>
					<?php endif; ?>

					<h2 class="banner-product-title">
						<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
							<?php echo esc_html( $product->get_title() ); ?>
						</a>
					</h2>

					<div class="banner-product-thumbnail">
						<?php if ( $image ): ?>
							<?php Minimog_Image::the_attachment_by_id( [
								'id' => $image,
							] ); ?>
						<?php endif; ?>

						<?php if ( $product->is_on_sale() ): ?>
							<div class="product-banner-badge">
								<?php

								if ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) ) {
									$_regular_price = $product->get_regular_price();
									$_sale_price    = $product->get_sale_price();

									$percentage = round( ( ( $_regular_price - $_sale_price ) / $_regular_price ) * 100 );

									echo '<span class="badge-value">' . "{$percentage}%" . '</span><span class="badge-text">' . esc_html__( 'Off', 'minimog' ) . '</span>';
								} else {
									echo '<span class="badge-value">' . esc_html__( 'Sale !', 'minimog' ) . '</span>';
								}
								?>
							</div>
						<?php endif; ?>
					</div>

					<?php \Minimog_Templates::render_button( [
						'text'          => esc_html__( 'Shop now', 'minimog' ),
						'link'          => [
							'url' => esc_url( $product->get_permalink() ),
						],
						'size'          => 'xs',
						'wrapper_class' => 'product-banner-button',
					] ) ?>
				</div>

			<?php endif; ?>
			<?php
			$this->widget_end( $args );
		}
	}
}
