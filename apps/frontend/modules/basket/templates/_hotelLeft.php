<tr class="basket-list-header active basket-hotel">
    <td><?php echo ucfirst(__('hotel')) ?></td>
    <td colspan="2" class="sub-total">
        <?php echo format_currency($hotel->getTotalPrice(), sfConfig::get('app_currency')); ?>
    </td>
</tr>
<tr class="basket-list">
    <td colspan="3">
        <ul class="sub-list">
            <li>
                <?php echo format_number_choice(
                        '[0]|[1]1 night  |(1,+Inf]%1% nights  ', array('%1%' => $hotelParameters->getNumberNights()), $hotelParameters->getNumberNights()) ?>
                in <?php echo $hotelParameters->getWhereBoxBasketPage(); ?>
            </li>
            <li>Checkin: <?php echo format_date($hotelParameters->getCheckinDate(), 'd'); ?>
            <li>Checkout: <?php echo format_date($hotelParameters->getCheckoutDate(), 'd'); ?></li>
        </ul>
    </td>
</tr>

<?php foreach($hotelParameters->arRooms as $key=>$room): ?>

<tr class="basket-list">
    <td colspan="2">
        &bull; <?php echo ucfirst(__('room'))?>
        <?php echo $key+1 ?>:
        <?php echo format_number_choice(
        '[0]|[1]1 adult, |(1,+Inf]%1% adults, ', array('%1%' => $room['number_adults']), $room['number_adults']) ?>
        <?php echo format_number_choice(
            '[0]|[1]1 child |(1,+Inf]%1% children ', array('%1%' => $room['number_children']), $room['number_children']) ?>
        
    </td>
    <td class="sub-total">
        <?php //echo $key; ?>
        <?php echo format_currency($hotel->getPrice($key, true), sfConfig::get('app_currency')); ?>
    </td>
</tr>

<?php endforeach; ?>

<tr class="basket-list"><td colspan="3"></td></tr>

<?php
//echo "<pre>";
//print_r($hotel->arRooms);