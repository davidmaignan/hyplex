<div class="span-15 shadow bg-flight-box append-bottom">
    <div class="flight">
        <a id="<?php echo $result->UniqueReferenceId ?>"></a>
        <div class="box-airline">
            <?php echo html_entity_decode($result->getAirlineIcon()); ?><br />
            <?php echo (count($result->arAirlines) > 1)? __('multiple airlines'): $result->SegmentOutbound->Airline; ?>
        </div>
        <div class="flight-data" >
            <table>
                <?php include_partial('segment', array('segment'=>$result->SegmentOutbound)); ?>
                <?php //include_partial('segment', array('segment'=>$result->SegmentInbound)); ?>
                <?php //echo $result->displayToStringBound($result->SegmentOutbound); ?>
            </table>
            <hr class="space3" />
            <a href="#" class="flight-link-details"><?php echo  __('Details')?></a>
            <a href="#" class="flight-link-save"><?php echo  __('Save')?></a>
            <a href="#" class="flight-link-share"><?php echo  __('Share')?></a>
        </div>
        <?php include_partial('flightPrice',array('result'=>$result, 'filename'=>$filename)); ?>
    </div>
</div>



<div class="span-15 bg-grey no-shadow append-bottom flight-box-details none">
    <div class="padded">
        <table class="flight-details append-bottom">
            <?php include_partial('segmentOutbound', array('result'=>$result)) ?>
        </table>
    </div>
</div>