<?php
    /**
    * Template Name: Single FiveTwoFive LP
    *
    * @link https://codex.wordpress.org/Template_Hierarchy
    *
    * @package The Authority
    */

    $lp_hubspot_form_heading = get_field('lp_hubspot_form_heading');
    $lp_hubspot_form_embed = get_field('lp_hubspot_form_embed');

    add_filter( 'body_class', 'custom_class' );

    function custom_class( $classes ) {
        if ( is_singular( 'fivetwofive-lp' ) ) {
            $classes[] = 'fivetwofive-lp-template';
        }
        return $classes;
    }

    get_header('landing');
?>

<div class="hero py-5">
	<div class="container">
		<div class="container_inner">
			<h1 class="text-center"><?php the_title(); ?></h1>
		</div>
	</div>
</div><!-- .hero -->

<div class="container">
    <div class="row">
        <main id="main" class="site-main col-12 col-md-8" role="main">
            <div class="content-wrapper m-b-lg">
                <div class="content-container">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </main><!-- #main -->

        <aside id="sidebar" class="col-12 col-md-4">
            <?php if ($lp_hubspot_form_heading): ?>
                <h3 class="lp-hs-form-heading"><?= $lp_hubspot_form_heading ;?></h3>
            <?php endif; ?>
            <?php echo $lp_hubspot_form_embed; ?>
        </aside><!-- #sidebar -->
    </div>
</div>

<?php get_template_part('template-parts/modules');?>

<?php get_footer('landing'); ?>