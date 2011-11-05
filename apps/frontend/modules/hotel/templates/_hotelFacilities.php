<?php if(count($hotelFacilites)> 0): ?>



<div>
    <h2 class="title"><?php echo __('Hotel facilities') ?></h2>
    <table class="hotel-info">
        <tbody>
            <tr>
                <td class="first">General</td>
                <td>
                   <?php foreach($hotelFacilites['general'] as $general):  ?>
                   <?php echo ucfirst($general); ?>,
                   <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <td class="first">Activities</td>
                <td>Library</td>
            </tr>
            <tr>
                <td class="first">Services</td>
                <td>
                   <?php foreach($hotelFacilites['services'] as $service):  ?>
                   <?php echo ucfirst($service); ?>,
                   <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <td class="first">Internet</td>
                <td>
                    <?php foreach($hotelFacilites['internet'] as $internet):  ?>
                    <?php echo ucfirst($internet); ?>,
                    <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <td class="first">Parking</td>
                <td>
                    <?php foreach($hotelFacilites['parking'] as $parking):  ?>
                    <?php echo ucfirst($parking); ?>,
                    <?php endforeach; ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<hr class="space3" />

<div>
    <h2 class="title"><?php echo __('Hotel Policies') ?></h2>
    <table class="hotel-info">
        <tbody>
            <tr>
                <td class="first">Check in</td>
                <td>Bar, 24-Hour Front Desk, Newspapers, Garden, Non-Smoking Rooms, Rooms/Facilities for Disabled Guests, Elevator, Safety Deposit Box, Heating, Design Hotel, Luggage Storage, All Public and Private spaces non-smoking, Airconditioning.</td>
            </tr>
            <tr>
                <td class="first">Check out</td>
                <td>Library</td>
            </tr>
            <tr>
                <td class="first">Cancellation</td>
                <td>Room Service, Laundry, Dry Cleaning, Breakfast in the Room, Ironing Service, Tour Desk, Fax/Photocopying, Ticket Service, Concierge Service.</td>
            </tr>
            <tr>
                <td class="first">Children & extra beds</td>
                <td>Free! Wi-fi is available in the entire hotel and is free of charge.</td>
            </tr>
            <tr>
                <td class="first">Pets</td>
                <td>No parking available</td>
            </tr>
        </tbody>
    </table>
</div>


<?php endif; ?>