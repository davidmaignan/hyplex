<h3 class="success">
    <?php echo __('You have selected the <span class="bold">%1%</span> in <span class="bold">%2%</span>',
            array('%0%' => count($hotel->getRoomIds()), '%1%'=> $hotel->getName(),'%2%'=> $parameters->getWhereBoxResultPage($sf_user->getCulture()))) ?>
</h3>
<p>
    <?php echo __('From')?>
    <span class="bold"><?php echo format_date($parameters->getCheckinDate(), 'P')?></span>
    <?php echo ('to'); ?>
    <span class="bold"><?php echo format_date($parameters->getCheckoutDate(), 'P') ?></span>
    |
    <?php echo format_number_choice(
        '[0]|[1]1 night | |(1,+Inf]%1% nights | ', array('%1%' => $parameters->getNumberNights()), $parameters->getNumberNights()) ?>
    <?php echo format_number_choice(
        '[0]|[1]1 room | |(1,+Inf]%1% rooms | ', array('%1%' => $parameters->getNumberRooms()), $parameters->getNumberRooms()) ?>
    <?php echo format_number_choice(
        '[0]|[1]1 adult | |(1,+Inf]%1% adults | ', array('%1%' => $parameters->getNumberAdults()), $parameters->getNumberAdults()) ?>
    <?php echo format_number_choice(
        '[0]|[1]1 child | |(1,+Inf]%1% children | ', array('%1%' => $parameters->getNumberChildren()), $parameters->getNumberAdults()) ?>
    <a href="#" id="changeSearch"><?php echo __('Change search') ?></a>
</p>
<hr />
