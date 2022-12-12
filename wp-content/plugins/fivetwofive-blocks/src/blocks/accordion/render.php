<?php
/**
 * All the parameters passed to the function where this file is being required are accessible in this scope:
 *
 * @param array    $attributes     The array of attributes for this block.
 * @param string   $content        Rendered block output. ie. <InnerBlocks.Content />.
 * @param WP_Block $block_instance The instance of the WP_Block class that represents the block being rendered.
 *
 * @package gutenberg-examples
 */

// @link https://github.com/WordPress/gutenberg/issues/26384
$inner_blocks_html = '';
foreach ( $block->inner_blocks as $inner_block ) {
	$inner_blocks_html .= $inner_block->render();
}

?>
<div <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>>
	<?php echo wp_kses_post( $inner_blocks_html ); ?>
</div>
