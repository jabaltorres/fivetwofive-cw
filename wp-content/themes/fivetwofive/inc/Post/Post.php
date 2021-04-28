<?php
/**
 * Custom icons for this theme.
 *
 * @package WordPress
 * @subpackage FiveTwoFive
 * @since FiveTwoFive 1.0
 */

namespace Fivetwofive\FivetwofiveTheme\Post;

use Fivetwofive\FivetwofiveTheme\Component_Interface;

class Post implements Component_Interface {

	public function register() {
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
	}

	/**
	 * Filter the except length to 70 words.
	 *
	 * @param int $length Excerpt length.
	 * @return int (Maybe) modified excerpt length.
	 */
	public function excerpt_length( $length ) {
		return 70;
	}

	/**
	 * Filter the "read more" excerpt string link to the post.
	 *
	 * @param string $more "Read more" excerpt string.
	 * @return string (Maybe) modified "read more" excerpt string.
	 */
	public function excerpt_more( $more ) {
		if ( ! is_single() ) {
			$more = sprintf(
				'<a title="%1$s" aria-label="%1$s" class="entry-read-more" href="%2$s">%3$s</a>',
				get_the_title( get_the_ID() ),
				get_permalink( get_the_ID() ),
				__( '...Read More', 'fivetwofive' )
			);
		}

		return $more;
	}

}
