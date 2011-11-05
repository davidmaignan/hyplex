<tr class="basket-list-header active basket-car">
    <td class="icon">
        <?php echo image_tag('mobico/car_on.png'); ?>
    </td>
    <td><?php echo __('Car') ?></td>
    <td class="sub-total">
        <?php echo Utils::getPrice(1999) ?>
    </td>
</tr>
<tr class="basket-list">
    <td colspan="3">
        <ul class="sub-list">
            <li>6 days, Boston Airport (BOS)</li>
            <li>Pick up: <?php //echo format_date($carParameters->getCheckinDate(), 'd');  ?></li>
            <li>Drop off: <?php //echo format_date($carParameters->getCheckoutDate(), 'd');  ?></li>
        </ul>
</tr>
<tr class="basket-list">
    <td colspan="2">
        &bull; Child/Toddler Seat
    </td>
    <td class="sub-total">
        free
    </td>
</tr>
<tr class="basket-list">
    <td colspan="2">
        &bull; Satellite Radio
    </td>
    <td class="sub-total">
        <?php echo Utils::getPrice(1999) ?>
    </td>
</tr>
<tr class="basket-list">
    <td colspan="2">
        &bull; Bicycle Rack
    </td>
    <td class="sub-total">
        <?php echo Utils::getPrice(1999) ?>
    </td>
</tr>
<tr class="basket-list">
    <td colspan="2">
        &bull; GPS navigation system
    </td>
    <td class="sub-total">
        <?php echo Utils::getPrice(1999) ?>
    </td>
</tr>
<tr class="basket-list"><td colspan="3"></td></tr>