<?php
/**
 * Created by PhpStorm.
 * User: touchebrand
 * Date: 7/7/17
 * Time: 6:10 PM
 *
 *
 */

$participation_headline = get_sub_field('headline');
$participation_row_heading_one = get_sub_field('row_heading_one');
$participation_start_date = get_sub_field('participation_start_date');
$participation_end_date = get_sub_field('participation_end_date');



?>
<div class="container">
    <div class="row">
        <div class="col island-30">
            <?php if($participation_headline): ?>
                <h4 class="heading heading--4 mb-4" ><?php echo $participation_headline; ?></h4>
            <?php endif; ?>
            <?php  $current_participation =  Roots\Sage\Extras\get_all_events_attend_by_user_in_current_season($participation_start_date,$participation_end_date);

            if ( ! empty( $current_participation ) ) {
                echo '<table class="table table-striped table-bordered">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">'.$participation_row_heading_one?:'Event'.'</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ( $current_participation  as $event_title ) {



                    echo '<tr>';
                    echo '<th scope="row">' . $event_title . '</th>';
                    echo '</tr>';


                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo 'Your have not signed up for any events.';
            }?>


        </div>
    </div>
</div>
