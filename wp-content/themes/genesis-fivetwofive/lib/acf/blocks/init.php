<?php
/**
 * ACF Blocks
 *
 * @package Genesis FiveTwoFive
 * @author  Danilo Parra Jr.
 * @license GPL-2.0-or-later
 * @link    https://daniloparrajr.com/
 */

add_action('acf/init', 'genesis_fivetwofive_register_acf_blocks');
/**
 * Register ACF blocks.
 *
 * @return void
 */
function genesis_fivetwofive_register_acf_blocks() {

    // Check function exists.
    if ( function_exists('acf_register_block_type') ) {

    }
}
