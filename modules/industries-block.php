<?php

/**
 *  Section Grid Content Module
 */


    $section_bg_image = get_sub_field('section_background_image');
    $section_bg_color = get_sub_field('section_background_color');
    ?>
        <section class="section-grid-content" style="
        <?php
            echo ($section_bg_image) ? 'background-image: url('.$section_bg_image['url'].');' : '';
            echo ($section_bg_color) ? 'background-color: '.$section_bg_color.';' : '';
        ?>">

            <?php
                if(get_sub_field('section_title')){
                    echo  '<h3 class="section-title">'.get_sub_field('section_title').'</h3>';
                }?>

            <div class="container">
                <?php
                $column_count =  count ( get_sub_field('column_grid_content') );
                $column_height = get_sub_field('column_height') . 'px';
                $bs_column = ($column_count != 0 ) ? 12 / $column_count : 12;
                // check if the nested repeater field has rows of data
                if( have_rows('column_grid_content') ):
                    echo '<div class="row">';

                    // loop through the rows of data
                    while ( have_rows('column_grid_content') ) : the_row();
                        $col_bg_image = get_sub_field('column_background_image');
                        $col_bg_color = get_sub_field('column_background_color');
                        $grid_size = get_sub_field('grid_size');
                        $bs_column = ($grid_size) ? $grid_size : $bs_column;

                        echo '<aside class="column-grid-content col-md-'.$bs_column.'" style="background-color: '.$col_bg_color.';background-image: url('. $col_bg_image['url'] .'); min-height: '.$column_height.';" >';
                            the_sub_field('column_content');
                        echo '</aside>';
                    endwhile;

                    echo '</div>';

                endif;
            ?>
            </div>
        </section>
    <?php

