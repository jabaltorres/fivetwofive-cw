<?php
/**
 * Template part for displaying single resource banner.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

$creative = get_field( 'ftf_resource_creative' );
?>

<header class="ftf-resource__header bg-gray py-4 py-sm-6">
	<div class="container">
		<?php the_title( '<h1 class="ftf-resource__title">', '</h1>' ); ?>

		<?php
		if ( is_array( $creative ) && count( $creative ) > 0 ) :
			$creative_name   = get_the_title( $creative[0] );
			$creative_link   = get_field( 'ftf_creative_link', $creative[0] );
			$creative_avatar = get_the_post_thumbnail( $creative[0], array( 80, 80 ), array( 'class' => 'ftf-avatar__image' ) );
			?>

			<div class="ftf-avatar">
				<?php if ( has_post_thumbnail( $creative[0] ) ) : ?>
					<div class="ftf-avatar__image-col">
						<?php echo wp_kses_post( $creative_avatar ); ?>
					</div>
				<?php endif; ?>
				<div class="ftf-avatar__details-col">
					<p class="ftf-avatar__text"><?php echo esc_html__( 'Author', 'fivetwofive-theme' ); ?></p>
					<h2 class="ftf-avatar__name"><?php echo esc_html( $creative_name ); ?></h2>
				</div>
			</div>

		<?php endif; ?>
	</div>
</header>
