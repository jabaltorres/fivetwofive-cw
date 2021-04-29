<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FiveTwoFive
 */

namespace Fivetwofive\FivetwofiveTheme;

if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'primary-sidebar' ); ?>
</aside><!-- #secondary -->
