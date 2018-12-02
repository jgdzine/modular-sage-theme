<?php
/**
 * Created by PhpStorm.
 * User: joshua.giowaya
 * Date: 9/26/18
 * Time: 6:31 PM
 */


$headline = get_sub_field('headline');
$body = get_sub_field('body');

$panel = get_sub_field('sides');

$left_panel = $panel['left_side'];

$right_panel = $panel['right_side'];

$panel_headline_left = $left_panel['panel_headline_left'];

$fee_one_left = $left_panel['fee_one_left'];

$fee_one_duration_left = $left_panel['fee_one_duration_left'];

$fee_two_left = $left_panel['fee_two_left'];

$fee_two_duration_left = $left_panel['fee_two_duration_left'];

$plan_details_left = $left_panel['plan_details_left'];

$button_cta_left = $left_panel['cta_button_left'];



$panel_headline_right = $right_panel['panel_headline_right'];

$fee_one_right = $right_panel['fee_one_right'];

$fee_one_duration_right = $right_panel['fee_one_duration_right'];

$fee_two_right = $right_panel['fee_two_right'];

$fee_two_duration_right = $right_panel['fee_two_duration_right'];

$plan_details_right = $right_panel['plan_details_right'];

$button_cta_right = $right_panel['cta_button_right'];



?>
<div class="container island-55">
    <?php if($headline || $body):?>
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <?php if($headline):?>
                <h4 class="heading heading--4"><?php echo $headline; ?></h4>
            <?php endif; ?>
            <?php if($headline):?>
                <p class="lead"><?php echo $body; ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if($headline || $body):?>
    <div class="card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal"></h4><?php echo $panel_headline_left; ?></h4>
            </div>
            <div class="card-body mt-3 p-3">
                <h1 class="card-title pricing-card-title">$<?php echo $fee_one_left; ?> <small class="text-muted"><?php echo $fee_one_duration_left; ?></small></h1>
                <h1 class="card-title pricing-card-title <?php echo $fee_two_left?'visible':'invisible';  ?>">$<?php echo $fee_two_left; ?> <small class="text-muted"><?php echo $fee_two_duration_left; ?></small></h1>
                <?php if($plan_details_left) : ?>
                <ul class="list-unstyled mt-3 mb-4">
                    <?php if($plan_details_left):

                    foreach ($plan_details_left as &$value) : ?>

                            <li><?php echo $value['detail'] ?></li>

                        <?php  endforeach; else : endif; ?>
                </ul>
                <?php endif; ?>
                <?php if($button_cta_left) : ?>
                    <a href="<?php echo $button_cta_left['url'] ?>" class="btn btn-primary btn-block btn-lg" role="button" aria-pressed="true"><?php echo $button_cta_left['title'] ?></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal"></h4><?php echo $panel_headline_right; ?></h4>
            </div>
            <div class="card-body mt-3 p-3">
                <h1 class="card-title pricing-card-title">$<?php echo $fee_one_right; ?> <small class="text-muted"><?php echo $fee_one_duration_right; ?></small></h1>
                <h1 class="card-title pricing-card-title <?php echo $fee_two_right?'visible':'invisible';  ?>">$<?php echo $fee_two_right; ?> <small class="text-muted"><?php echo $fee_two_duration_right; ?></small></h1>
                <?php if($plan_details_right) : ?>
                    <ul class="list-unstyled mt-3 mb-4">
                        <?php if($plan_details_right):

                            foreach ($plan_details_right as &$value) : ?>

                                <li><?php echo $value['detail'] ?></li>

                            <?php  endforeach; else : endif; ?>
                    </ul>
                <?php endif; ?>
                <?php if($button_cta_right) : ?>
                    <a href="<?php echo is_user_logged_in()? Roots\Sage\Extras\get_user_profile_edit_page_url() :$button_cta_right['url']; ?>" class="btn btn-primary btn-block btn-lg" role="button" aria-pressed="true"><?php  echo $button_cta_right['title'] ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>