<div class="span-15 shadow bg-white append-bottom">
    <div class="box-3">
        <table style="font-size: 90%; width:100%;">
            <tr>
                <td style="padding-right:280px;">Hotel</td>
                <td style="font-size: 110%; text-align: right;"><?php echo format_currency(3690, 'USD'); ?></td>
            </tr>
            <tr>
                <td></td>
                <td style=" text-align: right; font-size: 70%;">(includes Government Taxes and Fees)</td>
            </tr>
        </table>
    </div>


    <div class="hotel-container bg-light" style="padding: 10px;">
        <?php echo image_tag('../uploads/hotels/baseImage/041084A.jpg', array('style' => 'float:left; margin-right: 10px;')); ?>
        <div class="hotel-facilities" style="float: right; width: 140px; text-align: right;">
            <?php echo html_entity_decode($hotel->getFacilities()); ?>
        </div>
        <p style="margin-bottom: 6px;"><?php echo html_entity_decode($hotel->getStarRating()); ?></p>
        <h2 style="margin-bottom: 6px; font-size: 120%; font-weight: normal; font-family: 'Times';"><?php echo $hotel->getName(); ?></h2>
        <p class="small" style="color: #888; margin-bottom: 6px;"><?php echo $hotel->getAddress(); ?></p>
        <p class="small2 hotel-desc"><?php echo truncate_text(strip_tags(html_entity_decode($hotel->getDescription()), ''), 320); ?></p>

    <hr class="space3" />
    <?php foreach ($hotel->arRooms as $key=>$room): ?>

        <div class="hotel-room">
            <table class="room-table" style="font-size: 85%; width: 100%;">
            <thead>
                <tr>
                    <th colspan="5"><?php echo $key; ?></th>
                </tr>
            </thead>
            <?php foreach($room as $k=>$roomType): ?>
                <?php if($k <3): ?>
                <?php include_partial('roomType', array('roomType'=>$roomType)); ?>
                <?php else: ?>
                <?php include_partial('roomType', array('roomType'=>$roomType, 'class'=>'type2 none')); ?>
                <?php $endTable = '<tr class="room-type"><td><a href="#" class="more-room-type">'. __('More room types rates').'</a></td></tr>'; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if(isset($endTable))
                echo $endTable; ?>
            </table>
        </div>

        
    <?php endforeach; ?>

    </div>  
</div>