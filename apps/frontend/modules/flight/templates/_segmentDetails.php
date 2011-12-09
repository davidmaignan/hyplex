<tr>
    <td class="center" rowspan="2">
        <?php echo html_entity_decode($result->getAirlineIconDetails($data)) ?>
    </td>
    <td class="bold"><?php echo format_date($data->Departs, 'p') ?></td>
    <td class="blue1"><?php echo format_date($data->Departs, 't') ?></td>
    <td><?php echo html_entity_decode($result->getAirportName($data->DepartureFrom, $sf_user->getCulture())); ?></td>

    <td rowspan="2"><?php echo Utils::getHourMinutes($data->FlightDuration) ?></td>
    <td  rowspan="2"><?php echo $data->ClassOfService ?></td>
</tr>
<tr class="">
    <td class="bold"><?php echo format_date($data->Arrives, 'p') ?></td>
    <td class="blue1"><?php echo format_date($data->Arrives, 't') ?></td>
    <td><?php echo html_entity_decode($result->getAirportName($data->ArrivalTo, $sf_user->getCulture())); ?></td>
</tr>
<?php echo html_entity_decode($result->getOperatingAirlines($data)); ?>