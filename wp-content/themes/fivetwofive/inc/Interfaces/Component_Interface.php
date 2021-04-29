<?php
/**
 * Fivetwofive\FivetwofiveTheme\Interfaces\Component_Interface interface
 *
 * @package Fivetwofive\FivetwofiveTheme
 */

namespace Fivetwofive\FivetwofiveTheme\Interfaces;

/**
 * Interface for a theme component.
 */
interface Component_Interface {
	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function register();
}
