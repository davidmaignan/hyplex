<div style="padding: 10px; border: 2px solid #cecece; background-color: #f8f8f6">

<h4 class="append-bottom bold"> <?php echo __('Your basket contains the following items:') ?></h4>

<?php if(count($parameters) == 0):?>
<p><?php echo __('Basket empty') ?></p>
<?php endif; ?>


<table>
    <?php if(isset($parameters['flight'])): ?>
    <tr class="append-bottom">
        <td>
            <?php echo image_tag('mobico/flight.png'); ?>
        </td>
        <td>
            <ul class="none">
                <li><?php echo $parameters['flight']->getOriginFormatResultPage($sf_user->getCulture()); ?></li>
                <li><?php echo $parameters['flight']->getDestinationFormatResultPage($sf_user->getCulture()); ?></li>
            </ul>
        </td>
        <td>
            <ul class="none">
                <li><?php echo format_date($parameters['flight']->getDepartDate(), 'P')?></li>
                <?php if($parameters['flight']->getType() == 'flightReturn'): ?>
                <li><?php echo format_date($parameters['flight']->getReturnDate(), 'P') ?></li>
                <?php endif; ?>
            </ul>
        </td>
        <td>
            <?php echo Utils::getAdultChildInfantString(
                    $parameters['flight']->getAdults(),
                    $parameters['flight']->getChildren(),
                    $parameters['flight']->getInfants()); ?>
        </td>
        <td class="">
            <ul class="none">
                <li>
                    <a href="<?php echo url_for('basket_remove',array('type'=>'flight')) ?>"
                       class="remove bold right center"><?php echo __('remove') ?></a><br />
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
            <ul class="none">
                <li><?php echo format_date($parameters['hotel']->getCheckinDate(), 'P')?></li>
                <li><?php echo format_date($parameters['hotel']->getCheckoutDate(), 'P')?></li>
            </ul>
        </td>
        <td colspan="2">

            <ul class="none">
                <?php foreach($parameters['hotel']->arRooms as $key=>$room): ?>
                <li><?php echo __('room').' '.($key+1) ?>: 
                    <?php echo Utils::getAdultChildInfantString(
                    $room['number_adults'],
                    $room['number_children'],0); ?>

                    <?php echo Utils::getChildrenAgeString($room['children_age']) ?>
                    
                    
                </li>
                <?php endforeach; ?>
            </ul>
        </td>

         <td class="">
            <ul class="none">
                <li>
                    <a href="<?php echo url_for('basket_remove',array('type'=>'hotel')) ?>"
                       class=" remove bold right center"><?php echo __('remove') ?></a>
                </li>
                <li>
                    <a href="<?php echo url_for('hotel_modified_search',array('filename'=>PlexBasket::getInstance()->getHotelFilename())) ?>"
                        class="action basket-flight-link right center smaller">
                        <?php echo __('modify search') ?>
                    </a>
                </li>
            </ul>

        </td>
    </tr>

    <?php endif; ?>
</table>



</div>
