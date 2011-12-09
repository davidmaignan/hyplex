<tr>
    <td><?php echo $segment->DepartureFrom ?></td>
    <td class="bold"><?php echo format_date($segment->Departs, 'flight') ?></td>
    <td class="blue1"><?php echo format_date($segment->Departs, 't') ?></td>
    <td><?php echo $segment->ArrivalTo ?></td>
    <td class="bold"><?php echo format_date($segment->Arrives, 'flight') ?></td>
    <td class="blue1"><?php echo format_date($segment->Arrives, 't') ?></td>
    <td class="center"><?php echo $segment->NumberStops ?></td>
    <td><?php echo Utils::getHourMinutes($segment->FlightDuration) ?></td>
</tr>


