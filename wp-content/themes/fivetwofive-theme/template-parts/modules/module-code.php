<?php
/**
 * Template part for displaying the code module of the modules template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

// Styles.
$background_image = get_sub_field( 'background_image' );
$background_color = get_sub_field( 'background_color' );
$styles           = '';

$module_classes   = '';

if ( get_sub_field( 'module_classes' ) ) {
	$module_classes = implode( ' ', explode( ',', get_sub_field( 'module_classes' ) ) );
}

if ( $background_color ) {
	$styles .= sprintf( 'background-color: %1$s;', $background_color );
}

if ( $background_image ) {
	$styles .= sprintf( 'background: url(\'%1$s\') center center no-repeat; background-size:cover;', esc_url_raw( wp_get_attachment_image_url( $background_image, 'full' ) ) );
}
?>
<div class="ftf-module module-code <?php echo esc_attr( $module_classes ); ?>" style="<?php echo esc_attr( $styles ); ?>">
	<?php echo get_sub_field( 'code' ); ?>
</div>
