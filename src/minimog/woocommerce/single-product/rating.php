<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
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

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ( $rating_count > 0 ) : ?>
	<div class="woocommerce-product-rating">
		<?php Minimog_Templates::render_rating( $average, [
			'wrapper_class' => 'entry-product-star-rating',
		] ); ?>
		<div class="review-rating-average heading-color"><?php echo esc_html( $average ); ?></div>
		<?php
		$_rating_text = _n( 'See %s review', 'See %s reviews', $review_count, 'minimog' );
		$_rating_text = sprintf( $_rating_text, '<span class="count">' . esc_html( $review_count ) . '</span>' );
		$_rating_text = $_rating_text;

		if ( comments_open() ) :
			$_rating_text = '<a href="#reviews" class="woocommerce-review-link smooth-scroll-link">' . $_rating_text . '</a>';
		endif;

		Minimog_Helper::e( $_rating_text );
		?>
	</div>
<?php endif; ?>
