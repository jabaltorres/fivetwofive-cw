<?php
/**
 * Template part for displaying a post item with image left or right option through args.
 * This template expects a container class as parent.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

if ( ! $args['id'] ) {
	return;
}

$post_item_id = $args['id'];

?>

<article id="card-<?php esc_attr( $post_item_id ); ?>" <?php post_class( 'card', $post_item_id ); ?>>
	<div class="card__image-wrap mb-4">
		<a class="card__image-link" href="<?php echo esc_url( get_the_permalink( $post_item_id ) ); ?>" aria-hidden="true" tabindex="-1">
			<?php
			echo get_the_post_thumbnail(
				$post_item_id,
				'large',
				array(
					'alt' => the_title_attribute(
						array(
							'echo' => false,
							'post' => $post_item_id,
						)
					),
					'class' => 'card__image img-responsive',
				)
			);
			?>
			<div class="card__image-overlay">
				<button class="button card__image-link" aria-hidden="true" tabindex="-1"><?php echo esc_html__( 'Read More', 'fivetwofive-theme' ); ?></button>
			</div>
		</a>
	</div>
	<header class="card__header">
		<h3 class="card__title"><a href="<?php echo esc_url( get_permalink( $post_item_id ) ); ?>"><?php echo esc_html( get_the_title( $post_item_id ) ); ?></a></h3>
		<?php fivetwofive_theme_post_meta( $post_item_id ); ?>
	</header><!-- .card-header -->
	<div class="card__content">
		<?php echo wp_kses_post( get_the_excerpt( $post_item_id ) ); ?>
	</div>
</article><!-- #card-<?php echo esc_html( $post_item_id ); ?> -->
