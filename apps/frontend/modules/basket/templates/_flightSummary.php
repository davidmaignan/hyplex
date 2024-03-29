

<div class="span-18" style="width: 693px ;padding: 10px; border: 1px solid #97d1f4; background-color: #eff7fd">

<h4 class="append-bottom bold"> <?php echo __('Your basket contains the following items:') ?></h4>




<table class="basket-flight">
    <?php if(isset($parameters['flight'])): ?>
    <tr>
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
        </td>
        <td>

            <?php echo format_number_choice(
                '[0]|[1]1 adult  |(1,+Inf]%1% adults  ', array('%1%' => $parameters['flight']->getAdults()), $parameters['flight']->getAdults()) ?>
            <?php echo format_number_choice(
                '[0]|[1]1 child |(1,+Inf]%1% children  ', array('%1%' => $parameters['flight']->getChildren()), $parameters['flight']->getChildren()) ?>
            <?php echo format_number_choice(
                '[0]|[1]1 infant  |(1,+Inf]%1% infants  ', array('%1%' => $parameters['flight']->getInfants()), $parameters['flight']->getInfants()) ?>
        </td>
        <td class="">
            <ul>
                <li>
                    <a href="<?php echo url_for('basket_remove',array('type'=>'flight')) ?>" class=" append-bottom action button right center" style="font-size: 70%;"><?php echo ucfirst(__('remove flight')) ?></a>
                </li>
                <li>
                    <a href="<?php echo url_for('flight_modified_search',array('filename'=>PlexBasket::getInstance()->getFlightFilename())) ?>"
                        class="action basket-flight-link right center">
                        <?php echo ucfirst(__('modify search')) ?>
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
                <li><?php echo ucfirst(__('room')).' '.$key ?>:
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
                    <a href="<?php echo url_for('basket_remove',array('type'=>'hotel')) ?>" class=" append-bottom action button right center" style="font-size: 70%;"><?php echo ucfirst(__('remove hotel')) ?></a>
                </li>
                <li>
                    <a href="<?php echo url_for('hotel_modified_search',array('filename'=>PlexBasket::getInstance()->getHotelFilename())) ?>"
                        class="action basket-flight-link right center">
                        <?php echo ucfirst(__('modify search')) ?>
                    </a>
                </li>
            </ul>

        </td>
    </tr>
    <?php endif; ?>
</table>



</div>