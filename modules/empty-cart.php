<?php
/**
 * Created by PhpStorm.
 * User: touchebrand
 * Date: 7/7/17
 * Time: 6:10 PM
 *
 *
 */
$empty_image = get_sub_field('background_image');
$empty_align = get_sub_field('content_alignment');
$empty_headline = get_sub_field('headline');
$empty_body = get_sub_field('content');
$button_one = get_sub_field('button_one');
$button_two = get_sub_field('button_two');


?>
<?php if ( WC()->cart->get_cart_contents_count() == 0 ) : ?>
    <div class="empty--wrapper island-30  <?php $theme = get_sub_field("module_theme")?:'white'; echo Roots\Sage\Extras\get_theme_styles($theme); ?>" style="<?php echo ($empty_image) ? 'background: url('.$empty_image['url'].') no-repeat center/cover':'';?>">
        <div class="container">
            <div class="row">
                <div class="col island-30">
                    <?php if($empty_headline): ?>
                        <h4 class="heading heading--4 mb-4" ><?php echo $empty_headline; ?></h4>
                    <?php endif; ?>
                    <?php if($empty_body): ?>
                        <p class="empty--body mb-4"><?php echo $empty_body; ?></p>
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
<?php endif; ?>