<?php
/**
* Template Name: Landing Page Template JT
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package The Authority
*/

add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {
	if ( is_page_template( 'template-landing.php' ) ) {
		$classes[] = 'cribl-lp-template';
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
				<main id="main" class="site-main m-b-md" role=template-landing.php"main">
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

<div class="lp-ctas">
    <div class="container">
        <div class="container_inner">
            <div class="lp-cta-col">
                <div class="lp-cta-col-inner">
                    <h3 class="m-b-sm">6 Techniques to Control Log Volume</h3>
                    <div class="lp-cta-col-content lp-cta-col-1">
                        <p>Read the white paper and learn how to reduce logs up to 50%</p>
                    </div>
                    <a href="/white-paper-6-techniques-to-control-log-volume-reduce-logs-up-to-50-percent/?utm_source=cb&utm_medium=cta&utm_campaign=lp" class="button">Read the White Paper</a>
                </div>
            </div>
            <div class="lp-cta-col">
                <div class="lp-cta-col-inner">
                    <h3 class="m-b-sm">LogStream Sandbox</h3>
                    <div class="lp-cta-col-content lp-cta-col-2">
                        <p>Learn about the features of Cribl LogStream in our interactive sandbox!</p>
                    </div>
                    <a href="https://sandbox.cribl.io/?utm_source=cb&utm_medium=cta&utm_campaign=lp" class="button" target="_blank">Learn More</a>
                </div>
            </div>
            <div class="lp-cta-col">
                <div class="lp-cta-col-inner">
                    <h3 class="m-b-sm">Download LogStream</h3>
                    <div class="lp-cta-col-content lp-cta-col-3">
                        <p>Run Cribl in your environment. Download LogStream for installation on-premises or in your cloud account and get 100 GB of processing at no cost</p>
                    </div>
                    <a href="/download/?utm_source=cb&utm_medium=cta&utm_campaign=lp" class="button">Download</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php // include_once get_stylesheet_directory() . '/rs_templates/blog/cribl-sandbox-cta.php'; ?>

<?php get_footer('landing'); ?>