/**
 * Functionality specific to Figure/Ground.
 *
 * Provides helper functions to enhance the theme experience.
 */

( function( $ ) {
	var body    = $( 'body' ),
	    _window = $( window );

	/**
	 * Enables menu toggle.
	 */
	( function() {
		var nav = $( '#site-navigation' ), button, menu;
		if ( ! nav )
			return;

		button = nav.find( '.menu-toggle' );
		if ( ! button )
			return;

		// Hide button if menu is missing or empty.
		menu = nav.find( '.nav-menu' );
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}

		$( '.menu-toggle' ).on( 'click.figureground', function() {
			nav.toggleClass( 'toggled' );
		} );
		
		menu.on( 'focusout', function( event ) {
			if ( 'a' !== event.relatedTarget.localName ) {
				nav.removeClass( 'toggled' );
			}
		});

	} )();

	/**
	 * Toggle post categories display.
	 */
	( function() {
		button = $( '.post-categories' );
		if ( ! button )
			return;

		$( '.post-categories' ).on( 'click.figureground', function() {
			$( this ).toggleClass( 'toggled' );
			$( this ).next( 'li' ).removeClass( 'toggled' );
		} );
	} )();

	/**
	 * Toggle post tags display.
	 */
	( function() {
		button = $( '.post-tags' );
		if ( ! button )
			return;

		$( '.post-tags' ).on( 'click.figureground', function() {
			$(this).toggleClass( 'toggled' );
			$( this ).prev( 'li' ).removeClass( 'toggled' );
		} );
	} )();

	/**
	 * Makes "skip to content" link work correctly in IE9 and Chrome for better
	 * accessibility.
	 *
	 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
	 */
	_window.on( 'hashchange.figureground', function() {
		var element = document.getElementById( location.hash.substring( 1 ) );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
				element.tabIndex = -1;

			element.focus();
		}
	} );

	/**
	 * Arranges footer widgets vertically.
	 */
+	$( function() {
		var widgetArea;
		if ( ! $.isFunction( $.fn.masonry ) ) {
			return;
		}

		widgetArea = $( '#colophon .widget-area' );
		widgetArea.masonry( {
			itemSelector: '.widget',
			columnWidth: 384,
			gutterWidth: 64,
			isRTL: body.is( '.rtl' )
		} );

		if ( 'undefined' !== typeof wp && wp.customize && wp.customize.selectiveRefresh ) {
		    wp.customize.selectiveRefresh.bind( 'sidebar-updated', function( sidebarPartial ) {
		        if ( 'main' === sidebarPartial.sidebarId ) {
		            widgetArea.masonry( 'reloadItems' );
		            widgetArea.masonry( 'layout' );
		        }
		    } );
		}
	});
} )( jQuery );