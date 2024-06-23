<?php get_header(); ?>

<div class="content-area">
    <main class="site-main">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
            </header><!-- .page-header -->


            <div class="featured container mb-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2>Featured Content</h2>
                    </div>
                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                        <div class="card text-center">
                            <div class="h5 mb-0">
                                <a href="/music-type/beats/" class="d-block p-4 fw-bold">Beats</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                        <div class="card text-center">
                            <div class="h5 mb-0">
                                <a href="/the-jump-off-vol-1/" class="d-block p-4 fw-bold">The Jump Off Vol. 1</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                        <div class="card text-center">
                            <div class="h5 mb-0">
                                <a href="/music-type/songs/" class="d-block p-4 fw-bold">Songs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="categories container d-none">
                <div class="row">
                    <div class="col-12">
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'music_type',
                            'hide_empty' => true,
                        ));

                        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
                            echo '<div class="heading">Categories:</div>';
                            echo '<ul>';
                            foreach ( $categories as $category ) :
                                echo '<li><a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a></li>';
                            endforeach;
                            echo '</ul>';
                        else :
                            echo '<p>' . __( 'No categories found.', 'fivetwofive-theme' ) . '</p>';
                        endif;
                        ?>
                    </div>
                </div>
            </div><!-- .categories -->

            <div class="container music-posts">
                <div class="row">
                    <?php while ( have_posts() ) : the_post(); ?>

                    <div class="col-lg-4 col-md-6 col-sm-6 mb-3 mb-sm-4">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card p-4'); ?>>

                            <?php
                            if ( has_post_thumbnail() ) {
                                echo '<div class="thumbnail-wrapper mb-2">';
                                echo '<a href="' . esc_url( get_permalink() ) . '">';
                                the_post_thumbnail();
                                echo '</a>';
                                echo '</div>';
                            }
                            ?>

                            <header class="entry-header p-0">
                                <h1 class="entry-title h5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            </header><!-- .entry-header -->

                            <div class="entry-content mt-0">
                                <?php the_excerpt(); ?>
                            </div><!-- .entry-content -->

                            <footer class="entry-footer mb-3">
                                <?php
                                $terms = get_the_terms( $post->ID, 'music_type' );
                                if ( $terms && ! is_wp_error( $terms ) ) :
                                    $term_slugs_arr = array();
                                    foreach ( $terms as $term ) {
                                        $term_slugs_arr[] = $term->slug;
                                    }
                                    $terms_slug_str = join( ", ", $term_slugs_arr );
                                    ?>
                                    <span class="music-type">Type: <?php echo $terms_slug_str; ?></span>
                                <?php endif; ?>
                            </footer><!-- .entry-footer -->
                            <a href="<?php the_permalink(); ?>" class="button read-more"><?php _e('Read More', 'fivetwofive-theme'); ?></a>
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

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
