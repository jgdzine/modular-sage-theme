<?php

$header_image =  get_field('header_logo','option');
?>

<header class="banner clearfix">
  <div class="container-fluid">
      <section class="row-fluid">
          <a class="brand" href="<?= esc_url(home_url('/')); ?>"><img src="<?php echo $header_image['url'];?>" alt="<?php echo get_bloginfo('name')?>"/></a>
          <nav class="nav-primary">
              <?php
              if (has_nav_menu('primary_navigation')) :
                  wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
              endif;
              ?>
          </nav>
      </section>
  </div>
</header>

<section class="header-slider clearfix">
    <?php
    //Load Slides
    if( have_rows('header_slider') ):

        echo '<div id="carouselHeader" class="carousel slide" data-ride="carousel"><div class="carousel-inner" role="listbox">';
        $slider_height = get_field('slider_height');
        $text_color = get_field('text_color');
        // loop through the rows of data
        $slide_number = 1;
        while ( have_rows('header_slider') ) : the_row();



            $slide_image = get_sub_field('slide_image');
            $slide_title = get_sub_field('slide_title');
            $slide_description = get_sub_field('slide_description',false);
            $page_link = get_sub_field('page_link');
            $button_text = get_sub_field('button_text');

            ?>


                <div class="carousel-item <?php  echo ($slide_number == 1) ? 'active' : '';?>"
                     style="<?php echo ($slide_image) ? 'background: url('.$slide_image['url'].') no-repeat center/cover':'';?>;
                            <?php echo ($slider_height) ? 'min-height:'.$slider_height .'px' :'';?>;
                            <?php echo ($text_color) ? 'color:'.$text_color:'';?>">
                    <section class="container-fluid">
                        <div class="row-fluid">
                            <aside class="col-md-12">
                                <h1 class="slide-title crimson-text"><?php echo $slide_title;?></h1>
                                <h4 class="slide-description crimson-text italic"><?php echo $slide_description;?></h4>
                                <a href="<?php echo $page_link;?>" class="btn btn-secondary"><?php echo $button_text;?></a>
                            </aside>
                        </div>
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
                ';

    endif;
    ?>
</section>

