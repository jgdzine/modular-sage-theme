<?php
/**
 *  Query First Letter of Post
 *
 */




function query_first_letter($first_char) {

    global $wpdb;
    $postids = $wpdb->get_col($wpdb->prepare("
	SELECT      ID
	FROM        $wpdb->posts
	WHERE       SUBSTR($wpdb->posts.post_title,1,1) = %s
	AND 		$wpdb->posts.post_type = 'product'
	ORDER BY    $wpdb->posts.post_title",$first_char));
    if ( $postids ) {
        $args = array(
            'post__in' => $postids,
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'caller_get_posts'=> 1
        );
        $my_query = null;
        $my_query = new WP_Query($args);
        if( $my_query->have_posts() ) {
            echo '<p>List of Posts Titles beginning with the letter <strong>'. $first_char . '<strong></p>';
            $counter = 1;
            while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <p>
                    <span><?php echo $counter++; ?></span>
                    <a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                </p>
            <?php endwhile;
        }
        wp_reset_query();
    }
}


//add_action('pre_get_posts','alter_query');

//function alter_query($query) {
//    //gets the global query var object
//    global $wp_query;
//
//    //gets the front page id set in options
//    $front_page_id = get_option('page_on_front');
//
//    if ( 'page' != get_option('show_on_front') || $front_page_id != $wp_query->query_vars['page_id'] )
//        return;
//
//    if ( !$query->is_main_query() )
//        return;
//
//    $query-> set('post_type' ,'page');
//    $query-> set('post__in' ,array( $front_page_id , [YOUR SECOND PAGE ID]  ));
//	$query-> set('orderby' ,'post__in');
//	$query-> set('p' , null);
//	$query-> set( 'page_id' ,null);
//
//	//we remove the actions hooked on the '__after_loop' (post navigation)
//	remove_all_actions ( '__after_loop');
//}