<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 pad-40-t">
            <div class="title-section_bg mar-20-b"><h2 class="text-uppercase bold text-xlg txt-light-grey pos-abso">search by industries</h2></div>
            <?php

            $args = array(
                'orderby' => 'title',
                'post_type' => 'industries',
            );
            $the_query = new WP_Query( $args );

            ?>

            <?php

            $industry_post = get_field('industries_relatioship');

            if ( $the_query->have_posts() ): ?>
                <div class="row row-eq-height industry-section ">
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); // variable must be called $post (IMPORTANT) ?>
                        <?php setup_postdata($post); ?>
                        <div class="col-md-4 text-center flex-xs-middle pad-40-b">
                            <a href="<?php the_permalink(); ?>">
                                <figure>
                                    <img class="img-fluid pad-10-b icon-sm" src="<?php the_post_thumbnail_url(); ?>" alt="">
                                    <figcaption><?php the_field('short_name'); ?></figcaption>
                                </figure>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
            <?php endif; ?>
        </div>
        <div class="col-md-8 bg-dark-grey txt-white pad-20-b pad-40-t pad-40-l pad-40-r ">
            <div class="row">
                <div class="col-md-9 offet-md-1">
                    <div class="title-section_bg mar-20-b"><h2 class="text-uppercase bold font-lg  txt-light-grey pos-abso transparency-20">search by name</h2></div>
                    <?php echo do_shortcode('[search_by_name_list]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
