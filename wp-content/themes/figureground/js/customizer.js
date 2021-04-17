/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a .title' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Footer copyright name.
	wp.customize( 'copy_name', function( value ) {
		value.bind( function( to ) {
			$( '#footer-copy-name' ).text( to );
		} );
	} );

	// Footer credits.
	wp.customize( 'powered_by_wp', function( value ) {
		value.bind( function( to ) {
			$( '.wordpress-credit' ).toggle( to );
		} );
	} );
	wp.customize( 'theme_meta', function( value ) {
		value.bind( function( to ) {
			$( '.theme-credit' ).toggle( to );
		} );
	} );

	// Figure/Ground script settings. For each option, reset the animation on change for immediate feedback.
	wp.customize( 'fg_type', function( value ) {
		value.bind( function( to ) {
			window.fg.settings.type = to;
			window.fg.clearCanvas();
			window.fg.init();
			switch( to ) {
				case 'orthogonal': 
					$( 'body' ).removeClass( 'circular rhombus' );
					break;
				case 'circular':
					$( 'body' ).removeClass( 'rhombus' ).addClass( 'circular' );
					break;
				case 'rhombus':
					$( 'body' ).removeClass( 'circular' ).addClass( 'rhombus' );
					break;
			}
		} );
	} );

	wp.customize( 'fg_max_width', function( value ) {
		value.bind( function( to ) {
			window.fg.settings.maxw = to;
			window.fg.settings.maxr = ( 2 * to / 3 );
			window.fg.clearCanvas();
			window.fg.init();
		} );
	} );

	wp.customize( 'fg_max_height', function( value ) {
		value.bind( function( to ) {
			window.fg.settings.maxh = to;
			window.fg.clearCanvas();
			window.fg.init();
		} );
	} );

	wp.customize( 'fg_speed', function( value ) {
		value.bind( function( to ) {
			window.fg.settings.delay = to;
			window.fg.clearCanvas();
			window.fg.init();
		} );
	} );

	wp.customize( 'fg_initial', function( value ) {
		value.bind( function( to ) {
			window.fg.settings.initial = to;
			window.fg.clearCanvas();
			window.fg.init();
		} );
	} );

	// Custom colors. Only updates selected colors, generated colors are 
	// updated with Selective Refresh a few seconds later.
	wp.customize( 'fg_color_light', function( value ) {
		value.bind( function( to ) {
			window.fg.settings.bcolor = to;
			window.clocks.init();
			// Update custom color CSS
			var style = $( '#figureground-colors' ),
			    color = style.data( 'fg_color_light' ),
			    css = style.html();
			//css = css.replace( color, to );
			css = css.split( color ).join( to ); // css.replaceAll.
			$( '#figureground-colors' ).html( css )
			                           .data( 'fg_color_light', to );
		} );
	} );

	wp.customize( 'fg_color_dark', function( value ) {
		value.bind( function( to ) {
			window.fg.settings.color = to;
			window.fg.init();
			window.clocks.init();
			// Update custom color CSS
			var style = $( '#figureground-colors' ),
			    color = style.data( 'fg_color_dark' ),
			    css = style.html();
			//css = css.replace( color, to );
			css = css.split( color ).join( to ); // css.replaceAll.
			$( '#figureground-colors' ).html( css )
			                       .data( 'fg_color_dark', to );
		} );
	} );

	wp.customize( 'accent_color_light', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS
			var style = $( '#figureground-colors' ),
			    color = style.data( 'accent_color_light' ),
			    css = style.html();
			//css = css.replace( color, to );
			css = css.split( color ).join( to ); // css.replaceAll.
			$( '#figureground-colors' ).html( css )
			                           .data( 'accent_color_light', to );
		} );
	} );

	wp.customize( 'accent_color_dark', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS
			var style = $( '#figureground-colors' ),
			    color = style.data( 'accent_color_dark' ),
			    css = style.html();
			//css = css.replace( color, to );
			css = css.split( color ).join( to ); // css.replaceAll.
			$( '#figureground-colors' ).html( css )
			                           .data( 'accent_color_dark', to );
		} );
	} );

} )( jQuery );
