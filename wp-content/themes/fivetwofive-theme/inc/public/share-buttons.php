<?php
/**
 * FiveTwoFive Theme Share Buttons
 *
 * @package FiveTwoFive_Theme
 */

if ( ! function_exists( 'fivetwofive_share_buttons_func' ) ) :
	/**
	 * Create share button lists.
	 *
	 * @link https://github.com/bradvin/social-share-urls
	 */
	function fivetwofive_share_buttons_func() {

		$page_id = get_queried_object_id();
		$url     = get_the_permalink( $page_id );

		$facebook_share_url = add_query_arg( 'u', $url, 'https://www.facebook.com/sharer.php' );
		$linkedin_share_url = add_query_arg( 'url', $url, 'https://www.linkedin.com/sharing/share-offsite' );
		$twitter_share_url  = add_query_arg( 'url', $url, 'https://twitter.com/intent/tweet' );

		ob_start();
		?>
			<ul class="fivetwofive-share-buttons">
				<li><a href="<?php echo esc_url_raw( $facebook_share_url ); ?>" target="_blank"><span class="screen-reader-text"><?php echo esc_html_e( 'Share on facebook', 'fivetwofive-theme' ); ?></span> <?php echo fivetwofive_theme_get_icon_svg( 'social', 'facebook', '30' ); ?></a></li>
				<li><a href="<?php echo esc_url_raw( $twitter_share_url ); ?>" target="_blank"><span class="screen-reader-text"><?php echo esc_html_e( 'Share on twitter', 'fivetwofive-theme' ); ?></span> <?php echo fivetwofive_theme_get_icon_svg( 'social', 'twitter', '30' ); ?></a></li>
				<li><a href="<?php echo esc_url_raw( $linkedin_share_url ); ?>" target="_blank"><span class="screen-reader-text"><?php echo esc_html_e( 'Share on linkedin', 'fivetwofive-theme' ); ?></span> <?php echo fivetwofive_theme_get_icon_svg( 'social', 'linkedin', '30' ); ?></a></li>
			</ul>
		<?php

		return ob_get_clean();
	}
endif;
add_shortcode( 'fivetwofive_share_buttons', 'fivetwofive_share_buttons_func' );

if ( ! function_exists( 'fivetwofive_single_post_share_buttons' ) ) :
	/**
	 * Append the fivetwofive share buttons in the single post content.
	 *
	 * @param string $content Single post content.
	 * @return string $content Single post content.
	 */
	function fivetwofive_single_post_share_buttons( $content ) {
		if ( is_singular( 'post' ) ) {
			return $content . do_shortcode( '[fivetwofive_share_buttons]' );
		}

		return $content;
	}
endif;
add_filter( 'the_content', 'fivetwofive_single_post_share_buttons' );
