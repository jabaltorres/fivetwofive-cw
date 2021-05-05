<?php
/**
 * Template part for displaying the MultiColumn module of the modules template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

// Contents.
$module_title       = get_sub_field( 'title' );
$module_subtitle    = get_sub_field( 'sub_title' );
$module_description = get_sub_field( 'description' );
$module_button      = get_sub_field( 'button' );
$background_color   = get_sub_field( 'background_color' );
$column_count       = count( get_sub_field( 'columns' ) );

// Styles.
$background_image        = get_sub_field( 'background_image' );
$background_color        = get_sub_field( 'background_color' );
$text_color              = get_sub_field( 'text_color' );
$button_text_color       = get_sub_field( 'button_text_color' );
$button_background_color = get_sub_field( 'button_background_color' );
$button_border_color     = get_sub_field( 'button_border_color' );

switch ( $column_count ) {
	case '1':
		$column_width = '12';
		break;
	case '2':
		$column_width = '6';
		break;
	case '3':
		$column_width = '4';
		break;
	case '4':
		$column_width = '3';
		break;
	default:
		$column_width = '0';
}

$styles                  = '';
$text_color_inline_style = '';
$button_styles           = '';

if ( $background_color ) {
	$styles .= sprintf( 'background-color: %1$s;', $background_color );
}

if ( $background_image ) {
	$styles .= sprintf( 'background: url(\'%1$s\') center center no-repeat; background-size:cover;', esc_url_raw( wp_get_attachment_image_url( $background_image, 'full' ) ) );
}

if ( $text_color ) {
	$styles                 .= sprintf( 'color:%1$s;', $text_color );
	$text_color_inline_style = sprintf( 'color:%1$s;', $text_color );
}

if ( $button_text_color ) {
	$button_styles .= sprintf( 'color:%1$s;', $button_text_color );
}

if ( $button_background_color ) {
	$button_styles .= sprintf( 'background-color:%1$s;', $button_background_color );
}

if ( $button_border_color ) {
	$button_styles .= sprintf( 'border-color:%1$s;', $button_border_color );
}

?>
<section class="ftf-module module-multi-column py-5 py-md-6" style="<?php echo esc_attr( $styles ); ?>">
	<div class="container">
		<header class="module__header text-md-center mb-md-6">
			<?php if ( $module_title ) : ?>
				<h2 class="module__title" style="<?php echo esc_attr( $text_color_inline_style ); ?>"><?php echo esc_html( $module_title ); ?></h2>
			<?php endif; ?>

			<?php if ( $module_subtitle ) : ?>
				<h3 class="module__subtitle" style="<?php echo esc_attr( $text_color_inline_style ); ?>"><?php echo esc_html( $module_subtitle ); ?></h3>
			<?php endif; ?>
		</header>

		<div class="row text-md-center">
			<?php
			while ( have_rows( 'columns' ) ) :
				the_row();
				$column_image  = get_sub_field( 'image' );
				$column_title  = get_sub_field( 'title' );
				$column_text   = get_sub_field( 'text' );
				$column_button = get_sub_field( 'button' );
				?>
				<div class="column col-12 col-md-<?php echo esc_attr( $column_width ); ?>">
					<?php
					if ( $column_image ) :
						echo wp_get_attachment_image( $column_image, array( 150 ), false, array( 'class' => 'column-image mb-3 mb-md-4' ) );
					endif;
					?>
					<?php if ( $column_title ) : ?>
						<h3 class="column-title mb-3 mb-md-4" style="<?php echo esc_attr( $text_color_inline_style ); ?>"><?php echo esc_html( $column_title ); ?></h3>
					<?php endif; ?>

					<?php if ( $column_text ) : ?>
						<div class="column-text mb-3 mb-md-4" style="<?php echo esc_attr( $text_color_inline_style ); ?>"><?php echo wp_kses_post( $column_text ); ?></div>
					<?php endif; ?>

					<?php
					if ( $column_button ) :
						$link_url    = $column_button['url'];
						$link_title  = $column_button['title'];
						$link_target = $column_button['target'] ? $column_button['target'] : '_self';
						?>
						<a class="button column-button" role="button" href="<?php echo esc_url( $link_url ); ?>" style="<?php echo esc_attr( $button_styles ? $button_styles : '' ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		</div>

		<?php
		if ( $module_button ) :
			$link_url    = $module_button['url'];
			$link_title  = $module_button['title'];
			$link_target = $module_button['target'] ? $module_button['target'] : '_self';
			?>
			<footer class="module__footer mt-3 mt-md-5 text-center">
				<a class="button module__button" style="<?php echo esc_attr( $button_styles ? $button_styles : '' ); ?>" role="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
			</footer>
		<?php endif; ?>
	</div>
</section>
