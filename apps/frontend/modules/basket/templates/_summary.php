

<div class="span-18" style="width: 693px ;padding: 10px; border: 2px solid #cecece; background-color: #f8f8f6">

<h4 class="append-bottom bold"> <?php echo __('Your basket contains the following items:') ?></h4>

<?php if(count($parameters) == 0):?>
<p><?php echo __('Basket empty') ?></p>
<?php endif; ?>


<table class="smaller">

    <?php if(isset($parameters['flight'])): ?>
    <tr class="append-bottom">
        <td>
            <?php echo image_tag('mobico/flight.png'); ?>
        </td>
        <td>
            <ul class="normal">
                <li><?php echo $parameters['flight']->getOriginFormatResultPage($sf_user->getCulture()); ?></li>
                <li><?php echo $parameters['flight']->getDestinationFormatResultPage($sf_user->getCulture()); ?></li>
            </ul>
        </td>
        <td>
            <ul class="normal">
                <li><?php echo format_date($parameters['flight']->getDepartDate(), 'P')?></li>
                <li><?php echo format_date($parameters['flight']->getReturnDate(), 'P') ?></li>
            </ul>
        </td>
        <td>

            <?php echo format_number_choice(
                '[0]|[1]1 adult, |(1,+Inf]%1% adults, ', array('%1%' => $parameters['flight']->getAdults()), $parameters['flight']->getAdults()) ?>
            <?php echo format_number_choice(
                '[0]|[1]1 child, |(1,+Inf]%1% children, ', array('%1%' => $parameters['flight']->getChildren()), $parameters['flight']->getChildren()) ?>
            <?php echo format_number_choice(
                '[0]|[1]1 infant|(1,+Inf]%1% infants', array('%1%' => $parameters['flight']->getInfants()), $parameters['flight']->getInfants()) ?>
        </td>
        <td class="">
            <ul>
                <li>
                    <a href="<?php echo url_for('basket_remove',array('type'=>'flight')) ?>"
                       class="append-bottom bold right center color2"><?php echo __('remove') ?></a><br /><br />
                </li>
                <li>
                    <a href="<?php echo url_for('flight_modified_search',array('filename'=>PlexBasket::getInstance()->getFlightFilename())) ?>"
                        class="action basket-flight-link right center smaller">
                        <?php echo __('modify search') ?>
                    </a>
                </li>
            </ul>
            
        </td>
    </tr>
    <?php endif; ?>
    <?php if(isset($parameters['hotel'])): ?>
    <tr>
        <td><?php echo image_tag('mobico/hotel.png') ?></td>
        <td>
            <ul class="normal">
                <li><?php echo format_date($parameters['hotel']->getCheckinDate(), 'P')?></li>
                <li><?php echo format_date($parameters['hotel']->getCheckoutDate(), 'P')?></li>
            </ul>
        </td>
        <td colspan="2">

            <ul>
                <?php foreach($parameters['hotel']->arRooms as $key=>$room): ?>
                <li><?php echo __('room').' '.$key ?>:
                    <?php echo format_number_choice(
                    '[0]|[1]1 adult, |(1,+Inf]%1% adults, ', array('%1%' => $room['number_adults']), $room['number_adults']) ?>
                    <?php echo format_number_choice(
                        '[0]|[1]1 child |(1,+Inf]%1% children ', array('%1%' => $room['number_children']), $room['number_children']) ?>

                    <?php if($room['number_children']>0):?>
                    <?php echo __('aged') ?> (
                    <?php foreach($room['children_age'] as $k=>$child):?>
                       <?php echo $child['age'] ?>
                        <?php echo (($k < $room['number_children']-1)? ',': ''); ?>
                    <?php endforeach; ?>
                        )
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </td>

         <td class="">
            <ul>
                <li>
                    <a href="<?php echo url_for('basket_remove',array('type'=>'hotel')) ?>"
                       class=" append-bottom right center bold color2"><?php echo __('remove') ?></a><br /><br />
                </li>
                <li>
                    <a href="<?php echo url_for('hotel_modified_search',array('filename'=>PlexBasket::getInstance()->getHotelFilename())) ?>"
                        class="action smaller basket-flight-link right center">
                        <?php echo __('modify search') ?>
                    </a>
                </li>
            </ul>

        </td>
    </tr>

    <?php endif; ?>
</table>



</div>

<style>
    tr.append-bottom td{
        padding-bottom: 14px;
}
</style>