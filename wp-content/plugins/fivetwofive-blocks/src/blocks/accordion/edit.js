import {InnerBlocks, useBlockProps, BlockControls, AlignmentToolbar, InspectorControls} from '@wordpress/block-editor';

import {PanelBody, PanelRow, ToggleControl, SelectControl} from '@wordpress/components';

import FTFBBlockAppender from '../../components/Appender';

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
		attributes: {textAlignment, collapse, showMultiple, panelTitleTag},
		setAttributes,
		clientId
	} = props;

	return (
		<div {...useBlockProps()}>
			<BlockControls>
				<AlignmentToolbar
					value={textAlignment}
					onChange={x => setAttributes({textAlignment: x})}
				/>
			</BlockControls>
			<InspectorControls>
				<PanelBody>
					<PanelRow>
						<ToggleControl
							checked={collapse}
							label="Allow collapse expanded panel"
							onChange={x => setAttributes({collapse: x})}
						/>
					</PanelRow>
					<PanelRow>
						<ToggleControl
							checked={showMultiple}
							label="Show multiple elements at the same time"
							onChange={x => setAttributes({showMultiple: x})}
						/>
					</PanelRow>
				</PanelBody>
				<PanelBody title="Panel Title - Tag Settings" initialOpen={false}>
					<SelectControl
						label="Title Tag"
						onChange={x => setAttributes({panelTitleTag: x})}
						value={panelTitleTag}
						options={[
							{
								label: 'DIV',
								value: 'div'
							},
							{
								label: 'H2',
								value: 'h2'
							},
							{
								label: 'H3',
								value: 'h3'
							},
							{
								label: 'H4',
								value: 'h4'
							},
							{
								label: 'H5',
								value: 'h5'
							},
							{
								label: 'H6',
								value: 'h6'
							},
						]}
					/>
				</PanelBody>
			</InspectorControls>
			<InnerBlocks
				allowedBlocks={['fivetwofive-blocks/panel']}
				template={[['fivetwofive-blocks/panel', {}], ['fivetwofive-blocks/panel', {}]]}
				renderAppender={() => (
					<FTFBBlockAppender rootClientId={clientId} text="Add Panel"/>
				)}
			/>
		</div>
	);
}
