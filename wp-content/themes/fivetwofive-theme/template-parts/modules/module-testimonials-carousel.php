<?php
/**
 * Template part for displaying the Testimonials Carousel module of the modules template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

// Contents.
$module_title       = get_sub_field( 'title' );
$module_subtitle    = get_sub_field( 'subtitle' );
$module_description = get_sub_field( 'description' );

// Styles.
$background_image = get_sub_field( 'background_image' );
$background_color = get_sub_field( 'background_color' );
$text_color       = get_sub_field( 'text_color' );
$module_classes   = '';

if ( get_sub_field( 'module_classes' ) ) {
	$module_classes = implode( ' ', explode( ',', get_sub_field( 'module_classes' ) ) );
}

$styles                  = '';
$text_color_inline_style = '';

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

?>
<section class="ftf-module ftf-module-testimonials-carousel py-5 py-md-6 <?php echo esc_attr( $module_classes ); ?>" style="<?php echo esc_attr( $styles ); ?>">
	<div class="container">
		<?php if ( $module_title || $module_subtitle ) : ?>
			<header class="ftf-module__header text-md-center mb-md-6">
				<?php if ( $module_title ) : ?>
					<h2 class="ftf-module__title" style="<?php echo esc_attr( $text_color_inline_style ); ?>"><?php echo esc_html( $module_title ); ?></h2>
				<?php endif; ?>

				<?php if ( $module_subtitle ) : ?>
					<p class="ftf-module__subtitle" style="<?php echo esc_attr( $text_color_inline_style ); ?>"><?php echo esc_html( $module_subtitle ); ?></p>
				<?php endif; ?>

				<?php if ( $module_description ) : ?>
					<div class="ftf-module__description" style="<?php echo esc_attr( $text_color_inline_style ); ?>"><?php echo wp_kses_post( $module_description ); ?></div>
				<?php endif; ?>
			</header>
		<?php endif; ?>

		<div class="swiper-container">
			<div class="swiper-wrapper">
			<?php
			while ( have_rows( 'testimonials' ) ) :
				the_row();
				$author             = get_sub_field( 'author' );
				$author_job         = get_sub_field( 'author_job' );
				$author_avatar      = get_sub_field( 'author_avatar' );
				$message            = get_sub_field( 'message' );
				$testimonial_author = '';

				if ( $author ) {
					$testimonial_author .= $author;
				}

				if ( $author_job ) {
					$testimonial_author .= ', ' . $author_job;
				}
				?>
				<div class="swiper-slide">
					<div class="swiper-slide-content px-5 pt-3 pb-4 py-md-3 px-md-6">
						<div class="row align-items-center">
							<?php if ( $author_avatar ) : ?>
								<div class="col-12 col-md-2 mb-4 mb-md-0">
									<?php echo wp_get_attachment_image( $author_avatar, 'thumbnail', false, array( 'class' => 'testimonial__avatar mx-auto' ) ); ?>
								</div>
							<?php endif; ?>

							<div class="col-12 col-md-10">
								<?php if ( $message ) : ?>
									<div class="testimonial__message"><?php echo wp_kses_post( $message ); ?></div>
								<?php endif; ?>

								<?php if ( $author ) : ?>
									<h3 class="testimonial__author"><?php echo esc_html( $testimonial_author ); ?></h3>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
			</div><!-- .swiper-wrapper -->

			<!-- If we need pagination -->
			<div class="swiper-pagination"></div>

			<!-- If we need navigation buttons -->
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
	</div>
</section>
