<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Minimog_WP_Widget_Product_Sorting' ) ) {
	class Minimog_WP_Widget_Product_Sorting extends Minimog_Widget {

		public function __construct() {
			$this->widget_id          = 'minimog-wp-widget-product-sorting';
			$this->widget_cssclass    = 'minimog-wp-widget-product-sorting';
			$this->widget_name        = esc_html__( '[Minimog] Product Sorting', 'minimog' );
			$this->widget_description = esc_html__( 'Display a sorting list to sort products in your store.', 'minimog' );
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'std'   => esc_html__( 'Sort by', 'minimog' ),
					'label' => esc_html__( 'Title', 'minimog' ),
				),
			);

			parent::__construct();
		}

		public function widget( $args, $instance ) {
			if ( ! woocommerce_products_will_display() ) {
				return;
			}

			$orderby = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

			$show_default_orderby = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

			$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
				'menu_order' => esc_html__( 'Default', 'minimog' ),
				'popularity' => esc_html__( 'Popularity', 'minimog' ),
				'rating'     => esc_html__( 'Average rating', 'minimog' ),
				'date'       => esc_html__( 'Newness', 'minimog' ),
				'price'      => esc_html__( 'Price: low to high', 'minimog' ),
				'price-desc' => esc_html__( 'Price: high to low', 'minimog' ),
			) );

			if ( ! $show_default_orderby ) {
				unset( $catalog_orderby_options['menu_order'] );
			}

			if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
				unset( $catalog_orderby_options['rating'] );
			}

			$this->widget_start( $args, $instance );

			/*wc_get_template( 'loop/orderby.php', array(
				'catalog_orderby_options' => $catalog_orderby_options,
				'orderby'                 => $orderby,
				'show_default_orderby'    => $show_default_orderby,
				'list'                    => true,
			) );*/
			?>
			<ul class="order-by">
				<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
					<?php

					$link = Minimog_Woo::instance()->get_shop_page_link( true );

					$link = add_query_arg( 'orderby', $id, $link );

					?>
					<li
						<?php if ( selected( $orderby, $id, false ) ) { ?>
							class="selected-order"
						<?php } ?>
					>
						<a href="<?php echo esc_url( $link ); ?>"
						   data-order="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $name ); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php
			$this->widget_end( $args );
		}
	}
}
