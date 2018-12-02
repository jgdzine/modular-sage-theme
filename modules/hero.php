<?php
/**
 * Created by PhpStorm.
 * User: touchebrand
 * Date: 7/7/17
 * Time: 6:10 PM
 *
 *
 */
$hero_image = get_sub_field('background_image');
$hero_align = get_sub_field('content_alignment');
$hero_headline = get_sub_field('headline');
$hero_body = get_sub_field('content');
$button_one = get_sub_field('button_one');
$button_two = get_sub_field('button_two');


?>
<div class="hero--wrapper island-30  <?php $theme = get_sub_field("module_theme")?:'white'; echo Roots\Sage\Extras\get_theme_styles($theme); ?>" style="<?php echo ($hero_image) ? 'background: url('.$hero_image['url'].') no-repeat center/cover':'';?>">
    <div class="container">
        <div class="row">
            <div class="col island-30">
                <?php if($hero_headline): ?>
                    <h4 class="heading heading--4 mb-4" ><?php echo $hero_headline; ?></h4>
                <?php endif; ?>
                <?php if($hero_body): ?>
                    <p class="hero--body mb-4"><?php echo $hero_body; ?></p>
                <?php endif; ?>
                <?php if($button_one['button_one_content']): ?>
                    <a href="<?php echo $button_one['button_one_content']['url'];  ?>" class="btn btn-primary  btn-lg""><?php echo $button_one['button_one_content']['title']; ?></a>
                <?php endif; ?>

                <?php if($button_two['button_two_content']): ?>
                    <a href="<?php echo $button_two['button_two_content']['url']; ?>" class="btn btn-primary  btn-lg"><?php echo $button_two['button_two_content']['title']; ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
