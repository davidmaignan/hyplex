 <div class="flight-box-details">

    <div class="padded">
        <table class="flight-details">

        <tr class="small">
            <td style="width: 400px;"><?php echo __('Room details') ?></td>
            <?php foreach ($hotel->getRoomIds() as $value): ?>
                    <td><?php echo $value; ?></td>
                <?php endforeach; ?>
        </tr>
        <?php foreach ($hotel->arRoomsType as $key => $roomType): ?>
        
            <tr class="border"><td colspan="<?php echo count($hotel->getRoomIds())+1 ?>"><?php echo $key ?></td></tr>

            <?php foreach ($roomType->arRates as $k => $rate): ?>
            <tr class="border">

                <td><?php echo $k; ?></td>

                <?php foreach($hotel->getRoomIds() as $arRoomId): ?>

                    <?php if($rate->offsetExists($arRoomId)): ?>
                
                    <td class="room-night-price">
                        <ol class="hotel-passenger">
                            <?php foreach($booking->getPassengerRoom($rate[$arRoomId]['UniqueReferenceId']) as $passenger): ?>
                            <li><?php echo $passenger; ?></li>
                            <?php endforeach; ?>
                        </ol>
                    </td>

                    <?php else: ?>

                    <td></td>
                    
                    <?php endif; ?>

                <?php endforeach; ?>
            </tr>


            <?php endforeach; ?>
        <?php endforeach; ?>

        </table>

    </div>

</div>