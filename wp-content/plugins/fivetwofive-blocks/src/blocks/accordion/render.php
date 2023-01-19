<?php
/**
 * All the parameters passed to the function where this file is being required are accessible in this scope:
 *
 * @param array $attributes The array of attributes for this block.
 * @param string $content Rendered block output. ie. <InnerBlocks.Content />.
 * @param WP_Block $block The instance of the WP_Block class that represents the block being rendered.
 *
 * @package gutenberg-examples
 */

wp_enqueue_style( 'fivetwofive-blocks/accordion', );

$block_name = sprintf( 'wp-block-%1$s', str_replace( '/', '-', $block->name ) );

$block_style   = [];
$block_classes = [];

// @link https://github.com/WordPress/gutenberg/issues/26384
$inner_blocks_html = '';
foreach ( $block->inner_blocks as $inner_block ) {
	$inner_blocks_html .= $inner_block->render();
}

if ( isset( $attributes['panelIconStyle'] ) && ! empty( $attributes['panelIconStyle'] ) ) {
	$panel_icon        = '';
	$panel_active_icon = '';

	switch ( $attributes['panelIconStyle'] ) {
		case 'ftfb_accordion_icon_chevron_circle':
			$panel_icon        = "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath d='M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256 256-114.6 256-256S397.4 0 256 0zM135 241c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l87 87 87-87c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L273 345c-9.4 9.4-24.6 9.4-33.9 0L135 241z'/%3E%3C/svg%3E\")";
			$panel_active_icon = "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath d='M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256 256-114.6 256-256S397.4 0 256 0zM135 241c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l87 87 87-87c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L273 345c-9.4 9.4-24.6 9.4-33.9 0L135 241z'/%3E%3C/svg%3E\")";
			break;
		case 'ftfb_accordion_icon_plus_minus':
			$panel_icon        = "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'%3E%3Cpath d='M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32v144H48c-17.7 0-32 14.3-32 32s14.3 32 32 32h144v144c0 17.7 14.3 32 32 32s32-14.3 32-32V288h144c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z'/%3E%3C/svg%3E\")";
			$panel_active_icon = "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'%3E%3Cpath d='M432 256c0 17.7-14.3 32-32 32H48c-17.7 0-32-14.3-32-32s14.3-32 32-32h352c17.7 0 32 14.3 32 32z'/%3E%3C/svg%3E\");";
			break;
		case 'ftfb_accordion_icon_plus_minus_circle':
			$panel_icon        = "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath d='M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0 0 114.6 0 256s114.6 256 256 256zm-24-168v-64h-64c-13.3 0-24-10.7-24-24s10.7-24 24-24h64v-64c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24h-64v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z'/%3E%3C/svg%3E\")";
			$panel_active_icon = "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath d='M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0 0 114.6 0 256s114.6 256 256 256zm-72-280h144c13.3 0 24 10.7 24 24s-10.7 24-24 24H184c-13.3 0-24-10.7-24-24s10.7-24 24-24z'/%3E%3C/svg%3E\")";
			break;
		default:
			$panel_icon        = "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath d='M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z'/%3E%3C/svg%3E\")";
			$panel_active_icon = "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath d='M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z'/%3E%3C/svg%3E\")";
	}

	$block_style[] = sprintf( '--ftfb-accordion-btn-icon: %1$s', $panel_icon );
	$block_style[] = sprintf( '--ftfb-accordion-btn-active-icon: %1$s', $panel_active_icon );
}

if ( isset( $attributes['panelHeadingColor'] ) && $attributes['panelHeadingColor'] ) {
	$block_style[] = sprintf( '--ftfb-accordion-btn-color: %1$s', $attributes['panelHeadingColor'] );
}

if ( isset( $attributes['panelHeadingBackgroundColor'] ) && $attributes['panelHeadingBackgroundColor'] ) {
	$block_style[] = sprintf( '--ftfb-accordion-btn-bg: %1$s', $attributes['panelHeadingBackgroundColor'] );
}

if ( isset( $attributes['panelHeadingBorderColor'] ) && $attributes['panelHeadingBorderColor'] ) {
	$block_style[] = sprintf( '--ftfb-accordion-border-color: %1$s', $attributes['panelHeadingBorderColor'] );
}

if ( isset( $attributes['panelHeadingBorderRadius'] ) && $attributes['panelHeadingBorderRadius'] ) {
	$block_style[] = sprintf( '--ftfb-accordion-border-radius: %1$spx', $attributes['panelHeadingBorderRadius'] );
}

if ( isset( $attributes['panelActiveHeadingColor'] ) && $attributes['panelActiveHeadingColor'] ) {
	$block_style[] = sprintf( '--ftfb-accordion-active-color: %1$s', $attributes['panelActiveHeadingColor'] );
}

if ( isset( $attributes['panelActiveHeadingBackgroundColor'] ) && $attributes['panelActiveHeadingBackgroundColor'] ) {
	$block_style[] = sprintf( '--ftfb-accordion-active-bg: %1$s', $attributes['panelActiveHeadingBackgroundColor'] );
}

if ( isset( $attributes['panelActiveHeadingBorderColor'] ) && $attributes['panelActiveHeadingBorderColor'] ) {
	$block_style[] = sprintf( '--ftfb-accordion-border-active-color: %1$s', $attributes['panelActiveHeadingBorderColor'] );
}

if ( isset( $attributes['panelContentColor'] ) && $attributes['panelContentColor'] ) {
	$block_style[] = sprintf( '--ftfb-accordion-content-color: %1$s', $attributes['panelContentColor'] );
}

if ( isset( $attributes['panelContentBackgroundColor'] ) && $attributes['panelContentBackgroundColor'] ) {
	$block_style[] = sprintf( '--ftfb-accordion-content-bg: %1$s', $attributes['panelContentBackgroundColor'] );
}

$block_style[] = sprintf( 'text-align: %1$s', $attributes['textAlignment'] );

if ( isset( $attributes['panelIconDisplay'] ) && $attributes['panelIconDisplay'] ) {
	$block_classes[] = $block_name . '--icon-display-show';
} else {
	$block_classes[] = $block_name . '--icon-display-hidden';
}

if ( isset( $attributes['panelIconPosition'] ) && $attributes['panelIconPosition'] ) {
	$block_classes[] = $block_name . '--icon-position-' . $attributes['panelIconPosition'];
}

$block_wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => implode( ' ', $block_classes ),
		'style' => implode( ';', $block_style ),
	)
);

?>
<div <?php echo wp_kses_data( $block_wrapper_attributes ); ?>>
	<?php echo wp_kses_post( $inner_blocks_html ); ?>
</div>
