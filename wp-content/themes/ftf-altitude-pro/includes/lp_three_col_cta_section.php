<?php $lp_cta_card_group = get_field('three_col_cta_group'); ?>

<?php if ($lp_cta_card_group): ?>
    <div class="lp-ctas">
        <div class="container">
            <div class="container_inner">
                <div class="lp-cta-col">
                    <div class="lp-cta-col-inner">
                        <h3 class="lp-cta-col-title m-b-sm"><?php echo $lp_cta_card_group['three_col_cta_group_card_1']['lp_cta_card_1_title']; ?></h3>
                        <div class="lp-cta-col-content mb-3">
							<?php echo $lp_cta_card_group['three_col_cta_group_card_1']['lp_cta_card_1_content']; ?>
                        </div>
                        <a href="<?php echo $lp_cta_card_group['three_col_cta_group_card_1']['lp_cta_card_1_button_url']; ?>" class="btn btn-primary"><?php echo $lp_cta_card_group['three_col_cta_group_card_1']['lp_cta_card_1_button_text']; ?></a>
                    </div>
                </div>
                <div class="lp-cta-col">
                    <div class="lp-cta-col-inner">
                        <h3 class="lp-cta-col-title m-b-sm"><?php echo $lp_cta_card_group['three_col_cta_group_card_2']['lp_cta_card_2_title']; ?></h3>
                        <div class="lp-cta-col-content mb-3">
							<?php echo $lp_cta_card_group['three_col_cta_group_card_2']['lp_cta_card_2_content']; ?>
                        </div>
                        <a href="<?php echo $lp_cta_card_group['three_col_cta_group_card_2']['lp_cta_card_2_button_url']; ?>" class="btn btn-primary"><?php echo $lp_cta_card_group['three_col_cta_group_card_2']['lp_cta_card_2_button_text']; ?></a>
                    </div>
                </div>
                <div class="lp-cta-col">
                    <div class="lp-cta-col-inner">
                        <h3 class="lp-cta-col-title m-b-sm"><?php echo $lp_cta_card_group['three_col_cta_group_card_3']['lp_cta_card_3_title']; ?></h3>
                        <div class="lp-cta-col-content mb-3">
							<?php echo $lp_cta_card_group['three_col_cta_group_card_3']['lp_cta_card_3_content']; ?>
                        </div>
                        <a href="<?php echo $lp_cta_card_group['three_col_cta_group_card_3']['lp_cta_card_3_button_url']; ?>" class="btn btn-primary"><?php echo $lp_cta_card_group['three_col_cta_group_card_3']['lp_cta_card_3_button_text']; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>