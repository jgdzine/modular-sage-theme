<?php
/**
 * Created by PhpStorm.
 * User: touchebrand
 * Date: 7/7/17
 * Time: 6:10 PM
 *
 *
 */

$shortcode_headline = get_sub_field('headline');
$shortcode_bddy = get_sub_field('content');
$shortcode = get_sub_field('short_code_options');



?>
<div class="container">
    <div class="row">
        <div class="col island-30">
            <?php if($hero_headline): ?>
                <h4 class="heading heading--4 mb-4" ><?php echo $hero_headline; ?></h4>
            <?php endif; ?>
            <?php if($hero_bddy): ?>
                <p class="hero--body mb-4"><?php echo $hero_bddy; ?></p>
            <?php endif; ?>
            <?php echo do_shortcode("[$shortcode]"); ?>
        </div>
    </div>
</div>
