<?php
/**
 * Template part for displaying single resource related resouces.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

global $post;

if ( ! array_key_exists( 'event_id', $args ) && ! isset( $args['event_id'] ) ) {
	return;
}

if ( ! is_array( $args['event_type'] ) && ! isset( $args['event_type'] ) ) {
	return;
}

$event_id   = $args['event_id'];
$event_type = $args['event_type'];

$event_query_args = array(
	'numberposts' => 3,
	'post_type'   => 'ftf_event',
	'exclude'     => array( $event_id ),
	'meta_key'	  => 'ftf_event_type',
	'meta_value'  => $event_type,
);

$event_query = get_posts( $event_query_args );

?>

<?php if ( $event_query ) : ?>
	<section class="ftf-events-similar py-4 py-sm-6">
		<div class="container">
			<h2 class="ftf-events-similar__title mb-4 mb-md-5 text-center"><?php echo esc_html__( 'Similar Events', 'fivetwofive-theme' ); ?></h2>
			<div class="row">
				<?php
				foreach ( $event_query as $post ) :
					setup_postdata( $post );
					?>
					<div class="col-sm-4 mb-3 mb-sm-0">
						<?php get_template_part( 'template-parts/post-type/post-card', null, array( 'id' => get_the_ID() ) ); ?>
					</div>
					<?php
				endforeach;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
<?php endif; ?>
