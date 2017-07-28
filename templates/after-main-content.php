<div class="no-container-content">
    <?php

    if( have_rows('after_main_content_modules') ) {
        // Check if ACF is enabled and the modules field exists
        if (function_exists('get_field') && get_field('after_main_content_modules') !== null) {
            Roots\Sage\Extras\the_modules_loop('after_main_content_modules');
        }
    }

    ?>
</div>