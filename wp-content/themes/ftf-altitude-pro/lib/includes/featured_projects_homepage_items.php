<?php
    $project_client = get_field('project_client');
    $project_url = get_field('project_url');
    $project_button_text = get_field('project_button_text');
    $homepage_toggle = get_field('homepage_toggle');
?>

<div class="container featured-projects-homepage-item mb-4">
    <div class="row align-items-center">
	    <?php if($homepage_toggle == 1): ?>

		    <?php
		    /* This is where I'm going to set image left / right toggle. */
		    /* https://www.advancedcustomfields.com/resources/true-false/ */
		    /* The True / False field allows you to select a value that is either 1 or 0. */
		    ?>

            <div class="col-12 col-md-7 has-img">
			    <?php if ( has_post_thumbnail() ) : ?>
                    <a class="has-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <img class="thumbnail" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>" />
                    </a>
			    <?php endif; ?>
            </div>
            <div class="col-12 col-md-5 has-text">

                <a href="<?php echo get_permalink(); ?>"><h3 class="article-title"><?php echo the_title();?></h3></a>

			    <?php if ( has_excerpt()): ?>
                    <div class="project-excerpt mb-4"><?php echo the_excerpt();?></div>
			    <?php endif; ?>

                <a class="btn btn-primary" href="<?php echo get_permalink(); ?>">Learn More</a>

            </div>

	    <?php else: ?>

            <div class="col-12 col-md-7 has-image order-md-last">
                <?php if ( has_post_thumbnail() ) : ?>
                    <a class="has-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <img class="thumbnail" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_post_thumbnail_caption(); ?>" />
                    </a>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-5 has-text order-md-first">

                <a href="<?php echo get_permalink(); ?>"><h3 class="article-title"><?php echo the_title();?></h3></a>

                <?php if ( has_excerpt()): ?>
                    <div class="project-excerpt mb-4"><?php echo the_excerpt();?></div>
                <?php endif; ?>

                <a class="btn btn-primary" href="<?php echo get_permalink(); ?>">Learn More</a>

            </div>
	    <?php endif; ?>

    </div>
</div>
