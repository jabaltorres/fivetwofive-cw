import { RichText, InnerBlocks, useBlockProps } from '@wordpress/block-editor';

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
		attributes: { title },
		setAttributes,
	} = props;

	const saveTitle = (newValue) => {
		setAttributes({ title: newValue });
	}

	const panelTemplate = [
		[ 'core/paragraph', { placeholder: 'Enter panel content here..' } ],
	];

	return (
		<div { ...useBlockProps() }>
			<RichText className="ftfb-panel-title" placeholder="Enter panel title here.." tagName="h3" value={title} onChange={saveTitle}/>
			<div className="ftfb-panel-content">
				<InnerBlocks template={ panelTemplate } />
			</div>
		</div>
	);
}
