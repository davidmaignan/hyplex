<tr class="room-rate <?php echo $class; ?> <?php echo ($i%2 == 0) ? 'odd' : ''; ?>">
    <td class="room-rate-name">
        <ul>
            <li class="rate-name"><?php echo $k; ?></li>
            <li class="rate-links"><a href="#" class="rate-description">View description</a>
                <a class="termsConditions" onclick="return false;"
                   href="<?php echo url_for('hotel_terms_conditions',
                                            array('slug'=>  Utils::slugify($hotel->name, ''),
                                                  'termsConditionId'=> $rate['termsConditionId'])) ?>">
                    Terms & conditions</a></li>
        </ul>
        <div class="rate-description-content hide prepend-top">
            <?php echo $rate['RateDescription']; ?>
        </div>
        <div class="term-condition-content prepend-top">
            
        </div>
    </td>

    <?php foreach($hotel->getRoomIds() as $arRoomId): ?>

        <?php if($rate->offsetExists($arRoomId)): ?>
        <td class="room-night-price <?php echo $hotel->id.'-'.$arRoomId ?> <?php //echo ($firstRate === true)? 'selected': '' ?> ">
            <ul>
                <li>
                    <input class="radio-room-price"
                   type="radio"
                   <?php //if($firstRate === true) echo 'checked="checked"' ?>
                   id="<?php echo /*$hotel->id.'-'.*/$arRoomId ?>"
                   name="<?php echo /*$hotel->id.'-'.*/$arRoomId ?>"
                   value="<?php echo $rate[$arRoomId]['UniqueReferenceId'] ?>" />

                    <span class="price-per-night">
                        <?php echo format_currency($rate[$arRoomId]['AvgPricePerNight'], sfConfig::get('app_currency')); ?>
                    </span>

                </li>
                <li class="price-total">
                    Total: <span class="price-total"><?php echo $rate[$arRoomId]['TotalPrice'] ?></span>
                </li>
            </ul>

        </td>

        <?php else: ?>
            <td class=''>-</td>
        <?php endif; ?>
        
    <?php endforeach; ?>

</tr>