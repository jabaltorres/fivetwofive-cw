<?php
/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ftf-testimonial-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ftf-testimonial';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}

if ( ! empty( $block['align_text'] ) ) {
	$className .= ' has-text-align-' . $block['align_text'];
}

// Load values and assign defaults.
$message   = get_field( 'message' ) ?: '';
$name      = get_field( 'name' ) ?: '';
$job_title = get_field( 'job_title' ) ?: '';
$avatar    = get_field( 'avatar' );

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="ftf-testimonial__message-row">
        <svg class="ftf-testimonial__message-icon fivetwofive-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 103.45 91"><path d="M1016.81,117a9.7,9.7,0,0,0,9.64-9.75v-26a9.7,9.7,0,0,0-9.64-9.75h-16.08v-13a12.938,12.938,0,0,1,12.86-13h1.61a4.837,4.837,0,0,0,4.82-4.875v-9.75A4.837,4.837,0,0,0,1015.2,26h-1.61a32.321,32.321,0,0,0-32.158,32.5v48.75a9.7,9.7,0,0,0,9.647,9.75Zm-57.684,0a9.8,9.8,0,0,0,9.853-9.75v-26a9.8,9.8,0,0,0-9.853-9.75H942.705v-13a13.081,13.081,0,0,1,13.137-13h1.642a4.89,4.89,0,0,0,4.927-4.875v-9.75A4.89,4.89,0,0,0,957.484,26h-1.642A32.663,32.663,0,0,0,923,58.5v48.75a9.8,9.8,0,0,0,9.853,9.75Z" transform="translate(-923 -26)" fill="#e8ecef"/></svg>
        <p class="ftf-testimonial__message"><?php echo esc_html( $message ); ?></p>
    </div>
    <div class="ftf-testimonial__author">
        <div class="ftf-testimonial__author-avatar-col">
            <?php echo wp_get_attachment_image( $avatar, 'thumbnail', false, array( 'class' => 'ftf-testimonial__author-avatar', 'alt' => $name ) ); ?>
        </div>
        <div class="ftf-testimonial__author-identity">
            <p class="ftf-testimonial__author-name"><?php echo esc_html( $name ); ?></p>
            <p class="ftf-testimonial__author-job-title"><?php echo esc_html( $job_title ); ?></p>
        </div>
    </div>
</div>
