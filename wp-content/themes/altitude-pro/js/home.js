/**
 * This script adds the jQuery effects to the front page of the Altitude Pro Theme.
 *
 * @package Altitude Pro\JS
 * @author StudioPress
 * @license GPL-2.0-or-later
 */

( function( $ ) {

	if ( document.location.hash ) {
			window.setTimeout( function() {
				document.location.href += '';
			}, 10 );
	}

	// Scroll to target function.
	$( 'a[href*="#"]:not([href="#"])' ).click( function() {

		var target = $( this.hash );

		if ( location.pathname.replace( /^\//, '' ) == this.pathname.replace( /^\//, '' ) && location.hostname == this.hostname ) {

			target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );

			if ( target.length ) {

				$( 'html,body' ).animate({
					scrollTop: target.offset().top
				}, {
					duration: 750,
					complete: function() {
						target.focus();
					}
				});

				return false;

			}
		}

	});

	// Image section height.
	$( '.image-section' ) .css({'height': $( window ).height() + 'px'});

	$( window ).resize( function() {

		$( '.image-section' ) .css({'height': $( window ).height() + 'px'});

	});

}( jQuery ) );
