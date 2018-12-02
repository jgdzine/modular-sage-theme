
<?php

/**
 *  Section Grid Content Module
 */


    $section_bg_image = get_sub_field('section_background_image');
    $section_bg_color = get_sub_field('section_background_color');
    $section_css_class = get_sub_field('section_css_class');
    $section_css_id = get_sub_field('section_css_id');
    $no_container = get_sub_field('no_container');

    $staff_type =  get_sub_field('list_by_title');
    if($staff_type === 'partner'){
        $staff_type = array('partner','managing-partner');

    }
    $args = array(
        'posts_per_page'    => -1,
        'post_type'		    => 'staff',
        'meta_key'		    => 'title',
        'meta_value'	    => $staff_type,
        );
    $posts=get_posts($args);

    if( $posts ): ?>

        <section id="<?php echo $section_css_id;?>" class="fullwidth-section-grid-content mar-50-b mar-50-t <?php echo $section_css_class;?>" style="
        <?php
            echo ($section_bg_image) ? 'background-image: url('.$section_bg_image['url'].');' : '';
            echo ($section_bg_color) ? 'background-color: '.$section_bg_color.';' : '';
        ?>">

            <?php
                if(get_sub_field('section_title')){
                    echo  '<h3 class="section-title">'.get_sub_field('section_title').'</h3>';
                }?>
            <div class="container">


                    <div class="row">

                        <?php foreach( $posts as $post ):

                            setup_postdata( $post );
                            $name = get_the_title();
                            //echo gettype($name);
                            if($name){
                                $e = explode(".", $name);
                                if(count($e)>1 ){
                                    $names = explode(".", $name);
                                }else {
                                    $names = explode(" ", $name);

                                }
                            }


                            $staff_title = get_field('title');
                            ?>

                           <div class="col-md-3">
                               <?php if($name): ?>
                                 <a href="<?php the_permalink() ?>">
                                   <h4 class="crimson-text txt-dark-maroon mar-2-b"><?php echo $names[0]; ?></h4>
                                   <h4 class="txt-dark-maroon mar-2-b"><?php echo $names[1]; ?></h4>
                                 </a>
                               <?php endif; ?>
                               <?php if($staff_title): ?>
                                   <p class="mar-10-b txt-dark-maroon text-uppercase"><strong><?php echo $staff_title['label'];?></strong></p>
                               <?php endif; ?>

                               <?php if( have_rows('phone_number') ):

                                   while ( have_rows('phone_number') ) : the_row() ?>
                                       <?php
                                       $area_code = ( get_sub_field('area_code')?: '612' );
                                       $first_three = ( get_sub_field('first_three')?: '659' );
                                       $last_four = ( get_sub_field('last_four')?: '9340' );

                                       ?>


                                       <p class="mar-5-b"><strong><a href="tel:1-<?php echo $area_code; ?>-<?php echo $first_three; ?>-<?php echo $last_four;?>">(<?php echo $area_code; ?>) <?php echo $first_three; ?>-<?php echo $last_four;?></a></strong></p>

                                       <?php

                                   endwhile;

                               else :

// no rows found

                               endif; ?>
                               <?php
                               $vcard = get_field('vcard');
                               $email = get_field('email');
                               ?>
                               <?php if($vcard || $email): ?>
                                   <p class="mar-20-b text-uppercase"><?php if($email): ?><strong><a href="<?php echo $email; ?>">email</a></strong><?php endif; ?><?php if($vcard): ?>&nbsp;&nbsp;<strong><a href="<?php echo $vcard['url']; ?>">vCard</a></strong><?php endif; ?></p>
                               <?php endif; ?>


                           </div>


                        <?php endforeach; ?>

                    </div>

                    <?php wp_reset_postdata(); ?>
            </div>
        </section>
    <?php endif;

