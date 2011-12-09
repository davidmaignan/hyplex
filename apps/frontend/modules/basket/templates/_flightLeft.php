<tr class="header_1 bold">
    <td class="span-6"><?php echo __('Flight') ?></td>
    <td colspan="2" class="text-right blue1">
        <?php echo Utils::getPrice($flight->TotalPrice) ?>
    </td>
</tr>
<tr class="smaller">
    <td colspan="2">
        <ul class="none">
            <li class="bold">
                <?php echo $flightParameters->arOrigin['code']; ?>
                <?php echo __('to') ?>
                <?php echo $flightParameters->arDestination['code']; ?>
            </li>
            <li>
                Depart:
                <?php echo format_date($flightParameters->getDepartDate(), 'd'); ?>
            </li>
            <?php if ($flightParameters->getType() == 'flightReturn'): ?>
                <li>
                    Return:
                    <?php echo format_date($flightParameters->getReturnDate(), 'd'); ?>
                </li>
            <?php endif; ?>
        </li>
        <li>
            <?php
            echo Utils::getAdultChildInfantString(
                    $flightParameters->getAdults(), $flightParameters->getChildren(), $flightParameters->getInfants());
            ?>
        </li>
        </ul>

    </td>
    <td class="text-right">
        <?php echo Utils::getPrice($flight->TotalPrice) ?>
    </td>
</tr>


