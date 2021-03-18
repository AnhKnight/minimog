<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.0
 */

defined( 'ABSPATH' ) || exit;
?>
<li class="wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>">
	<div class="payment_title">
		<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio"
		       name="payment_method"
		       value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?>
		       data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>"/>

		<label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
			<span class="payment-image-wrap">
				<?php if ( $gateway instanceof WC_Gateway_Paypal ) : ?>
					<img src="<?php echo MINIMOG_THEME_IMAGE_URI . '/payments/paypal.png' ?>"
					     alt="<?php esc_attr_e( 'Paypal', 'minimog' ); ?>" class="payment-image payment-image-normal">
					<img src="<?php echo MINIMOG_THEME_IMAGE_URI . '/payments/paypal-active.png' ?>"
					     alt="<?php esc_attr_e( 'Paypal', 'minimog' ); ?>" class="payment-image payment-image-active">
				<?php elseif ( $gateway instanceof WC_Gateway_COD ) : ?>
					<img src="<?php echo MINIMOG_THEME_IMAGE_URI . '/payments/cash-on-delivery.png' ?>"
					     alt="<?php esc_attr_e( 'Cash', 'minimog' ); ?>" class="payment-image payment-image-normal">
					<img src="<?php echo MINIMOG_THEME_IMAGE_URI . '/payments/cash-on-delivery-active.png' ?>"
					     alt="<?php esc_attr_e( 'Cash', 'minimog' ); ?>" class="payment-image payment-image-active">
				<?php elseif ( $gateway instanceof WC_Gateway_BACS ) : ?>
					<img src="<?php echo MINIMOG_THEME_IMAGE_URI . '/payments/direct-bank.png' ?>"
					     alt="<?php esc_attr_e( 'Direct Bank', 'minimog' ); ?>" class="payment-image payment-image-normal">
					<img src="<?php echo MINIMOG_THEME_IMAGE_URI . '/payments/direct-bank-active.png' ?>"
					     alt="<?php esc_attr_e( 'Direct Bank', 'minimog' ); ?>" class="payment-image payment-image-active">
				<?php elseif ( $gateway instanceof WC_Gateway_Cheque ) : ?>
					<img src="<?php echo MINIMOG_THEME_IMAGE_URI . '/payments/check-payments.png'; ?>"
					     alt="<?php esc_attr_e( 'Check Payments', 'minimog' ); ?>"
					     class="payment-image payment-image-normal">
					<img src="<?php echo MINIMOG_THEME_IMAGE_URI . '/payments/check-payments-active.png'; ?>"
					     alt="<?php esc_attr_e( 'Direct Bank', 'minimog' ); ?>" class="payment-image payment-image-active">
				<?php elseif ( $gateway instanceof WC_Gateway_Stripe ) : ?>
					<img src="<?php echo MINIMOG_THEME_IMAGE_URI . '/payments/credit.png'; ?>"
					     alt="<?php esc_attr_e( 'Credit', 'minimog' ); ?>"
					     class="payment-image payment-image-normal">
					<img src="<?php echo MINIMOG_THEME_IMAGE_URI . '/payments/credit-active.png'; ?>"
					     alt="<?php esc_attr_e( 'Credit', 'minimog' ); ?>" class="payment-image payment-image-active">
				<?php else: ?>
					<?php echo wp_kses_post( $gateway->get_icon() ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?>
				<?php endif; ?>
			</span>
			<?php echo wp_kses_post( $gateway->get_title() ); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?>
		</label>
	</div>
	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>"
		     <?php if ( ! $gateway->chosen ) : /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>style="display:none;"<?php endif; /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>>
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</li>
