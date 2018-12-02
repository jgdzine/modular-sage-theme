<?php

/**
 *  Section Grid Content Module
 */


?>
<!--<section class="page-slider">-->
<!---->
<!---->
<!--    --><?php
//        //Load Slides
//        if( have_rows('page_slider') ):
//
//            echo '<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">';
//
//            // loop through the rows of data
//            while ( have_rows('page_slider') ) : the_row();
//
//                $slider_image = get_sub_field('background_img');
//                $slide_title = get_sub_field('slide_title');
//
//                ?>
<!---->
<!--                <div class="carousel-inner" role="listbox">-->
<!--                    <div class="carousel-item active">-->
<!--                        <img class="d-block img-fluid" src="--><?php //echo $slider_image['url'];?><!--" alt="--><?php //echo $slide_title;?><!--">-->
<!--                    </div>-->
<!--                </div>-->
<!--                --><?php
//            endwhile;
//
//            echo '<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
//                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
//                        <span class="sr-only">Previous</span>
//                    </a>
//                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
//                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
//                        <span class="sr-only">Next</span>
//                    </a>
//                </div>
//                ';
//
//        endif;
//    ?>
<!--</section>-->
<?php
$slider_height = get_sub_field('slider_height');
$text_color = get_sub_field('text_color');


//Load Slides
if( have_rows('header_slider') ): ?>
    <div class="row no-gutters">

    <section class="header-slider clearfix col-12 ">
        <?php
        echo '<div id="carouselHeader" class="carousel slide" data-ride="carousel"><div class="carousel-inner" role="listbox">';
        // loop through the rows of data
        $slide_number = 1;
        while ( have_rows('header_slider') ) : the_row();



            $slide_image = get_sub_field('slide_image');
            $slide_title = get_sub_field('slide_title');
            $slide_description = get_sub_field('slide_description',false);
//            $page_link = get_sub_field('page_link');
//            $hero_bddy = get_sub_field('content');
            $button_one = get_sub_field('button_one');
           // print_r($button_one);

            ?>


            <div class="carousel-item <?php  echo ($slide_number == 1) ? 'active' : '';?>"
                 style="<?php echo ($slide_image) ? 'background: url('.$slide_image['url'].') no-repeat center/cover':'';?>;
                 <?php echo $slider_height ? 'min-height:'.$slider_height .'px' :'';?>;
                 <?php echo $text_color ? 'color:'.$text_color:'';?>">

                <section class="carousel-caption">
                    <h1  class="headilng heading--1"><?php echo $slide_title;?></h1>
                    <h4 class="slide-description mb-4"><?php echo $slide_description;?></h4>
                    <?php if($button_one): ?>
                        <a href="<?php echo $button_one['url'];  ?>" target="<?php echo $button_one['target'];  ?>"" class="btn btn-secondary btn-lg""><?php echo $button_one['title']; ?></a>
                    <?php endif; ?>
                </section>
            </div>

            <?php
            $slide_number++;
        endwhile;

        echo '</div><a class="carousel-control-prev" href="#carouselHeader" role="button" data-slide="prev">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselHeader" role="button" data-slide="next">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                ';?>
    </section>
    </div>
<?php  endif;?>


