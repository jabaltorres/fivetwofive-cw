<?php
/**
* Template Name: Single Cribl LP
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package The Authority
*/

add_filter( 'body_class', 'custom_class' );

function custom_class( $classes ) {
	if ( is_singular( 'fivetwofive-lp' ) ) {
		$classes[] = 'fivetwofive-lp-template';
	}
	return $classes;
}

// get_template_part('header-landing.php');
get_header('landing'); ?>

<style>.intercom-launcher { display:none !important; }</style>

<div class="hero m-b-lg p-y-lg">
	<div class="container">
		<div class="container_inner">
			<h1 class="text-center"><?php the_title(); ?></h1>
		</div>
	</div>
</div>

<div class="content">
	<div class="container">
		<div class="container_inner">
			<div id="primary" class="content-area-full">
				<main id="main" class="site-main m-b-md" role="main">
					<div class="content-wrapper m-b-lg">
						<div class="content-container">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; ?>
						</div>
					</div>
				</main><!-- #main -->

				<?php if ( is_active_sidebar( 'custom-side-bar' ) ) { ?>
                    <aside id="sidebar" class="m-b-md">
						<?php dynamic_sidebar( 'custom-side-bar' ); ?>
                    </aside>
				<?php } ?>
			</div><!-- #primary -->
		</div>
	</div>
</div>

<?php include_once get_stylesheet_directory() . '/includes/lp_three_col_cta_section.php'; ?>

<?php get_footer('landing'); ?>