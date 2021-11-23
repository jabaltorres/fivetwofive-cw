<?php
/**
 * Template part for displaying single resource related resouces.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

global $post;

if ( ! array_key_exists( 'resource_id', $args ) && ! isset( $args['resource_id'] ) ) {
	return;
}

if ( ! is_array( $args['resource_categories'] ) && ! isset( $args['resource_categories'] ) ) {
	return;
}

$resource_id         = $args['resource_id'];
$resource_categories = $args['resource_categories'];

$resource_query_args = array(
	'post_type'      => 'ftf_resource',
	'exclude'        => array( $resource_id ),
	'posts_per_page' => 3,
	'tax_query'      => array(
		array(
			'taxonomy' => 'ftf_resource_category',
			'terms'    => $resource_categories,
		),
	),
);

$resource_query = get_posts( $resource_query_args );

?>

<?php if ( $resource_query ) : ?>
	<section class="ftf-resource-related py-4 py-sm-6">		
		<div class="container">
			<h2 class="ftf-resource-related__title mb-5 text-center"><?php echo esc_html__( 'Related Resources', 'fivetwofive-theme' ); ?></h2>
			<div class="row">
				<?php
				foreach ( $resource_query as $post ) :
					setup_postdata( $post );
					?>
					<div class="col-sm-4 mb-3 mb-sm-0">
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
				endforeach;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
<?php endif; ?>
