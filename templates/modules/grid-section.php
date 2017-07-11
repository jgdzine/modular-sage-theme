<?php

/**
 *  Section Grid Content Module
 */



    ?>
        <section class="section-grid-content" style="">
            <?php
                if(get_sub_field('section_title')){
                    echo  '<h3 class="section-title">'.get_sub_field('section_title').'</h3>';
                }
            $column_count =  count ( get_sub_field('section_grid_content') );
            $bs_column = ($column_count != 0 ) ? 12 / $column_count : 12;
            // check if the nested repeater field has rows of data
            if( have_rows('section_grid_content') ):

                echo '<div class="col-md-'.$bs_column.'" >';

                // loop through the rows of data
                while ( have_rows('section_grid_content') ) : the_row();

                    $column_content = get_sub_field('column_content');
                    echo $column_content;

                endwhile;

                echo '</div>';

            endif;
            ?>
        </section>
    <?php

