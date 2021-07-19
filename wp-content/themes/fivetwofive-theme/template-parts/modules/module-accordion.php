<?php
/**
 * Template part for displaying the Gallery module of the modules template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

wp_enqueue_script( 'fivetwofive-theme-module-accordion' );

$module_title          = get_sub_field( 'title' );
$module_subtitle       = get_sub_field( 'subtitle' );
$module_description    = get_sub_field( 'description' );
$module_panels         = get_sub_field( 'panels' );
$background_color      = get_sub_field( 'background_color' );
$background_image      = get_sub_field( 'background_image' );
$module_text_color     = get_sub_field( 'text_color' );
$module_text_alignment = get_sub_field( 'text_alignment' );
$module_classes        = '';
$module_styles         = '';
$inline_text_color     = '';
$module_id             = uniqid( 'ftf-module', true );

if ( get_sub_field( 'module_classes' ) ) {
	$module_classes = implode( ' ', explode( ',', get_sub_field( 'module_classes' ) ) );
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
	$module_classes .= sprintf( ' text-md-%1$s', $module_text_alignment );
}

?>
<section class="ftf-module ftf-module-accordion py-5 py-md-6 <?php echo esc_attr( $module_classes ); ?>" style="<?php echo esc_attr( $module_styles ); ?>">
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
					<div class="ftf-module_description"><?php echo wp_kses( $module_description, fivetwofive_kses_extended_ruleset() ); ?></div>
				<?php endif; ?>
			</header>
		<?php endif; ?>

		<?php if ( $module_panels ) : ?>
			<div class="ftf-module-accordion__panels">
				<?php
				foreach ( $module_panels as $module_panel ) :
					$panel_title   = $module_panel['title'];
					$panel_content = $module_panel['content'];
					?>
					<div class="ftf-module-accordion__panel">
						<?php if ( $panel_title ) : ?>
							<h3 class="ftf-module-accordion__panel-title" style="<?php echo esc_attr( $inline_text_color ); ?>"><?php echo wp_kses( $panel_title, fivetwofive_kses_extended_ruleset() ); ?></h3>
						<?php endif; ?>

						<?php if ( $panel_content ) : ?>
							<div class="ftf-module-accordion__panel-content"><?php echo wp_kses( $panel_content, fivetwofive_kses_extended_ruleset() ); ?></div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
