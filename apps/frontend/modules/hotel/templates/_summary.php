<h2 class="fontface">
    <?php echo format_number_choice(
        	'[0]Hotel found in %2%|[1]%1% Hotel found in %2%|(1,+Inf] %1% Hotels found in %2%',
            array('%1%' => $nbrHotels, '%2%'=> $parameters->getWhereBoxResultPage($sf_user->getCulture())), $nbrHotels) ?>
</h2>

<p class="notice">
    <?php echo __('From')?> <b><?php echo format_date($parameters->getCheckinDate(), 'P')?></b>
    <?php echo ('to'); ?> <b><?php echo format_date($parameters->getCheckoutDate(), 'P') ?></b> |
    <?php echo Utils::getNightString($parameters->getNumberNights()) ?> |
    <?php echo Utils::getNumberRoomsString($parameters->getNumberRooms()) ?> | 
    <?php echo Utils::getAdultChildInfantString($parameters->getNumberAdults(), $parameters->getNumberChildren(), 0) ?>
    <a href="#" class="change" id="changeSearch"><?php echo __('Change search') ?></a>
</p>

