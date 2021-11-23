<?php
/**
 * Template part for displaying single resource file type.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

$file_attachment = get_field( 'ftf_resource_file_attachment' );

if ( ! $file_attachment ) {
	return;
}

$file_attachment_meta    = wp_prepare_attachment_for_js( $file_attachment );
$file_attachment_preview = get_field( 'ftf_resource_file_attachment_preview' );
?>

<div class="row mb-3 mb-sm-6">
	<?php if ( $file_attachment_preview ) : ?>
		<div class="col-12 col-sm-5">
			<?php echo wp_get_attachment_image( $file_attachment_preview, 'full' ); ?>
		</div>
	<?php endif; ?>
	<div class="col-12 col-sm-7">
		<div class="ftf-resource__details">
			<p><strong>File Name: </strong><?php echo esc_html( $file_attachment_meta['title'] ); ?></p>
			<p><strong>File Type: </strong><?php echo esc_html( $file_attachment_meta['type'] ); ?></p>
			<p><strong>File Size: </strong><?php echo esc_html( $file_attachment_meta['filesizeHumanReadable'] ); ?></p>
		</div>
		<div class="ftf-resource__excerpt">
			<?php the_excerpt(); ?>
		</div>
		<?php get_template_part( 'template-parts/resource/meta' ); ?>
		<a href="<?php echo esc_url( $file_attachment_meta['url'] ); ?>" class="button button--lg" download><?php echo esc_html__( 'Download Now', 'fivetwofive-theme' ); ?></a>
	</div>
</div>
