(
	function( $ ) {
		'use strict';

		$.minimogGridLayout = function( element, options ) {
			var plugin = this;

			var $el = $( element );
			var $grid = $el.find( '.minimog-grid' );
			var resizeTimer;

			plugin.init = function() {
				var settings = $el.data( 'grid' );
				var gridData;

				if ( $grid.length > 0 && settings && typeof settings.type !== 'undefined' ) {
					var $isotopeOptions = {
						itemSelector: '.grid-item',
						percentPosition: true,
						transitionDuration: 0,
						packery: {
							columnWidth: '.grid-sizer',
						},
						fitRows: {
							gutter: 10
						}
					};

					if ( 'masonry' === settings.type || 'metro' === settings.type ) {
						$isotopeOptions.layoutMode = 'packery';
					} else {
						$isotopeOptions.layoutMode = 'fitRows';
					}

					gridData = $grid.imagesLoaded( function() {
						calculateMasonrySize( $isotopeOptions );
						if ( 'grid' === settings.type ) {
							$grid.children( '.grid-item' ).matchHeight();
							$grid.isotope( 'layout' );
						}
						$grid.addClass( 'loaded' );
					} );

					gridData.one( 'arrangeComplete', function() {
						handlerEntranceAnimation();
					} );

					$( window ).resize( function() {
						calculateMasonrySize( $isotopeOptions );

						// Sometimes layout can be overlap. then re-cal layout one time.
						clearTimeout( resizeTimer );
						resizeTimer = setTimeout( function() {
							// Run code here, resizing has "stopped"
							calculateMasonrySize( $isotopeOptions );
						}, 500 ); // DO NOT decrease the time. Sometime, It'll make layout overlay on resize.
					} );
				} else {
					handlerEntranceAnimation();
				}

				$el.on( 'minimogQueryEnd', function( event, el, $items ) {
					if ( $grid.length > 0 && settings && typeof settings.type !== 'undefined' ) {
						$grid.isotope()
						     .append( $items )
						     .isotope( 'reloadItems', $items )
						     .imagesLoaded()
						     .always( function() {
							     $items.addClass( 'animate' );
							     calculateMasonrySize( $isotopeOptions );
							     if ( 'grid' === settings.type ) {
								     $grid.children( '.grid-item' ).matchHeight();
								     $grid.isotope( 'layout' );
							     }
						     } );
					} else {
						$grid.append( $items ).imagesLoaded().always( function() {
							$items.addClass( 'animate' );
						} );
					}
				} );
			}

			/**
			 * Calculate size for grid items
			 */
			var calculateMasonrySize = function( $isotopeOptions ) {
				var windowWidth    = window.innerWidth,
				    $gridWidth     = $grid[ 0 ].getBoundingClientRect().width,
				    $column        = 1,
				    $gutter        = 0,
				    $zigzagHeight  = 0,
				    settings       = $el.data( 'grid' ),
				    lgGutter       = settings.gutter ? settings.gutter : 0,
				    mdGutter       = settings.gutterTablet ? settings.gutterTablet : lgGutter,
				    smGutter       = settings.gutterMobile ? settings.gutterMobile : mdGutter,
				    lgColumns      = settings.columns ? settings.columns : 1,
				    mdColumns      = settings.columnsTablet ? settings.columnsTablet : lgColumns,
				    smColumns      = settings.columnsMobile ? settings.columnsMobile : mdColumns,
				    lgZigzagHeight = settings.zigzagHeight ? settings.zigzagHeight : 0,
				    mdZigzagHeight = settings.zigzagHeightTablet ? settings.zigzagHeightTablet : lgZigzagHeight,
				    smZigzagHeight = settings.zigzagHeightMobile ? settings.zigzagHeightMobile : mdZigzagHeight,
				    zigzagReversed = settings.zigzagReversed && settings.zigzagReversed === 1 ? true : false;

				var tabletBreakPoint = 1025;
				var mobileBreakPoint = 768;

				if ( typeof elementorFrontendConfig !== 'undefined' ) {
					tabletBreakPoint = elementorFrontendConfig.breakpoints.lg;
					mobileBreakPoint = elementorFrontendConfig.breakpoints.md;
				}

				if ( windowWidth >= tabletBreakPoint ) {
					$column = lgColumns;
					$gutter = lgGutter;
					$zigzagHeight = lgZigzagHeight;
				} else if ( windowWidth >= mobileBreakPoint ) {
					$column = mdColumns;
					$gutter = mdGutter;
					$zigzagHeight = mdZigzagHeight;
				} else {
					$column = smColumns;
					$gutter = smGutter;
					$zigzagHeight = smZigzagHeight;
				}

				var totalGutterPerRow = (
					                        $column - 1
				                        ) * $gutter;

				var columnWidth = (
					                  $gridWidth - totalGutterPerRow
				                  ) / $column;

				columnWidth = Math.floor( columnWidth );

				var columnWidth2 = columnWidth;
				if ( $column > 1 ) {
					columnWidth2 = columnWidth * 2 + $gutter;
				}

				$grid.children( '.grid-sizer' ).css( {
					'width': columnWidth + 'px'
				} );

				var columnHeight   = 0,
				    columnHeight2  = 0, // 200%.
				    columnHeight7  = 0, // 70%.
				    columnHeight13 = 0, // 130%.
				    isMetro        = false,
				    ratioW         = 1,
				    ratioH         = 1;

				if ( settings.ratio ) {
					ratioH = settings.ratio;
					isMetro = true;
				}

				// Calculate item height for only metro type.
				if ( isMetro ) {
					columnHeight = columnWidth * ratioH / ratioW;
					columnHeight = Math.floor( columnHeight );

					if ( $column > 1 ) {
						columnHeight2 = columnHeight * 2 + $gutter;
						columnHeight13 = parseInt( columnHeight * 1.3 );
						columnHeight7 = columnHeight2 - $gutter - columnHeight13;
					} else {
						columnHeight2 = columnHeight7 = columnHeight13 = columnHeight;
					}
				}

				$grid.children( '.grid-item' ).each( function( index ) {
					var gridItem = $( this );

					// Zigzag.
					if (
						$zigzagHeight > 0 // Has zigzag.
						&& $column > 1 // More than 1 column.
						&& index + 1 <= $column // On top items.
					) {
						if ( zigzagReversed === false ) { // Is odd item.
							if ( index % 2 === 0 ) {
								gridItem.css( {
									'marginTop': $zigzagHeight + 'px'
								} );
							} else {
								gridItem.css( {
									'marginTop': '0px'
								} );
							}
						} else {
							if ( index % 2 !== 0 ) {
								gridItem.css( {
									'marginTop': $zigzagHeight + 'px'
								} );
							} else {
								gridItem.css( {
									'marginTop': '0px'
								} );
							}
						}

					} else {
						gridItem.css( {
							'marginTop': '0px'
						} );
					}

					if ( gridItem.data( 'width' ) === 2 ) {
						gridItem.css( {
							'width': columnWidth2 + 'px'
						} );
					} else {
						gridItem.css( {
							'width': columnWidth + 'px'
						} );
					}

					if ( 'grid' === settings.type ) {
						gridItem.css( {
							'marginBottom': $gutter + 'px'
						} );
					}

					if ( isMetro ) {
						var $itemHeight;

						if ( gridItem.hasClass( 'grid-item-height' ) ) {
							$itemHeight = gridItem;
						} else {
							$itemHeight = gridItem.find( '.grid-item-height' );
						}

						if ( gridItem.data( 'height' ) === 2 ) {
							$itemHeight.css( {
								'height': columnHeight2 + 'px'
							} );
						} else if ( gridItem.data( 'height' ) === 1.3 ) {
							$itemHeight.css( {
								'height': columnHeight13 + 'px'
							} );
						} else if ( gridItem.data( 'height' ) === 0.7 ) {
							$itemHeight.css( {
								'height': columnHeight7 + 'px'
							} );
						} else {
							$itemHeight.css( {
								'height': columnHeight + 'px'
							} );
						}
					}
				} );

				if ( $isotopeOptions ) {
					$isotopeOptions.packery.gutter = $gutter;
					$isotopeOptions.fitRows.gutter = $gutter;
					$grid.isotope( $isotopeOptions );
				}

				$grid.isotope( 'layout' );
			}

			var handlerEntranceAnimation = function() {
				// Used find() for flex layout.
				var items = $grid.find( '.grid-item' );

				items.elementorWaypoint( function() {
					// Fix for different ver of waypoints plugin.
					var _self = this.element ? this.element : this;
					var $self = $( _self );
					$self.addClass( 'animate' );
				}, {
					offset: '90%',
					triggerOnce: true
				} );
			}

			plugin.init();

		}

		$.fn.minimogGridLayout = function( options ) {
			return this.each( function() {
				if ( undefined === $( this ).data( 'minimogGridLayout' ) ) {
					var plugin = new $.minimogGridLayout( this, options );
					$( this ).data( 'minimogGridLayout', plugin );
				}
			} );
		}

	}( jQuery )
);
