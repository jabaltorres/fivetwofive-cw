/**
 * Adds a “hide featured image” checkbox to Genesis Block Editor sidebar in an
 * Image panel. Unchecked by default.
 *
 * If checked and the post is updated or published,
 * `_genesis_hide_singular_image` is set to true in post meta.
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
import { GenesisImageToggleInfo } from '../components/image-toggle-info.js';
import { newMeta } from '../editor/new-meta.js';

/**
 * Checkbox component for the hide title option.
 *
 * @param {Object} props Component properties.
 * @return {Object} GenesisHideFeaturedImageComponent.
 */
function GenesisHideFeaturedImageComponent( { hideFeaturedImage = false, onUpdate } ) {
	return (
		<Fragment>
			<Fill name="GenesisSidebar">
				<PanelBody initialOpen={ true } title={ __( 'Images', 'genesis' ) }>
					<PanelRow>
						<CheckboxControl
							label={ __( 'Hide Featured Image', 'genesis' ) }
							checked={ !! hideFeaturedImage }
							onChange={ () => onUpdate( ! hideFeaturedImage ) }
						/>
					</PanelRow>
					<PanelRow>
						<GenesisImageToggleInfo />
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
			hideFeaturedImage: select( 'core/editor' ).getEditedPostAttribute( 'meta' )._genesis_hide_singular_image,
		};
	} ),
	withDispatch( ( dispatch ) => ( {
		onUpdate( hideFeaturedImage ) {
			dispatch( 'core/editor' ).editPost(
				{ meta: newMeta( '_genesis_hide_singular_image', !! hideFeaturedImage ) }
			);
		},
	} ) ),
] )( GenesisHideFeaturedImageComponent );

registerPlugin( 'genesis-image-toggle', { render } );
