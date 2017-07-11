<?php

/**
 *  Section Grid Content Module
 */


    $section_bg_image = get_sub_field('section_background_image');
    ?>
        <section class="section-grid-content" style="<?php echo ($section_bg_image) ? 'background: url('.$section_bg_image['url'].') no-repeat top/contain;' : ''; ?>">
            <?php
                if(get_sub_field('section_title')){
                    echo  '<h3 class="section-title">'.get_sub_field('section_title').'</h3>';
                }
                $column_count =  count ( get_sub_field('column_grid_content') );
                $bs_column = ($column_count != 0 ) ? 12 / $column_count : 12;
                // check if the nested repeater field has rows of data
                if( have_rows('column_grid_content') ):
                    echo '<div class="row">';

                    // loop through the rows of data
                    while ( have_rows('column_grid_content') ) : the_row();
                        $col_bg_image = get_sub_field('column_background_image');
                        echo '<aside class="col-md-'.$bs_column.'" style="background: url('. $col_bg_image['url'] .') no-repeat center bottom; min-height: 438px;">';
                            the_sub_field('column_content');
                        echo '</aside>';
                    endwhile;

                    echo '</div>';

                endif;
            ?>
        </section>
    <?php

