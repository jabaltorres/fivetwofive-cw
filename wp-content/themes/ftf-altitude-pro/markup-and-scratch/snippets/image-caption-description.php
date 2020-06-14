<?php
	/* Only display to logged in users */
	if ( is_user_logged_in() ) {

		/* Displaying the image caption and description */
		$thumb_img = get_post( get_post_thumbnail_id() ); // Get post by ID
		echo '<p>The Caption: ' . $thumb_img->post_excerpt . '<br>'; // Display Caption
		echo 'The Description: ' . $thumb_img->post_content . '</p> '; // Display Description

		/* Displaying the image alt text */
		$thumb_img_meta = get_post_meta( get_post_thumbnail_id() ); // Get post meta by ID
		echo $thumb_img_meta['_wp_attachment_image_alt']['0']; // Display Alt text

	} else {
		echo '';
	}
?>