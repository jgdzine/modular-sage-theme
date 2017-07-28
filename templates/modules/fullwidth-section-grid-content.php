<?php

/**
 *  Section Grid Content Module
 */


    $section_bg_image = get_sub_field('section_background_image');
    $section_bg_color = get_sub_field('section_background_color');
    $section_css_class = get_sub_field('section_css_class');
    $section_css_id = get_sub_field('section_css_id');
    $no_container = get_sub_field('no_container');


    ?>
        <section id="<?php echo $section_css_id;?>" class="fullwidth-section-grid-content <?php echo $section_css_class;?>" style="
        <?php
            echo ($section_bg_image) ? 'background-image: url('.$section_bg_image['url'].');' : '';
            echo ($section_bg_color) ? 'background-color: '.$section_bg_color.';' : '';
        ?>">
            <div class="<?php echo ($no_container) ? 'no-container' : 'container-fluid'?>">
            <?php
                if(get_sub_field('section_title')){
                    echo  '<h3 class="section-title">'.get_sub_field('section_title').'</h3>';
                }
                $column_count =  count ( get_sub_field('column_grid_content') );
                $column_height = get_sub_field('column_height') . 'px';
                $bs_column = ($column_count != 0 ) ? 12 / $column_count : 12;
                // check if the nested repeater field has rows of data
                if( have_rows('column_grid_content') ):
                    echo '<section class="row first-row">';
                    // loop through the rows of data
                    $count = 0;
                    while ( have_rows('column_grid_content') ) : the_row();
                        $col_bg_image = get_sub_field('column_background_image');
                        $column_classes = get_sub_field('column_classes');
                        $rand_col_class = 'col-'.rand(11111,999999);
                        $col_css = get_sub_field('column_settings');
                        $grid_size = get_sub_field('grid_size');
                        $bs_column = (get_sub_field('custom_column_grid')) ? $grid_size : $bs_column;



                        echo '<aside  class="column-grid-content '.$column_classes.' '. $rand_col_class .' col-md-'.$bs_column.'" style="background-image: url('. $col_bg_image['url'] .'); min-height: '.$column_height.';" >';
                                    the_sub_field('column_content');
                        echo '</aside>';
                        // Load Column CSS
                        if($col_css) {
                            echo ' <style type="text/css">'.
                                '.'.$rand_col_class .'{';
                            foreach ($col_css as $key=>$value){
                                echo $key .':'.$value,';';
                            }
                            echo  '}
                                    </style>';
                        }

                    $count++;
                    endwhile;

                    echo '</section>';

                endif;
            ?>
            </div>
        </section>
    <?php

