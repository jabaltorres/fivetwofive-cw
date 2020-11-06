<?php
$module_heading = get_sub_field('module_heading');
$module_sub_heading = get_sub_field('module_sub_heading');
$case_studies = get_sub_field('case_studies');

if ($case_studies){ ?>
    <div class="sst-module case-study-view-section">
        <div class="overlay-white p-y-lg">
            <div class="container">

                <?php if ($module_heading || $module_sub_heading): ?>
                    <div class="row m-b">
                        <div class="col-xs-12 text-center">
                            <?php if ($module_heading): ?>
                                <h3 class="module-heading h2"><?=$module_heading;?></h3>
                            <?php endif;?>
                            <?php if ($module_sub_heading): ?>
                                <h4 class="module-sub-heading h3"><?=$module_sub_heading;?></h4>
                            <?php endif;?>
                        </div>
                    </div>
                <?php endif;?>

                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                        <div class="row">
                            <?php
                                foreach ($case_studies as $cs) {
                                    echo '<div class="col-xs-12 col-sm-6 text-center"><a href="'.$cs['case_study_url'].'" target="_blank" title="'.$cs['case_study_title'].'"><img src="'.$cs['case_study_image'].'" class="cs-img" /><h4>'.$cs['case_study_title'].'</h4></a></div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>