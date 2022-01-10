<?php
/**
 * The [fivetwofive_cta] shortcode content.
 *
 * @link       https://fivetwofive.com/
 * @since      1.0.0
 *
 * @package    FiveTwoFive
 * @subpackage FiveTwoFive/resources/views/public
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<section class="ftf-cta" style="<?php echo $cta_style; ?>">
	<div class="ftf-cta__inner">
		<div class="ftf-cta__column-1">

			<?php if ( ! empty( $cta_title ) ) : ?>
				<h2 class="fta-cta__title mb-2" style="<?php echo $cta_title_style; ?>"><?php echo esc_html( $cta_title ); ?></h2>
			<?php endif; ?>

			<div class="fta-cta__content" style="<?php echo $cta_message_style; ?>">
				<?php
				if ( ! empty( $cta_message ) ) :
					echo wp_kses_post( $cta_message );
				endif;
				?>
			</div><!-- end .cta-content -->

		</div><!-- end .cta-column-1 -->

		<?php if ( ! empty( $cta_button_text ) ) : ?>
			<div class="ftf-cta__column-2">
				<a class="ftf-cta__btn" style="<?php echo $cta_button_style; ?>" href="<?php echo esc_url( $cta_button_link ); ?>" target="<?php echo esc_attr( $cta_button_target ); ?>"><?php echo wp_kses_post( $cta_button_text ); ?></a>
			</div><!-- end .cta-column-2 -->
		<?php endif; ?>

	</div><!-- end .cta-download-inner -->
</section><!-- end .cta-download -->
