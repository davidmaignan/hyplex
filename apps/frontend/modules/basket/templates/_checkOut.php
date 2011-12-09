<div class="span-7">
    <table class="style1">
        <?php if (isset($flight)): ?>
            <?php include_partial('basket/flightLeft', array('flight' => $flight, 'flightParameters' => $flightParameters)) ?>
        <?php else: ?>
            <?php include_partial('basket/flightLeftAdd'); ?>
        <?php endif; ?>

        <?php if (isset($hotel)): ?>
            <?php include_partial('basket/hotelLeft', array('hotel' => $hotel, 'hotelParameters' => $hotelParameters)) ?>
        <?php else: ?>
            <?php include_partial('basket/hotelLeftAdd'); ?>
        <?php endif; ?>

        <?php if (isset($extra)): ?>
            <?php include_partial('basket/extraLeft', array('extra' => $extra)) ?>
        <?php else: ?>
            <?php include_partial('basket/extraLeftAdd'); ?>
        <?php endif; ?>

        <?php if (isset($car)): ?>
            <?php include_partial('basket/carLeft', array('car' => $car, 'carParameters' => $carParameters)) ?>
        <?php else: ?>
            <?php include_partial('basket/carLeftAdd'); ?>
        <?php endif; ?>

        <?php if (isset($excursions)): ?>
            <?php include_partial('basket/excursionLeft', array('excursions' => $excursions)) ?>
        <?php else: ?>
            <?php include_partial('basket/excursionLeftAdd'); ?>
        <?php endif; ?>

        <tr class="footer_1">
            <td colspan="2">
                <span class="bold"><?php echo __('Total') ?></span>
            </td>
            <td class="total" style="min-width: 100px;">
                <span class="bold bigger blue1 right"><?php echo Utils::getPrice($plexBasket->getTotalPrice()) ?></span><br /><br />
                <?php echo link_to1(__('checkout'), '@checkout', array('class' => 'action button small right')); ?>
            </td>
        </tr>
    </table>
    <hr class="space3" />
    <a class="small blue prepend-top" href="<?php echo url_for('basket/removeDataBooking') ?>">Remove data booking</a>
</div>