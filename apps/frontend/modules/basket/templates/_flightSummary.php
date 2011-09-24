<div class="span-18" style="width: 693px ;padding: 10px; border: 1px solid #97d1f4; background-color: #eff7fd">

<h4 class="append-bottom"> <?php echo __('You have selected a %s% with the following parameters:' ,
            array(  '%s%' => $parameters->getTypeRenamed())) ?></h4>
<table class="basket-flight">
    <tr>
        <td class="first">
            <?php echo ucfirst(__('from')); ?>
        </td>
        <td>
            <?php echo $parameters->getOriginFormatResultPage($sf_user->getCulture()); ?>
        </td>
         <td class="first">
            <?php echo ucfirst(__('to')); ?>
        </td>
        <td>
            <?php echo $parameters->getDestinationFormatResultPage($sf_user->getCulture()); ?>
        </td>
    </tr>
    <tr>
        <td class="first">
            <?php echo ucfirst(__('depart')); ?>
        </td>
        <td>
            <?php echo format_date($parameters->getDepartDate(), 'P')?>
        </td>
         <td class="first">
            <?php echo ucfirst(__('return')); ?>
        </td>
        <td>
            <?php echo format_date($parameters->getReturnDate(), 'P') ?>
        </td>
    </tr>
    <tr>
        <td class="first"><?php echo ucfirst(__('Passengers')) ?></td>
        <td colspan="3">

            <?php echo format_number_choice(
                '[0]|[1]1 adult  |(1,+Inf]%1% adults  ', array('%1%' => $parameters->getAdults()), $parameters->getAdults()) ?>
            <?php echo format_number_choice(
                '[0]|[1]1 child |(1,+Inf]%1% children  ', array('%1%' => $parameters->getChildren()), $parameters->getChildren()) ?>
            <?php echo format_number_choice(
                '[0]|[1]1 infant  |(1,+Inf]%1% infants  ', array('%1%' => $parameters->getInfants()), $parameters->getInfants()) ?>
            

        </td>
    </tr>
    <tr>
        <td colspan="4" style="background-color: none; border: none;">
            <a href="<?php echo url_for('basket_remove',array('type'=>'flight')) ?>" class="delete left center"><?php echo ucfirst(__('remove flight')) ?></a>
            <a href="<?php echo url_for('flight_modified',array('filename'=>PlexBasket::getInstance()->getFlightFilename())) ?>"
               class="select basket-flight-link right center">
                    <?php echo ucfirst(__('change flight')) ?>
            </a>
            <a href="<?php echo url_for('flight_modified_search',array('filename'=>PlexBasket::getInstance()->getFlightFilename())) ?>"
                class="select basket-flight-link right center">
                <?php echo ucfirst(__('modify search')) ?>
            </a>
        </td>
    </tr>
</table>



</div>