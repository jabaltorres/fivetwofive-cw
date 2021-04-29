<?php
/**
 * Interface for a theme component.
 *
 * @package Fivetwofive
 * @subpackage FivetwofiveTheme/Interfaces
 * @since 1.0.0
 */

namespace Fivetwofive\FivetwofiveTheme\Interfaces;

/**
 * Interface for a theme component.
 *
 * @since 1.0.0
 */
interface Component_Interface {
	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function register();
}
