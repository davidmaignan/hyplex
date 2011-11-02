<h1 style="font-weight: normal;">
   <?php echo __('%total% flights found for a %s% from %s1% to %s2%' ,
            array(  '%total%'=> $total,
                    '%s%' => $parameters->getTypeRenamed(),
                    '%s1%'=>$parameters->getOriginFormatResultPage($sf_user->getCulture()),
                    '%s2%'=>$parameters->getDestinationFormatResultPage($sf_user->getCulture()))) ?>
</h1>
<p class="notice">
    <?php echo __('Depart')?>
    <b><?php echo format_date($parameters->getDepartDate(), 'P')?></b>
    <?php echo __('and return'); ?>
    <b><?php echo format_date($parameters->getReturnDate(), 'P') ?></b>
    <?php echo __('for')?> :
    <?php echo format_number_choice(
        '[0]|[1]1 adult | |(1,+Inf]%1% adults | ', array('%1%' => $parameters->getAdults()), $parameters->getAdults()) ?>
    <?php echo format_number_choice(
        '[0]|[1]1 child | |(1,+Inf]%1% children | ', array('%1%' => $parameters->getChildren()), $parameters->getChildren()) ?>
    <?php echo format_number_choice(
        '[0]|[1]1 infant | |(1,+Inf]%1% infants | ', array('%1%' => $parameters->getInfants()), $parameters->getInfants()) ?>
    <a href="#" class="change" id="changeSearch"><?php echo __('Change search') ?></a>
</p>

