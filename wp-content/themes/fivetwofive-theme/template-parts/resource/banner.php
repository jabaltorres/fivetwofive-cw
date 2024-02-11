<?php
/**
 * Template part for displaying single resource banner.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FiveTwoFive_Theme
 */

// Get the creative data
$creative = get_field('ftf_resource_creative');

// Set up the background image if available
$banner_style = has_post_thumbnail()
    ? 'style="background-image: url(' . esc_url(get_the_post_thumbnail_url()) . ');"'
    : '';

?>

<header class="ftf-resource__header bg-gray py-4 py-sm-6 text-center" <?php echo $banner_style; ?>>
    <div class="container">
        <?php the_title('<h1 class="ftf-resource__title">', '</h1>'); ?>

        <?php
        if (is_array($creative) && count($creative) > 0):
            $creative_data = [
                'name'   => get_the_title($creative[0]),
                'link'   => get_field('ftf_creative_link', $creative[0]),
                'avatar' => get_the_post_thumbnail($creative[0], [80, 80], ['class' => 'ftf-avatar__image'])
            ];
            ?>

            <div class="ftf-avatar justify-content-center">
                <?php if (!empty($creative_data['avatar'])): ?>
                    <div class="ftf-avatar__image-col">
                        <?php echo wp_kses_post($creative_data['avatar']); ?>
                    </div>
                <?php endif; ?>
                <div class="ftf-avatar__details-col">
                    <p class="ftf-avatar__text"><?php esc_html_e('Author', 'fivetwofive-theme'); ?></p>
                    <h2 class="ftf-avatar__name">
                        <a href="<?php echo esc_url($creative_data['link']); ?>" target="_blank">
                            <?php echo esc_html($creative_data['name']); ?>
                        </a>
                    </h2>
                </div>
            </div>

        <?php endif; ?>
    </div>
</header>
