<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package FiveTwoFive_Theme
 */

if ( ! function_exists( 'fivetwofive_theme_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function fivetwofive_theme_posted_on( $post_item_id ) {
		$time_string = '';
		$date_format = get_option( 'date_format' );

		$time_string = sprintf(
			'<time class="entry-date published updated" datetime="%1$s">%2$s</time>',
			esc_attr( get_the_date( DATE_W3C, $post_item_id ) ),
			esc_html( get_the_date( $date_format, $post_item_id ) ),
		);

		if ( get_the_time( 'U', $post_item_id ) !== get_the_modified_time( 'U', $post_item_id ) ) {
			$time_string = sprintf(
				'<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>',
				esc_attr( get_the_date( DATE_W3C, $post_item_id ) ),
				esc_html( get_the_date( $date_format, $post_item_id ) ),
				esc_attr( get_the_modified_date( DATE_W3C, $post_item_id ) ),
				esc_html( get_the_modified_date( $date_format, $post_item_id ) )
			);
		}

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'fivetwofive-theme' ),
			'<a href="' . esc_url( get_permalink( $post_item_id ) ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'fivetwofive_theme_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function fivetwofive_theme_posted_by( $post_author_id ) {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'fivetwofive-theme' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $post_author_id ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $post_author_id ) ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'fivetwofive_theme_category_links' ) ) :
	/**
	 * Prints the post categories
	 */
	function fivetwofive_theme_category_links( $post_id ) {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type( $post_id ) ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'fivetwofive-theme' ), '', $post_id );

			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'fivetwofive-theme' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if ( ! function_exists( 'fivetwofive_theme_tag_links' ) ) :
	/**
	 * Prints the post tags
	 */
	function fivetwofive_theme_tag_links( $post_id ) {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type( $post_id ) ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', '', '', $post_id );

			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'fivetwofive-theme' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if ( ! function_exists( 'fivetwofive_theme_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function fivetwofive_theme_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			fivetwofive_theme_category_links( get_the_ID() );
			fivetwofive_theme_tag_links( get_the_ID() );
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'fivetwofive-theme' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'fivetwofive-theme' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'fivetwofive_theme_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function fivetwofive_theme_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package FiveTwoFive_Theme
 */

if ( ! function_exists( 'fivetwofive_theme_post_meta' ) ) :
	/**
	 * Display post meta fields.
	 *
	 * @param int $post_item_id Post item ID.
	 * @return string $post_meta Post meta.
	 */
	function fivetwofive_theme_post_meta( $post_item_id, $output = true ) {
		$post_type = get_post_type( $post_item_id );

		ob_start();

		echo '<div class="ftf-post-meta entry-meta">';

		do_action( 'fivetwofive_theme_before_post_meta', $post_item_id, $post_type );

		if ( 'post' === $post_type ) {
			fivetwofive_theme_posted_on( $post_item_id );
			fivetwofive_theme_posted_by( get_post_field( 'post_author', $post_item_id ) );
			fivetwofive_theme_category_links( get_the_ID() );
			fivetwofive_theme_tag_links( get_the_ID() );
		}

		do_action( 'fivetwofive_theme_after_post_meta', $post_item_id, $post_type );

		echo '</div>';

		if ( ! $output ) {
			return ob_get_clean();
		}

		echo wp_kses( ob_get_clean(), fivetwofive_kses_extended_ruleset() );
	}
endif;
