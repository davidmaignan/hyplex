<?php $datas = $result->Segments[$type]; ?>

<?php for ($i = 0; $i < count($datas); $i++): ?>

    <table>
        <tr>
            <td class="bold span-2"><?php echo __('From')?>: </td>
            <td class="big">
                <?php echo html_entity_decode($result->getAirportName($datas[$i]->DepartureFrom, $sf_user->getCulture())); ?>
            </td>
        </tr>
        <tr>
            <td class="bold"><?php echo __('To')?>: </td>
            <td class="big">
                <?php echo html_entity_decode($result->getAirportName($datas[$i]->ArrivalTo, $sf_user->getCulture())); ?>
            </td>
        </tr>
        <tr>
            <td class="bold"><?php echo __('Flight')?>: </td>
            <td>
                <?php echo $datas[$i]->Airline . ' ('. $datas[$i]->FlightNumber.')' ?>
            </td>
        </tr>
        <tr>
            <td class="bold"><?php echo __('Depart')?>: </td>
            <td>
                <?php echo format_date($datas[$i]->Departs, 'P') ?> - 
                <?php echo format_date($datas[$i]->Departs, 't') ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="grey1">
                Coach class: <?php echo $datas[$i]->ClassOfService ?> | 
                Duration: <?php echo Utils::getHourMinutes($datas[$i]->FlightDuration) ?> | 
                This flight is operated by:  <?php echo $datas[$i]->OperatingAirline ?>
            </td>
        </tr>
    </table>

<?php endfor; ?>
