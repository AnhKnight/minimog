<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$page_layout_style = Minimog_Woo::instance()->get_single_product_style();
?>
	<div id="page-content" class="product-single <?php echo 'product-single-' . $page_layout_style; ?>">

		<div class="container">
			<?php if ($page_layout_style === 'sidebar-full-height') : ?>
				<div class="product-single__sidebar">
					<?php Minimog_Templates::generated_sidebar( 'single_shop_sidebar' ); ?>
				</div>
			<?php endif; ?>

			<div class="product-single__content">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php wc_get_template_part( 'content', 'single-product' ); ?>
					<?php endwhile; ?>
					<?php Minimog_Templates::render_sidebar( 'right' ); ?>
					<div class="entry-after-product">
						<div class="row">
							<div class="col-md-12">
								<?php do_action( 'woocommerce_after_single_product' ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
<?php
get_footer( 'shop' );

