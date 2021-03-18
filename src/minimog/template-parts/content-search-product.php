<?php
/**
 * Template part for displaying search product single loop item
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimog
 * @since   1.0
 */

/**
 * Hook: woocommerce_shop_loop.
 *
 * @hooked WC_Structured_Data::generate_product_data() - 10
 */
do_action( 'woocommerce_shop_loop' );

wc_get_template_part( 'content-product' );
