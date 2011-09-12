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
        <div class="flight-box-price color2">
            <p class="price"><?php echo format_currency($result->TotalPrice, 'USD') ?></p>
            <a href="#" class="select"><?php echo  __('Select')?></a>
        </div>
    </div>
</div>



<div class="span-15 bg-grey no-shadow append-bottom flight-box-details none">
    <div class="padded">
        <table class="flight-details append-bottom">
            <?php include_partial('segmentOutbound', array('result'=>$result)) ?>
            <?php //include_partial('segmentInbound', array('result'=>$result)) ?>
        </table>
        <?php //echo html_entity_decode($result->displayDetails()); ?>
    </div>
</div>