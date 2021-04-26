/* global wp, jQuery */
/**
 * File customize.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Hide site title.
	wp.customize( 'fivetwofive_theme_mods[site_identity][hide_blogname]', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.site-title' ).addClass('screen-reader-text');
			} else {
				$( '.site-title' ).removeClass('screen-reader-text');
			}
		} );
	} );

	// Hide site description.
	wp.customize( 'fivetwofive_theme_mods[site_identity][hide_blogdescription]', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.site-description' ).addClass('screen-reader-text');
			} else {
				$( '.site-description' ).removeClass('screen-reader-text');
			}
		} );
	} );

}( jQuery ) );
