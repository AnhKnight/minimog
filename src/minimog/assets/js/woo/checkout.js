jQuery( document ).ready( function( $ ) {
	'use strict';

	paymentMethodChanged();

	function paymentMethodChanged() {
		var $order_review = $( '#order_review' );

		$order_review.on( 'click', 'input[name="payment_method"]', function() {
			var selectedClass = 'payment-selected';
			var parent = $( this ).parents( '.wc_payment_method' ).first();
			parent.addClass( selectedClass ).siblings().removeClass( selectedClass );
		} );
	}
} );
