<?php get_header(); ?>

<div class="content-area">
    <main class="site-main">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php $music_file = get_field( 'music_file' ); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <header class="entry-header bg-primary text-center mb-5">
                    <h1 class="entry-title mb-0"><?php the_title(); ?></h1>
                </header><!-- .entry-header -->

                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-12 col-lg-8">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <figure class="entry-thumbnail text-center mb-4">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </figure>
                            <?php endif; ?>

                            <div class="entry-content">
                                <?php if ( $music_file ) : ?>
                                    <div class="music-file mb-4">
                                        <audio controls>
                                            <source src="<?php echo esc_url( $music_file['url'] ); ?>" type="audio/mpeg">
                                            <?php esc_html_e( 'Your browser does not support the audio element.', 'fivetwofive-theme' ); ?>
                                        </audio>
                                    </div><!-- .music-file -->
                                <?php endif; ?>

                                <div class="music-meta mb-4">
                                    <span class="posted-on"><?php echo get_the_date(); ?></span>
                                    <span class="byline"> <?php _e('by', 'fivetwofive-theme'); ?> <?php the_author_posts_link(); ?></span>

                                    <?php
                                    $genres = get_the_terms( get_the_ID(), 'music_genre' );
                                    if ( $genres && ! is_wp_error( $genres ) ) :
                                        $genre_links = array_map( function( $genre ) {
                                            return '<a href="' . esc_url( get_term_link( $genre ) ) . '">' . esc_html( $genre->name ) . '</a>';
                                        }, $genres );
                                        $genres_list = join( ', ', $genre_links );
                                        ?>
                                        <span class="music-genres"> | <?php _e('Genres:', 'fivetwofive-theme'); ?> <?php echo $genres_list; ?></span>
                                    <?php endif; ?>

                                    <?php
                                    $music_types = get_the_terms( get_the_ID(), 'music_type' );
                                    if ( $music_types && ! is_wp_error( $music_types ) ) :
                                        $music_type_links = array_map( function( $music_type ) {
                                            return '<a href="' . esc_url( get_term_link( $music_type ) ) . '">' . esc_html( $music_type->name ) . '</a>';
                                        }, $music_types );
                                        $music_types_list = join( ', ', $music_type_links );
                                        ?>
                                        <span class="music-types"> | <?php _e('Type:', 'fivetwofive-theme'); ?> <?php echo $music_types_list; ?></span>
                                    <?php endif; ?>
                                </div><!-- .music-meta -->

                                <?php the_content(); ?>

                                <?php
                                wp_link_pages( array(
                                    'before' => '<div class="page-links">' . __( 'Pages:', 'fivetwofive-theme' ),
                                    'after'  => '</div>',
                                ) );
                                ?>
                            </div><!-- .entry-content -->
                        </div>
                    </div>
                </div>

                <footer class="entry-footer">
                    <?php if ( comments_open() || get_comments_number() ) : ?>
                        <?php comments_template(); ?>
                    <?php endif; ?>
                </footer><!-- .entry-footer -->
            </article><!-- #post-## -->

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="post-navigation">
                            <div class="nav-links">
                                <div class="nav-previous">
                                    <?php previous_post_link( '%link', __( 'Previous Post: %title', 'fivetwofive-theme' ) ); ?>
                                </div>
                                <div class="nav-next">
                                    <?php next_post_link( '%link', __( 'Next Post: %title', 'fivetwofive-theme' ) ); ?>
                                </div>
                            </div><!-- .nav-links -->
                        </nav><!-- .post-navigation -->
                    </div>
                </div>
            </div>

        <?php endwhile; else : ?>

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
