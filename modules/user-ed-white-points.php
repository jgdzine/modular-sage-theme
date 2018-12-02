<?php
/**
 * Created by PhpStorm.
 * User: touchebrand
 * Date: 7/7/17
 * Time: 6:10 PM
 *
 *
 */
//print_r(Roots\Sage\Extras\get_bmc_active_member_ed_white_points(34));
//
//
//print_r(Roots\Sage\Extras\user_role_update_getter(34));
//echo Roots\Sage\Extras\user_role_update_getter(34);
//echo $custom_points = get_field('custom_ed_white_points', 'user_34');
//echo '<pre>';
//$attendee_event_array = tribe_tickets_get_attendees(3055);
//print_r($attendee_event_array[0]['user_id']);
//echo ($attendee_event_array[0]['user_id'] == 34);
//echo '</pre>';
//$user_query = new WP_User_Query( array( 'role' => 'um_bmc-current-member' ) );


$edwhite_headline = get_sub_field('title');
$user_id = get_current_user_id();

?>
<div class="container">
    <div class="row">
        <div class="col col-md-12">
            <?php echo '<pre>For Test Only: '; print_r(Roots\Sage\Extras\get_bmc_active_members_ed_white_points($user_id)); echo '</pre>';  ?>
            <h4 class="heading heading--4 mt-3 mb-3"><?php echo $edwhite_headline; ?> : <?php echo  array_sum(Roots\Sage\Extras\get_bmc_active_members_ed_white_points($user_id))?:'0'; ?> <?php// echo Roots\Sage\Extras\get_bmc_active_members_ed_white_points($user_id)?></h4>
        </div>
    </div>
</div>