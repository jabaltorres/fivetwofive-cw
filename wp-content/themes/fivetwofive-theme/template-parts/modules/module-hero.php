<?php
/**
 * Template part for displaying the hero module in the modules template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

$module_title     = get_sub_field( 'title' );
$module_content   = get_sub_field( 'content' );
$background_image = get_sub_field( 'background_image' );
$video            = get_sub_field( 'video' );
$video_thumbnail  = get_sub_field( 'video_thumbnail' );
$video_caption    = get_sub_field( 'video_caption' );
$module_button    = get_sub_field( 'button' );

if ( $video ) :
	preg_match( '/src="([^"]+)"/', $video, $match );
	$video              = $match[1];
	$video              = remove_query_arg( 'feature', $video );
	$params             = array(
		'autoplay' => 1,
		'rel'      => 0,
	);
	$video              = add_query_arg( $params, $video );
	$hero_content_class = 'col-md-7 order-md-1';
endif;
?>

<section class="ftf-module module-hero <?php echo ( $video ) ? 'with-video' : 'without-video'; ?>" style="background:url('<?php echo esc_url_raw( $background_image['sizes']['large'] ); ?>') center center no-repeat; background-size:cover;">
	<div class="container">
		<div class="row">

			<?php if ( $video ) : ?>
				<div class="col-12 col-md-5 order-md-2">
					<div class="module-hero__image-wrap">
						<?php
						if ( $video_thumbnail ) :
							echo wp_get_attachment_image( $video_thumbnail, 'medium' );
						endif;
						?>

						<a class="module-hero__video-button fancybox.iframe" href="<?php echo esc_url_raw( $video ); ?>"><?php echo fivetwofive_theme_get_icon_svg( 'ui', 'play', 30 ); ?></a>

					</div>
					<?php if ( $video_caption ) : ?>
						<p class="module-hero__caption"><?php echo esc_html( $video_caption ); ?></p>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="col-12 <?php echo esc_attr( $hero_content_class ); ?>">
				<?php if ( $module_title ) : ?>
					<h1 class="module__title"><?php echo esc_html( $module_title ); ?></h1>
				<?php endif; ?>

				<?php if ( $module_content ) : ?>
					<div class="module__content"><?php echo wp_kses_post( $module_content ); ?></div>
				<?php endif; ?>

				<?php
				if ( $module_button ) :
					$link_url    = $module_button['url'];
					$link_title  = $module_button['title'];
					$link_target = $module_button['target'] ? $module_button['target'] : '_self';
					?>
					<a class="button module__button" role="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
