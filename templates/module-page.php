<?php
/**
 * Created by PhpStorm.
 * User: touchebrand
 * Date: 7/7/17
 * Time: 6:01 PM
 */

    if( have_rows('modules') ) {
        // Check if ACF is enabled and the modules field exists
        if (function_exists('get_field') && get_field('modules') !== null) {
            Roots\Sage\Extras\the_modules_loop();
        } else {
            Roots\Sage\Extras\the_module('post');
        }
    }else{
        the_content();

    }
