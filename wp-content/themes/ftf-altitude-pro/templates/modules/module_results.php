<?php
    $results_module_background_color = get_sub_field('results_module_background_color');
    $results_module_heading = get_sub_field('results_module_heading');
    $results_module_sub_heading = get_sub_field('results_module_sub_heading');
    $result_module_body_copy = get_sub_field('result_module_body_copy');
    $result_items = get_sub_field('result_items');
?>

<div class="sst-module module-results p-y-lg" style="background-color:<?= $results_module_background_color; ?>;">
    <div class="container">
        <div class="row">
            <?php if ($results_module_heading) :?>
                <div class="col-xs-12">
                    <h3 class="results-module-heading h2 text-center m-t-0 m-b-sm"><?= $results_module_heading; ?></h3>
                </div>
            <?php endif; ?>

            <?php if ($results_module_sub_heading) :?>
                <div class="col-xs-12">
                    <h4 class="results-module-subheading h3 text-center m-t-0 m-b-sm"><?= $results_module_sub_heading; ?></h4>
                </div>
            <?php endif; ?>

            <?php if ($result_module_body_copy) :?>
                <div class="col-xs-12">
                    <div class="result-module-body-copy"><?= $result_module_body_copy; ?></div>
                </div>
            <?php endif; ?>
        </div>

        <?php if ( $result_items ): ?>
            <div class="row result-items-wrapper">
                <?php foreach( $result_items as $post ):

                    // Setup this post for WP functions (variable must be named $post).
                    setup_postdata($post);
                ?>

                    <?php
                        $results_title = get_field('results_title');
                        $results_description = get_field('results_description');
                        $results_stat = get_field('results_stat');
                        $results_button = get_field('results_button');

                        $result_button_open_new_tab = $results_button['result_button_open_new_tab'];

                        if ( $result_button_open_new_tab){
                            $result_button_target =  'target="_blank" rel="noopener noreferrer"';
                        } else {
                            $result_button_target = '';
                        }
                    ?>

                    <div class="results-item col-xs-12 col-md-4 m-b">
                        <div class="results-item-inner-wrapper text-center p-y p-x-sm border border-dark border-radius bg-white">
<!--                            <a class="d-block h3 m-b-sm" href="--><?php //the_permalink(); ?><!--">--><?php //the_title(); ?><!--</a>-->

<!--                            --><?php //if( ! empty( $post->post_title ) ) : ?>
<!--                                <h3 class="m-b-sm">--><?php //the_title(); ?><!--</h3>-->
<!--                            --><?php //endif; ?>

                            <?php if ( $results_title ) :?>
                                <h3 class="m-b-sm"><?= $results_title; ?></h3>
                            <?php endif; ?>

                            <?php if ( $results_stat ) :?>
                                <div class="d-block stat display-4 m-t-0 m-b-sm text-red font-weight-lighter"><?= $results_stat; ?></div>
                            <?php endif; ?>

                            <?php if ( $results_description ) :?>
                                <div class="d-block description font-weight-bold"><?= $results_description; ?></div>
                            <?php endif; ?>

                            <?php if ( $results_button['results_button_link'] && $results_button['results_button_text'] ):?>
                                <a class="btn btn-primary m-t-sm" href="<?= $results_button['results_button_link']; ?>" <?= $result_button_target; ?>><?= $results_button['results_button_text']; ?></a>
                            <?php endif; ?>

                            <?php
                                if (is_user_logged_in()){
                                    echo '<br/>';
                                }
                                edit_post_link(__('Edit'));
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php
            // Reset the global post object so that the rest of the page works correctly.
            wp_reset_postdata();
            endif;
        ?>
    </div>
</div>


<script type="text/javascript">
    jQuery(document).ready(function($) {
        // $('.results-item').each(function(fadeInDiv){
            // $(this).delay(fadeInDiv * 300).fadeIn(300);
            // $(this).delay(fadeInDiv * 300).addClass('fade-in');

        // });

        // Get all elements
        $('.results-item').each(function(i,el) {
            var $this = $(this);
            var $resultsFadeInSpeed = 200;
            setTimeout(function() {
                $this.addClass('fade-in');
                // $this.addClass('fade-in').addClass('visible').removeClass('fade-in');
            }, i * $resultsFadeInSpeed); // milliseconds
        });
    });
</script>