/**
 * This script adds notice dismissal to the Altitude Pro theme.
 *
 * @package Altitude Pro\JS
 * @author StudioPress
 * @license GPL-2.0-or-later
 */

jQuery( document ).on( 'click', '.altitude-woocommerce-notice .notice-dismiss', function() {

	jQuery.ajax({
		url: ajaxurl,
		data: {
			action: 'altitude_dismiss_woocommerce_notice'
		}
	});

});
