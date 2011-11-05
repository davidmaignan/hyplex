<?php use_helper('Date','Number','I18n','Text'); ?>

<?php ini_set('error_reporting', E_ALL|E_ERROR) ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>
<?php use_stylesheet('flightResult'); ?>
<?php use_stylesheet('custom-theme/jquery-ui-1.8.16.custom.css'); ?>
<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>

<?php use_javascript('jquery-1.6.2.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.16.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>



<style>


.total{
    font-size: 140%;
    width: 220px;
    text-align: right;
}

table.basket-flight{
    background: none;
}

table.basket-flight td{
    border-bottom: 1px dotted #dddddd;
    background: none;
    line-height: 18px;
}


ol.hotel-passenger li{
    list-style-type: decimal;
    font-weight: bold;
    font-size: 80%;
    list-style-position: inside;
}

li.print, li.send, li.savePDF{
    font-size: 80%;
    line-height: 25px;
    padding-left: 22px;
    background: url('/images/icons/printer.png') no-repeat left 4px;
}

li.send{
    background-image: url('/images/icons/email.png');
}

li.savePDF{
    background-image: url('/images/icons/page_white_acrobat.png');
}

p{
    line-height: 18px;
}

h2.entourage{
    border: 0px solid #C2DAE9;
    border-top-color: #c2dae9;
    border-top-width: 3px;
    border-top-style: solid;
    padding: 8px;
    margin-bottom: 8px;
    margin-top: 25px;
    abackground-color: #EFF7FD;
}

h2.traveler, h2.flight, h2.hotel, h2.car{
    background: url('/images/mobico/flight.png') no-repeat left 5px;
    padding-left: 35px;
    height: auto;
}

h2.hotel{
    background-image: url('/images/mobico/hotel.png');
}

</style>

<hr class="space2" />
<div class="span-5">
    <div class="box-1"><?php echo __('Need Help ?') ?></div>
    <div class="box-2">
        <ul>
            <li class="print"><a><?php echo __('Print this page') ?></a></li>
            <li class="send"><a><?php echo __('Send by email') ?></a></li>
            <li class="savePDF"><a><?php echo __('Save as PDF') ?></a></li>
        </ul>
    </div>
</div>

<div class="span-20 last">
<h3 class="success">Thank you for your booking with Hypertech. 
    Your booking reference is: <span class="bold"><?php echo $booking->getBookingId() ?></span>
</h3>

    
<p>Dear <?php echo $booking->getCustomer() ?></p>
<p>Your booking is confirmed and an acknowledgement of the same has also been emailed to you.
    While travelling, please carry a print of this confirmation email, your e-tickets, hotel vouchers
    and any other travel documents that may be required.</p>
<p>Carry valid identity proofs where the name is the same as on your tickets.</p>
<p>You will recieve the e-tickets/hotel vouchers for your booking as per schedule detailed in the package details.
    If you do not recieve your e-tickets/hotel voucher or any communication about these, please contact
    our customer care helpline at </p>

<hr class="space3" />

<h2 class="entourage summary">Booking summary</h2>
<?php include_partial('bookingSummary', array('booking'=>$booking)); ?>

<hr class="space3" />
<h2 class="entourage traveler">Travelers</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
<hr class="space2" />

<h2 class="title prepend-top smaller">Travelers details</h2>
<?php $meals = Utils::createMealPreferenceArray(); ?>
<?php $assistance = Utils::createSpecialServicesArray(); ?>


<div class="flight-box-details">
    
    <div class="padded">
        <table class="flight-details">

        <tr class="small">
            <td class=""><?php echo __('Title') ?></td>
            <td style="width: 180px;"><?php echo __('Full name') ?></td>
            <td><?php echo __('dob') ?></td>
            <td><?php echo __('age') ?></td>
            <td><?php echo __('frequent flyer programm') ?></td>
            <td><?php echo __('Special request') ?></td>
        </tr>
        <?php foreach($booking->getPassengers() as $passenger): ?>
        <tr class="border">
            <td class=""><?php echo $passenger['salutation'] ?></td>
            <td class=""><?php echo $passenger['first_name'].' '. $passenger['last_name'] ?></td>
            <td class=""><?php echo $passenger['dob'] ?></td>
            <td class=""><?php echo ($passenger['type'] == 'CHD')? format_number_choice(
                        '[0,1] year old|(2,+Inf]%1% years old',
                            array('%1%' => Utils::getAge($passenger['dob'], date('Y-m-d'))),
                            Utils::getAge($passenger['dob'], date('Y-m-d'))): '' ?></td>
            <td class="">
                <?php if($passenger['frequent_flyer_number']): ?>
                <ul>
                    <li><?php echo __('%1%: '.$passenger['frequent_flyer_number'], array('%1%'=>'Number')) ?></li>
                    <li><?php echo __('%1%: '.$passenger['airline_code'], array('%1%'=>'Compagnie')) ?></li>
                </ul>
                <?php endif; ?>
            </td>
            <td class="">
                <ul>
                    <?php if($meals[$passenger['meal_preference']]): ?>
                    <li><?php echo __('%1%: '.$meals[$passenger['meal_preference']], array('%1%'=>'Meal')) ?></li>
                    <?php endif; ?>
                    <?php if($assistance[$passenger['special_assistance']]): ?>
                    <li><?php echo __('%1%: '.$assistance[$passenger['special_assistance']], array('%1%'=>'Assistance')) ?></li>
                    <?php endif; ?>
                </ul>
            </td>
            
         </tr>
         <?php endforeach; ?>
        
        </table>

    </div>
    
</div>
<hr class="space3" />

<?php $flight = $booking->getFlight() ?>




<?php if($flight): ?>

<h2 class="entourage flight">Flight</h2>
<p><?php echo html_entity_decode($flight->displayConfirmationTitle($sf_user->getCulture())) ?>
     for <?php echo $flight->getPassengerInfo($booking->getFlightFilename())?>
</p>

<hr class="space3" />
<h2 class="title prepend-top smaller">Flight details</h2>
<div class="append-bottom flight-box-details">
    <div class="padded">
        <table class="flight-details append-bottom">
            <?php include_partial('flight/segmentOutbound', array('result'=>$booking->getFlight())) ?>
            <?php include_partial('flight/segmentInbound', array('result'=>$booking->getFlight())) ?>
        </table>
        <?php //echo html_entity_decode($result->displayDetails()); ?>
    </div>
</div>
<?php endif; ?>

<hr class="space3" />

<?php $hotel = $booking->getHotel() ?>

<?php if($hotel): ?>
<h2 class="entourage hotel">Hotel</h2>
    <?php include_partial('booking/hotelDescription', array('result'=>$hotel)); ?>
    <?php include_partial('booking/hotelRoom',array('hotel'=>$hotel, 'booking'=>$booking)); ?>
<?php endif; ?>

<hr />


</div>
<hr />

<?php

//echo "<pre>";
//print_r($hotel);