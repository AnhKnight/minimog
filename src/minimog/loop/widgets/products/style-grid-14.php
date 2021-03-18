<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}


$product_id = $product->get_id();

$position = get_query_var( 'position' );

$col = Minimog_Woo::instance()->get_position($position);

$custom_thumbnail_size = false;

if ( isset( $settings ) ) {
	$custom_thumbnail_size = Minimog_Image::elementor_parse_image_size( $settings, false );
}
?>
<div class="<?php echo $col ?>">
	<div <?php wc_product_class( 'grid-item', $product ); ?>>
		<div class="product-wrapper">
			<div class="product-thumbnail">
				<?php
				if ( function_exists( 'woocommerce_show_product_loop_sale_flash' ) ) {
					woocommerce_show_product_loop_sale_flash();
				}
				?>

				<div class="thumbnail">
					<?php woocommerce_template_loop_product_link_open(); ?>

					<div class="product-main-image">
						<?php
						$thumbnail_id = get_post_thumbnail_id();
						if ( ! $custom_thumbnail_size ) {
							Minimog_Woo::instance()->get_product_image( array(
								'id'          => $thumbnail_id,
								'extra_class' => 'wp-post-image',
							) );
						} else {
							Minimog_Image::the_attachment_by_id( array(
								'id'   => $thumbnail_id,
								'size' => $custom_thumbnail_size,
							) );
						}
						?>
					</div>
					<?php woocommerce_template_loop_product_link_close(); ?>
				</div>

				<div class="product-actions">
					<?php
					$button_settings = [
							'tooltip_position' => 'top',
							'style'            => '01',
					];

					Minimog_Woo::instance()->get_quick_view_button_template( $button_settings );

					?>
					<div class="product-action product-action--quickview compare-btn style-01 hint--bounce hint--top hint--primary" aria-label="Quick View">
						<?php
						echo do_shortcode('[woosq id="'. $product_id .'"]');
						?>
					</div>
				</div>

				<div class="product-action-cart">
					<?php  woocommerce_template_loop_add_to_cart(); ?>
				</div>
			</div>

			<div class="product-info">
				<div class="product-info__rating">
					<?php Minimog_Templates::render_rating( $product->get_average_rating(), [ 'echo' => true ] ); ?>
				</div>

				<div class="product-info__title">
					<?php
					/**
					 * woocommerce_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_template_loop_product_title - 10
					 */
					do_action( 'woocommerce_shop_loop_item_title' );
					?>
				</div>
				<div class="product-info__price">
					<?php
					/**
					 * woocommerce_after_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
					?>
				</div>
			</div>
		</div>
	</div>
</div>
