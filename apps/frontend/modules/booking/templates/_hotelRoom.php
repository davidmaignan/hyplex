<?php $i = 1; ?>
<table>
    <?php foreach ($hotel->arRoomsType as $key => $roomType): ?>
        <?php foreach ($roomType->arRates as $k => $rate): ?>
            <tr class="border-top">
                <td class="bold">Room <?php echo $i; ?></td>
                <td><?php echo $k; ?></td>

                <?php foreach ($hotel->getRoomIds() as $arRoomId): ?>

                    <?php if ($rate->offsetExists($arRoomId)): ?>

                        <td class="room-night-price">
                            <ol class="hotel-passenger">
                                <?php foreach ($booking->getPassengerRoom($rate[$arRoomId]['UniqueReferenceId']) as $passenger): ?>
                                    <li><?php echo $passenger; ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </td>

                    <?php else: ?>

                        <td></td>

                    <?php endif; ?>

                <?php endforeach; ?>
            </tr>
         <?php $i++; ?>
        <?php endforeach; ?>
    <?php endforeach; ?> 
    <tr class="border-top"></tr>
</table>