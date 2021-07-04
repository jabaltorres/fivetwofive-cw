/**
 * Adds a “layout toggle” to the Block Editor sidebar under the
 * Document sidebar. No layout selected by default.
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
import { Fragment, Component } from '@wordpress/element';
import { compose } from '@wordpress/compose';
import { select, withSelect, withDispatch } from '@wordpress/data';
import { registerPlugin } from '@wordpress/plugins';
import { SelectControl, Fill, Panel, PanelBody, Spinner } from '@wordpress/components';
import apiFetch from '@wordpress/api-fetch';

/**
 * Internal dependencies
 */
import { newMeta } from '../editor/new-meta.js';

class genesisLayoutToggleComponent extends Component {
	constructor( props ) {
		super( props );

		this.state = {
			layouts: [],
		};
	}

	componentDidMount() {
		// Show Genesis layouts of type [postType-ID], [postType], 'singular', then 'site' in that order.
		const layoutsEndpoint = `/genesis/v1/layouts/singular,${this.props.currentPostType},${this.props.currentPostID}`;
		apiFetch( { path: layoutsEndpoint } ).then( ( collection ) => {
			const stack = [ { label: __( 'Default Layout', 'genesis' ), value: '' } ];

			for ( const slug of Object.keys( collection ) ) {
				stack.push( {
					label: collection[ slug ].label,
					value: slug,
				} );
			}

			this.setState( { layouts: stack } );
		} );
	}

	render() {
		return (
			<Fragment>
				<Fill name="GenesisSidebar">
					<Panel>
						<PanelBody initialOpen={ true } title={ __( 'Layout', 'genesis' ) }>
							{
								this.state.layouts.length ?
									<SelectControl
										label={ __( 'Select Layout', 'genesis' ) }
										value={ this.props.layout }
										options={ this.state.layouts }
										onChange={ ( layout ) => this.props.onChange( layout ) }
									/> :
									<Spinner />
							}
						</PanelBody>
					</Panel>
				</Fill>
			</Fragment>
		);
	}
}

// Retrieves meta from the Block Editor Redux store (withSelect) to set initial checkbox state.
// Persists it to the Redux store on change (withDispatch).
// Changes are only stored in the WordPress database when the post is updated.
const render = compose( [
	withSelect( () => {
		return {
			layout: select( 'core/editor' ).getEditedPostAttribute( 'meta' )._genesis_layout,
			currentPostID: select( 'core/editor' ).getCurrentPostId(),
			currentPostType: select( 'core/editor' ).getCurrentPostType(),
		};
	} ),
	withDispatch( ( dispatch ) => ( {
		onChange( layout ) {
			dispatch( 'core/editor' ).editPost(
				{ meta: newMeta( '_genesis_layout', layout ) }
			);
		},
	} ) ),
] )( genesisLayoutToggleComponent );

registerPlugin( 'genesis-layout-toggle', { render } );
