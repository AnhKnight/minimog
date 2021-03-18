jQuery( document ).ready( function( $ ) {
	'use strict';

	initProductImagesSlider();

	function initProductImagesSlider() {
		if ( $minimog.isProduct === '1' && $minimog.productFeatureStyle === 'slider' ) {
			var $sliderWrap = $( '#woo-single-info' ).find( '.minimog-slider' );

			var options = {};
			if ( $sliderWrap.hasClass( 'has-thumbs-slider' ) ) {
				var thumbsSlider = $sliderWrap.children( '.minimog-thumbs-swiper' ).minimogSwiper();
				options = {
					thumbs: {
						swiper: thumbsSlider
					}
				};
			}
			var mainSlider = $sliderWrap.children( '.minimog-main-swiper' ).minimogSwiper( options );
			var $form = $( '.variations_form' );
			var variations = $form.data( 'product_variations' );

			$form.find( 'select' ).on( 'change', function() {
				var test = true;
				var globalAttrs = {};

				var formValues = $form.serializeArray();

				for ( var i = 0; i < formValues.length; i ++ ) {

					var _name = formValues[ i ].name;
					if ( _name.substring( 0, 10 ) === 'attribute_' ) {

						globalAttrs[ _name ] = formValues[ i ].value;

						if ( formValues[ i ].value === '' ) {
							test = false;

							break;
						}
					}
				}

				if ( test === true ) {
					globalAttrs = JSON.stringify( globalAttrs );

					for ( var i = variations.length - 1; i >= 0; i -- ) {
						var attributes = variations[ i ].attributes;
						var loopAttributes = JSON.stringify( attributes );

						if ( loopAttributes == globalAttrs ) {
							var variationImageID = variations[ i ].image_id;

							mainSlider.$wrapperEl.find( '.swiper-slide' ).each( function( index ) {
								var slideImageID = $( this ).attr( 'data-image-id' );
								slideImageID = parseInt( slideImageID );

								if ( slideImageID === variationImageID ) {
									mainSlider.slideTo( index );

									return false;
								}
							} );
						}
					}
				} else {
					// Reset to main image.
					var $mainImage = mainSlider.$wrapperEl.find( '.product-main-image' );
					var index = $mainImage.index();
					mainSlider.slideTo( index );
				}
			} );
		}
	}
} );
