<?php
/**
 * Created by PhpStorm.
 * User: touchebrand
 * Date: 7/7/17
 * Time: 6:10 PM
 *
 *
 */
$renew_align = get_sub_field('content_alignment');
$renew_headline = get_sub_field('headline');
$renew_body = get_sub_field('content');
$renew_one = get_sub_field('button_one');

$current_um_user_status = Roots\Sage\Extras\get_current_user_um_status();

?>
<?php if($current_um_user_status != 'um_bmc-current-member'): ?>
<div class="hero--wrapper <?php $theme = get_sub_field("module_theme")?:'white'; echo Roots\Sage\Extras\get_theme_styles($theme); ?>" style="text-align: center">
    <div class="container">
        <div class="row">
            <div class="col col-md-6 offset-3">
                <?php if($renew_headline): ?>
                    <h4 class="heading heading--4 mb-4" ><?php echo $renew_headline; ?></h4>
                <?php endif; ?>
                <?php if($renew_body): ?>
                    <p class="hero--body mb-4"><?php echo $renew_body; ?></p>
                <?php endif; ?>
                <?php if($renew_one['button_one_content']): ?>
                    <a href="<?php echo $renew_one['button_one_content']['url'];  ?>" class="btn btn-primary btn-lg btn-block""><?php echo $renew_one['button_one_content']['title']; ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>