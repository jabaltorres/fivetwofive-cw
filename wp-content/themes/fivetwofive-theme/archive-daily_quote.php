<?php get_header(); ?>

<div class="content-area">
    <main class="site-main">

        <?php if ( have_posts() ) : ?>


            <header class="page-header">
                <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
            </header><!-- .page-header -->


            <div class="container quotes-posts">
                <div class="row">
                    <?php while ( have_posts() ) : the_post(); ?>

                    <div class="col-lg-4 col-md-6 col-sm-6 mb-3 mb-sm-4">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card p-4'); ?>>
                            <div class="entry-content mt-0">
                                <blockquote class="mb-0">
                                    <div class="quote mb-2">
                                        <?php echo wp_kses_post ( get_field('quote') ); ?>
                                    </div>
                                    <footer>
                                        - <?php echo wp_kses_post ( get_field('author') ); ?>
                                        <?php if ( get_field('citation') ) : ?>
                                        <cite title="Source Title">
                                            <a href="<?php echo wp_kses_post ( get_field('citation') ); ?>" target="_blank">Citation</a>
                                        </cite>
                                        <?php endif; ?>
                                    </footer>
                                </blockquote>
                            </div><!-- .entry-content -->
                        </article><!-- #post-## -->
                    </div>
                <?php endwhile; ?>
                </div>
            </div>

            <?php
            the_posts_pagination( array(
                'prev_text' => __( 'Previous', 'fivetwofive-theme' ),
                'next_text' => __( 'Next', 'fivetwofive-theme' ),
            ) );
            ?>

        <?php else : ?>

            <article class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php _e( 'Nothing Found', 'fivetwofive-theme' ); ?></h1>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php _e( 'It seems we can’t find what you’re looking for. Perhaps searching can help.', 'fivetwofive-theme' ); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .page-content -->
            </article><!-- .no-results -->

        <?php endif; ?>

    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
