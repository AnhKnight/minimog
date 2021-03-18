(
	function( $ ) {
		'use strict';

		var minimogGridHandler = function( $scope, $ ) {
			var $element = $scope.find( '.minimog-grid-wrapper' );

			$element.minimogGridLayout();
		};

		$( window ).on( 'elementor/frontend/init', function() {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-image-gallery.default', minimogGridHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-testimonial-grid.default', minimogGridHandler );
			elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-product-categories.default', minimogGridHandler );
		} );
	}
)( jQuery );
