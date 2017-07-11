<?php

/**
 *  Section Grid Content Module
 */


?>
<section class="page-slider">


    <?php
        //Load Slides
        if( have_rows('page_slider') ):

            echo '<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">';

            // loop through the rows of data
            while ( have_rows('page_slider') ) : the_row();

                $slider_image = get_sub_field('background_img');
                $slide_title = get_sub_field('slide_title');

                ?>

                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" src="<?php echo $slider_image['url'];?>" alt="<?php echo $slide_title;?>">
                    </div>
                </div>
                <?php
            endwhile;

            echo '<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                ';

        endif;
    ?>
</section>
