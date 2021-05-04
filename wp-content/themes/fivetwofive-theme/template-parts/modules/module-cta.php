<?php
/**
 * Template part for displaying the CTA module of the modules template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

$show_logo        = get_sub_field( 'show_logo' );
$background_color = get_sub_field( 'background_color' );
$background_image = get_sub_field( 'background_image' );
$module_title     = get_sub_field( 'title' );
$module_subtitle  = get_sub_field( 'subtitle' );
$module_content   = get_sub_field( 'content' );
$module_button    = get_sub_field( 'button' );

if ( $background_image ) {
	$background = "url('" . wp_get_attachment_image_url( $background_image, 'large' ) . "') center center no-repeat";
} else {
	$background = $background_color;
}

?>
<section class="ftf-module module-cta" style="background:<?php echo esc_attr( $background ); ?>;background-size:cover;">
	<div class="container">
		<?php if ( $show_logo ) : ?>
			<?php the_custom_logo(); ?>
		<?php endif; ?>

		<?php if ( $module_title ) : ?>
			<h2 class="module__title"><?php echo esc_html( $module_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $module_subtitle ) : ?>
			<h2 class="module__subtitle"><?php echo esc_html( $module_subtitle ); ?></h2>
		<?php endif; ?>

		<?php if ( $module_content ) : ?>
			<div class="module__content"><?php echo wp_kses_post( $module_content ); ?></div>
		<?php endif; ?>

		<?php
		if ( $module_button ) :
			$link_url    = $module_button['url'];
			$link_title  = $module_button['title'];
			$link_target = $module_button['target'] ? $module_button['target'] : '_self';
			?>
			<a class="button module__button" role="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
		<?php endif; ?>
	</div>
</section>
