<span class="blue bold"><?php echo count($hotel->arRoomsType); ?> </span> room types available with
<span class="blue bold"><?php echo $hotel->getNumberRates(); ?> </span>
rates from
<span class="blue bold"><?php echo format_currency($hotel->minPrice, sfConfig::get('app_currency')); ?></span> to
<span  class="blue bold"><?php echo format_currency($hotel->maxPrice, sfConfig::get('app_currency')); ?></span>