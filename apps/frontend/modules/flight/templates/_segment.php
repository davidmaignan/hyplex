
<tr>
    <td class=""><?php echo $segment->DepartureFrom ?></td>
    <td class="bold"><?php echo format_date($segment->Departs, 'flight') ?></td>
    <td class="blue"><?php echo format_date($segment->Departs, 't') ?></td>
    
    <td class=""><?php echo $segment->ArrivalTo ?></td>
    <td class="bold"><?php echo format_date($segment->Arrives, 'flight') ?></td>
    <td class="blue"><?php echo format_date($segment->Arrives, 't') ?></td>
    <td class="center">
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
        <?php echo $segment->NumberStops ?>
    </td>
    <td class=""><?php echo Utils::getHourMinutes($segment->FlightDuration) ?></td>
</tr>
