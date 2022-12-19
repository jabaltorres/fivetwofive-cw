import { Inserter } from '@wordpress/block-editor';
import { Button, Icon } from '@wordpress/components';

/**
 * Custom block appender based on ButtonBlockAppender
 * @link https://github.com/WordPress/gutenberg/blob/v8.2.1/packages/block-editor/src/components/button-block-appender/index.js
 *
 * @param rootClientId
 * @param text
 * @returns {JSX.Element}
 * @constructor
 */
export default function FTFBBlockAppender( { rootClientId, text } ) {
	return (
		<Inserter
			rootClientId={ rootClientId }
			renderToggle={ ( { onToggle, disabled } ) => (
				<Button
					className="ftfb-block-appender"
					variant="primary"
					icon={ <Icon icon="plus-alt2" /> }
					text= { text }
					onClick={ onToggle }
					disabled={ disabled }>
				</Button>
			) }
			isAppender
		/>
	);
}
