<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post;

$heading = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'minimog' ) );

?>


<?php // the_content(); ?>

<div class="entry-product-detail-description">

	<?php if ( $heading ) : ?>
		<h3 class="entry-product-section-heading product-description-heading"><?php echo esc_html( $heading ); ?></h3>
	<?php endif; ?>

	<div class="row">
		<div class="col-lg-3">
			<h6 class="title">Product Details</h6>
			<ul>
				<li>
					Cropped pink crepe knit top
				</li>
				<li>
					Square neckline
				</li>
				<li>
					Embroidered Aje logo
				</li>
				<li>
					Cross back straps
				</li>
			</ul>
		</div>
		<div class="col-lg-3">
			<h6 class="title">Size & Fit</h6>
			<ul>
				<li>
					Model wears a size 8/S
				</li>
				<li>
					Model: 178cm/5’10
				</li>
				<li>
					Bust: 81cm
				</li>
				<li>
					Waist: 61cm
				</li>
			</ul>
		</div>
		<div class="col-lg-3">
			<h6 class="title">Fabrication</h6>
			<ul>
				<li>
					65% Viscose 35% Nylon
				</li>
				<li>
					Delicate Cold Hand Wash
				</li>
			</ul>
		</div>
		<div class="col-lg-3">
			<h6 class="title">Shipping and Returns</h6>
			<p>
				Enjoy complimentary express shipping on orders over $150. We accept returns within 21 days of purchase.
			</p>
			<p>
				Due to hygiene reasons, we do not accept returns for jewellery.
			</p>
		</div>
	</div>
</div>
