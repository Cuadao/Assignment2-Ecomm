/**
 * Clocks script. Runs on <canvas> elements to draw clocks.
 *
 */

var clocks = {};
( function() {

	// Define style settings.
	clocks.settings = {
		m_radius: 96,
		m_linet: 12,
		m_circlet: 8,
		h_radius: 72,
		h_linet: 16,
		h_circlet: 0,
		color: '#ffcc00',
		width: 0,
		height: 0
	};
	clocks.it = 0;

	clocks.settings.width = 2 * Math.max( clocks.settings.m_radius + clocks.settings.m_circlet, 
										clocks.settings.h_radius + clocks.settings.h_circlet ),
	clocks.settings.height = clocks.settings.width;

	// Start the animation.
	clocks.init = function() {
		clocks.canvases = document.getElementsByClassName( 'clock-canvas' );
		clocks.settings.color = fg.settings.color;

		for ( i = 0; i < clocks.canvases.length; i++ ) {
			clocks.it = i;
			clocks.draw( clocks.canvases[i] );
		}
	},

	// Draw a single clock.
	// el is a canvas element to draw the clock on.
	clocks.draw = function( el ) {
		if ( null === el || 'canvas' !== el.tagName.toLowerCase() ) {
			return;
		}

		var m, h, centerx, centery, px, py, ctx;
		centerx = clocks.settings.width / 2;
		centery = clocks.settings.height / 2;
		m = parseInt( el.dataset.minute );
		h = parseInt( el.dataset.hour );

		ctx = el.getContext( '2d' );
		el.width = clocks.settings.width;
		el.height = clocks.settings.height;
		
		if ( ( ( document.body.classList.contains( 'archive' ) ) ? 1 : 0 ) == clocks.it % 2 ) {
			ctx.strokeStyle = fg.settings.bcolor;
		} else {
			ctx.strokeStyle = clocks.settings.color;
		}

		// Draw minute hand and circle.
		if ( m >= 0 ) {
			// Draw circle.
			if ( 0 < clocks.settings.m_circlet ) {
				ctx.lineWidth = clocks.settings.m_circlet;
				ctx.beginPath();
				ctx.arc( centerx, centery, clocks.settings.m_radius, 0, Math.PI*2, false );
				ctx.stroke();
			}
	
			// Draw line at the specified minute angle.
			m = - m * ( 2 * Math.PI / 60 ); // Minutes to radian angle (as a ratio of 2*PI).
			px = clocks.settings.m_radius * ( 1 - ( Math.sin( m ) ) );
			py = clocks.settings.m_radius * ( 1 - ( Math.cos( m ) ) );

			ctx.lineWidth = clocks.settings.m_linet;
			ctx.beginPath();
			ctx.moveTo( centerx, centery );
			ctx.lineTo( px, py );
			ctx.stroke();
		}

		// Draw hour hand and circle.
		if ( h >= 0 ) {
			// Draw circle.
			if ( 0 < clocks.settings.h_circlet ) {
				ctx.lineWidth = clocks.settings.h_circlet;
				ctx.beginPath();
				ctx.arc( centerx, centery, clocks.settings.h_radius, 0, Math.PI*2, false );
				ctx.stroke();
			}
	
			// Draw line at the specified hour angle.
			h = - h * ( 2 * Math.PI / 12 ); // Hours to radian angle (as a ratio of 2*PI).
			px = clocks.settings.m_radius - clocks.settings.h_radius * ( Math.sin( h ) );
			py = clocks.settings.m_radius - clocks.settings.h_radius * ( Math.cos( h ) );

			ctx.lineWidth = clocks.settings.h_linet;
			ctx.beginPath();
			ctx.moveTo( centerx, centery );
			ctx.lineTo( px, py );
			ctx.stroke();
		}
	}

} )();