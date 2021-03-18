<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

$feature_style = Minimog_Woo::instance()->get_single_product_style();
$classes = "product-single-thumbnails product-single-thumbnails--$feature_style";
?>
<div class="<?php echo esc_attr( $classes ); ?>">
	<?php wc_get_template_part('single-product/product-thumbnails/thumbnail', $feature_style); ?>
</div>
