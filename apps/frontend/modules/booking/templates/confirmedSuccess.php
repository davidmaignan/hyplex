<?php use_helper('Date', 'Number', 'I18n', 'Text'); ?>

<?php ini_set('error_reporting', E_ALL | E_ERROR) ?>

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



<hr class="space2" />

<div class="span-6">
    <h4 class="filterForm">
        What's next
    </h2>
    <div class="box-content">
        <ul>
            <li><a href="#" class="print"><?php echo __('Print this page') ?></a></li>
            <li><a href="#" class="savePDF"><?php echo __('Save as PDF') ?></a></li>
            <li><a href="#" class="send"><?php echo __('Send by email') ?></a></li>
        </ul>
    </div>
</div>


<div class="span-18 last prepend-1">

    <h3 class="fontface">Thank your for ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</h3>
    <h3 class="success">Your booking reference is: 
        <span class="bold"><?php echo $booking->getBookingId() ?></span>
    </h3>
    <p>Dear <?php echo $booking->getCustomer() ?></p>
    <p>Your booking is confirmed and an acknowledgement of the same has also been emailed to you.
        While travelling, please carry a print of this confirmation email, your e-tickets, hotel vouchers
        and any other travel documents that may be required.</p>
    <p>Carry valid identity proofs where the name is the same as on your tickets.</p>
    <p>You will recieve the e-tickets/hotel vouchers for your booking as per schedule detailed in the package details.
        If you do not recieve your e-tickets/hotel voucher or any communication about these, please contact
        our customer care helpline at </p>





    <hr class="space" />

    <h3 class="title2">Booking summary</h2>
        <?php include_partial('bookingSummary', array('booking' => $booking)); ?>

        <hr class="space" />

        <h3 class="title2">Travelers details</h2>

            <?php $meals = Utils::createMealPreferenceArray(); ?>
            <?php $assistance = Utils::createSpecialServicesArray(); ?>

            <table class="passengers">


                <tr class="bg1 bold">
                    <td><?php echo __('Title') ?></td>
                    <td><?php echo __('Full name') ?></td>
                    <td><?php echo __('dob') ?></td>
                    <td><?php echo __('age') ?></td>
                    <td><?php echo __('frequent flyer programm') ?></td>
                    <td><?php echo __('Special request') ?></td>
                </tr>
                <?php foreach ($booking->getPassengers() as $passenger): ?>
                    <tr class="border">
                        <td class=""><?php echo $passenger['salutation'] ?></td>
                        <td class=""><?php echo $passenger['first_name'] . ' ' . $passenger['last_name'] ?></td>
                        <td class=""><?php echo $passenger['dob'] ?></td>
                        <td class="">
                            <?php
                            echo ($passenger['type'] == 'CHD') ? format_number_choice(
                                            '[0,1] year old|(2,+Inf]%1% years old', array('%1%' => Utils::getAge($passenger['dob'], date('Y-m-d'))), Utils::getAge($passenger['dob'], date('Y-m-d'))) : ''
                            ?>
                        </td>
                        <td class="">
                            <?php if ($passenger['frequent_flyer_number']): ?>
                                <ul>
                                    <li><?php echo __('%1%: ' . $passenger['frequent_flyer_number'], array('%1%' => 'Number')) ?></li>
                                    <li><?php echo __('%1%: ' . $passenger['airline_code'], array('%1%' => 'Compagnie')) ?></li>
                                </ul>
                            <?php endif; ?>
                        </td>
                        <td class="">
                            <ul>
                                <?php if ($meals[$passenger['meal_preference']]): ?>
                                    <li><?php echo __('%1%: ' . $meals[$passenger['meal_preference']], array('%1%' => 'Meal')) ?></li>
                                <?php endif; ?>
                                <?php if ($assistance[$passenger['special_assistance']]): ?>
                                    <li><?php echo __('%1%: ' . $assistance[$passenger['special_assistance']], array('%1%' => 'Assistance')) ?></li>
                                <?php endif; ?>
                            </ul>
                        </td>

                    </tr>
                <?php endforeach; ?>

            </table>


            <hr class="space" />

            <?php $flight = $booking->getFlight() ?>

            <?php if ($flight): ?>

                <h3 class="title2">Flight</h3>
                <h4><?php echo html_entity_decode($flight->displayConfirmationTitle($sf_user->getCulture())) ?>
                    for <?php echo $flight->getPassengerInfo($booking->getFlightFilename()) ?>
                </h4>

                <div class="span-4 border-top">
                    <h4 class="bold blue1">Inbound</h4>
                </div>

                <div class="span-14 last border-top">
                    <?php include_partial('flight', array('result' => $booking->getFlight(), 'type' => 'inbound')) ?>
                </div>

                <div class="span-4 border-top">
                    <h4 class="bold blue1">Outbound</h4>
                </div>

                <div class="span-14 last border-top">
                    <?php include_partial('flight', array('result' => $booking->getFlight(), 'type' => 'outbound')) ?>
                </div>                    

            <?php endif; ?>

            <hr class="space" />

            <?php $hotel = $booking->getHotel() ?>

            <?php if ($hotel): ?>

                <div class="span-4 border-top">
                    <h4 class="bold blue1">Hotel</h4>
                </div>

                <div class="span-14 last border-top">

                    <h3><?php echo $hotel->getName(); ?>
                        <?php echo html_entity_decode(HotelGenericObj::getStarRating($hotel->starRating)); ?>
                    </h3>
                    <p><?php echo $hotel->getFullAddress(); ?></p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    
                    <?php include_partial('booking/hotelRoom', array('hotel' => $hotel, 'booking' => $booking)); ?>

                </div>
                <hr />
                <?php //var_dump($hotelParameters); ?>
                <!--<h2 class="entourage hotel">Hotel</h2>-->
                <?php //include_partial('booking/hotelDescription', array('result' => $hotel)); ?>

            <?php endif; ?>

            <hr class="space" />


            </div>
            <hr class="space" />

