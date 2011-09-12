<tr class="border"><td class="flight-info" rowspan="2">
<?php echo html_entity_decode($result->getAirlineIconDetails($data)) ?>
</td>
<td class="date"><?php echo format_date($data->Departs, 'p') ?></td>
<td class="time"><?php echo format_date($data->Departs, 't') ?></td>
<td class="airport"><?php echo $data->DepartureFrom ?></td>
<td class="duration" rowspan="2"><?php echo Utils::getHourMinutes($data->FlightDuration) ?></td>
<td class="class" rowspan="2"><?php echo $data->ClassOfService ?></td>
</tr>
<tr class="border">
<td class="date"><?php echo format_date($data->Arrives, 'p') ?></td>
<td class="time"><?php echo format_date($data->Arrives, 't') ?></td>
<td class="airport"><?php echo $data->ArrivalTo ?></td>
</tr>
<?php echo html_entity_decode($result->getOperatingAirlines($data)); ?>