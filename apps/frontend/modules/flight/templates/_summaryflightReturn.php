<h2 class="fontface">
   <?php echo __('%total% flights found for a %s% from %s1% to %s2%' ,
            array(  '%total%'=> $total,
                    '%s%' => $parameters->getTypeRenamed(),
                    '%s1%'=>$parameters->getOriginFormatResultPage($sf_user->getCulture()),
                    '%s2%'=>$parameters->getDestinationFormatResultPage($sf_user->getCulture()))) ?>
</h2>
<p class="notice">
    <?php echo __('Depart')?>
    <b><?php echo format_date($parameters->getDepartDate(), 'P')?></b>
    <?php echo __('and return'); ?>
    <b><?php echo format_date($parameters->getReturnDate(), 'P') ?></b>
    <?php echo __('for')?> :
    <?php echo Utils::getAdultChildInfantString($parameters->getAdults(), $parameters->getChildren(), $parameters->getInfants()) ?>
    <a href="#" class="change bold" id="changeSearch"><?php echo __('Change search') ?></a>
</p>

