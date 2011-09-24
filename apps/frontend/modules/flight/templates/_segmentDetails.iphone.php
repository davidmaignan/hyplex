<div class="flight-details <?php echo $result->class ?>">
    <div class="flight-date-2">
        <?php //echo $way; ?> <?php echo format_date($data->Departs, 'P') ?>
    </div>
    <div class="search-box-float" style="margin-left:5px">
        <?php echo html_entity_decode($result->getAirlineIcon()) ?>
        <?php //echo html_entity_decode($result->getAirlineIconDetails($data)); ?>
    </div>
    <span class="flight-number bold"><?php echo $data->Airline ?>
    <span class="smaller blue2">Flight: <?php echo  $data->FlightNumber ?></span></span>
    <div style="clear: both;"></div>
    <div class="search-box-float details">
        <dl>
            <dt><?php echo __('From') ?>: </dt>
            <dd><?php echo html_entity_decode($result->getAirportName($data->DepartureFrom, 'en_US')); ?></dd>
            <dt><?php echo __('To') ?>: </dt>
            <dd><?php echo html_entity_decode($result->getAirportName($data->ArrivalTo, 'en_US')); ?></dd>
            <dt><?php echo __('Depart') ?>: </dt>
            <dd><?php echo format_date($data->Departs, 'q'); ?></dd>
            <dt><?php echo __('Arrive') ?>: </dt>
            <dd><?php echo format_date($data->Arrives, 'q') ?></dd>
            <dt><?php echo __('Duration')?>: </dt>
            <dd><?php echo $result->calculateDuration($data->Departs, $data->Arrives) ?></dd>
            <dt class="no-border"><?php echo __('Details')?>: </dt>
            <?php echo html_entity_decode($result->getOperatingAirlines2($data)) ?>
        </dl>
    </div>
</div>
<div style="clear:both;"></div>

