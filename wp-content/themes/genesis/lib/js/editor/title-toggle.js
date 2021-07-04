/**
 * Adds a “hide title” checkbox to Genesis Block Editor sidebar in a
 * Title panel. Unchecked by default.
 *
 * If checked and the post is updated or published, `_genesis_hide_title`
 * is set to true in post meta.
 *
 * To disable the checkbox, use the PHP `genesis_title_toggle_enabled`
 * filter: `add_filter( 'genesis_title_toggle_enabled', '__return_false' );`.
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
import { Fragment } from '@wordpress/element';
import { compose } from '@wordpress/compose';
import { select, withSelect, withDispatch } from '@wordpress/data';
import { CheckboxControl, Fill, PanelBody, PanelRow } from '@wordpress/components';
import { registerPlugin } from '@wordpress/plugins';

/**
 * Internal dependencies
 */
import { newMeta } from '../editor/new-meta.js';

/**
 * Checkbox component for the hide title option.
 *
 * @param {Object} props Component properties.
 * @return {Object} hideTitleComponent
 */
function genesisHideTitleComponent( { hideTitle = false, onUpdate } ) {
	return (
		<Fragment>
			<Fill name="GenesisSidebar">
				<PanelBody initialOpen={ true } title={ __( 'Title', 'genesis' ) }>
					<PanelRow>
						<CheckboxControl
							label={ __( 'Hide Title', 'genesis' ) }
							checked={ !! hideTitle }
							onChange={ () => onUpdate( ! hideTitle ) }
						/>
					</PanelRow>
				</PanelBody>
			</Fill>
		</Fragment>
	);
}

// Retrieves meta from the Block Editor Redux store (withSelect) to set initial checkbox state.
// Persists it to the Redux store on change (withDispatch).
// Changes are only stored in the WordPress database when the post is updated.
const render = compose( [
	withSelect( () => {
		return {
			hideTitle: select( 'core/editor' ).getEditedPostAttribute( 'meta' )._genesis_hide_title,
		};
	} ),
	withDispatch( ( dispatch ) => ( {
		onUpdate( hideTitle ) {
			dispatch( 'core/editor' ).editPost(
				{ meta: newMeta( '_genesis_hide_title', !! hideTitle ) }
			);
		},
	} ) ),
] )( genesisHideTitleComponent );

registerPlugin( 'genesis-title-toggle', { render } );
