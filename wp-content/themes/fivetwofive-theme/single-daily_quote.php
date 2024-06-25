<?php
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                    the_content();
                    ?>

                    <blockquote>
                        <?php echo wp_kses_post ( get_field('quote') ); ?>
                        <footer>
                            - <?php echo wp_kses_post ( get_field('author') ); ?>
                            <cite title="Source Title"><?php echo wp_kses_post ( get_field('citation') ); ?></cite>
                        </footer>
                    </blockquote>
                </div><!-- .entry-content -->

                <footer class="entry-footer">
                    <?php
                    edit_post_link(
                        sprintf(
                            wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                                __( 'Edit <span class="screen-reader-text">%s</span>', 'textdomain' ),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            get_the_title()
                        ),
                        '<span class="edit-link">',
                        '</span>'
                    );
                    ?>
                </footer><!-- .entry-footer -->
            </article><!-- #post-## -->

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
?>
