/**
 * This script adds the jquery effects to the Altitude Pro Theme.
 *
 * @package Altitude Pro\JS
 * @author StudioPress
 * @license GPL-2.0-or-later
 */

jQuery( function( $ ) {

	if ( 0 < $( document ).scrollTop() ) {
		$( '.site-header' ).addClass( 'dark' );
	}

	// Add opacity class to site header.
	$( document ).on( 'scroll', function() {

		if ( 0 < $( document ).scrollTop() ) {
			$( '.site-header' ).addClass( 'dark' );

		} else {
			$( '.site-header' ).removeClass( 'dark' );
		}

	});

});
