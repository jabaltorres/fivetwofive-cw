<?php
/**
 * Template part for displaying the Resouces module of the modules template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

wp_enqueue_script( 'fivetwofive-theme-module-resources' );

$module_title          = get_sub_field( 'title' );
$module_subtitle       = get_sub_field( 'subtitle' );
$module_description    = get_sub_field( 'description' );
$background_toggle     = get_sub_field( 'background_toggle' );
$background_color      = get_sub_field( 'background_color' );
$background_image      = get_sub_field( 'background_image' );
$module_text_color     = get_sub_field( 'text_color' );
$module_text_alignment = get_sub_field( 'text_alignment' );
$module_id             = uniqid( 'ftf-module-resources' );
$module_resources      = get_sub_field( 'resources' );
$module_resources_type = get_sub_field( 'resources_type' );
$module_item_per_page  = get_sub_field( 'item_per_page' );
$module_classes        = '';
$module_styles         = '';
$inline_text_color     = '';

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

if ( $background_toggle ) {
	if ( $background_image ) {
		$module_styles .= sprintf( 'background: url(\'%1$s\') center center no-repeat; background-size:cover;', esc_url( wp_get_attachment_image_url( $background_image, 'full' ) ) );
	}
} else {
	if ( $background_color ) {
		$module_styles .= sprintf( 'background-color:%1$s;', $background_color );
	}
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

$posts_per_page = 6;

if ( $module_item_per_page ) {
	$posts_per_page = intval( $module_item_per_page );
}

$resource_query_args = array(
	'post_type'      => 'ftf_resource',
	'posts_per_page' => $posts_per_page,
);

if ( $module_resources_type ) {
	$resource_query_args['tax_query'] = array(
		array(
			'taxonomy' => 'ftf_resource_type',
			'field'    => 'term_id',
			'terms'    => $module_resources_type,
		),
	);
}

$resources_query  = new WP_Query( $resource_query_args );
$resource_counter = 0;

?>

<section id="<?php echo esc_attr( $module_id ); ?>" data-item-per-page="<?php echo esc_attr( $posts_per_page ); ?>" data-current-page="1" data-animation="<?php echo esc_attr( wp_json_encode( $module_animation_options ) ); ?>" class="ftf-module ftf-module-resources <?php echo esc_attr( $module_classes ); ?>" style="<?php echo esc_attr( $module_styles ); ?>">
	<div class="container">
		<?php if ( $module_title || $module_subtitle || $module_description ) : ?>
			<header class="ftf-module__header mb-3 mb-md-5">

				<?php if ( $module_title ) : ?>
					<h2 class="ftf-module__title" style="<?php echo esc_attr( $inline_text_color ); ?>"><?php echo esc_html( $module_title ); ?></h2>
				<?php endif; ?>

				<?php if ( $module_subtitle ) : ?>
					<p class="ftf-module__subtitle h3"><?php echo esc_html( $module_subtitle ); ?></p>
				<?php endif; ?>

				<?php if ( $module_description ) : ?>
					<div class="ftf-module_description"><?php echo wp_kses( $module_description, fivetwofive_kses_extended_ruleset() ); ?></div>
				<?php endif; ?>

				<form class="ftf-form">

					<fieldset class="ftf-fieldset">
						<input type="search" class="ftf-input ftf-input--search" name="ftf-search-resource" placeholder="<?php echo esc_html__( 'Search resources', 'fivetwofive-theme' ); ?>" aria-label="<?php echo esc_html__( 'Search resources', 'fivetwofive-theme' ); ?>">
					</fieldset>

					<?php if ( ! $module_resources_type ) : ?>
						<fieldset class="ftf-fieldset">
							<?php
							wp_dropdown_categories(
								array(
									'show_option_all' => __( 'All Types', 'fivetwofive-theme' ),
									'orderby'         => 'name',
									'class'           => 'ftf-select',
									'name'            => 'ftf-type-resource',
									'value_field'     => 'term_id',
									'taxonomy'        => 'ftf_resource_type',
								)
							);
							?>
						</fieldset>
					<?php endif; ?>

					<fieldset class="ftf-fieldset">
						<input type="submit" class="ftf-button" value="<?php echo esc_html__( 'Search', 'fivetwofive-theme' ); ?>">
					</fieldset>

				</form>

			</header>
		<?php endif; ?>

		<?php if ( $resources_query->have_posts() ) : ?>

			<div class="row ftf-resources-wrap">

				<?php
				while ( $resources_query->have_posts() ) :
					$resources_query->the_post();
					?>

						<div class="col-md-4 mb-3 mb-md-5">
							<?php
								get_template_part(
									'template-parts/post-type/post-card',
									null,
									array(
										'id'         => get_the_ID(),
										'image_size' => 'ftf-resource-thumb',
									)
								);
							?>
						</div>

					<?php
				endwhile;
				wp_reset_postdata();
				?>

			</div>

			<div class="ftf-module__pagination-container"></div>

		<?php else : ?>

			<p><?php _e( 'Sorry, no resources matched your criteria.' ); ?></p>

		<?php endif; ?>
	</div>
</section>
