<?php use_helper('Date', 'Number', 'I18n', 'Text'); ?>

<div class="span-18 shadow bg-white append-bottom hotel-detail">

    <div class="span-18">
        <div style="padding: 15px; float: left;">
            <h1>Concorde La Fayette <?php echo image_tag('icons/5stars.png') ?></h1>
            <p>3 Place du Général Koenig, 17. Palais des Congrès, 75017 Paris</p>
        </div>
       <input type="submit" value="Book now" class="search-small" style="float: right; margin: 15px;" />
    </div>

    
    <hr class="space" />
    <div class="" style="padding: 15px;">

        <ul id="tabs">
            <li><a href="#" class="active hotel-tab" id="tab-info"><?php echo __('Information and availability') ?></a></li>
            <li><a href="#" class="hotel-tab" onclick="return false;" id="tab-map"><?php echo __('Map') ?></a></li>
            <li><a href="#" class="hotel-tab" onclick="return false;" id="tab-review"><?php echo __('Reviews') ?></a></li>
        </ul>
        <hr class="space2" />
        <div id="tab-data-info" class="hotel-tab-data">


            <div id="images">

                <div id="main-image">
                    <?php echo image_tag('../uploads/hotels/dummy/1.jpg', array('class'=>'normal', 'alt'=>"no pic")); ?>
                </div>

                <div id="list-thumbs">
                    <ul>
                        <li><a><?php echo image_tag('../uploads/hotels/dummy/1th.jpg', array('class'=>'thumb')) ?></a></li>
                        <li<a><?php echo image_tag('../uploads/hotels/dummy/2th.jpg', array('class'=>'thumb')) ?></a></li>
                        <li><a><?php echo image_tag('../uploads/hotels/dummy/3th.jpg', array('class'=>'thumb')) ?></a></li>
                        <li><a><?php echo image_tag('../uploads/hotels/dummy/1th.jpg', array('class'=>'thumb')) ?></a></li>
                        <li><a><?php echo image_tag('../uploads/hotels/dummy/2th.jpg', array('class'=>'thumb')) ?></a></li>
                        <li><a><?php echo image_tag('../uploads/hotels/dummy/2th.jpg', array('class'=>'thumb')) ?></a></li>
                        <li><a><?php echo image_tag('../uploads/hotels/dummy/2th.jpg', array('class'=>'thumb')) ?></a></li>
                        <li><a><?php echo image_tag('../uploads/hotels/dummy/3th.jpg', array('class'=>'thumb')) ?></a></li>
                    </ul>
                </div>

                <p class="small">Concorde La Fayette sits between the Champs-Elysées and La Défense. It is famous for its 33rd-floor panoramic bar overlooking the Eiffel Tower, and is directly connected to the Palais des Congrés.
                    Rooms at the Concorde La Fayette have a view of the Eiffel Tower or the Sacre Cœur Basillica in Montmarte. They all have flat-screen satellite TV, free Wi-Fi and bathrooms with bath and shower.
                    The Restaurant La Fayette serves traditional French cuisine and hosts a Sunday champagne brunch with live entertainment for children.</p>

            </div>
            <hr class="space3" />
            <div>
                <h2>Available</h2>
                <p>Available rooms from Sat 17 Sep 2011, to Sun 18 Sep 2011 <a href="#">Change dates</a></p>
            </div>

            <table class="rates">
                <thead>
                    <tr>
                        <th clas="room-type"><?php echo __('Room type'); ?></th>
                        <th><?php echo __('Room 1'); ?></th>
                        <th><?php echo __('Room 2'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="room-type">
                        <td>Deluxe room with two queen beds<span class="number-rate">1 rate available<span></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="room-rate">
                        <td class="room-rate-name">Sunshine on Sale</td>
                        <td class="price"><input type="radio"  name="room1" value="0" /><?php echo format_currency(229.90, sfConfig::get('app_currency')); ?></td>
                        <td class="price"><input type="radio"  name="room1" value="0" /><?php echo format_currency(229.90, sfConfig::get('app_currency')); ?></td>
                    </tr>
                    <tr class="room-rate">
                        <td class="room-rate-name">Mountain view</td>
                        <td class="price"><input type="radio"  name="room1" value="0" /><?php echo format_currency(229.90, sfConfig::get('app_currency')); ?></td>
                        <td class="price"><input type="radio"  name="room1" value="0" /><?php echo format_currency(229.90, sfConfig::get('app_currency')); ?></td>
                    </tr>
                    <tr class="room-type">
                        <td>Deluxe room with two queen beds<span class="number-rate">1 rate available<span></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="room-rate">
                        <td class="room-rate-name">Sunshine on Sale</td>
                        <td class="price"><input type="radio"  name="room1" value="0" /><?php echo format_currency(229.90, sfConfig::get('app_currency')); ?></td>
                        <td class="price"><input type="radio"  name="room1" value="0" /><?php echo format_currency(229.90, sfConfig::get('app_currency')); ?></td>
                    </tr>
                    <tr class="room-rate">
                        <td class="room-rate-name">Mountain view</td>
                        <td class="price"><input type="radio"  name="room1" value="0" /><?php echo format_currency(229.90, sfConfig::get('app_currency')); ?></td>
                        <td class="price"><input type="radio"  name="room1" value="0" /><?php echo format_currency(229.90, sfConfig::get('app_currency')); ?></td>
                    </tr>
                    <tr class="room-type">
                        <td>Deluxe room with two queen beds<span class="number-rate">1 rate available<span></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="room-rate">
                        <td class="room-rate-name">Sunshine on Sale</td>
                        <td class="price"><input type="radio"  name="room1" value="0" /><?php echo format_currency(229.90, sfConfig::get('app_currency')); ?></td>
                        <td class="price"><input type="radio"  name="room1" value="0" /><?php echo format_currency(229.90, sfConfig::get('app_currency')); ?></td>
                    </tr>
                    <tr class="room-rate">
                        <td class="room-rate-name">Mountain view</td>
                        <td class="price"><input type="radio"  name="room1" value="0" /><?php echo format_currency(229.90, sfConfig::get('app_currency')); ?></td>
                        <td class="price"><input type="radio"  name="room1" value="0" /><?php echo format_currency(229.90, sfConfig::get('app_currency')); ?></td>
                    </tr>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><input type="submit" value="Book Now" /></td>
                    </tr>
                </tfoot>

            </table>
            
            <hr class="space3" />

            <div>
                <h2><?php echo __('Hotel facilities') ?></h2>
                <table class="hotel-info">
                    <tbody>
                        <tr>
                            <td class="first">General</td>
                            <td>Bar, 24-Hour Front Desk, Newspapers, Garden, Non-Smoking Rooms, Rooms/Facilities for Disabled Guests, Elevator, Safety Deposit Box, Heating, Design Hotel, Luggage Storage, All Public and Private spaces non-smoking, Airconditioning.</td>
                        </tr>
                        <tr>
                            <td class="first">Activities</td>
                            <td>Library</td>
                        </tr>
                        <tr>
                            <td class="first">Services</td>
                            <td>Room Service, Laundry, Dry Cleaning, Breakfast in the Room, Ironing Service, Tour Desk, Fax/Photocopying, Ticket Service, Concierge Service.</td>
                        </tr>
                        <tr>
                            <td class="first">Internet</td>
                            <td>Free! Wi-fi is available in the entire hotel and is free of charge.</td>
                        </tr>
                        <tr>
                            <td class="first">Parking</td>
                            <td>No parking available</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr class="space3" />

            <div>
                <h2><?php echo __('Hotel Policies') ?></h2>
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

        </div>


        <div id="tab-data-map" class="hotel-tab-data">

            <div id="map_canvas">
                
            </div>
            <hr class="space3" />
            <h2>Area map</h2>


            <hr class="space3 "/>
            <h2>Nearby Activities & Points of Interest</h2>
            <div class="list-activities">
                <div class="span-8 append-1">
                <h6>Less than 0.5 miles</h6>
                <ul>
                    <li>Palais Royal - 100 yards</li>
                    <li>Louvre - 300 yards</li>
                    <li>Pont du Carrousel - 500 yards</li>
                    <li>Passarelle des Arts - 600 yards</li>
                    <li>Pont Royal - 600 yards</li>
                    <li>City Centre Paris - 700 yards</li>
                    <li>Place Vendome - 700 yards</li>
                    <li>Paris Bourse - 800 yards</li>
                    <li>Les Halles - 800 yards</li>
                </ul>
                </div>
                <div class="span-8">
                <h6>0.50 - 1.0 mi</h6>
                <ul>
                    <li>Jardin des Tuileries - 900 yards</li>
                </ul>
                <br />
                <h6>3.0+ mi</h6>
                <ul>
                    <li>Paris Heliport (JDP) - 3.4 miles</li>
                    <li>Paris Le Bourget Airport (LBG) - 7.4 miles</li>
                    <li>Paris Orly Airport (ORY) - 9.2 miles</li>
                    <li>Toussus-le-Noble Airport (TNF) - 13 miles</li>
                    <li>Emerainville Airport - 13 miles</li>
                    <li>Paris Charles De Gaulle Airport (CDG) - 13 miles</li>
                    <li>Pontoise Cormeilles Airport (POX) - 21 miles</li>
                    <li>Paris Beauvais Airport (BVA) - 43 miles</li>
                    <li>Chartres Champhol (QTJ) - 47 miles</li>
                </ul>
                </div>
            </div>           
        </div>

    </div>
    <hr class="space3" />

</div>

<style>


    /* Google map */

    #tab-data-map{
        display: none;
    }

    #map_canvas{
        width: 100%;
        height: 350px;
        background-color: #eee;
    }

    .list-activities h6{
        font-size: 80%;
        font-weight: bold;
        
        margin: 0 0 3px 0;
        
    }
    .list-activities ul{
        margin: 0 0 8px 0;
    }

    .list-activities ul li{
        
        font-size: 80%;
        padding-bottom: 3px;
        
        
    }

    /* Hotel info */

    #tab-data-info{
        display: table-row;
    }

    .hotel-detail h1{
        font-size: 160%;
        color: #0c4878;
        font-family: Times;
    }

    .hotel-detail h2{
        font-size: 100%;
        color: #0c4878;
        font-weight:  800;
        margin-bottom: 5px;
        padding-bottom: 7px;
        border-bottom: 1px solid #a3b9cb;
    }

    #tabs{
        height: 28px;
        background-color: #eff6fb;
    }

    #tabs li{
        display: inline;
        font-size: 85%;
        line-height: 18px;
    }

    #tabs a{
        padding: 0 18px;
        height: 28px;
        display: block;
        float: left;
        line-height: 28px;
        min-width: 70px;
        
        text-align: center;
    }

    #tabs a:hover{
        background-color: #e0edf8;
    }

    #tabs a.active{
        background-color: #deded0;
    }

    

    #images #main-image{
        width: 300px;
        height: 200px;
        background-color: #ddd;
        display: block;
        float: left;
        margin-right: 10px;
    }

    #list-thumbs{
        float: left;
        width: 370px;
    }

    #list-thumbs li{
        display: inline;
    }

    #list-thumbs li a{
        display: block;
        float: left;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .hotel-detail p{
        
        font-size: 82%;
        line-height: 15.6px;
        letter-spacing: normal;
        font-weight: 400;
    }

    /* Table rates */

    table.rates, table.hotel-info{
        margin: 10px 0;
        font-size: 90%;
        width: 100%;
    }

    table.rates th, table.rates td{
        vertical-align: middle;
        padding: 0 10px;
        text-align: left;
    }

    table.rates th{
        background-color: #a3b9cb;
        color: white;
        font-weight: bold;
        height: 25px;
    }

    table.rates td{
        padding: 5px 10px;
        vertical-align: top;
    }

    table.rates thead tr{
        border: 1px solid #a3b9cb;
    }

    table.rates tbody tr{
        border: 1px solid #dae3ea;

    }

    table.rates tr.room-type{
        color: #0c4878;
    }

    table.rates tr.room-rate td{
        margin: 0;
        padding: 5px 10px;
        line-height: 20px;
    }

    table.rates tbody .price{
        font-size: 100%;
        border-left: 1px solid white;
        
    }

    table.rates tbody .price input{
        padding-right: 20px;
        
    }

    span.number-rate{
        float: right;
        font-style: italic;
        font-size: 75%;
        color: #888;
        font-weight: normal;
    }


    table.rates tbody td.room-rate-name{
        background: url('/images/icons/bullet_orange.png') no-repeat 10px 7px;
        padding-left: 30px;
    }

    table.rates tfoot td{
        padding-top: 20px;
    }



    table.hotel-info td{
        font-size: 90%;
        line-height: 17px;
        padding: 5px 5px 10px 15px;
    }

    table.hotel-info td.first{
        width: 100px;
        color: #0c4878;  
        font-weight: bold;
        background-color: #edede5;
        border-bottom: 1px solid white;
        padding: 5px 5px 10px 15px;
    }


</style>

<script type="text/javascript">


  var mapInitialized = false;

  function initialize() {

        mapInitialized = true;

        var latlng = new google.maps.LatLng(21.276, -157.825);
        var myOptions = {
          zoom: 12,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          scrollwheel: false
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);


        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title:"Hotel name"
            //animation: google.maps.Animation.DROP
        });

        
        google.maps.event.addListener(map, 'click', function() {

          if (map.getZoom() <= 12) {
            map.setZoom(17);
          } else {
            map.setZoom(12);
            map.setCenter(latlng);
          }
            
        });
        
        google.maps.event.addListener(marker, 'click', function() {

            var panoramaOptions = {
              position: latlng,
              enableCloseButton: true,
              scrollwheel: false,
              pov: {
                heading: 34,
                pitch: 10,
                zoom: 0
              }
            };
            var panorama = new  google.maps.StreetViewPanorama(document.getElementById("map_canvas"),panoramaOptions);
            map.setStreetView(panorama);


        });

        

    };

    

  $('document').ready(function(){

        

        $('.hotel-tab').click(function(){

            var id = $(this).attr('id');

            switch(id){
                case 'tab-info':
                $('.hotel-tab').removeClass('selected');
                $(this).addClass('selected');
                $('.hotel-tab-data').hide();
                $('#tab-data-info').show();
                break;

                case 'tab-map':
                $('.hotel-tab').removeClass('selected');
                $(this).addClass('selected');
                $('.hotel-tab-data').hide();
                $('#tab-data-map').show();
                if(mapInitialized == false){
                     initialize();
                }

                break;

                case 'tab-review':
                $('.hotel-tab').removeClass('selected');
                $(this).addClass('selected');
                $('.hotel-tab-data').hide();
                $('#tab-data-review').show();
                break;


            }



        });

  });

</script>





