// Add custom button styles.
wp.domReady( function() {

    // Spacer styles.
	wp.blocks.registerBlockStyle( 'core/spacer', {
		name: 'default',
		label: 'Default',
		isDefault: true
	});

	wp.blocks.registerBlockStyle( 'core/spacer', {
		name: 'responsive-large',
		label: 'Responsive Large'
	});

     wp.blocks.registerBlockStyle( 'core/spacer', {
		name: 'responsive-medium',
		label: 'Responsive Medium'
	});

     wp.blocks.registerBlockStyle( 'core/spacer', {
		name: 'responsive-small',
		label: 'Responsive Small'
	});

    // Heading Styles.
    wp.blocks.registerBlockStyle( 'core/heading', {
		name: 'dotted',
		label: 'With Yellow Dot'
	});
});
