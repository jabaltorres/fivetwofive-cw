<?php
/**
 * Template part for displaying single resource categories.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

?>

<p class="ftf-resource__categories"><?php echo get_the_term_list( get_the_ID(), 'ftf_resource_category', '<strong>Categories:</strong> ', ', ' ); ?></p>

<p class="ftf-resource__tags"><?php echo get_the_term_list( get_the_ID(), 'ftf_resource_tag', '<strong>Tags:</strong> ', ', ' ); ?></p>
