<tr class="room-rate <?php echo $class; ?> <?php echo ($i%2 == 0) ? 'odd' : ''; ?>">
    <td class="room-rate-name" style="width: 400px;">
        <ul>
            <li class="rate-name"><?php echo $k; ?></li>
 
        </ul>
        <div class="rate-description-content hide prepend-top">
            <?php echo $rate['RateDescription']; ?>
        </div>
        <div class="term-condition-content prepend-top">
            
        </div>
    </td>

    <?php foreach($hotel->getRoomIds() as $arRoomId): ?>

        <?php if($rate->offsetExists($arRoomId)): ?>
        <td class="room-night-price">
            
            <ol class="hotel-passenger">
                <?php foreach($booking->getPassengerRoom($rate[$arRoomId]['UniqueReferenceId']) as $passenger): ?>
                <li>
                   <?php echo $passenger; ?>
                </li>
                <?php endforeach; ?>
               
            </ol>

        </td>

        <?php else: ?>

        <?php endif; ?>
        
    <?php endforeach; ?>

</tr>