<footer id="page-footer" class="content-info clearfix">
  <div class="container">
      <?php

      if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
          <div class="widget-area" role="complementary">
              <?php dynamic_sidebar( 'sidebar-footer' ); ?>
          </div>
      <?php else:

          if( have_rows('footer_modules','option') ):

              // loop through the rows of data
              while ( have_rows('footer_modules', 'option') ) : the_row();

                  // display a sub field value
                  $background_image = get_sub_field('background_image', 'option');
                  $content = get_sub_field('content', 'option');
                  $col_css = get_sub_field('footer_settings');
                  $rand_col_class = 'footer-'.rand(11111,999999);
                  ?>
                  <section class="fullwidth-section-grid-content footer-content <?php echo $rand_col_class?>" style="
        <?php
                  echo ($background_image) ? 'background-image: url('.$background_image['url'].');' : '';
                  ?>">
                      <?php the_sub_field('content', 'option');?>
                  </section>

                  <?php


                  if($col_css) {
                      echo ' <style type="text/css">'.
                          '.'.$rand_col_class .'{';
                      foreach ($col_css as $key=>$value){
                          echo $key .':'.$value,';';
                      }
                      echo  '}
                                    </style>';
                  }
              endwhile;

          endif;

      endif; ?>
  </div>
</footer>

<?php

if( have_rows('bottom_footer_modules','option') ):

    // loop through the rows of data
    while ( have_rows('bottom_footer_modules', 'option') ) : the_row();

        // display a sub field value
        $background_image = get_sub_field('background_image', 'option');
        $content = get_sub_field('content', 'option');
        $col_css = get_sub_field('footer_settings');
        $rand_col_class = 'bottom-footer-'.rand(11111,999999);
        ?>
        <section class="bottom-footer-content <?php echo $rand_col_class?>" style="
        <?php
        echo ($background_image) ? 'background-image: url('.$background_image['url'].');' : '';
        ?>">
            <?php the_sub_field('content', 'option');?>
        </section>

        <?php


        if($col_css) {
            echo ' <style type="text/css">'.
                '.'.$rand_col_class .'{';
            foreach ($col_css as $key=>$value){
                echo $key .':'.$value,';';
            }
            echo  '}
                                    </style>';
        }
    endwhile;

endif;

