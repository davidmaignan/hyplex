<?php
//echo '<pre>';
//print_r($parameters);
?>
<h1>
    <?php echo __('Results for a %s% from %s1% to %s2%' , 
            array(  '%s%' => $parameters->getTypeRenamed(),
                    '%s1%'=>$parameters->getOriginFormatResultPage($sf_user->getCulture()),
                    '%s2%'=>$parameters->getDestinationFormatResultPage($sf_user->getCulture()))) ?>
</h1>
<p class="notice">
    <?php echo __('Depart')?>
    <b><?php echo format_date($parameters->getDepartDate(), 'P')?></b>
    <?php echo ('and Return '); ?>
    <b><?php echo format_date($parameters->getReturnDate(), 'P') ?></b>
    <?php echo __('for')?> :
    <?php echo format_number_choice(
        '[0]|[1]1 adult | |(1,+Inf]%1% adults | ', array('%1%' => $parameters->getAdults()), $parameters->getAdults()) ?>
    <?php echo format_number_choice(
        '[0]|[1]1 child | |(1,+Inf]%1% children | ', array('%1%' => $parameters->getChildren()), $parameters->getChildren()) ?>
    <?php echo format_number_choice(
        '[0]|[1]1 infant | |(1,+Inf]%1% infants | ', array('%1%' => $parameters->getInfants()), $parameters->getInfants()) ?>
    <a href="#" id="changeSearch"><?php echo __('Change search') ?></a>
</p>

