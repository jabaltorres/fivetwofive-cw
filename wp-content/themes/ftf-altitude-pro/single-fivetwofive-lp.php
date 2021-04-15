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

    $lp_page_title = get_field('lp_page_title');
    $lp_hero_content = get_field('lp_hero_content');
    $lp_hero_bg_img = get_field('lp_hero_bg_img');
    $lp_hero_id = get_field('lp_hero_id');
    $lp_hero_additional_classes = get_field('lp_hero_additional_classes');
    $lp_hero_dark_bg_overlay = get_field('lp_hero_dark_bg_overlay');

    $lp_hero_cta = get_field('lp_hero_cta');
    $lp_hero_cta_text = $lp_hero_cta['lp_hero_cta_text'];
    $lp_hero_cta_url = $lp_hero_cta['lp_hero_cta_url'];

    add_filter( 'body_class', 'custom_class' );

    function custom_class( $classes ) {
        if ( is_singular( 'fivetwofive-lp' ) ) {
            $classes[] = 'lp-template';
        }
        return $classes;
    }

    get_header('landing');

    // This is for the featured image
//    $backgroundImg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

    if ($backgroundImg){
        $headerTextColorClass = 'text-white mb-4';
    } else {
        $headerTextColorClass = '';
    }

?>

<?php
    // Removing Paragraph Tags from WYSIWYG Fields
//    remove_filter('the_content','wpautop');
?>


<div id="<?= $lp_hero_id; ?>" class="hero lp-hero py-5 <?= $headerTextColorClass; ?> <?= $lp_hero_additional_classes; ?>" style="background: url('<?php echo $lp_hero_bg_img; ?>') no-repeat; background-size: cover;">

    <?php if ($lp_hero_dark_bg_overlay): ?>
        <span class="hero-bg-overlay"></span>
    <?php endif;?>

    <div class="container">
		<div class="row">
            <div class="col-12 col-md-10 offset-md-1">
                <h1 id="lp-title" class="text-center"><?php echo $lp_page_title; ?></h1>

                <?php if ($lp_hero_content): ?>
                    <div class="lp-hero-content">
                        <?php echo $lp_hero_content; ?>
                    </div>
                <?php endif; ?>

                <?php if ($lp_hero_cta_text && $lp_hero_cta_url): ?>
                    <a class="btn btn-primary" href="<?= $lp_hero_cta_url; ?>"><?= $lp_hero_cta_text; ?></a>
                <?php endif; ?>

            </div>
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