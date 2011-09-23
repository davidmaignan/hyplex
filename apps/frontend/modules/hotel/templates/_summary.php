<h1>
    <?php echo format_number_choice(
        '[0]Hotel found in %2%|[1]%1% Hotel found in %2%|(1,+Inf] %1% Hotels found in %2%',
            array('%1%' => $nbrHotels, '%2%'=> $parameters->getWhereBoxResultPage($sf_user->getCulture())), $nbrHotels) ?>
</h1>
<hr class="space2" />
<p class="notice">
    <?php echo __('From')?>
    <b><?php echo format_date($parameters->getCheckinDate(), 'P')?></b>
    <?php echo ('to'); ?>
    <b><?php echo format_date($parameters->getCheckoutDate(), 'P') ?></b>
    |
    <?php echo format_number_choice(
        '[0]|[1]1 night | |(1,+Inf]%1% nights | ', array('%1%' => $parameters->getNumberNights()), $parameters->getNumberNights()) ?>
    <?php echo format_number_choice(
        '[0]|[1]1 room | |(1,+Inf]%1% rooms | ', array('%1%' => $parameters->getNumberRooms()), $parameters->getNumberRooms()) ?>
    <?php echo format_number_choice(
        '[0]|[1]1 adult | |(1,+Inf]%1% adults | ', array('%1%' => $parameters->getNumberAdults()), $parameters->getNumberAdults()) ?>
    <?php echo format_number_choice(
        '[0]|[1]1 child | |(1,+Inf]%1% children | ', array('%1%' => $parameters->getNumberChildren()), $parameters->getNumberAdults()) ?>
    <a href="#" class="change" id="changeSearch"><?php echo __('Change search') ?></a>
</p>

