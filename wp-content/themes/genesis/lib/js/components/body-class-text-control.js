/**
 * The BodyClassTextControl component for use in the Custom Classes panel.
 *
 * @since   3.1.0
 * @package Genesis\JS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 */

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { compose } from '@wordpress/compose';
import { select, withSelect, withDispatch } from '@wordpress/data';
import { TextControl } from '@wordpress/components';

/**
 * Internal dependencies
 */
import { newMeta } from '../editor/new-meta.js';

function BodyControl( { bodyClass, onUpdate } ) {
	return (
		<TextControl
			label={ __( 'Body Class', 'genesis' ) }
			value={ bodyClass }
			onChange={ ( newClass ) => onUpdate( newClass ) }
		/>
	);
}

export const BodyClassTextControl = compose( [
	withSelect( () => {
		return {
			bodyClass: select( 'core/editor' ).getEditedPostAttribute( 'meta' )._genesis_custom_body_class,
		};
	} ),
	withDispatch( ( dispatch ) => ( {
		onUpdate( newClass ) {
			dispatch( 'core/editor' ).editPost(
				{ meta: newMeta( '_genesis_custom_body_class', newClass ) }
			);
		},
	} ) ),
] )( BodyControl );

