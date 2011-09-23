<tr class="basket-list-header active basket-flight">
    <td class="icon">
        <?php echo image_tag('mobico/flight_on.png'); ?>
    </td>
    <td><?php echo ucfirst(__('flight')) ?></td>
    <td class="sub-total">
        <?php echo format_currency($flight->TotalPrice, sfConfig::get('app_currency')); ?>
    </td>
</tr>
<tr class="basket-list">
    <td colspan="2">
        <ul class="sub-list">
            <li>
                <?php echo $flightParameters->getOrigin(); ?> to <?php echo $flightParameters->getDestination(); ?>
            </li>
            <li>
                <?php echo $flightParameters->getTypeRenamed(); ?>:
                <?php echo format_date($flightParameters->getDepartDate(), 'd'); ?> -
                <?php echo format_date($flightParameters->getReturnDate(), 'd'); ?>
            </li>
            <li>
                &bull;
                <?php echo format_number_choice(
                        '[0]|[1]1 adult  |(1,+Inf]%1% adults  ', array('%1%' => $flightParameters->getAdults()), $flightParameters->getAdults()) ?>
                <?php echo format_number_choice(
                        '[0]|[1]1 child |(1,+Inf]%1% children  ', array('%1%' => $flightParameters->getChildren()), $flightParameters->getChildren()) ?>
                <?php echo format_number_choice(
                        '[0]|[1]1 infant  |(1,+Inf]%1% infants  ', array('%1%' => $flightParameters->getInfants()), $flightParameters->getInfants()) ?>
            </li>
        </ul>

    </td>
    <td class="sub-total">
        <?php echo format_currency($flight->TotalPrice, sfConfig::get('app_currency')); ?>
    </td>
</tr>
<tr class="basket-list"><td colspan="3"></td></tr>

