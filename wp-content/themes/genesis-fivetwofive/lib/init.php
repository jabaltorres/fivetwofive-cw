<?php
/**
 * Genesis Framework Override.
 *
 * @package Genesis FiveTwoFive\Override
 * @author  Danilo Parra Jr.
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

$lib_dir = trailingslashit( CHILD_DIR ) . 'lib/';

// Load Structure.
$structure_dir = $lib_dir . 'structure/';
require_once $structure_dir . 'footer.php';
