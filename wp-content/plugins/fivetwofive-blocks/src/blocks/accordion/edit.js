import '@fonticonpicker/react-fonticonpicker/dist/fonticonpicker.base-theme.react.css';
import '@fonticonpicker/react-fonticonpicker/dist/fonticonpicker.material-theme.react.css';
import FontIconPicker from '@fonticonpicker/react-fonticonpicker';

import metadata from './block.json';

import {
	InnerBlocks,
	useBlockProps,
	BlockControls,
	AlignmentToolbar,
	InspectorControls,
	withColors,
	__experimentalColorGradientSettingsDropdown as ColorGradientSettingsDropdown,
	useSetting,
} from '@wordpress/block-editor';

import {__} from '@wordpress/i18n';

import {
	PanelBody,
	PanelRow,
	ToggleControl,
	SelectControl,
	BaseControl
} from '@wordpress/components';


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
function AccordionEdit(props) {
	const {
		clientId,
		attributes,
		setAttributes,
		panelHeadingColor,
		panelHeadingBackgroundColor,
		panelContentColor,
		panelContentBackgroundColor,
		setPanelHeadingColor,
		setPanelHeadingBackgroundColor,
		setPanelContentColor,
		setPanelContentBackgroundColor
	} = props;

	const {
		textAlignment,
		panelTitleTag,
		panelIconStyle,
		panelIconDisplay,
		panelIconPosition,
		panelHeadingColorValue,
		panelHeadingBackgroundColorValue,
		panelContentColorValue,
		panelContentBackgroundColorValue
	} = attributes;

	const blockName = `wp-block-${metadata.name.replace('/', '-')}`;

	const iconIds = [
		'ftfb_accordion_icon_chevron',
		'ftfb_accordion_icon_chevron_circle',
		'ftfb_accordion_icon_plus_minus',
		'ftfb_accordion_icon_plus_minus_circle',
	];

	let blockAttributesClasses = [];

	blockAttributesClasses.push(`${blockName}--icon-display-${panelIconDisplay ? 'show' : 'hidden'}`);

	if (panelIconDisplay) {
		blockAttributesClasses.push(`${blockName}--icon-position-${panelIconPosition}`);
	}

	let iconStyle = '';

	if (panelIconDisplay && panelIconStyle) {
		switch (panelIconStyle) {
			case 'ftfb_accordion_icon_chevron_circle':
				iconStyle = `url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath d='M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256 256-114.6 256-256S397.4 0 256 0zM135 241c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l87 87 87-87c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L273 345c-9.4 9.4-24.6 9.4-33.9 0L135 241z'/%3E%3C/svg%3E")`;
				break;
			case 'ftfb_accordion_icon_plus_minus':
				iconStyle = `url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'%3E%3Cpath d='M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32v144H48c-17.7 0-32 14.3-32 32s14.3 32 32 32h144v144c0 17.7 14.3 32 32 32s32-14.3 32-32V288h144c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z'/%3E%3C/svg%3E")`;
				break;
			case 'ftfb_accordion_icon_plus_minus_circle':
				iconStyle = `url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath d='M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0 0 114.6 0 256s114.6 256 256 256zm-24-168v-64h-64c-13.3 0-24-10.7-24-24s10.7-24 24-24h64v-64c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24h-64v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z'/%3E%3C/svg%3E")`;
				break;
			default:
				iconStyle = `url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath d='M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z'/%3E%3C/svg%3E")`;
		}
	}

	const blockProps = useBlockProps({
		className: blockAttributesClasses
	});

	const colorSettings = [
		{
			// Use custom attribute as fallback to prevent loss of named color selection when
			// switching themes to a new theme that does not have a matching named color.
			value: panelHeadingColor.color || panelHeadingColorValue,
			onChange: (colorValue) => {
				setPanelHeadingColor(colorValue);
				setAttributes({panelHeadingColorValue: colorValue});
			},
			label: __("Panel heading color"),
			resetAllFilter: () => {
				setPanelHeadingColor(undefined);
				setAttributes({panelHeadingColorValue: undefined});
			},
		},
		{
			value: panelHeadingBackgroundColor.color || panelHeadingBackgroundColorValue,
			onChange: (colorValue) => {
				setPanelHeadingBackgroundColor(colorValue);
				setAttributes({panelHeadingBackgroundColorValue: colorValue});
			},
			label: __("Panel heading background color"),
			resetAllFilter: () => {
				setPanelHeadingBackgroundColor(undefined);
				setAttributes({panelHeadingBackgroundColorValue: undefined});
			},
		},
		{
			value: panelContentColor.color || panelContentColorValue,
			onChange: (colorValue) => {
				setPanelContentColor(colorValue);
				setAttributes({panelContentColorValue: colorValue});
			},
			label: __("Panel content color"),
			resetAllFilter: () => {
				setPanelContentColor(undefined);
				setAttributes({panelContentColorValue: undefined});
			},
		},
		{
			value: panelContentBackgroundColor.color || panelContentBackgroundColorValue,
			onChange: (colorValue) => {
				setPanelContentBackgroundColor(colorValue);
				setAttributes({panelContentBackgroundColorValue: colorValue});
			},
			label: __("Panel content background color"),
			resetAllFilter: () => {
				setPanelContentBackgroundColor(undefined);
				setAttributes({panelContentBackgroundColorValue: undefined});
			},
		},
	];

	return (
		<div {...blockProps} style={{"--ftfb-accordion-btn-icon": `${iconStyle}`}}>
			<BlockControls>
				<AlignmentToolbar
					value={textAlignment}
					onChange={x => setAttributes({textAlignment: x})}
				/>
			</BlockControls>
			<InspectorControls>
				<PanelBody title={__("Panel Title Settings")} initialOpen={false}>
					<SelectControl
						label={__("Title Tag")}
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
				<PanelBody title={__("Panel Icon Settings")} initialOpen={false}>
					<PanelRow>
						<ToggleControl
							label={__("Show Icon")}
							checked={panelIconDisplay}
							onChange={x => setAttributes({panelIconDisplay: x})}
						/>
					</PanelRow>
					<BaseControl
						label={__("Icon style")}
					>
						<FontIconPicker
							icons={iconIds}
							value={panelIconStyle}
							onChange={icon => setAttributes({panelIconStyle: icon})}
							showSearch={false}
							renderFunc={svg => <svg>
								<use xlinkHref={`#${svg}`}/>
							</svg>}
							appendTo="body"
							theme="ftfb-accordion"
						/>
					</BaseControl>
					<SelectControl
						label={__("Icon Position")}
						value={panelIconPosition}
						onChange={x => setAttributes({panelIconPosition: x})}
						options={[
							{
								label: __("Left"),
								value: "left"
							},
							{
								label: __("Right"),
								value: 'right'
							},
						]}
					/>
				</PanelBody>
			</InspectorControls>
			<InspectorControls __experimentalGroup="color">
				{colorSettings.map(
					({onChange, label, value, resetAllFilter}) => (
						<ColorGradientSettingsDropdown
							key={`accordion-panel-color-${label}`}
							__experimentalIsRenderedInSidebar
							settings={[
								{
									colorValue: value,
									label,
									onColorChange: onChange,
									isShownByDefault: true,
									resetAllFilter,
									enableAlpha: true,
								},
							]}
							panelId={clientId}
							colors={useSetting('color.palette.default')}
							disableCustomColors={!useSetting('color.custom')}
							disableCustomGradients={!useSetting('color.customGradient')}
						/>
					)
				)}

			</InspectorControls>
			<InnerBlocks
				allowedBlocks={['fivetwofive-blocks/panel']}
				template={[['fivetwofive-blocks/panel', {}]]}
				renderAppender={() => (
					<FTFBBlockAppender rootClientId={clientId} text={__("Add Panel")}/>
				)}
			/>
		</div>
	);
}

const panelColorAttributes = {
	panelHeadingColor: 'panel-heading-color',
	panelHeadingBackgroundColor: 'panel-heading-background-color',
	panelContentColor: 'panel-content-color',
	panelContentBackgroundColor: 'panel-content-background-color'
};

export default withColors(panelColorAttributes)(AccordionEdit);
