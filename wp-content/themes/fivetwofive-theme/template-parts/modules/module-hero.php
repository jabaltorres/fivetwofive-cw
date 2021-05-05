<?php
/**
 * Template part for displaying the hero module in the modules template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

$module_title         = get_sub_field( 'title' );
$module_subtitle      = get_sub_field( 'subtitle' );
$module_product_title = get_sub_field( 'product_title' );
$module_content       = get_sub_field( 'content' );
$video                = get_sub_field( 'video' );
$video_thumbnail      = get_sub_field( 'video_thumbnail' );
$video_caption        = get_sub_field( 'video_caption' );
$module_button        = get_sub_field( 'button' );

$background_image        = get_sub_field( 'background_image' );
$text_color              = get_sub_field( 'text_color' );
$button_text_color       = get_sub_field( 'button_text_color' );
$button_background_color = get_sub_field( 'button_background_color' );
$button_border_color     = get_sub_field( 'button_border_color' );

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

$styles                  = '';
$text_color_inline_style = '';
$button_styles           = '';

if ( $background_image ) {
	$styles .= sprintf( 'background:url(\'%1$s\') center center no-repeat; background-size:cover;', esc_url_raw( $background_image['sizes']['large'] ) );
}

if ( $text_color ) {
	$styles                 .= sprintf( 'color:%1$s;', $text_color );
	$text_color_inline_style = sprintf( 'color:%1$s;', $text_color );
}

if ( $button_text_color ) {
	$button_styles .= sprintf( 'color:%1$s;', $button_text_color );
}

if ( $button_background_color ) {
	$button_styles .= sprintf( 'background-color:%1$s;', $button_background_color );
}

if ( $button_border_color ) {
	$button_styles .= sprintf( 'border-color:%1$s;', $button_border_color );
}

?>

<section class="ftf-module module-hero py-5 py-md-6 <?php echo ( $video ) ? 'with-video' : 'without-video'; ?>" style="<?php echo esc_attr( $styles ); ?>">
	<div class="container">
		<div class="row">

			<?php if ( $video ) : ?>
				<div class="col-12 col-md-5 mb-2 mb-md-0 order-md-2">
					<?php if ( $video_thumbnail ) : ?>
						<figure class="module-hero__video">
							<div class="module-hero__video-image-wrap">
								<?php echo wp_get_attachment_image( $video_thumbnail, 'full', false, array( 'class' => 'module-hero__video-image' ) ); ?>
								<a class="module-hero__video-play-buttton" data-fancybox href="<?php echo esc_url_raw( $video ); ?>" style="<?php echo esc_attr( $text_color_inline_style ); ?>">
									<?php echo fivetwofive_theme_get_icon_svg( 'ui', 'play', 100 ); ?>
								</a>
							</div>
							<?php if ( $video_caption ) : ?>
								<figcaption class="module-hero__video-caption" style="<?php echo esc_attr( $text_color_inline_style ); ?>"><?php echo esc_html( $video_caption ); ?></figcaption>
							<?php endif; ?>
						</figure>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="col-12 <?php echo esc_attr( $hero_content_class ); ?>">
				<?php if ( $module_product_title ) : ?>
					<p class="module-hero__product-title" style="<?php echo esc_attr( $text_color_inline_style ); ?>"><?php echo esc_html( $module_product_title ); ?></p>
				<?php endif; ?>

				<?php if ( $module_title ) : ?>
					<h1 class="module__title" style="<?php echo esc_attr( $text_color_inline_style ); ?>"><?php echo esc_html( $module_title ); ?></h1>
				<?php endif; ?>

				<?php if ( $module_subtitle ) : ?>
					<h2 class="module__subtitle" style="<?php echo esc_attr( $text_color_inline_style ); ?>"><?php echo esc_html( $module_subtitle ); ?></h2>
				<?php endif; ?>

				<?php if ( $module_content ) : ?>
					<div class="module__content mb-3 mb-md-4" style="<?php echo esc_attr( $text_color_inline_style ); ?>"><?php echo wp_kses_post( $module_content ); ?></div>
				<?php endif; ?>

				<?php
				if ( $module_button ) :
					$link_url    = $module_button['url'];
					$link_title  = $module_button['title'];
					$link_target = $module_button['target'] ? $module_button['target'] : '_self';
					?>
					<a class="button module__button" style="<?php echo esc_attr( $button_styles ? $button_styles : '' ); ?>" role="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
