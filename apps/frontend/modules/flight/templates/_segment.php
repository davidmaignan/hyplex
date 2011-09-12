<?php use_helper('Date', 'Number', 'I18n'); ?>

<tr>
    <td class="airport"><?php echo $segment->DepartureFrom ?></td>
    <td class="bold date"><?php echo format_date($segment->Departs, 'flight') ?></td>
    <td class="blue time"><?php echo format_date($segment->Departs, 't') ?></td>
    <td class="arrow"><?php echo image_tag('generic/arrow.gif') ?></td>
    <td class="airport"><?php echo $segment->ArrivalTo ?></td>
    <td class="bold date"><?php echo format_date($segment->Arrives, 'flight') ?></td>
    <td class="blue time"><?php echo format_date($segment->Arrives, 't') ?></td>
    <td class="stop">
        <?php
        /*
            echo format_number_choice(
                        '[0]0 stop|[1] 1 stop|(1,+Inf]%count% stops',
                        array('%count%' => $segment->NumberStops . '</strong>'),
                        $segment->NumberStops
                );
         * 
         */
        ?>
        <?php echo $segment->NumberStops . __(' stop') ?>
    </td>
    <td class="duration"><?php echo Utils::getHourMinutes($segment->FlightDuration) ?></td>
</tr>
