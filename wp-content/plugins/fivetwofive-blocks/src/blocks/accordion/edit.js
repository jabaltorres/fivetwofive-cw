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
	useSetting
} from '@wordpress/block-editor';

import {__} from '@wordpress/i18n';

import {
	PanelBody,
	PanelRow,
	ToggleControl,
	SelectControl,
	BaseControl,
	TabPanel,
	__experimentalBorderBoxControl as BorderBoxControl,
	RangeControl as RangeControl
} from '@wordpress/components';

import BlockAppender from '../../components/Appender';
import BlockTitle from '../../components/blockTitle';
import ColorSettingsDropdown from '../../components/ColorSettingsDropdown';

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
function Edit(props) {
	const {
		clientId,
		attributes,
		setAttributes
	} = props;

	const {
		textAlignment,
		panelTitleTag,
		panelIconStyle,
		panelIconDisplay,
		panelIconPosition,
		panelHeadingColor,
		panelHeadingBackgroundColor,
		panelHeadingBorderColor,
		panelHeadingBorderRadius,
		panelActiveHeadingColor,
		panelActiveHeadingBackgroundColor,
		panelActiveHeadingBorderColor,
		panelContentColor,
		panelContentBackgroundColor
	} = attributes;

	const blockName = `wp-block-${metadata.name.replace('/', '-')}`;

	const panelTitleTags = [
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
		}
	];

	const siteColorsSettings = {
		colors: useSetting('color.palette.default'),
		disableCustomColors: !useSetting('color.custom'),
		disableCustomGradients: !useSetting('color.customGradient')
	};

	const siteBorderSettings = {
		colors: useSetting('color.palette.default'),
		disableCustomColors: !useSetting('color.custom'),
	};

	const headerColorSettingsTabs = [
		{
			name: "accordion-panel-normal",
			title: "Normal"
		},
		{
			name: "accordion-panel-active",
			title: "Active"
		},
	];

	const headerColorSettings = [
		{
			name: "accordion-panel-normal",
			settings: [
				{
					// Use custom attribute as fallback to prevent loss of named color selection when
					// switching themes to a new theme that does not have a matching named color.
					value: panelHeadingColor,
					onChange: (colorValue) => {
						setAttributes({panelHeadingColor: colorValue});
					},
					label: __("Text"),
				},
				{
					value: panelHeadingBackgroundColor,
					onChange: (colorValue) => {
						setAttributes({panelHeadingBackgroundColor: colorValue});
					},
					label: __("Background"),
				},
				{
					value: panelHeadingBorderColor,
					onChange: (colorValue) => {
						setAttributes({panelHeadingBorderColor: colorValue});
					},
					label: __("Border"),
				}
			]
		},
		{
			name: "accordion-panel-active",
			settings: [
				{
					value: panelActiveHeadingColor,
					onChange: (colorValue) => {
						setAttributes({panelActiveHeadingColor: colorValue});
					},
					label: __("Text"),
				},
				{
					value: panelActiveHeadingBackgroundColor,
					onChange: (colorValue) => {
						setAttributes({panelActiveHeadingBackgroundColor: colorValue});
					},
					label: __("Background"),
				},
				{
					value: panelActiveHeadingBorderColor,
					onChange: (colorValue) => {
						setAttributes({panelActiveHeadingBorderColor: colorValue});
					},
					label: __("Border"),
				}
			]
		}
	];

	const contentColorSettings = [
		{
			value: panelContentColor,
			onChange: (colorValue) => {
				setAttributes({panelContentColor: colorValue});
			},
			label: __("Text"),
		},
		{
			value: panelContentBackgroundColor,
			onChange: (colorValue) => {
				setAttributes({panelContentBackgroundColor: colorValue});
			},
			label: __("Background"),
		}
	];

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

	let style = {};

	if (panelIconDisplay && panelIconStyle) {
		let iconStyle = '';

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

		style['--ftfb-accordion-btn-icon'] = iconStyle;
	}

	if (panelHeadingColor) {
		style['--ftfb-accordion-btn-color'] = panelHeadingColor;
	}

	if (panelHeadingBackgroundColor) {
		style['--ftfb-accordion-btn-bg'] = panelHeadingBackgroundColor;
	}

	if (panelHeadingBorderColor) {
		style['--ftfb-accordion-border-color'] = panelHeadingBorderColor;
	}

	if (panelHeadingBorderRadius || 0 === panelHeadingBorderRadius) {
		style['--ftfb-accordion-border-radius'] = `${panelHeadingBorderRadius}px`;
	}

	if (panelActiveHeadingColor) {
		style['--ftfb-accordion-active-color'] = panelActiveHeadingColor;
	}

	if (panelActiveHeadingBackgroundColor) {
		style['--ftfb-accordion-active-bg'] = panelActiveHeadingBackgroundColor;
	}

	if (panelActiveHeadingBorderColor) {
		style['--ftfb-accordion-border-active-color'] = panelActiveHeadingBorderColor;
	}

	if (panelContentColor) {
		style['--ftfb-accordion-content-color'] = panelContentColor;
	}

	if (panelContentBackgroundColor) {
		style['--ftfb-accordion-content-bg'] = panelContentBackgroundColor;
	}

	const blockProps = useBlockProps({
		className: blockAttributesClasses,
		style
	});

	return (
		<div {...blockProps}>
			<BlockControls>
				<AlignmentToolbar
					value={textAlignment}
					onChange={x => setAttributes({textAlignment: x})}
				/>
			</BlockControls>
			<InspectorControls>
				<PanelBody title={__("Header Settings")}>
					<SelectControl
						label={__("Title Tag")}
						onChange={x => setAttributes({panelTitleTag: x})}
						value={panelTitleTag}
						options={panelTitleTags}
					/>
				</PanelBody>
				<PanelBody title={__("Header Color")} initialOpen={false}>
					<TabPanel
						className="ftfb-tab-panel components-tab-panel"
						tabs={headerColorSettingsTabs}
					>
						{tab => {
							const tabColorContent = headerColorSettings.filter(setting => setting.name === tab.name);
							return (
								<div className={`ftfb-${tab.name}-tab`}>
									{tabColorContent.length > 0 && tabColorContent[0]["settings"].map((setting, index) => {
										return (
											<ColorSettingsDropdown
												key={index}
												{...siteColorsSettings}
												{...setting}
											/>
										)
									})}
								</div>
							)
						}}
					</TabPanel>
				</PanelBody>
				<PanelBody title={__("Header Border")} initialOpen={false}>
					<RangeControl
						label={__("Border Radius (PX)")}
						value={panelHeadingBorderRadius}
						onChange={radius => setAttributes({panelHeadingBorderRadius: radius})}
					/>
				</PanelBody>
				<PanelBody title={__("Header Icon")} initialOpen={false}>
					<PanelRow>
						<ToggleControl
							label={__("Show Icon")}
							checked={panelIconDisplay}
							onChange={x => setAttributes({panelIconDisplay: x})}
						/>
					</PanelRow>
					<BaseControl
						label={__("Icon Style")}
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
				<PanelBody title={__("Content Color")} initialOpen={false}>
					{contentColorSettings.map((setting, index) => {
						return (
							<ColorSettingsDropdown
								key={index}
								{...siteColorsSettings}
								{...setting}
							/>
						)
					})}
				</PanelBody>
			</InspectorControls>
			<BlockTitle title={metadata.title}/>
			<InnerBlocks
				allowedBlocks={['fivetwofive-blocks/panel']}
				template={[['fivetwofive-blocks/panel', {}]]}
				renderAppender={() => (
					<BlockAppender rootClientId={clientId} text={__("Add Panel")}/>
				)}
			/>
		</div>
	);
}

export default Edit;
