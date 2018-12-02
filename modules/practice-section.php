<?php

$section_bg_image = get_sub_field('section_background_image');
$section_bg_color = get_sub_field('section_background_color');
$section_css_class = get_sub_field('section_css_class');
$section_css_id = get_sub_field('section_css_id');
$no_container = get_sub_field('no_container');


?>

<section id="<?php echo $section_css_id;?>" class="fullwidth-section-grid-content mar-50-b mar-10-t <?php echo $section_css_class;?>" style="
        <?php
echo ($section_bg_image) ? 'background-image: url('.$section_bg_image['url'].');' : '';
echo ($section_bg_color) ? 'background-color: '.$section_bg_color.';' : '';
?>">

    <?php

    echo  '<h3 class="section-title txt-dark-maroon mar-40-b">'.(get_sub_field('section_title')?: get_the_title()).'</h3>';
    ?>
    <div class="container">
        <?php

        /*
        *  Query posts for a relationship value.
        *  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
        */

        $attorneys = get_posts(array(
            'post_type' => 'staff',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key' => 'practice_area_relationship', // name of custom field
                    'value' => 594, // matches exaclty "123", not just 123. This prevents a match for "1234"
                    'compare' => 'LIKE'
                )
            )
        ));

        ?>
        <?php if( $attorneys ): ?>
        <div class="row">

            <?php foreach( $attorneys as $attorney ): ?>
                <?php


                ?>




                <?php


                $name = get_the_title( $attorney->ID);
                //echo gettype($name);
                if($name){
                    $e = explode(".", $name);
                    if(count($e)>1 ){
                        $names = explode(".", $name);
                    }else {
                        $names = explode(" ", $name);

                    }
                }


                $staff_title = get_field('title', $attorney->ID);
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

                    <?php if( have_rows('phone_number', $attorney->ID) ):

                        while ( have_rows('phone_number', $attorney->ID) ) : the_row() ?>
                            <?php
                            $area_code = ( get_sub_field('area_code', $attorney->ID)?: '612' );
                            $first_three = ( get_sub_field('first_three', $attorney->ID)?: '659' );
                            $last_four = ( get_sub_field('last_four', $attorney->ID)?: '9340' );

                            ?>


                            <p class="mar-5-b"><strong><a href="tel:1-<?php echo $area_code; ?>-<?php echo $first_three; ?>-<?php echo $last_four;?>">(<?php echo $area_code; ?>) <?php echo $first_three; ?>-<?php echo $last_four;?></a></strong></p>

                            <?php

                        endwhile;

                    else :

// no rows found

                    endif; ?>
                    <?php
                    $vcard = get_field('vcard', $attorney->ID);
                    $email = get_field('email', $attorney->ID);
                    ?>
                    <?php if($vcard || $email): ?>
                        <p class="mar-20-b text-uppercase"><?php if($email): ?><strong><a href="<?php echo $email; ?>">email</a></strong><?php endif; ?><?php if($vcard): ?>&nbsp;&nbsp;<strong><a href="<?php echo $vcard['url']; ?>">vCard</a></strong><?php endif; ?></p>
                    <?php endif; ?>


                </div>


            <?php endforeach; ?>

        </div>
    </div>
<?php endif; ?>


    </div><!-- #content -->
</section><!-- #primary -->

