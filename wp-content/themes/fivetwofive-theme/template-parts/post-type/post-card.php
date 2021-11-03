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
$image_size   = 'post-thumbnail';

if ( array_key_exists( 'image_size', $args ) ) {
	$image_size = $args['image_size'];
}

?>

<article id="card-<?php echo esc_attr( $post_item_id ); ?>" <?php post_class( 'card', $post_item_id ); ?>>
	<div class="card__top">
		<a class="card__image-link" href="<?php echo esc_url( get_the_permalink( $post_item_id ) ); ?>">
			<?php
			echo get_the_post_thumbnail(
				$post_item_id,
				$image_size,
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
		</a>
	</div>

	<div class="card__bottom">
		<header class="card__header m-0">
			<?php fivetwofive_theme_post_meta( $post_item_id ); ?>
			<h3 class="card__title mt-2"><a href="<?php echo esc_url( get_permalink( $post_item_id ) ); ?>"><?php echo esc_html( get_the_title( $post_item_id ) ); ?></a></h3>
		</header><!-- .card-header -->

		<?php if ( has_excerpt( $post_item_id ) ) : ?>
			<div class="card__content mt-2">
				<?php echo wp_kses_post( get_the_excerpt( $post_item_id ) ); ?>
			</div>
		<?php endif; ?>

		<footer class="card__footer mt-4">
			<a class="button card__button" href="<?php echo esc_url( get_the_permalink( $post_item_id ) ); ?>" aria-hidden="true" tabindex="-1"><?php echo esc_html__( 'Read More', 'fivetwofive-theme' ); ?></a>
		</footer>
	</div>
</article><!-- #card-<?php echo esc_html( $post_item_id ); ?> -->
