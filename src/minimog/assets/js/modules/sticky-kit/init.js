jQuery( document ).ready( function( $ ) {
	'use strict';

	var $body = $( 'body' );
	var wWidth = window.innerWidth;

	initStickyElement();

	$( window ).resize( function() {
		wWidth = window.innerWidth;
		initStickyElement();
	} );

	function initStickyElement() {
		var $parent = $( '.tm-sticky-parent' );

		$parent.each( function() {
			var $stickyColumns = $( this ).find( '.tm-sticky-column' );

			if ( wWidth < 992 ) {
				$stickyColumns.trigger( 'sticky_kit:detach' );
			} else {
				var $smallestColumn;
				var smallestHeight = null;

				$stickyColumns.each( function() {
					var thisArea = $( this ).outerHeight();
					if ( smallestHeight === null || thisArea < smallestHeight ) {
						$smallestColumn = $( this );
						smallestHeight = thisArea;
					}
				} );

				var _offset = parseInt( $body.data( 'header-sticky-height' ) );

				if ( $body.hasClass( 'admin-bar' ) ) {
					_offset += 32;
				}

				_offset += 30;

				$smallestColumn.stick_in_parent( {
					parent: $parent,
					'offset_top': _offset,
				} );
			}
		} );
	}
} );
