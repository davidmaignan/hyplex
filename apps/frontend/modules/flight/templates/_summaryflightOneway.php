<h1>
    <?php echo __('%total% flights found for a %s% from %s1% to %s2%' ,
            array(  '%total%'=> $total,
                    '%s%' => $parameters->getTypeRenamed(),
                    '%s1%'=>$parameters->getOriginFormatResultPage($sf_user->getCulture()),
                    '%s2%'=>$parameters->getDestinationFormatResultPage($sf_user->getCulture()))) ?>
</h1>
<p class="notice">
    <?php echo __('Depart')?>
    <b><?php echo format_date($parameters->getDepartDate(), 'P')?></b>
    <?php echo __('for')?> :
    <?php echo Utils::getAdultChildInfantString($parameters->getAdults(), $parameters->getChildren(), $parameters->getInfants()) ?>
    <a href="#" class="change" id="changeSearch"><?php echo __('Change search') ?></a>
</p>
<hr class="space" />

