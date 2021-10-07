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

$thumbnail_col_position_class = '';

if ( isset( $args['thumbnail-position'] ) && 'right' === $args['thumbnail-position'] ) {
	$thumbnail_col_position_class = 'order-md-last';
}

$post_item_id = $args['id'];

?>

<article class="ftf-post-item row mb-4 align-items-center">

	<?php if ( has_post_thumbnail( $post_item_id ) ) : ?>
		<div class="col-12 col-md-7 ftf-post-item__thumbnail-col <?php echo esc_attr( $thumbnail_col_position_class ); ?>">
			<a class="ftf-post-item__link" href="<?php echo esc_url( get_permalink( $post_item_id ) ); ?>" title="<?php echo esc_attr( get_the_title( $post_item_id ) ); ?>">
				<img class="ftf-post-item__thumbnail" src="<?php echo esc_url( get_the_post_thumbnail_url( $post_item_id ) ); ?>" alt="<?php echo esc_attr( get_the_post_thumbnail_caption( $post_item_id ) ); ?>" />
			</a>
		</div>
	<?php endif; ?>

	<div class="col-12 col-md-5 ftf-post-item__text-col">

		<h3 class="ftf-post-item__title"><a href="<?php echo esc_url_raw( get_permalink() ); ?>"><?php echo wp_kses_post( get_the_title( $post_item_id ) ); ?></a></h3>

		<?php fivetwofive_theme_post_meta( $post_item_id ); ?>

		<?php if ( has_excerpt( $post_item_id ) ) : ?>
			<div class="ftf-post-item__excerpt mb-4"><?php echo wp_kses_post( get_the_excerpt( $post_item_id ) ); ?></div>
		<?php endif; ?>

		<a class="button ftf-post-item__button" href="<?php echo esc_url( get_permalink( $post_item_id ) ); ?>"><?php echo esc_html__( 'Learn More', 'fivetwofive-theme' ); ?></a>

	</div>

</article>
