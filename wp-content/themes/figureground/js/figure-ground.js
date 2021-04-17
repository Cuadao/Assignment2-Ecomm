/**
 * Figure/Ground animation script. Runs on a full-window <canvas> element.
 */

var fg = {};
( function( $ ) {

	// Load settings passed from wp_localize_script().
	fg.settings = figureGroundSettings;

	// Start the animation.
	fg.init = function() {
		clearInterval( fg.t ); // Allows re-initing via this same function.
		clearTimeout( fg.t );

		fg.canvas = document.getElementById( 'figure-ground' );
		fg.ctx = fg.canvas.getContext('2d');

		fg.resizeCanvas();

		fg.ctx.fillStyle = fg.settings.color;
		fg.ctx.strokeStyle = fg.settings.color;
		fg.i = 0;

		if ( 'orthogonal' == fg.settings.type ) {
			fg.initOrthogonal( fg.settings.initial );
			if ( 0 != fg.settings.delay ) {
				fg.t = setInterval( fg.rectangle, fg.settings.delay );
			}
			fg.alignToGrid();
		}
		else if ( 'rhombus' == fg.settings.type ) {
			fg.settings.maxw = parseInt( fg.settings.maxw );
			if( fg.settings.maxw < 32 ) {
				fg.settings.maxw = 32;
			}
			fg.initRhombus();
		}
		else {
			fg.initCircular( fg.settings.initial );
			if ( 0 != fg.settings.delay ) {
				fg.t = setInterval( fg.circle, fg.settings.delay );
			}
		}

		// Update play/pause button.
		if ( 0 !== parseInt( fg.settings.delay ) ) {
			$( '#figureground-animation-toggle' ).show();
		} else {
			$( '#figureground-animation-toggle' ).hide();
		}

		// Initialize clocks.
		clocks.init();
	};

	// Run the initial iterations of the orthogonal animation.
	fg.initOrthogonal = function( iterations ) {
		var ii = 0;
		while ( ii < iterations ) {
			fg.rectangle();
			ii++;
		}
	};

	// Run the initial iterations of the circular animation.
	fg.initCircular = function( iterations ) {
		var ii = 0;
		while ( ii < iterations ) {
			fg.circle();
			ii++;
		}
	}

	// Run the initialization of the rhombus pattern.
	fg.initRhombus = function() {
		fg.iy = 2;
		fg.i = 1;
		fg.cols = 2;
		fg.offsetY = .866025; // sqrt(3)/2
		fg.ctx.lineWidth = fg.settings.linet;

		fg.drawRhombus( 0, 0, 0 ); // Initialize recursively.
	}

	// Alternately draw or remove a randomly sized and positioned rectangle.
	fg.rectangle = function() {
		var w = Math.ceil( Math.random() * fg.settings.maxw / 16 ) * 16,
			h = Math.ceil( Math.random() * fg.settings.maxh / 16 ) * 16,
			x = Math.floor( Math.random() * ( fg.iwidth - w + 16 ) / 16 ) * 16,
			y = Math.floor( Math.random() * ( fg.iheight - h + 16 ) / 16 ) * 16;

		( fg.isEven( fg.i ) ) ? fg.ctx.fillRect( x, y, w, h ) : fg.ctx.clearRect( x, y, w, h );
		fg.i++;
	}

	// Alternately draw or remove a randomly sized and positioned circle.
	fg.circle = function() {
		var rad = Math.ceil( Math.random() * fg.settings.maxr / 16 ) * 16,
			x = Math.floor( Math.random() * ( fg.iwidth - rad ) / 16 ) * 16 + ( rad / 2 ),
			y = Math.floor( Math.random() * ( fg.iheight - rad ) / 16 ) * 16 + ( rad / 2 );

		( fg.isEven( fg.i ) ) ? fg.drawCircle( x, y, rad ) : fg.clearCircle( x, y, rad );
		fg.i++;
	}

	// Draw a circle at the given position and size.
	fg.drawCircle = function( x, y, rad ) {
		fg.ctx.beginPath();
		fg.ctx.arc( x, y, rad, 0, Math.PI*2, false );
		fg.ctx.closePath();
		fg.ctx.fill();
	}

	// Remove a circle at the given position and size.
	fg.clearCircle = function( x, y, rad ) {
		fg.ctx.save();
		fg.ctx.globalCompositeOperation = 'destination-out';
		fg.ctx.beginPath();
		fg.ctx.arc( x, y, rad, 0, 2 * Math.PI, false );
		fg.ctx.closePath();
		fg.ctx.fill();
		fg.ctx.restore();
	};

	// Draw or remove rhombi at random, by redrawing the rhombus pattern.
	fg.rhombus = function() {
		fg.drawRhombus( 0, 0, Math.floor( parseInt( fg.settings.delay ) / 4 ) );
	}

	// Recursively draw rhombi until the screen is filled
	fg.drawRhombus = function( cornerX, cornerY, delay ) {
		var x1 = cornerX,
		    x2 = cornerX + 1 * fg.settings.maxw, // max w = side length
			x3 = cornerX + 1.5 * fg.settings.maxw,
			x4 = cornerX + .5 * fg.settings.maxw,
			y1 = cornerY,
			y2 = cornerY,
			y3 = cornerY + ( ( fg.isEven(fg.i) ) ? -1 : 1 ) * fg.offsetY * fg.settings.maxw,
			y4 = cornerY + ( ( fg.isEven(fg.i) ) ? -1 : 1 ) * fg.offsetY * fg.settings.maxw;


		fg.ctx.beginPath();
		fg.ctx.moveTo( x1, y1 );
		fg.ctx.lineTo( x2, y2 );
		fg.ctx.lineTo( x3, y3 );
		fg.ctx.lineTo( x4, y4 );
		fg.ctx.lineTo( x1, y1 );

		if ( parseInt( fg.settings.initial ) / 640 > Math.random() ) { // Dentity
			fg.ctx.fill();
		} else {
			fg.ctx.globalCompositeOperation = 'destination-out'; // clear
			fg.ctx.fill();
			fg.ctx.globalCompositeOperation = 'source-over'; // draw over (restore for next iteration)
		}

		fg.ctx.stroke();

		fg.i = fg.i + 1;

		cornerX = x3;
		cornerY = y3;
		if ( cornerY < fg.canvas.height || cornerX < fg.canvas.width ) {
			if ( cornerX > fg.canvas.width ) {
				if ( 0 === delay && 2 === fg.iy ) {
					// Center the canvas when the first row initialization is complete.
					var offsetX = - (cornerX - fg.canvas.width) / 2;
					fg.canvas.style.marginLeft = offsetX + 'px';

					if ( ! fg.isEven( fg.i ) ) {
						fg.cols = 1;
					}
				}

				cornerX = 0;
				fg.iy = fg.iy + 1;
				cornerY = cornerY + 1 * fg.offsetY * fg.settings.maxw;
				
				// Even-columned screens require the pattern to be flipped every row.
				if ( ! fg.isEven( fg.cols ) ) {
					fg.i = fg.i + 1;
					if ( fg.isEven( fg.i ) ) {
						cornerY = cornerY + 1 * fg.offsetY * fg.settings.maxw;
					} else {
						cornerY = cornerY - 1 * fg.offsetY * fg.settings.maxw;
					}
				}
			}
			fg.t = setTimeout( function(){ fg.drawRhombus( cornerX, cornerY, delay ); }, delay );
		} else {
			if ( delay > 0 ) {
				fg.i = 1;
				fg.iy = 1;
				fg.drawRhombus( 0, 0, delay ); // Reset, and redraw infinitely.
			} else {

				// Initialize the animated loop when the first pass is complete.
				if ( 0 !== parseInt( fg.settings.delay ) ) {
					fg.rhombus();
				}
			}
		}
	}

	// Returns boolean whether the value is true or false.
	fg.isEven = function( value ) {
		return ( 0 == value % 2 ) ? true : false;
	}

	// Resive the <canvas> element to fill the window, and update the corresponding internal vars.
	fg.resizeCanvas = function() {
		fg.iwidth = window.innerWidth;
		fg.iheight = window.innerHeight;
		fg.canvas.width = fg.iwidth + parseInt( fg.settings.maxw );
		fg.canvas.height = fg.iheight + parseInt( fg.settings.maxw );
	}

	// Attempt to align the figure/ground grid to the centered page layout grid. This isn't pixel-perfect in most browsers, unfortunately
	fg.alignToGrid = function() {
		var offsetX = ( fg.iwidth % 16 ) / 2;
		fg.canvas.style.marginLeft = offsetX + 'px';
	}

	// Clear the entire canvas.
	fg.clearCanvas = function() {
		fg.resizeCanvas(); // Might as well re-set it now if it changed.
		fg.alignToGrid();
		clearInterval( fg.t );
		clearTimeout( fg.t );
		fg.ctx.clearRect( 0, 0, fg.canvas.width, fg.canvas.height );
		fg.ctx.fillStyle = fg.settings.color;
	}

	$(document).ready( function() {
		fg.init();

		$( window ).resize( function() {
			fg.clearCanvas(); // Must be cleared when size is changed, also re-aligns.
			fg.init();
		});

		$( '#figureground-animation-toggle' ).on( 'click', function( e ) {
			if ( $( e.currentTarget ).hasClass( 'on' ) ) {
				$( e.currentTarget ).removeClass( 'on' );
				clearInterval( fg.t );
				clearTimeout( fg.t );
			} else {
				$( e.currentTarget ).addClass( 'on' );
				fg.init();
			}
		});
	} );

} )( jQuery );