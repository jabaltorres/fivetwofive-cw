<?php
/**
 * Template part for displaying the Gallery module of the modules template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

$module_title          = get_sub_field( 'title' );
$module_subtitle       = get_sub_field( 'subtitle' );
$module_description    = get_sub_field( 'description' );
$module_images         = get_sub_field( 'images' );
$background_color      = get_sub_field( 'background_color' );
$background_image      = get_sub_field( 'background_image' );
$module_text_color     = get_sub_field( 'text_color' );
$module_text_alignment = get_sub_field( 'text_alignment' );
$module_column_count   = get_sub_field( 'column_count' );
$module_classes        = '';
$module_styles         = '';
$inline_text_color     = '';
$module_id             = uniqid( 'ftf-module', true );

if ( get_sub_field( 'module_classes' ) ) {
	$module_classes = implode( ' ', explode( ',', get_sub_field( 'module_classes' ) ) );
}

if ( $module_column_count ) {
	$module_column_count = sprintf( 'col-md-%1$s', $module_column_count );
} else {
	$module_column_count = 'col-md-12';
}

if ( $background_color ) {
	$module_styles .= sprintf( 'background-color:%1$s;', $background_color );
}

if ( $background_image ) {
	$module_styles .= sprintf( 'background: url(\'%1$s\') center center no-repeat; background-size:cover;', esc_url( wp_get_attachment_image_url( $background_image, 'full' ) ) );
}

if ( $module_text_color ) {
	$module_styles    .= sprintf( 'color:%1$s;', $module_text_color );
	$inline_text_color = sprintf( 'color:%1$s;', $module_text_color );
}

if ( $module_text_alignment ) {
	$module_styles .= sprintf( 'text-align:%1$s;', $module_text_alignment );
}

?>
<section class="ftf-module ftf-module-gallery py-5 py-md-6 <?php echo esc_attr( $module_classes ); ?>" style="<?php echo esc_attr( $module_styles ); ?>">
	<div class="container">
		<?php if ( $module_title || $module_subtitle || $module_description ) : ?>
			<header class="ftf-module__header mb-md-5">
				<?php if ( $module_title ) : ?>
					<h2 class="ftf-module__title" style="<?php echo esc_attr( $inline_text_color ); ?>"><?php echo esc_html( $module_title ); ?></h2>
				<?php endif; ?>

				<?php if ( $module_subtitle ) : ?>
					<p class="ftf-module__subtitle"><?php echo esc_html( $module_subtitle ); ?></p>
				<?php endif; ?>

				<?php if ( $module_description ) : ?>
					<div class="ftf-module_description"><?php echo wp_kses_post( $module_description ); ?></div>
				<?php endif; ?>
			</header>
		<?php endif; ?>
		<?php if ( $module_images ) : ?>
			<div class="row ftf-module-gallery__gallery">
				<?php foreach ( $module_images as $image_id ) : ?>
					<div class="col-12 <?php echo esc_attr( $module_column_count ); ?> ftf-module-gallery__column">
						<a class="ftf-module-gallery__item" href="<?php echo esc_url( wp_get_attachment_image_url( $image_id, 'full' ) ); ?>" data-fancybox="<?php echo esc_attr( $module_id ); ?>">
							<?php echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'ftf-module-gallery__item-image' ) ); ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
