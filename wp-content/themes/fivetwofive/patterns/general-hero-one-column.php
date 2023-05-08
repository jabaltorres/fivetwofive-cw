<?php
/**
 * Title: Section with image, text, buttons.
 * Slug: fivetwofive/general-hero-one-column
 * Categories: fivetwofive-general
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0px"},"padding":{"top":"var:preset|spacing|x-large","right":"30px","bottom":"var:preset|spacing|x-large","left":"30px"}}},"layout":{"type":"constrained","wideSize":"800px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0px;padding-top:var(--wp--preset--spacing--x-large);padding-right:30px;padding-bottom:var(--wp--preset--spacing--x-large);padding-left:30px"><!-- wp:image {"id":3480,"sizeSlug":"full","linkDestination":"none"} -->
	<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri() ) . '/assets/images/sample-black_1920x1200.jpg'; ?>" alt="Sample Image" class="wp-image-3480"/></figure>
	<!-- /wp:image -->

	<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"fontSize":"max-48"} -->
	<h2 class="wp-block-heading has-text-align-center has-max-48-font-size" id="image-heading-text-buttons" style="margin-top:var(--wp--preset--spacing--large)">Image, heading, text, buttons.</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center">Lorem ipsum dolor sit amet, consectetur adipiscing vestibulum. Fringilla nec accumsan eget, facilisis mi justo, luctus eu pellentesque vitae gravida non diam accumsan.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"}} -->
	<div class="wp-block-buttons"><!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Get Started</a></div>
		<!-- /wp:button -->

		<!-- wp:button {"className":"is-style-outline"} -->
		<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">Learn More</a></div>
		<!-- /wp:button --></div>
	<!-- /wp:buttons --></div>
<!-- /wp:group -->