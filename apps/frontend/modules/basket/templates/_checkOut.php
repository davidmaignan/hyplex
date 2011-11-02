<?php use_helper('Text','Date','Number','I18n') ?>

<div class="span-7">
    <table id="basket-summary">

        <?php if(isset($flight)): ?>
        <?php include_partial('basket/flightLeft', array('flight'=>$flight,'flightParameters'=>$flightParameters)) ?>
        <?php else: ?>
        <?php include_partial('basket/flightLeftAdd');?>
        <?php endif; ?>

        <?php if(isset($hotel)): ?>
        <?php include_partial('basket/hotelLeft', array('hotel'=>$hotel,'hotelParameters'=>$hotelParameters)) ?>
        <?php else: ?>
        <?php include_partial('basket/hotelLeftAdd');?>
        <?php endif; ?>

         <?php if(isset($extra)): ?>
        <?php include_partial('basket/extraLeft', array('extra'=>$extra)) ?>
        <?php else: ?>
        <?php include_partial('basket/extraLeftAdd');?>
        <?php endif; ?>

        <?php if(isset($car)): ?>
        <?php include_partial('basket/carLeft', array('car'=>$car,'carParameters'=>$carParameters)) ?>
        <?php else: ?>
        <?php include_partial('basket/carLeftAdd');?>
        <?php endif; ?>

        <?php if(isset($excursions)): ?>
        <?php include_partial('basket/excursionLeft', array('excursions'=>$excursions)) ?>
        <?php else: ?>
        <?php include_partial('basket/excursionLeftAdd');?>
        <?php endif; ?>

        <tr class="basket-list-total">
            <td colspan="2">
                <ul>
                    <li><?php echo __('Total') ?></li>
                    <li class="sub-person"><?php //echo ucfirst(__('price per person')) ?></li>
                </ul>
            </td>
            <td class="total">
                <ul>
                    <li>
                        <?php echo format_currency($plexBasket->getTotalPrice(),  sfConfig::get('app_currency')); ?>
                    </li>
                    <li class="sub-person">
                        <?php //echo format_currency(rand(2999,8999)/3,  sfConfig::get('app_currency')); ?>
                    </li>
                </ul>

            </td>
        </tr>

    </table>

    <a href="<?php echo url_for('basket/removeDataBooking') ?>">Remove data booking</a>


</div>