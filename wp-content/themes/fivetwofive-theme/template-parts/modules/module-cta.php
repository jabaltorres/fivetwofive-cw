<?php
/**
 * Template part for displaying the CTA module of the modules template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

$show_logo         = get_sub_field( 'show_logo' );
$background_color  = get_sub_field( 'background_color' );
$background_image  = get_sub_field( 'background_image' );
$module_title      = get_sub_field( 'title' );
$module_subtitle   = get_sub_field( 'subtitle' );
$module_content    = get_sub_field( 'content' );
$module_button     = get_sub_field( 'button' );
$module_text_color = '';
$module_classes    = '';

if ( get_sub_field( 'module_classes' ) ) {
	$module_classes = implode( ' ', explode( ',', get_sub_field( 'module_classes' ) ) );
}

if ( $background_image ) {
	$background = "url('" . wp_get_attachment_image_url( $background_image, 'large' ) . "') center center no-repeat";
} else {
	$background = $background_color;
}

if ( get_sub_field( 'text_color' ) ) {
	$module_text_color = 'color:' . get_sub_field( 'text_color' );
}

?>
<section class="ftf-module ftf-module-cta py-5 py-md-6 <?php echo esc_attr( $module_classes ); ?>" style="background:<?php echo esc_attr( $background ); ?>;background-size:cover;<?php echo esc_attr( $module_text_color ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-10 offset-md-1">
				<?php if ( $show_logo ) : ?>
					<div class="ftf-module-cta__logo mb-3 mb-md-4">
						<?php the_custom_logo(); ?>
					</div>
				<?php endif; ?>

				<?php if ( $module_title ) : ?>
					<h2 class="ftf-module__title my-0" style="<?php echo esc_attr( $module_text_color ); ?>"><?php echo esc_html( $module_title ); ?></h2>
				<?php endif; ?>

				<?php if ( $module_subtitle ) : ?>
					<h3 class="ftf-module__subtitle mt-3 mt-md-4 mb-0" style="<?php echo esc_attr( $module_text_color ); ?>"><?php echo esc_html( $module_subtitle ); ?></h3>
				<?php endif; ?>

				<?php if ( $module_content ) : ?>
					<div class="ftf-module__content mt-3 mt-md-4"><?php echo wp_kses_post( $module_content ); ?></div>
				<?php endif; ?>

				<?php
				if ( $module_button ) :
					$link_url    = $module_button['url'];
					$link_title  = $module_button['title'];
					$link_target = $module_button['target'] ? $module_button['target'] : '_self';
					?>
					<a class="button module__button mt-3 mt-md-4" role="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
