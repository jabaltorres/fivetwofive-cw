<?php
/**
 * Template part for displaying the MultiColumn module of the modules template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

$module_title     = get_sub_field( 'title' );
$module_subtitle  = get_sub_field( 'sub_title' );
$module_button    = get_sub_field( 'button' );
$background_color = get_sub_field( 'background_color' );
$color            = get_sub_field( 'text_color' );
$column_count     = count( get_sub_field( 'columns' ) );

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

$button = get_sub_field( 'button' );

?>
<section class="ftf-module module-multi-column py-5 py-md-6" style="background-color:<?php echo esc_attr( $background_color ); ?>;">
	<div class="container">
		<header class="module__header text-md-center mb-md-6">
			<?php if ( $module_title ) : ?>
				<h2 class="module__title" style="color:<?php echo esc_attr( $color ); ?>"><?php echo esc_html( $module_title ); ?></h2>
			<?php endif; ?>

			<?php if ( $module_subtitle ) : ?>
				<h3 class="module__subtitle" style="color:<?php echo esc_attr( $color ); ?>"><?php echo esc_html( $module_subtitle ); ?></h3>
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
						echo wp_get_attachment_image( $column_image, 'thumbnail', false, array( 'class' => 'column-image mb-3 mb-md-4' ) );
					endif;
					?>
					<?php if ( $column_title ) : ?>
						<h3 class="column-title mb-3 mb-md-4" style="color:<?php echo esc_attr( $color ); ?>"><?php echo esc_html( $column_title ); ?></h3>
					<?php endif; ?>

					<?php if ( $column_text ) : ?>
						<div class="column-text mb-3 mb-md-4" style="color:<?php echo esc_attr( $color ); ?>"><?php echo wp_kses_post( $column_text ); ?></div>
					<?php endif; ?>

					<?php
					if ( $column_button ) :
						$link_url    = $column_button['url'];
						$link_title  = $column_button['title'];
						$link_target = $column_button['target'] ? $column_button['target'] : '_self';
						?>
						<a class="button column-button" role="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
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
			<a class="button module__button" role="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
		<?php endif; ?>
	</div>
</section>
