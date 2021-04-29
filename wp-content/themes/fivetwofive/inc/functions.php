<?php
/**
 * The `fivetwofive()` function.
 *
 * @package fivetwofive
 */

namespace Fivetwofive\FivetwofiveTheme;

/**
 * Provides access to all available template tags of the theme.
 *
 * When called for the first time, the function will initialize the theme.
 *
 * @return Template_Tags Template tags instance exposing template tag methods.
 */
function fivetwofive() : Template_Tags {
	static $theme = null;

	if ( null === $theme ) {
		$theme = new Init();
		$theme->register();
	}

	return $theme->template_tags();
}
