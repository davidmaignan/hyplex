<div class="span-19 flight-box append-bottom">
    <div class="flight">
        <a id="<?php echo $result->UniqueReferenceId ?>"></a>
        <div class="box-airline">
            <?php echo html_entity_decode($result->getAirlineIcon()); ?><br />
            <?php echo (count($result->arAirlines) > 1)? __('multiple airlines'): $result->SegmentOutbound->Airline; ?>
        </div>
        <div class="flight-data" >
            <table>
                <thead>
                    <tr>
                        <th colspan="3"><?php echo __('Departure') ?></th>
                        <th colspan="3"><?php echo __('Arrival') ?></th>
                        <th><?php echo __('Stops') ?></th>
                        <th><?php echo __('Duration') ?></th>
                    </tr>
                </thead>
                <?php include_partial('flight/segment', array('segment'=>$result->SegmentOutbound)); ?>
                <?php include_partial('flight/segment', array('segment'=>$result->SegmentInbound)); ?>
            </table>
            <a href="#" class="flight-link-details"><?php echo  __('Details')?></a>
            <a href="#" class="flight-link-save"><?php echo  __('Save')?></a>
            <a href="#" class="flight-link-share"><?php echo  __('Share')?></a>
        </div>
        <?php include_partial('flight/flightPrice',array('result'=>$result, 'filename'=>$filename)); ?>
    </div>
</div>



<div class="span-19 bg-grey append-bottom flight-box-details hide">
    <div class="padded">
        <table class="flight-details append-bottom">
            <?php include_partial('flight/segmentOutbound', array('result'=>$result)) ?>
            <?php include_partial('flight/segmentInbound', array('result'=>$result)) ?>
        </table>
        <?php //echo html_entity_decode($result->displayDetails()); ?>
    </div>
</div>

<?php
//var_dump($result);
//exit;

?>