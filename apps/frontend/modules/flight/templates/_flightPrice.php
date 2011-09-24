<div class="flight-box-price color2">
    <ul>
        <li class="price"><?php echo format_currency($result->TotalPrice, sfConfig::get('app_currency')) ?></li>
        <li class="pricePerPerson"><?php echo format_currency($result->TotalPrice, sfConfig::get('app_currency')) ?> / person</li>
        <li class=""><a href="<?php echo url_for('flight_selected',
                                array('filename'=>$filename,
                                     'uniqueReferenceId'=>$result->UniqueReferenceId)) ?>"
                                        class="select"><?php echo __('add to basket') ?>
                    </a></li>
    </ul>
</div>