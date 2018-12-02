<?php
/**
 * Created by PhpStorm.
 * User: joshua.giowaya
 * Date: 9/26/18
 * Time: 6:31 PM
 */

$align = get_sub_field('content_alignment');
$headline = get_sub_field('headline');
$body = get_sub_field('body_copy');

$event_list_type =  get_sub_field('event_list_type');

$event_calendar = get_sub_field('calendar');
$event_list = get_sub_field('event_list');


$button_main = get_sub_field('button_cta');

$button_list = get_sub_field('button_list');

$button_calendar = $event_calendar['button_cta_cal'];

$button_list = $event_list['button_cta_list'];


?>
<div class="container <?php echo $align; ?>">
    <div class="row island-55">
        <?php if($headline || $body):?>
            <div class="col col-md-6 mb-3">
                <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto">
                <?php if($headline):?>
                    <h4 class="heading heading--4 mb-4"><?php echo $headline; ?></h4>
                <?php endif; ?>
                <?php if($body):?>
                    <p class="lead"><?php echo $body; ?></p>
                <?php endif; ?>
                <?php if($button_main):?>
                        <a href="<?php echo $button_main['url']; ?>" class="btn btn-primary btn-block btn-lg" role="button" aria-pressed="true"><?php echo $button_main['title']; ?></a>
                <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if($headline || $body):?>
            <div class="col col-md-6">
        <?php endif; ?>

        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h3 class="uk-panel-title" data-userway-font-size="28"><i class="fa fa-calendar" data-userway-font-size="28"></i> Upcoming Events</h3>
            </div>
            <div class="card-body mt-3 p-3">
                <?php echo $event_list_type? do_shortcode('[tribe_mini_calendar]') :  do_shortcode('[tribe_events_list category="tickets-available"]'); ?>
                <?php
                  $button_toggle = $event_list_type?$button_calendar:$button_list;
                if($button_toggle): ?>
                    <a href="<?php echo $button_toggle['url']; ?>" class="btn btn-primary btn-block btn-lg" role="button" aria-pressed="true"><?php echo $button_toggle['title']; ?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php if($headline || $body):?>
            </div>
        <?php endif; ?>
    </div>
</div>
