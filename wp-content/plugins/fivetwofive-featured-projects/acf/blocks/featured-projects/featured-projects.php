<?php
/**
 * Featured Projects Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

global $post;

// Create id attribute allowing for custom "anchor" value.
$id = 'ftf-featured-projects-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ftf-featured-projects';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}

if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$number_of_projects = get_field( 'number_of_projects_to_show' ) ?: 2;

$featured_projects = get_posts(
	array(
		'numberposts' => $number_of_projects,
		'post_type'   => 'featured-projects',
		'meta_query'	 => array(
			array(
				'key'	  	=> 'project_is_featured',
				'value'	  	=> '1',
				'compare' 	=> '=',
			),
		),
	)
);
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<?php
	if ( $featured_projects ) :
        foreach ( $featured_projects as $post ) :
			setup_postdata( $post );
			?>

            <article class="ftf-featured-project ftf-featured-project-<?php echo esc_attr( get_the_ID() ); ?>">
				<div class="ftf-featured-project__col ftf-featured-project__col-image">
					<a class="ftf-featured-project__image-link" href="<?php the_permalink(); ?>">
						<?php echo the_post_thumbnail( 'fivetwofive-featured-project', array( 'class' => 'ftf-featured-project__image', 'alt' => get_the_title() ) ); ?>
					</a>
				</div>
				<div class="ftf-featured-project__col ftf-featured-project__col-text">
					<header class="ftf-featured-project__header">
						<p class="ftf-featured-project__categories">
							<?php
								$taxonomy = 'category';

								// Get the term IDs assigned to post.
								$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );

								// Separator between links.
								$separator = ', ';

								if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {

									$term_ids = implode( ',' , $post_terms );

									$terms = wp_list_categories( array(
										'title_li' => '',
										'style'    => 'none',
										'echo'     => false,
										'taxonomy' => $taxonomy,
										'include'  => $term_ids
									) );

									$terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );

									// Display post categories.
									echo  $terms;
								}
							?> 
						</p>
						<?php the_title( '<h3 class="ftf-featured-project__title"><a class="ftf-featured-project__title-link" href="' . esc_url( get_the_permalink() ) . '">', '</h3>' ); ?></a>
					</header>
					<div class="ftf-featured-project__excerpt">
						<?php the_excerpt(); ?>
					</div>
					<footer class="ftf-featured-project__footer">
						<a class="ftf-featured-project__link" href="<?php echo esc_url( get_the_permalink() ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" class="fivetwofive-icon" viewBox="0 0 30 30"><g transform="translate(3 3)"><circle cx="15" cy="15" r="15" transform="translate(-3 -3)" fill="#facc0a"/><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6z" fill="#1a2238"/></g></svg>
							<?php _e( 'View project', 'fivetwofive-featured-projects' ); ?>
						</a>
					</footer>
				</div>
			</article>

			<?php
		endforeach;
		wp_reset_postdata();
    endif;
	?>
</section>
