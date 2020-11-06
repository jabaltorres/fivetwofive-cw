<?php 
	$title = get_sub_field('title'); 
	$image = get_sub_field('image'); 
?>
<div class="sst-module resource-section">
	<div class="container p-y-lg">
        <div class="row">
            <div class="img-col-wrapper col-xs-12 col-md-7">
                <h3><?php echo $title; ?></h3>
                <div class="thumb-wrap">
                    <img style="margin-top: 30px;" src="<?php echo $image['sizes']['large']; ?>" border="0" />
                </div>
            </div>
            <div class="resource-col-wrapper col-xs-12 col-md-5">
                <div class="m-b">
                    <h3 class="m-b-sm">Resources</h3>

                    <?php if(have_rows('resources')): ?>
                        <ul>
                            <?php while(have_rows('resources')) : the_row();
                                $file = get_sub_field('file');
                                $site_resource = get_sub_field('site_resource');
                                $title = get_sub_field('title');
                                if($file) {
                                    $filetype = pathinfo($file, PATHINFO_EXTENSION);
                                    $path = $file;
                                    $target = "_blank";
                                    $type = "pdf";
                                }
                                if($site_resource) {
                                    $filetype = get_post_type($site_resource);
                                    $path = get_permalink($site_resource);
                                    $target = "_self";
                                    $type = "link";
                                }
                                ?>
                                <li><a class="<?php echo $type; ?>" href="<?php echo $path; ?>" target="<?php echo $target; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <div>
                    <?php
                    $resources_section = get_sub_field('resources_sections');

                    foreach ($resources_section as $resources_group) {
                        echo '<h3 class="m-b-sm">'.$resources_group['title'].'</h3>';
                        $resources = $resources_group['resources'];
                        echo '<ul>';
                        foreach ($resources as $resource) {
                            $long_title = '';
                            $type = $resource['type'];
                            $pdf = $resource['pdf'];
                            $long_title = $resource['long_title'];
                            $long_class = ($long_title == true)? 'long-title': '';
                            $file =  ($pdf != '')? $pdf : $resource['url'];
                            $title = $resource['title'];
                            echo '<li><a class="'.$type.' '.$long_class.'" href="'.$file.'" target="_blank" title="'.$title.'">'.$title.'</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                </div>
            </div>
        </div>
	</div>
</div>