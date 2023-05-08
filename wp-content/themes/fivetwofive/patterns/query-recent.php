<?php
/**
 * Title: List of the recent posts.
 * Slug: fivetwofive/query-recent
 * Categories: fivetwofive-query
 * Viewport Width: 1280
 */
?>

<!-- wp:query {"queryId":2,"query":{"perPage":5,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false,"parents":[]},"displayLayout":{"type":"list","columns":3},"align":"wide"} -->
<div class="wp-block-query alignwide"><!-- wp:post-template -->
	<!-- wp:columns -->
	<div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center","width":"33.33%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:33.33%"><!-- wp:post-title {"isLink":true} /-->
			<!-- wp:read-more {"content":"Learn more","className":"is-style-button-fill"} /--></div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"66.66%"} -->
		<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:post-featured-image {"isLink":true} /--></div>
		<!-- /wp:column --></div>
	<!-- /wp:columns -->
	<!-- /wp:post-template --></div>
<!-- /wp:query -->