<?php
/**
 * Content Editor Manager
 * 
 * Handles hiding the content editor for pages using the Modules Template.
 * This ensures that when users select the Modules Template, the traditional
 * content editor is hidden since the page content is managed through ACF
 * flexible content fields instead.
 * 
 * Features:
 * - Multiple template detection methods for reliability
 * - CSS fallback to ensure editor is hidden
 * - Works with both admin_init and current_screen hooks
 * 
 * @package FiveTwoFive_Theme
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Remove content editor for pages using the Modules Template
 */
function fivetwofive_remove_modules_template_editor() {
	global $post;
	
	// If not in admin or no post object, return
	if (!is_admin() || !$post) {
		return;
	}
	
	// Get current template
	$template = get_post_meta($post->ID, '_wp_page_template', true);
	
	// Check for multiple possible template values
	$is_modules_template = (
		'page-templates/template-module.php' === $template ||
		'Modules Template' === $template ||
		'template-module.php' === $template
	);
	
	// If using Modules Template, remove the editor
	if ($is_modules_template) {
		remove_post_type_support('page', 'editor');
	}
}
add_action('admin_init', 'fivetwofive_remove_modules_template_editor');

/**
 * Alternative method to hide content editor using current_screen hook
 * This runs later in the admin process and might be more reliable
 */
function fivetwofive_hide_editor_on_modules_template() {
	$screen = get_current_screen();
	
	// Only run on page edit screens
	if (!$screen || 'page' !== $screen->post_type || 'post' !== $screen->base) {
		return;
	}
	
	// Get the current post ID from the URL
	$post_id = isset($_GET['post']) ? intval($_GET['post']) : 0;
	
	if (!$post_id) {
		return;
	}
	
	// Get current template
	$template = get_post_meta($post_id, '_wp_page_template', true);
	
	// Check for multiple possible template values
	$is_modules_template = (
		'page-templates/template-module.php' === $template ||
		'Modules Template' === $template ||
		'template-module.php' === $template
	);
	
	// If using Modules Template, remove the editor
	if ($is_modules_template) {
		remove_post_type_support('page', 'editor');
	}
}
add_action('current_screen', 'fivetwofive_hide_editor_on_modules_template');

/**
 * CSS fallback to hide content editor when using Modules Template
 * This ensures the editor is hidden even if the PHP method doesn't work
 */
function fivetwofive_hide_editor_css() {
	$screen = get_current_screen();
	
	// Only run on page edit screens
	if (!$screen || 'page' !== $screen->post_type || 'post' !== $screen->base) {
		return;
	}
	
	// Get the current post ID from the URL
	$post_id = isset($_GET['post']) ? intval($_GET['post']) : 0;
	
	if (!$post_id) {
		return;
	}
	
	// Get current template
	$template = get_post_meta($post_id, '_wp_page_template', true);
	
	// Check for multiple possible template values
	$is_modules_template = (
		'page-templates/template-module.php' === $template ||
		'Modules Template' === $template ||
		'template-module.php' === $template
	);
	
	// If using Modules Template, add CSS to hide the editor
	if ($is_modules_template) {
		echo '<style>
			#postdivrich,
			#post-body-content #postdivrich,
			.wp-editor-wrap,
			#content_ifr,
			#content-tmce,
			#content-html {
				display: none !important;
			}
			#post-body-content .wp-editor-wrap {
				display: none !important;
			}
		</style>';
	}
}
add_action('admin_head', 'fivetwofive_hide_editor_css');
