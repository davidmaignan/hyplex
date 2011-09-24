<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>

<?php use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>


<?php
$amenities = array('1' => 'Room Service', 'Air Conditioning', 'Concierge', 'Elevator/Lift', 'Laundry', 'Luggage room', 'Porter',
    'Reception (24 hours)', 'Safety Deposit Boxes', 'Spa treatments', 'Terrace', 'Valet parking',
    'Well-being massage', 'Wi-Fi');
?>

<style>

    table{
        font-size: 80%;
        width: 100%;
    }

    td{
        vertical-align: top;
        padding-right: 15px;
        line-height: 17px;
    }
    td.line{
        border-top:1px solid #ddd;
        padding-top:10px;
    }

    td.icon{
        width: 35px;
        text-align: center;
        vertical-align: text-top;
    }

    td.last{
        padding-bottom: 10px;
    }

    td.smaller{
        padding-right: 5px;
    }

    td.check{
        background: url('/images/icons/12-em-check.png') 180px 5px no-repeat;
        border:1px dashed #ddd;
        border-left: none;
        border-right: none;
        padding:3px 0;
        width: 200px;

    }

    h1.hotel{
        font-size: 145%;
        font-family: "Times";
        letter-spacing: .02em;

    }

    h2.hotel{
        font-size: 119%;
        margin:10px 0;
        font-family: "Times";
    }

    h3{
        font-size: 80%;
        font-weight: bold;
        color: #0c4878;
        margin-bottom: 2px;
        margin-top: 3px;
    }

    p{
        font-size: 80%;
        line-height: 16px;
        margin-bottom: 10px;
    }


    #tabs{
        border-bottom: 1px solid #ddd;
        overflow: hidden;
        margin-top: 18px;
    }

    #tabs li{
        display: inline;
    }

    #tabs li a{
        width: 120px;
        height: 33px;
        display: block;
        float: left;
        font-size: 90%;
        border:1px solid #ddd;
        border-bottom: none;
        text-align: center;
        background-color: #efefef;
        line-height: 35px;
        margin-right: 10px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        -webkit-border-top-right-radius: 5px;
        -webkit-border-top-left-radius: 5px;
        border-top-left-radius: 5px; /* future proofing */
        border-top-right-radius: 5px; /* future proofing */
    }

    #rooms{
        width: 100%;
}

    #rooms td{
        padding:5px 0;
    }

    tr.line{
        border-bottom: 1px solid #ddd;
    }

    span.title{
        display: block;
        font-weight: bold;
        color: #0c4878;
        font-size: 110%;
    }


</style>


<div class="span-4 bg1">

    <div class="span-4 shadow bg-white">
        <div class="padded">
            <a href="#">Back to search result</a>
            <a href="#">Start search over</a>
        </div>

        <?php echo image_tag('tmp/hotel_left.jpg'); ?>
    </div>



</div>


<div class="span-21 last">

    <div class="span-21 shadow bg-white append-bottom">
        <div class="box-1">
            <h2><?php echo __('Your current package contains the following items:'); ?></h2>
        </div>
        <div class="box-2">
            <table>
                <tr>
                    <td class="icon"><?php echo image_tag('icons/flight.png', array('style' => 'border:1px solid #ddd; padding: 2px;')); ?></td>
                    <td class="blue" style="width: 330px;">
                        Los Angeles (LAX) to Honolulu (HNL)<br />
                        Honolulu (HNL) to Los Angeles (LAX)<br />
                    </td>
                    <td class="smaller" style="width: 68px;">
                        Depart:<br />
                        Return:
                    </td>
                    <td class="last">
                        Monday, Oct 21 2011 at 9:30am<br />
                        Friday, Oct 28 2011 at 5:30pm
                    </td>
                </tr>
                <tr>
                    <td class="icon line"><?php echo image_tag('icons/hotel.png', array('style' => 'border:1px solid #ddd; padding: 2px;')); ?></td>
                    <td class="blue line">
                        Hyatt Regency Waikiki Beach resort & Spa <br />
                        4 nights, 2 rooms, Ocean View
                    </td>
                    <td class="smaller line">
                        Check in:<br />
                        Check out:
                    </td>
                    <td class="last line">
                        Monday, Oct 21 2011<br />
                        Friday, Oct 28 2011
                    </td>
                </tr>
                <tr>
                    <td class="icon line"><?php echo image_tag('icons/car.png', array('style' => 'border:1px solid #ddd; padding: 2px;')); ?></td>
                    <td class="line blue">
                        1 economy car, Honolulu <br />
                        1 GPS, 1 baby seat, automatic transmission, 1 cd player
                    </td>
                    <td class="smaller line">
                        Pick up:<br />
                        Drop off:
                    </td>
                    <td class="line">
                        Monday, Oct 21 2011<br />
                        Friday, Oct 28 2011
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <div class="span-21 bg-white shadow">

        <div class="padded">

            <div class="span-21">
                <h1 class="hotel blue append-bottom padded">Hyatt Regency Waikiki Beach resort & Spa</h1>
                <div class="no-shadow _small span-8 padded" style="background-color: #efefef;">
                    <p class="padded">2424 Kalakaua Avenue,<br />
                        Honolulu, Hawaii, USA 96815-3289<br />
                        Tel: +1 808 923 1234<br />
                        Fax: +1 808 926 3415
                    </p>

                </div>

            </div>

        </div>

        <div style="clear: both;"></div>

        <div class="padded" id="tabs">

            <ul id="tabs">
                <li><a href="#" id="tab1">Hotel Overview</a></li>
                <li><a href="#" id="tab2">Rooms & Rates</a></li>
                <li><a href="#" id="tab3">Hotel policies</a></li>
                <li><a href="#" id="tab4">Activities</a></li>
                <li><a href="#" id="tab4">Attractions</a></li>
            </ul>

            <div class="span-21" id="tabs-1">

                <div class="span-12">
                    <div class="padded">
                        <h2 class="hotel">Hotel overview</h2>
                        <p>
                            Experience the ancient spirit of aloha from our luxury Hyatt Waikiki hotel.
                            The past and the future are united in fresh and surprising ways in this world-famous neighborhood
                            (known in Hawaiian as “spouting waters”) that was once the playground for Hawaiian royalty.</p>
                        <p>
                            Hyatt Regency Waikiki offers the ultimate combination of personalized service, oversized,
                            luxurious guestrooms, inspired culinary creations and a perfect location close to all that
                            embodies our island. Sink your toes in legendary sand, or stroll Diamond Head (Leahi),
                            Honolulu Zoo and the Waikiki Aquarium from our spectacular Hawaii Waikiki hotel. Relax,
                            refresh and recharge with a visit to Na Ho’ola Spa, our Hawaii hotel spa, or awaken your
                            adventurous side with surfing lessons on Waikiki Beach.</p>
                        <p>
                            Treat your staff to a meeting wrapped up in an island getaway. Set in the heart of Waikiki, our Honolulu
                            convention center hotel features expert staff, premier meeting facilities and cutting edge resources.
                            Reward yourself with a stay at our AAA Four Diamond island paradise, and experience the true meaning of
                            Hawaiian hospitality.
                        </p>
                    </div>
                    <div class="padded">
                        <h2 class="hotel">Amenities</h2>
                        <table><tr>
                                <?php
                                foreach ($amenities as $key => $value) {



                                    echo "<td class='check'>$value</td>";
                                    echo "<td></td>";

                                    if ($key % 2 == 0) {
                                        echo "</tr><tr>";
                                    }
                                }
                                ?>
                            </tr></table>
                    </div>
                </div>

                <div class="span-8 last" style="margin-left: 30px;">
                    <?php echo image_tag('tmp/hotel_gallery.jpg', array('class' => 'right')); ?>
                </div>

            </div>

            <div class="span-20 none" id="tabs-2">
                <p class="padded">Relax, refresh and recharge while enjoying spectacular views of Honolulu within our bright, welcoming Waikiki accommodations. Our spacious guestrooms are the largest in Waikiki and include one King or two Double beds.</p>
                <div class="padded">
                    <table id="rooms">
                        <tr class="line">
                            <td><input type="radio" /></td>
                            <td>City View</td>
                            <td>
                                Deluxe Cenote Room Superior double / twin<br />
                                1 King bed or 2 Queen bed
                            </td>
                            <td><a>Details</a></td>
                            <td class="right">
                                include in this package
                            </td>
                        </tr>
                        <tr class="line">
                            <td><input type="radio" /></td>
                            <td>City View</td>
                            <td>
                                Deluxe Cenote Room Superior double / twin<br />
                                1 King bed or 2 Queen bed
                            </td>
                            <td><a>Details</a></td>
                            <td class="right">
                                include in this package
                            </td>
                        </tr>
                        <tr class="line">
                            <td><input type="radio" /></td>
                            <td>City View</td>
                            <td>
                                Deluxe Cenote Room Superior double / twin<br />
                                1 King bed or 2 Queen bed
                            </td>
                            <td><a>Details</a></td>
                            <td class="right">
                                include in this package
                            </td>
                        </tr>
                    </table>
                </div>

            </div>

            <div class="span-20 none" id="tabs-3">
                <div class="padded">

                    <h3>Check In Time</h3>

                    <p>Check-in time is 3:00 p.m. The hotel will make every effort to accommodate early arrivals. Requests will be handled on an individual basis and will depend upon the hotel's current availability.</p>
                    <h3>Check Out Time</h3>

                    <p>Check-out time is 12:00 p.m. If you request a late check out an extension charge may apply. We would be happy to store your belongings in the valet room if you so require on the day of departure, at no charge.</p>
                    <h3>Cancellation Policy</h3>

                    <p>There is no cancellation fee if reservation is cancelled by 1600 local time. In case of no-show or late cancellation, you will be charged with one night's room charge.</p>
                    <h3>Guarantee Policy</h3>

                    <p>A credit card is required to confirm or guarantee reservation. Your credit card will not be charged in advance of stay.</p>
                    <h3>Guaranteed Reservation - Our Commitment Guarantee</h3>

                    <p>Feel confident that your guaranteed reservation will be honoured. However, in the event you should arrive and your reserved room has not been vacated by a previous guest, the Embassy Hotel & Suites will arrange accommodation for you at another hotel at our expense. We will also provide you with a long distance phone call, so you can notify a contact of these changes.</p>
                    <h3>Pet Policy</h3>

                    <p>No Pets Allowed</p>
                    <h3>Environmental Policy</h3>

                    <p>At the Embassy Hotel & Suites we constantly challenge ourselves to provide the right environment for our guests and employees. We are committed to minimizing the impact of our operations on the environment. With this goal in mind, the Embassy Hotel and Suites is committed to:</p>
                    <p>Comply with, or exceed, all applicable environmental laws and regulations. Promote environmental awareness. Train our employees to incorporate good environmental practice in all aspects of operation. Monitor our performance with respect to the environment, by periodically reviewing our practices, procedures, and objectives.</p>
                    <p>We further prompt guests and suppliers to participate for the protection of the environment. The Embassy Hotel & Suites gives guests the opportunity to make their own decisions in certain areas (e.g. replacement of towels, etc) so as to encourage their participation in such an approach. Suppliers are encouraged to operate in an environmentally responsible manner. We are a member of ECOmmodation - a benchmarking and certification program that encourages, promotes and supports the "greening" of the hotel industry to bring together hotels interested in environmental issues such as water and energy conservation and solid waste reduction. Our current ranking is 3 Green Key. We know that our commitment is ongoing, will take constant work, and will always need improving. Contact us at (613) 237- 2111 for more information about Embassy Hotel and Suites Policies.</p>
                </div>
            </div>

            <div class="span-20 none" id="tabs-4">

                <div class="padded">
                    <p>Fronting on the former playground of Hawaiian royalty, the world-class amenities
                        of our luxurious Waikiki resort will make you feel almost regal yourself.
                        Plan a relaxing day of renewal at Na Ho’ola Spa, swim in our fresh water pool
                        overlooking the beach, exercise 24/7 in the StayFitTM gym or shop in more than
                        60 unique boutiques on-site. There’s daily live Hawaiian entertainment at the Elegant
                        Dive pool bar, and families can “hulacise” or learn to make leis</p>
                        <p>Visit exciting attractions, like the Waikiki Aquarium, Honolulu Zoo, Diamond Head Crater,
                            art museums and galleries – all within walking distance of our Waikiki Hawaii resort
                            hotel. </p>
                        <p>Contact our knowledgeable Concierge to seek recommendations or book activities, dining
                            or entertainment reservations prior to your arrival.
                        </p>
                        <table id="rooms">
                            <tr>
                                 <td style="width: 170px;">
                                    <?php echo image_tag('tmp/hotel/about_content_111.jpg'); ?>
                                </td>
                                <td style="width: 220px;">
                                    <span class="title">Na Ho'ola Spa</span>
                                    Embrace the culture of Hawaii at Na Ho’ola, our Waikiki hotel spa.
                                </td>
                               
                            
                                 <td style="width: 170px;">
                                    <?php echo image_tag('tmp/hotel/about_content_65.jpg'); ?>
                                </td>
                                <td>
                                    <span class="title">Na Ho'ola Spa</span>
                                     Enjoy one of the world's most beautiful beaches from Hyatt Regency Waikiki Beach Resort and Spa.
                                </td>

                            </tr>
                            <tr>
                                 <td style="width: 170px;">
                                    <?php echo image_tag('tmp/hotel/about_content_49.jpg'); ?>
                                </td>
                                <td>
                                    <span class="title">Na Ho'ola Spa</span>
                                     Beckoning drums signal the opening of our special festivities held every Friday from 4:30 p.m.
                                     to 6:00 p.m. in the Great Hall on the first floor.
                                </td>

                            
                                 <td style="width: 170px;">
                                    <?php echo image_tag('tmp/hotel/about_content_98.jpg'); ?>
                                </td>
                                <td>
                                    <span class="title">Na Ho'ola Spa</span>
                                    Learn about some of Hawaii’s popular ali’i, (royalty), and important elements in Hawaiian culture.
                                </td>

                            </tr>
                        </table>
                </div>

            </div>

        </div>

    </div>


</div>

<div style="clear:both;" ></div>



<script type="text/javascript">


    $('document').ready(function(){
        $('#tabs-2').css('display', 'none');

        $('#tab1').click(function(){
            $('#tabs-1').css('display', 'block');
            $('#tabs-2').css('display', 'none');
            $('#tabs-3').css('display', 'none');
            $('#tabs-4').css('display', 'none');
            return false;
        });

        $('#tab2').click(function(){
            $('#tabs-1').css('display', 'none');
            $('#tabs-2').css('display', 'block');
            $('#tabs-3').css('display', 'none');
            $('#tabs-4').css('display', 'none');
            return false;
        });

        $('#tab3').click(function(){
            $('#tabs-1').css('display', 'none');
            $('#tabs-2').css('display', 'none');
            $('#tabs-3').css('display', 'block');
            $('#tabs-4').css('display', 'none');
            return false;
        });

        $('#tab4').click(function(){
            $('#tabs-1').css('display', 'none');
            $('#tabs-3').css('display', 'none');
            $('#tabs-2').css('display', 'none');
            $('#tabs-4').css('display', 'block');
            return false;
        });

    });


</script>