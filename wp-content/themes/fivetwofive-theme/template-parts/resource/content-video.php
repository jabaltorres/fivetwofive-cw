<?php
/**
 * Template part for displaying single resource video type.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

$video = get_field( 'ftf_resource_video' );
?>

<?php if ( $video ) : ?>
	<div class="embed-container mb-3 mb-sm-5">
		<?php echo fivetwofive_get_acf_oembed_iframe( $video, array( 'controls' => 1 ) ); ?>
	</div>
<?php endif; ?>

<?php get_template_part( 'template-parts/resource/meta' ); ?>
