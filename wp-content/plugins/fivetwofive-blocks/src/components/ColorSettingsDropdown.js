import {
	Flex,
	FlexItem,
	Button,
	ColorIndicator,
	ColorPalette,
	Dropdown
} from '@wordpress/components';

/**
 * External dependencies
 */
import classnames from 'classnames';

import "../scss/components/_color-settings-dropdown.scss";

const LabeledColorIndicator = ({colorValue, label}) => (
	<Flex justify="flex-start">
		<ColorIndicator
			className="ftfb-color-settings-dropdown__color-indicator"
			colorValue={colorValue}
		/>
		<FlexItem
			className="ftfb-color-settings-dropdown__color-name"
			title={label}
		>
			{label}
		</FlexItem>
	</Flex>
);

const renderToggle =
	(settings) =>
		({onToggle, isOpen}) => {
			const {value, label} = settings;

			const toggleProps = {
				onClick: onToggle,
				className: classnames(
					'ftfb-color-settings-dropdown__dropdown-toggle',
					{'is-open': isOpen}
				),
				'aria-expanded': isOpen,
			};

			return (
				<Button {...toggleProps}>
					<LabeledColorIndicator
						colorValue={value}
						label={label}
					/>
				</Button>
			);
		};

const ColorSettingsDropdown = (props) => {
	const {
		value,
		label,
		colors,
		disableCustomColors,
		disableCustomGradients,
		enableAlpha,
		onChange
	} = props;

	const toggleSettings = {
		value,
		label,
	}

	const controlProps = {
		showTitle: false,
		clearable: true,
		value,
		colors,
		disableCustomColors,
		disableCustomGradients,
		enableAlpha,
		onChange
	};

	const popoverProps = {
		placement: 'left-start',
		offset: 36,
		shift: true,
	};

	return (
		<Dropdown
			popoverProps={popoverProps}
			className="ftfb-color-settings-dropdown__dropdown"
			renderToggle={ renderToggle( toggleSettings ) }
			renderContent={ () => (
				<div className="ftfb-color-settings-dropdown__dropdown-content" style={{padding: "8px", width: "260px"}}>
					<ColorPalette
						{ ...controlProps }
					/>
				</div>
			) }
		/>
	);
};

export default ColorSettingsDropdown;