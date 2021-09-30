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
$background_color      = get_sub_field( 'background_color' );
$background_image      = get_sub_field( 'background_image' );
$module_text_color     = get_sub_field( 'text_color' );
$module_text_alignment = get_sub_field( 'text_alignment' );
$module_classes        = '';
$module_styles         = '';
$inline_text_color     = '';
$module_id             = uniqid( 'ftf-module-accordion' );
$module_works          = get_sub_field( 'works' );
$module_display        = get_sub_field( 'display' );

// Animations.
$module_animation_desktop  = get_sub_field( 'animation_desktop' );
$module_animation_mobile   = get_sub_field( 'animation_mobile' );
$module_animation_reset    = get_sub_field( 'animation_reset' );
$module_animation_delay    = get_sub_field( 'animation_delay' );
$module_animation_distance = get_sub_field( 'animation_distance' );
$module_animation_duration = get_sub_field( 'animation_duration' );
$module_animation_opacity  = get_sub_field( 'animation_opacity' );
$module_animation_origin   = get_sub_field( 'animation_origin' );
$module_animation_scale    = get_sub_field( 'animation_scale' );

$module_animation_options = array(
	'reset'   => $module_animation_reset,
	'origin'  => $module_animation_origin,
	'desktop' => $module_animation_desktop,
	'mobile'  => $module_animation_mobile,
);

if ( $module_animation_delay ) {
	$module_animation_options['delay'] = $module_animation_delay;
}

if ( $module_animation_distance ) {
	$module_animation_options['distance'] = $module_animation_distance . 'px';
}

if ( $module_animation_duration ) {
	$module_animation_options['duration'] = (int) $module_animation_duration;
}

if ( $module_animation_opacity ) {
	$module_animation_options['opacity'] = (int) $module_animation_opacity;
}

if ( $module_animation_scale ) {
	$module_animation_options['scale'] = (int) $module_animation_scale;
}

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

if ( $module_animation_desktop || $module_animation_mobile ) {
	$module_classes .= ' ftf-module-hidden';
}

?>

<section id="<?php echo esc_attr( $module_id ); ?>" data-animation="<?php echo esc_attr( wp_json_encode( $module_animation_options ) ); ?>" class="ftf-module ftf-module-accordion py-5 py-md-6 <?php echo esc_attr( $module_classes ); ?>" style="<?php echo esc_attr( $module_styles ); ?>">
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

		<?php
		if ( $module_works && 'stacked-alternate' === $module_display ) :
			$work_counter = 0;
			foreach ( $module_works as $post ) :
				setup_postdata( $post );
				$work_counter++;
				?>

					<div class="row mb-4 align-items-center">
						<?php if ( 0 !== $work_counter % 2 ) : ?>

							<div class="col-12 col-md-7 has-img">
								<?php if ( has_post_thumbnail() ) : ?>
									<a class="has-hover" href="<?php echo esc_url_raw( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
										<img class="thumbnail" src="<?php echo esc_url_raw( get_the_post_thumbnail_url() ); ?>" alt="<?php echo esc_attr( get_the_post_thumbnail_caption() ); ?>" />
									</a>
								<?php endif; ?>
							</div>
							<div class="col-12 col-md-5 has-text">

								<h3 class="article-title"><a href="<?php echo esc_url_raw( get_permalink() ); ?>" style="<?php echo esc_attr( $inline_text_color ); ?>"><?php the_title(); ?></a></h3>

								<?php if ( has_excerpt() ) : ?>
									<div class="project-excerpt mb-4"><?php echo wp_kses_post( the_excerpt() ); ?></div>
								<?php endif; ?>

								<a class="button" href="<?php echo esc_url_raw( get_permalink() ); ?>"><?php echo esc_html__( 'Learn More', 'fivetwofive-featured-projects' ); ?></a>

							</div>

						<?php else : ?>

							<div class="col-12 col-md-7 has-image order-md-last">
								<?php if ( has_post_thumbnail() ) : ?>
									<a class="has-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<img class="thumbnail" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>" />
									</a>
								<?php endif; ?>
							</div>
							<div class="col-12 col-md-5 has-text order-md-first">

								<h3 class="article-title"><a href="<?php echo esc_url_raw( get_permalink() ); ?>" style="<?php echo esc_attr( $inline_text_color ); ?>"><?php the_title(); ?></a></h3>

								<?php if ( has_excerpt() ) : ?>
									<div class="project-excerpt mb-4"><?php echo wp_kses_post( the_excerpt() ); ?></div>
								<?php endif; ?>

								<a class="button" href="<?php echo esc_url_raw( get_permalink() ); ?>"><?php echo esc_html__( 'Learn More', 'fivetwofive-featured-projects' ); ?></a>

							</div>
						<?php endif; ?>
					</div>

				<?php
			endforeach;
			wp_reset_postdata();
		endif;
		?>

		<?php
		if ( $module_works && 'stacked' === $module_display ) :
			foreach ( $module_works as $post ) :
				setup_postdata( $post );
				?>

					<div class="row mb-4 align-items-center">
						<div class="col-12 col-md-7 has-image">
							<?php if ( has_post_thumbnail() ) : ?>
								<a class="has-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<img class="thumbnail" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>" />
								</a>
							<?php endif; ?>
						</div>
						<div class="col-12 col-md-5 has-text">

							<h3 class="article-title"><a href="<?php echo esc_url_raw( get_permalink() ); ?>" style="<?php echo esc_attr( $inline_text_color ); ?>"><?php the_title(); ?></a></h3>

							<?php if ( has_excerpt() ) : ?>
								<div class="project-excerpt mb-4"><?php echo wp_kses_post( the_excerpt() ); ?></div>
							<?php endif; ?>

							<a class="button" href="<?php echo esc_url_raw( get_permalink() ); ?>"><?php echo esc_html__( 'Learn More', 'fivetwofive-featured-projects' ); ?></a>

						</div>
					</div>

				<?php
			endforeach;
			wp_reset_postdata();
		endif;
		?>

		<?php if ( $module_works && 'grid' === $module_display ) : ?>
			<div class="row">
				<?php
				foreach ( $module_works as $post ) :
					setup_postdata( $post );
					?>

						<div class="col-md-4 mb-3 mb-md-5">
							<article id="card-<?php the_ID(); ?>" <?php post_class( 'card' ); ?>>
								<div class="card__image-wrap mb-4">
									<?php
										the_post_thumbnail(
											'large',
											array(
												'alt' => the_title_attribute(
													array(
														'echo' => false,
													)
												),
												'class' => 'card__image img-responsive',
											)
										);
									?>
									<div class="card__image-overlay">
										<a class="button card__image-link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">Read More</a>
									</div>
								</div>
								<header class="card__header">
									<?php the_title( sprintf( '<h2 class="card__title"><a href="%s" style="' . esc_attr( $inline_text_color ) . '" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								</header><!-- .card-header -->
								<div class="card__content">
									<?php the_excerpt(); ?>
								</div>
							</article><!-- #card-<?php the_ID(); ?> -->
						</div>

					<?php
				endforeach;
				wp_reset_postdata();
				?>
			</div>
		<?php endif; ?>

	</div>
</section>
