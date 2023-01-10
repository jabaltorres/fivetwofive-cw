import {RichText, InnerBlocks, useBlockProps} from '@wordpress/block-editor';

import { __ } from '@wordpress/i18n';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit(props) {

	const {
		attributes,
		setAttributes,
		context
	} = props;

	const {
		title
	} = attributes;
	const saveTitle = (newValue) => {
		setAttributes({title: newValue});
	}

	const panelTemplate = [['core/paragraph', {}]];

	return (
		<div {...useBlockProps()}>
			<RichText
				className="ftfb-panel-title"
				placeholder={ __( 'Enter panel title here..' ) }
				tagName={context["fivetwofive-blocks/accordion/panelTitleTag"]}
				value={title}
				onChange={saveTitle}
			/>
			<div className="ftfb-panel-collapse">
				<div className="ftfb-panel-body">
					<InnerBlocks
						template={panelTemplate}
					/>
				</div>
			</div>
		</div>
	);
}
