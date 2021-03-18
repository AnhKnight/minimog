jQuery( document ).ready( function( $ ) {
	'use strict';

	$( '.minimog-tabpanel' ).each( function( index, element ) {
		var $el = $( this );
		var $navTabs = $( this ).children( '.minimog-nav-tabs' );
		var $contentTabs = $( this ).children( '.minimog-tab-content' );
		var currentTab = 0;
		var maxTab = $navTabs.children().length;

		$navTabs.children().eq( currentTab ).addClass( 'active' );
		$contentTabs.children().eq( currentTab ).addClass( 'active' );

		$el.children( '.minimog-nav-tabs' ).on( 'click', 'a', function( e ) {
			e.preventDefault();

			var parent = $( this ).parent( 'li' );
			if ( parent.hasClass( 'active' ) ) {
				return;
			}

			parent.siblings().removeClass( 'active' );
			parent.addClass( 'active' );

			currentTab = parent.index();

			$contentTabs.children().removeClass( 'active' );
			$contentTabs.children().eq( currentTab ).addClass( 'active' );
		} );

		$el.on( 'click', '.tab-mobile-heading', function( e ) {
			e.preventDefault();

			var parent = $( this ).parent( '.tab-panel' );
			if ( parent.hasClass( 'active' ) ) {
				return;
			}

			parent.siblings().removeClass( 'active' );
			parent.addClass( 'active' );

			currentTab = parent.index();

			$navTabs.children().removeClass( 'active' ).eq( currentTab ).addClass( 'active' );
		} );

		$el.on( 'click', '.tab-button', function( e ) {
			e.preventDefault();
			var role = $( this ).attr( 'aria-controls' );

			if ( 'next' === role ) {
				if ( currentTab < maxTab - 1 ) {
					currentTab ++;

					$navTabs.children().removeClass( 'active' ).eq( currentTab ).addClass( 'active' );
					$contentTabs.children().removeClass( 'active' ).eq( currentTab ).addClass( 'active' );
				}
			} else {
				if ( currentTab > 0 ) {
					currentTab --;

					$navTabs.children().removeClass( 'active' ).eq( currentTab ).addClass( 'active' );
					$contentTabs.children().removeClass( 'active' ).eq( currentTab ).addClass( 'active' );
				}
			}
		} );
	} );
} );
