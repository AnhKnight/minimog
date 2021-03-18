(
	function( $ ) {
		'use strict';

		$.fn.minimogNiceSelect = function( options ) {
			var FOCUSED_CLASS = 'focused';
			var SELECTED_CLASS = 'selected';


			return this.each( function() {
				var $el = $( this );
				var settings = $( this ).data( 'select' );
				var fakeSelect = '';
				var fieldLabel = settings.fieldLabel ? '<span class="label">' + settings.fieldLabel + '</span>' : '';
				var $current = $( '<div class="minimog-fake-select-current">' + fieldLabel + '<span class="value"></span></div>' );

				$el.children( 'option' ).each( function() {
					var itemClass = 'item';
					if ( $( this ).is( ':selected' ) ) {
						$current.find( '.value' ).text( $( this ).text() )
						itemClass += ' ' + SELECTED_CLASS;
					}

					fakeSelect += '<li class="' + itemClass + '" data-value="' + $( this ).val() + '">' + $( this ).text() + '</li>';
				} );

				fakeSelect = '<ul class="minimog-fake-select">' + fakeSelect + '</ul>';

				var $wrap = $( '<div class="minimog-fake-select-wrap"></div>' );

				$wrap.append( $current ).append( fakeSelect );

				$current.on( 'click', function() {
					$wrap.addClass( FOCUSED_CLASS );
				} );

				$wrap.on( 'click', 'li', function() {
					$wrap.removeClass( FOCUSED_CLASS );

					if ( ! $( this ).hasClass( SELECTED_CLASS ) ) {
						$( this ).siblings().removeClass( SELECTED_CLASS );
						$( this ).addClass( SELECTED_CLASS );
						var val = $( this ).data( 'value' );
						$current.find( '.value' ).text( $( this ).text() );
						$el.val( val );
						$el.trigger( 'change' );
					}
				} );

				$( document ).on( 'click', function( e ) {
					if ( $( e.target ).closest( $wrap ).length == 0 ) {
						$wrap.removeClass( FOCUSED_CLASS );
					}
				} );

				$el.hide().after( $wrap );
			} );
		};
	}( jQuery )
);
