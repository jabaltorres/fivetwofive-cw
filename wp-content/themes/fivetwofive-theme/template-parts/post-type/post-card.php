<?php
/**
 * Template part for displaying a post item with image left or right option through args.
 * This template expects a container class as parent.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

if ( ! array_key_exists( 'id', $args ) && ! isset( $args['id'] ) ) {
	return;
}

$post_item_id       = $args['id'];
$image_size         = 'post-thumbnail';
$post_taxonomy      = 'category';
$post_tags_taxonomy = 'post_tag';

if ( array_key_exists( 'image_size', $args ) && isset( $args['image_size'] ) ) {
	$image_size = $args['image_size'];
}

if ( array_key_exists( 'taxonomy', $args ) && isset( $args['taxonomy'] ) ) {
	$post_taxonomy = $args['taxonomy'];
}

if ( array_key_exists( 'tags', $args ) && isset( $args['tags'] ) ) {
	$post_tags_taxonomy = $args['tags'];
}

$post_categories = get_the_terms( $post_item_id, $post_taxonomy );

?>

<article id="card-<?php echo esc_attr( $post_item_id ); ?>" <?php post_class( 'card', $post_item_id ); ?>>

        <div class="card__top">
            <?php if ( $post_categories ) : ?>
                <ul class="card__categories">
                    <?php foreach ( $post_categories as $post_category ) : ?>
                        <li><a href="<?php echo esc_url( get_category_link( $post_category->term_id ) ); ?>"><?php echo esc_html( $post_category->name ); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php
            echo get_the_post_thumbnail(
                $post_item_id,
                $image_size,
                array(
                    'alt'   => the_title_attribute(
                        array(
                            'echo' => false,
                            'post' => $post_item_id,
                        )
                    ),
                    'class' => 'card__image img-responsive',
                )
            );
            ?>
        </div>

        <div class="card__bottom">
            <header class="card__header m-0">
                <?php fivetwofive_theme_post_meta( $post_item_id ); ?>
                <h3 class="card__title mt-2"><a href="<?php echo esc_url( get_permalink( $post_item_id ) ); ?>"><?php echo esc_html( get_the_title( $post_item_id ) ); ?></a></h3>

                <?php if ( $post_tags_taxonomy ) : ?>
                    <?php echo get_the_term_list( get_the_ID(), $post_tags_taxonomy, '<p class="card__tags"><strong>Tags:</strong> ', ', ', '</p>' ); ?>
                <?php endif; ?>
            </header><!-- .card-header -->

            <?php if ( has_excerpt( $post_item_id ) ) : ?>
                <div class="card__content mt-2">
                    <?php echo wp_kses_post( get_the_excerpt( $post_item_id ) ); ?>
                </div>
            <?php endif; ?>
        </div>

</article><!-- #card-<?php echo esc_html( $post_item_id ); ?> -->
