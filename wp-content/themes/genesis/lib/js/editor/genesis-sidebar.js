/**
 * Adds the Genesis Sidebar to the Block Editor.
 *
 * Exposes a 'GenesisSidebar' slot. Other components can use portal rendering
 * to appear inside the Genesis sidebar by wrapping themselves in a Fill
 * component. First, import the Fill component:
 *
 * `import { Fill } from '@wordpress/components';`
 *
 * Then wrap your own component in a Fill component:
 *
 * `<Fill name="GenesisSidebar">I'm in the Genesis sidebar</Fill>`
 *
 * @since   3.1.0
 * @package Genesis\JS
 * @author  StudioPress
 * @license GPL-2.0-or-later
 */

/**
 * WordPress dependencies
 */
import { Fragment } from '@wordpress/element';
import { registerPlugin } from '@wordpress/plugins';
import { PluginSidebar, PluginSidebarMoreMenuItem } from '@wordpress/edit-post';
import { Slot } from '@wordpress/components';

/**
 * Internal dependencies
 */
import { GenesisIcon, GenesisIconSmall } from '../components/genesis-icons';

// Genesis Sidebar Component
const render = () => {
	return (
		<Fragment>
			<PluginSidebarMoreMenuItem
				target="genesis-sidebar"
				icon={ <GenesisIconSmall /> }
			>
				Genesis
			</PluginSidebarMoreMenuItem>
			<PluginSidebar
				name="genesis-sidebar"
				title="Genesis"
				icon={ <GenesisIcon /> }
			>
				<Slot name="GenesisSidebar" />
			</PluginSidebar>
		</Fragment>
	);
};

registerPlugin( 'genesis-sidebar', { render, icon: <GenesisIconSmall /> } );
