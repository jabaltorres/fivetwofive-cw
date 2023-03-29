<?php
/**
 * Title: Hidden No Results Content
 * Slug: fivetwofive-block-theme/hidden-no-results-content
 * Inserter: no
 */
?>
<!-- wp:paragraph -->
<p>
<?php echo esc_html_x( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'Message explaining that there are no results returned from a search', 'fivetwofive-block-theme' ); ?>
</p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"<?php echo esc_html_x( 'Search', 'label', 'fivetwofive-block-theme' ); ?>","placeholder":"<?php echo esc_attr_x( 'Search...', 'placeholder for search field', 'fivetwofive-block-theme' ); ?>","showLabel":false,"buttonText":"<?php esc_attr_e( 'Search', 'fivetwofive-block-theme' ); ?>","buttonUseIcon":true} /-->
