<?php
/**
 * Custom icons for this theme.
 *
 * @package WordPress
 * @subpackage FiveTwoFive
 * @since FiveTwoFive 1.0
 */

namespace Fivetwofive\FivetwofiveTheme;

use InvalidArgumentException;

use Fivetwofive\FivetwofiveTheme\Interfaces\Component_Interface;
use Fivetwofive\FivetwofiveTheme\Interfaces\Templating_Component_Interface;

/**
 * Custom icons for this theme.
 *
 * @package WordPress
 * @subpackage FiveTwoFive
 * @since FiveTwoFive 1.0
 */
final class Init {
	/**
	 * Associative array of theme components, keyed by their slug.
	 *
	 * @var array
	 */
	protected $components = array();

	/**
	 * The template tags instance, providing access to all available template tags.
	 *
	 * @var Template_Tags
	 */
	protected $template_tags;

	/**
	 * Constructor.
	 *
	 * Sets the theme components.
	 *
	 * @param array $components Optional. List of theme components. Only intended for custom initialization, typically
	 *                          the theme components are declared by the theme itself. Each theme component must
	 *                          implement the Component_Interface interface.
	 *
	 * @throws InvalidArgumentException Thrown if one of the $components does not implement Component_Interface.
	 */
	public function __construct( array $components = array() ) {
		if ( empty( $components ) ) {
			$components = $this->get_default_components();
		}

		// Set the components.
		foreach ( $components as $component ) {

			// Bail if a component is invalid.
			if ( ! $component instanceof Component_Interface ) {
				throw new InvalidArgumentException(
					sprintf(
						/* translators: 1: classname/type of the variable, 2: interface name */
						__( 'The theme component %1$s does not implement the %2$s interface.', 'wp-rig' ),
						gettype( $component ),
						Component_Interface::class
					)
				);
			}

			$this->components[] = $component;
		}

		// Instantiate the template tags instance for all theme templating components.
		$this->template_tags = new Template_Tags(
			array_filter(
				$this->components,
				function( Component_Interface $component ) {
					return $component instanceof Templating_Component_Interface;
				}
			)
		);
	}

	/**
	 * Retrieves the template tags instance, the entry point exposing template tag methods.
	 *
	 * Calling `fivetwofive()` is a short-hand for calling this method on the main theme instance. The instance then allows
	 * for actual template tag methods to be called. For example, if there is a template tag called `posted_on`, it can
	 * be accessed via `fivetwofive()->posted_on()`.
	 *
	 * @return Template_Tags Template tags instance.
	 */
	public function template_tags() : Template_Tags {
		return $this->template_tags;
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 *
	 * This method must only be called once in the request lifecycle.
	 */
	public function register() {
		array_walk(
			$this->components,
			function( Component_Interface $component ) {
				$component->register();
			}
		);
	}

	/**
	 * Gets the default theme components.
	 *
	 * This method is called if no components are passed to the constructor, which is the common scenario.
	 *
	 * @return array List of theme components to use by default.
	 */
	protected function get_default_components() : array {
		$components = array(
			new Styles\Styles(),
			new Customize\Customize(),
			new Template\Template(),
			new Theme\Theme(),
			new Widgets\Widgets(),
			new Post\Post(),
			new Icons\Icons(),
		);

		return $components;
	}
}
