<div class="flight-box prepend-top">
    <a id="<?php echo $result->UniqueReferenceId ?>"></a>
    <table>
        <tr>
            <td class="airline-icon">
                <?php echo html_entity_decode($result->getAirlineIcon()); ?><br />
                <?php echo (count($result->arAirlines) > 1) ? __('multiple airlines') : $result->SegmentOutbound->Airline; ?>
            </td>
            <td class="flight-datas">
                <table class="flight-box">
                    <thead>
                        <tr>
                            <th colspan="3"><?php echo __('Departure') ?></th>
                            <th colspan="3"><?php echo __('Arrival') ?></th>
                            <th><?php echo __('Stops') ?></th>
                            <th><?php echo __('Duration') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include_partial('flight/segment', array('segment' => $result->SegmentOutbound)); ?>
                        <tr>
                            <td colspan="8">
                                <ul class="flight-link">
                                    <li><a class="flight-link-details"><?php echo __('Details') ?></a></li>
                                    <li><a class="flight-link-save"><?php echo __('Save') ?></a></li>
                                    <li><a class="flight-link-share"><?php echo __('Share') ?></a></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td class="flight-price">
                <?php include_partial('flight/flightPrice', array('result' => $result, 'filename' => $filename)); ?>
            </td>
    </table>
</div>




<div class="flight-box-details prepend-top2 hide">
    <table class="flight-details append-bottom">
        <?php include_partial('flight/segmentOutbound', array('result' => $result)) ?>
    </table>
</div>