<?php

$event_subtitle    = get_field( 'ftf_event_subtitle' );
$event_description = get_field( 'ftf_event_description' );
$event_form        = get_field( 'ftf_event_form' );
$event_type        = get_field( 'ftf_event_type' );
$event_start_date  = get_field( 'ftf_event_start_date' );
$event_end_date    = get_field( 'ftf_event_end_date' );
$event_start_time  = get_field( 'ftf_event_start_time' );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-3 mb-md-5' ); ?>>
	<header class="entry-header text-center bg-secondary py-md-6 mb-md-3 mb-md-5">
		<div class="container">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<?php fivetwofive_theme_post_thumbnail(); ?>
					<?php if ( $event_subtitle ) : ?>
						<h2 class="event__subtitle mt-3"><?php echo wp_kses_post( $event_subtitle ); ?></h2>
					<?php endif; ?>

					<dl class="event__meta-list">
						<div>
							<dt>Type:</dt>
							<dd><?php echo esc_html( $event_type ); ?></dd>
						</div>
						<div>
							<dt>Date:</dt>
							<dd><?php echo esc_html( $event_start_date ); ?> - <?php echo esc_html( $event_end_date ); ?></dd>
						</div>

						<?php if ( $event_start_time ) : ?>
							<div>
								<dt>When:</dt>
								<dd><?php echo esc_html( $event_start_time ); ?></dd>
							</div>
						<?php endif; ?>

						<?php
						if ( have_rows( 'ftf_event_details' ) ) :
							while ( have_rows( 'ftf_event_details' ) ) :
								the_row();
								?>
								<div>
									<dt><?php the_sub_field( 'label' ); ?>:</dt>
									<dd><?php the_sub_field( 'value' ); ?></dd>
								</div>
							<?php
							endwhile;
						endif;
						?>
					</dl>

					<?php if ( $event_description ) : ?>
						<div class="event__description">
							<?php echo wp_kses_post( $event_description ); ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="col-md-5 event-form-col">
					<?php
					if ( $event_form ) :
						echo do_shortcode( wp_kses( $event_form, fivetwofive_kses_extended_ruleset() ) );
					endif;
					?>
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
