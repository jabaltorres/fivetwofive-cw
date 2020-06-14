/**
 * Builds new meta for use when saving post data.
 *
 * @since   3.1.3
 * @package Genesis\JS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 */

/**
 * WordPress dependencies
 */
import { select } from '@wordpress/data';

/**
 * Builds the new Genesis meta given a new key and value.
 *
 * Ensures that:
 * 1. Only Genesis meta is updated when saving Genesis settings, fixing
 * https://github.com/studiopress/genesis/issues/2473.
 * 2. A value of 'false' is sent instead of null for empty checkboxes, fixing
 * https://github.com/studiopress/genesis/issues/2523.
 * 3. Checkboxes do not flicker on and off when saving posts. See “additional
 * info” at https://github.com/studiopress/genesis/pull/2474#issue-310416033.
 *
 * @param {string} newKey
 * @param {*} newValue
 * @return {Object} Genesis meta keys and values.
 */
export function newMeta( newKey, newValue ) {
	const currentMeta = select( 'core/editor' ).getEditedPostAttribute( 'meta' );
	const genesisMeta = Object.keys( currentMeta )
		.filter( ( key ) => key.startsWith( '_genesis' ) )
		.reduce( ( obj, key ) => {
			obj[ key ] = currentMeta[ key ];
			if ( obj[ key ] === null ) {
				obj[ key ] = false;
			}
			return obj;
		}, {} );

	return {
		...genesisMeta,
		[ newKey ]: newValue,
	};
}
