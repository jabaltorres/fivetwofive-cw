<?php
// ACF Global Button Clone
$button = get_sub_field('global_button_group');
$buttonText = $button['ftf_button_text'];
$buttonURL = $button['ftf_button_url'];
$buttonExtLink = $button['ftf_button_external_link'];

$buttonStyle = $button['ftf_button_style'];
if ($buttonStyle == "Primary"){
    $button_style_class = "btn-primary";
} elseif ($buttonStyle == "Secondary") {
    $button_style_class = "btn-secondary";
} else {
    $button_style_class = "";
}

if ($buttonExtLink){
    $buttonTarget = '_blank';
} else {
    $buttonTarget = '_self';
}

if ($buttonText && $buttonURL) : ?>
    <a class="btn <?= $button_style_class;?>" target="<?= $buttonTarget;?>" href="<?= $buttonURL; ?>"><?= $buttonText; ?></a>
<?php endif; ?>
