jQuery( document ).ready( function( $ ) {
	'use strict';

	var $body = $( 'body' );

	initQuickViewPopup();
	initShopFilters();

	function initQuickViewPopup() {
		$( '.minimog-product' ).on( 'click', '.quick-view-btn', function( e ) {
			e.preventDefault();
			e.stopPropagation();

			var $button = $( this );

			var $actions = $button.parents( '.product-actions' ).first();
			$actions.addClass( 'refresh' );

			$button.addClass( 'loading' );
			var productID = $button.data( 'pid' );

			/**
			 * Avoid duplicate ajax request.
			 */
			var $popup = $body.children( '#' + 'popup-product-quick-view-content-' + productID );
			if ( $popup.length > 0 ) {
				openQuickViewPopup( $popup, $button );
			} else {
				var data = {
					action: 'product_quick_view',
					pid: productID
				};

				$.ajax( {
					url: $minimog.ajaxurl,
					type: 'POST',
					data: $.param( data ),
					dataType: 'json',
					success: function( results ) {
						$popup = $( results.template );
						$body.append( $popup );
						openQuickViewPopup( $popup, $button );
					},
				} );
			}
		} );
	}

	function openQuickViewPopup( $popup, $button ) {
		$button.removeClass( 'loading' );

		$.magnificPopup.open( {
			mainClass: 'mfp-fade popup-product-quick-view',
			items: {
				src: $popup.html(),
				type: 'inline'
			},
			callbacks: {
				open: function() {
					var $sliderWrap = this.content.find( '.woo-single-gallery' );
					var thumbsSlider = $sliderWrap.children( '.minimog-thumbs-swiper' ).minimogSwiper();
					var mainSlider = $sliderWrap.children( '.minimog-main-swiper' ).minimogSwiper( {
						thumbs: {
							swiper: thumbsSlider
						}
					} );

					this.content.find( '.entry-summary .inner-content' ).perfectScrollbar( {
						suppressScrollX: true
					} );
				},
			}
		} );
	}

	function initShopFilters() {
		var $filterBtn = $( '#btn-toggle-shop-filters' );
		var $shopFilterWidgets = $( '#shop-filter-widgets' );

		if ( $filterBtn.length <= 0 || $shopFilterWidgets.length <= 0 ) {
			return;
		}

		$shopFilterWidgets.removeClass( 'filters-opened' ).stop().hide();
		$shopFilterWidgets.find( '.widget' ).children().not( '.widget-title' ).wrap( '<div class="widget-content" />' );

		$shopFilterWidgets.find( '.filter-swatch' ).removeClass( 'hint--bounce hint--top' );

		$filterBtn.on( 'click', function( e ) {
			e.preventDefault();

			if ( $( this ).hasClass( 'active' ) ) {
				$( this ).removeClass( 'active' );
				$shopFilterWidgets.removeClass( 'filters-opened' ).stop().slideUp( 350 );
			} else {
				$( this ).addClass( 'active' );
				$shopFilterWidgets.addClass( 'filters-opened' ).stop().slideDown( 350 );
			}

			setTimeout( function() {

				$shopFilterWidgets.find( '.widget' ).children( '.widget-content' ).perfectScrollbar( { suppressScrollX: true } );
			}, 500 );
		} );
	}
} );
