/**
 * Adds a Classes panel to the Genesis Block Editor sidebar with body class
 * and post class input fields.
 *
 * Fields are stored in post meta as:
 *
 * - `_genesis_custom_body_class`
 * - `_genesis_custom_post_class`
 *
 * These are the same fields used by the original Layout Settings meta box.
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
import { Fill, Panel, PanelBody } from '@wordpress/components';
import { registerPlugin } from '@wordpress/plugins';

/**
 * Internal dependencies
 */
import { BodyClassTextControl } from '../components/body-class-text-control';
import { PostClassTextControl } from '../components/post-class-text-control';

function GenesisCustomClasses() {
	return (
		<Fragment>
			<Fill name="GenesisSidebar">
				<Panel>
					<PanelBody initialOpen={ true } title={ __( 'Custom Classes', 'genesis' ) }>
						<BodyClassTextControl />
						<PostClassTextControl />
					</PanelBody>
				</Panel>
			</Fill>
		</Fragment>
	);
}

registerPlugin( 'genesis-custom-classes', { render: GenesisCustomClasses } );
