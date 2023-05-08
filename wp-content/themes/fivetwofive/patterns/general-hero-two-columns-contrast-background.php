<?php
/**
 * Title: Section with image, text, buttons in contrast background.
 * Slug: fivetwofive/general-hero-two-columns-contrast-background
 * Categories: fivetwofive-general
 * Viewport Width: 1280
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large","right":"30px","left":"30px"}}},"backgroundColor":"contrast","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-contrast-background-color has-background" style="padding-top:var(--wp--preset--spacing--x-large);padding-right:30px;padding-bottom:var(--wp--preset--spacing--x-large);padding-left:30px"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|medium","left":"var:preset|spacing|medium"}}}} -->
	<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1,"textColor":"base","fontSize":"max-60"} -->
			<h1 class="wp-block-heading has-base-color has-text-color has-max-60-font-size" id="text-on-left-image-on-right"><strong>Text on left, media on right.</strong></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"base"} -->
			<p class="has-base-color has-text-color">Lorem ipsum dolor sit amet, consectetur adipiscing vestibulum. Fringilla nec accumsan eget, facilisis mi justo, luctus pellentesque gravida vitae non diam accumsan posuere, venenatis mi turpis.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill"} -->
				<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button">Get Started</a></div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline-base"} -->
				<div class="wp-block-button is-style-outline-base"><a class="wp-block-button__link wp-element-button">Learn More</a></div>
				<!-- /wp:button --></div>
			<!-- /wp:buttons --></div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large"} -->
			<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri() ) . '/assets/images/sample-white_1200x1200.jpg'; ?>" alt="sample image"/></figure>
			<!-- /wp:image --></div>
		<!-- /wp:column --></div>
	<!-- /wp:columns --></div>
<!-- /wp:group -->