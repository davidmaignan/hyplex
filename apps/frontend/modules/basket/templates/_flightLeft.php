<tr class="basket-list-header active basket-flight">
    <td><?php echo __('Flight') ?></td>
    <td colspan="2" class="sub-total">
        <?php echo Utils::getPrice($flight->TotalPrice) ?>
    </td>
</tr>
<tr class="basket-list">
    <td colspan="2">
        <ul class="sub-list">
            <li class="bold">
                <?php echo $flightParameters->arOrigin['code']; ?>
                <?php echo __('to') ?>
                <?php echo $flightParameters->arDestination['code']; ?>
            </li>
        </ul>

    </td>
    <td class="sub-total">
        <?php echo Utils::getPrice($flight->TotalPrice) ?>
    </td>
</tr>
<tr class="basket-list">
    <td colspan="3">
        <ul class="normal">
            <li>
                <?php echo $flightParameters->getTypeRenamed(); ?>:
                <?php echo format_date($flightParameters->getDepartDate(), 'd'); ?> -
                <?php if($flightParameters->getType() == 'flightReturn'): ?>
                <?php echo format_date($flightParameters->getReturnDate(), 'd'); ?>
                <?php endif; ?>
            </li>
            <li>
                <?php echo Utils::getAdultChildInfantString(
                        $flightParameters->getAdults(),
                        $flightParameters->getChildren(),
                        $flightParameters->getInfants());
                ?>
               </li>
        </ul>
    </td>
</tr>


