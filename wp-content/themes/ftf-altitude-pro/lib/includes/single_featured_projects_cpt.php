<?php 
  $project_client = get_field('project_client');
  $project_url = get_field('project_url');
  $project_button_text = get_field('project_button_text');
?>

<header class="entry-header">
    <h1 class="entry-title" itemprop="headline"><?php echo the_title();?></h1>
</header>

<?php while ( have_posts() ) : the_post(); ?>
    <article class="single-project">

        <div class="single-project-thumbnail container p-0 mb-4">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9">
                    <div class="border">
	                    <?php the_post_thumbnail('large'); ?>
                    </div>

	                <?php $caption = get_post(get_post_thumbnail_id())->post_excerpt; ?>
	                <?php if($caption): ?>
                        <div class="img-description small">
			                <?php echo $caption; ?>
                        </div>
	                <?php endif; ?>
	                <?php // the_post_thumbnail_caption(); ?>
                </div>
            </div>
        </div>

        <div class="single-project-meta bg-light container p-4 py-md-5 mb-5">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-7">
                    <div class="client h3">Client: <?php echo $project_client; ?></div>
                    <div class="categories">Categories: <?php the_category( ', ' ); ?></div>
	                <?php the_tags( '<div class="tags">Tagged With: ', ', ', '</div>' ); ?>
                </div>
                <div class="col-12 col-md-3 text-md-right">
                    <a class="btn btn-primary mt-3" target="_blank" href="<?php echo $project_url; ?>"><?php echo $project_button_text; ?> <i class="fas fa-external-link-square-alt ml-2"></i></a>
                </div>
            </div>
        </div>

        <div class="single-project-content"><?php the_content(); ?></div>

	    <?php echo do_shortcode("[featured_project_CTAshortcode]"); ?>

        <?php if ( 'featured-projects' == get_post_type() ): ?>
            <div class="container-fluid bg-light">
                <div class="row">
                    <div class="col-12 col-md-6 p-4 text-right">
		                <?php if (strlen(get_previous_post()->post_title) > 0) { ?>
                            <p>Previous</p>
                            <h6><?php previous_post_link(); ?></h6>
		                <?php }; ?>
                    </div>

                    <div class="col-12 col-md-6 p-4">
	                    <?php if (strlen(get_next_post()->post_title) > 0) { ?>
                            <p>Next</p>
                            <h6><?php next_post_link(); ?></h6>
	                    <?php }; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

	    <?php echo edit_post_link('(Edit)', '<span class="btn btn-warning my-2">', '</span>'); ?>

    </article>
<?php endwhile; ?>




