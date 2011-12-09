<tr class="room-rate <?php echo $class; ?> <?php echo ($i % 2 == 0) ? 'odd' : ''; ?>"">
    <td>
        <ul class="none">
            <li class="rate-name"><?php echo $k; ?></li>
            <li class="rate-links">
                <a class="rate-description" href="#"><?php echo __('View description') ?></a>
                <?php
                echo link_to2(__('Terms & conditions'), 'hotel_terms_conditions', array('slug' => Utils::slugify($hotel->name, ''),
                    'termsConditionId' => $rate['termsConditionId']), array('class' => 'termsConditions'))
                ?>
            </li>
        </ul>
        <div class="rate-description-content hide prepend-top"><?php echo $rate['RateDescription']; ?></div>
        <div class="term-condition-content prepend-top"></div>
    </td>
    
    <?php foreach ($hotel->getRoomIds() as $arRoomId): ?>
    
        <?php if ($rate->offsetExists($arRoomId)): ?>
    
        <td class="room-night-price <?php echo $hotel->id . '-' . $arRoomId ?>">
            <ul>
                <li>
                    <input class="radio-room-price"
                               type="radio"
                               <?php if ($firstRate === true)
                                   echo 'checked="checked"' ?>
                               id="<?php echo /* $hotel->id.'-'. */$arRoomId ?>"
                               name="<?php echo /* $hotel->id.'-'. */$arRoomId ?>"
                               value="<?php echo $rate[$arRoomId]['UniqueReferenceId'] ?>" />

                        <span class="bold blue bigger">
                            <?php echo Utils::getPrice($rate[$arRoomId]['AvgPricePerNight']); ?>
                        </span>
                </li>
                <li class="grey1">
                    Total: <span class=""><?php echo Utils::getPrice($rate[$arRoomId]['TotalPrice']) ?></span>
                </li>
            </ul>

        </td>
        
        <?php else: ?>
            <td class=''>-</td>
        <?php endif; ?>
            
    <?php endforeach; ?>
</tr>
