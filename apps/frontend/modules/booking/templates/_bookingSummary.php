
<?php
//$hotel = $booking->getHotel();
//var_dump($hotel);
?>
<div style="padding: 10px; border: 2px solid #cecece; background-color: #f8f8f6">
<table>
    <?php if($booking->getFlight()): ?>
    <tr>
        <td><img src="/images/mobico/flight.png" /></td>
        <td>
            <?php echo $booking->getFlight()->getOriginOrDestination('origin',$sf_user->getCulture()) ?><br />
            <?php echo $booking->getFlight()->getOriginOrDestination('destination',$sf_user->getCulture()) ?>
        </td>
        <td class="smaller">
            Depart:<br />
            Return:
        </td>
        <td class="bold">
            <?php echo format_date($booking->getFlight()->getOriginOrReturnDateOrTime('origin','date'),'D') ?><br />
            <?php echo format_date($booking->getFlight()->getOriginOrReturnDateOrTime('return','date'), 'D') ?>
        </td>
        <td style="text-align: right">
            <?php echo $booking->getFlight()->getOriginOrReturnDateOrTime('origin','time') ?><br />
            <?php echo $booking->getFlight()->getOriginOrReturnDateOrTime('return','time') ?>
        </td>
        <td style="text-align: right" class="bold"><?php echo format_currency(rand(1999,12999),  sfConfig::get('app_currency')) ?></td>
    </tr>
    <?php endif; ?>
    <?php if($booking->getHotel()): ?>
    <tr>
        <td><img src="/images/mobico/hotel.png" /></td>
        <td style="width: 350px;">
            <?php echo $booking->getHotel()->getName() ?>,
            <?php echo $booking->getHotel()->getFullAddress(false) ?><br />
            <?php echo format_number_choice(
                    '[1] night|(1,+Inf]%nights nights',
                    array('%nights'=>$booking->getHotel()->getParameters()->getNumberNights()),
                    $booking->getHotel()->getParameters()->getNumberNights()) ?>
            ,  <?php echo format_number_choice(
                    '[1] room|(1,+Inf]%rooms rooms',
                    array('%rooms'=>count($booking->getHotel()->arRooms)),
                    count($booking->getHotel()->arRooms)) ?>
        </td>
        <td class="smaller">
            Checkin:<br />
            Checkout:
        </td>
        <td colspan="2">
            <?php echo format_date($booking->getHotel()->getParameters()->getCheckinDate(),'D') ?><br />
            <?php echo format_date($booking->getHotel()->getParameters()->getCheckOutDate(),'D') ?>
        </td>
        <td style="text-align: right" class="bold"><?php echo format_currency(rand(1999,12999),  sfConfig::get('app_currency')) ?></td>
    </tr>
    <?php endif; ?>
    <?php if($booking->getCar()): ?>
    <tr>
        <td style="vertical-align: middle;"><img src="/images/mobico/car.png" /></td>
        <td>
            1 economy car  <br />
            GPS, child seat, 2nd driver
        </td>
        <td class="smaller">
            Pick up:<br />
            Drop off:
        </td>
        <td colspan="2">
            Tuesday, November 1, 2011  <br />
            Tuesday, November 8, 2011
        </td>
        <td style="text-align: right" class="bold"><?php echo format_currency(rand(1999,12999),  sfConfig::get('app_currency')) ?></td>
    </tr>
    <?php endif; ?>
    <tr>
        
        <td  colspan="5" class="bold text-right paddingTop">Total</td>
        <td class="total bigger text-right border-top" style="width: 100px;"><?php echo format_currency(rand(1999,12999),  sfConfig::get('app_currency')) ?></td>
    </tr>
</table>
</div>