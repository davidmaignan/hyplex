<tr class="header_1 bold">
    <td class="span-6"><?php echo __('Hotel') ?></td>
    <td colspan="2" class="text-right blue1">
        <?php echo Utils::getPrice($hotel->getTotalPrice()) ?>
    </td>
</tr>
<tr class="smaller">
    <td colspan="3">
        <ul class="none">
            <li class="bold">
                <?php echo Utils::getNightString($hotelParameters->getNumberNights()) ?>
                <?php echo __('in') ?>
                <?php echo $hotelParameters->getWhereBoxBasketPage($sf_user->getCulture()); ?>
            </li>
            <li><?php echo __('Check-in') ?>: <?php echo format_date($hotelParameters->getCheckinDate(), 'd'); ?>
            <li><?php echo __('Check-out') ?>: <?php echo format_date($hotelParameters->getCheckoutDate(), 'd'); ?></li>
        </ul>
    </td>
</tr>

<?php foreach($hotelParameters->arRooms as $key=>$room): ?>
<tr class="smaller">
    <td colspan="2">
        <?php echo __('room')?>
        <?php echo $key+1 ?>:
        <?php echo Utils::getAdultChildInfantString($room['number_adults'],$room['number_children']);?>
    </td>
    <td class="sub-total text-right">
        <?php echo Utils::getPrice($hotel->getPrice($key, true)) ?>
    </td>
</tr>

<?php endforeach; ?>

