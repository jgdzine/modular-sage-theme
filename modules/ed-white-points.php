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


$edwhite_headline = get_sub_field('headline');
$edwhite_body= get_sub_field('body');
$edwhite_list_length = get_sub_field('length_of_list');
$edwhite_row_heading_one = get_sub_field('row_heading_one');
$edwhite_row_heading_two = get_sub_field('row_heading_two');
$edwhite_row_heading_three = get_sub_field('row_heading_three');
?>
<div class="container">
    <div class="row">
        <div class="col col-md-12">
            <h3 class="heading heading--2 mt-3 mb-3"><?php echo $edwhite_headline; ?></h3>
           <div class="mt-3 mb-3 "><?php echo $edwhite_body; ?></div>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-12">
        <?php
            $args = array(
                'role' => 'um_bmc-current-member'
            );

        // The Query
             $user_query = new WP_User_Query( $args );
        //echo '<pre>';
        //print_r($user_query);
        //echo '</pre>';

        // User Loop
            $ed_white_point_array = array();
            if ( ! empty( $user_query->results ) ) {
                foreach ( $user_query->results as $user ) {
                    //print_r($user->user_email);

                    //echo '<p>' . $user->display_name . '</p>';
                    $ed_white_points_array =  Roots\Sage\Extras\get_bmc_active_members_ed_white_points($user->ID);

                    $ed_white_point_total = array_sum($ed_white_points_array);
                    if ($ed_white_point_total > 0){
                        $ed_white_point_array[$user->display_name] = $ed_white_point_total;
                    }
                    if ($ed_white_point_total > 0){
                        $ed_white_point_array[$user->display_name] = $ed_white_point_total;
                    }


                }
            } else {
                echo 'No users are Current BMC Members.';
            }


            if ( ! empty( $ed_white_point_array ) ) {
                echo '<table class="table table-striped table-bordered">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">'.$edwhite_row_heading_one?:'#'.'</th>';
                echo '<th scope="col">'.$edwhite_row_heading_two?:'Member'.'</th>';
                echo '<th scope="col">'.$edwhite_row_heading_three?:'Total Points'.'</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                $ed_white_point_array_sorted = arsort($ed_white_point_array);
                $count = 1;
                $current_standing = 1;
                $current_points;
                foreach ( $ed_white_point_array as $user => $points ) {
                    if ( $count >= $edwhite_list_length ) {
                        break;
                    }

                    if( $count === 1){
                        $current_points =  $points;
                    }

                    if($current_points > $points){
                        $current_standing++;
                    }

                    echo '<tr>';
                    echo '<th scope="row">' . $current_standing . '</th>';
                    echo '<td>' . $user . '</td>';
                    echo '<td>' . $points . '</td>';
                    echo '</tr>';

                    $count  ++;
                    $current_points =  $points;

                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo 'No users Have Ed White Points.';
            }?>
            </div>
        </div>
    </div>
</div>