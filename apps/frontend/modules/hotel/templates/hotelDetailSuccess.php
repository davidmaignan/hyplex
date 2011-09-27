<?php use_helper('Date', 'Number', 'I18n', 'Text'); ?>
<?php echo "<script> var slugName = '".$slugName."'; </script>"; ?>
<?php echo "<script> var hotelThumbName = '#hotel-thumb-".$hotel->id."'; </script>"; ?>


<form id="hotel-detail-form" method="post" action="<?php echo url_for('hotel_detail_form') ?>">

    <input type="hidden" name="slug" value="<?php echo Utils::slugify($hotel->name) ?>" />
    <input type="hidden" name="filename" value="<?php echo $filename ?>" />

<div class="span-18 shadow bg-white prepend-top append-bottom hotel-detail">

    <div class="span-18 last ">
        <div style="padding: 0px; float: left;" class="span-12 last">
            <p style="margin-bottom: 12px;"><?php echo html_entity_decode(HotelGenericObj::getStarRating($hotel->starRating)); ?></p>
            <h1><?php echo $hotel->getName(); ?></h1>
            <p><?php echo $hotel->getFullAddress(); ?></p>
            <p><?php  echo html_entity_decode($hotel->getFacilities()); ?></p>
        </div>
        <div class="span-5 last" id="hotel-total-top" class="hotel-total">
            <ul>
                <li id="hotel-price" class="hotel-price"><?php echo __('select a room'); ?></li>
                <li class="hotel-price-total">
                    Total for <?php echo $parameters->getNumberRooms(); ?> rooms, <?php echo $parameters->getNumberNights();?> nights
                </li>
                
                <li><input type="submit" value="Book now" class="search"/></li>

            </ul>
            
        </div>
       
    </div>

    
    <hr class="space3" />
    <div class="" style="padding:0px;">

        <div class="span-18 append-bottom" id="tab-viewing">
            <ul>
                <li><a id="tab-info" class="view-information hotel-tab selected"><?php echo __('Information') ?></a></li>
                <li><a id="tab-rate" class="view-rates hotel-tab"><?php echo __('Rooms & Rates') ?></a></li>
                <li><a onclick="return false;" id="tab-map" class="view-map hotel-tab"><?php echo __('Map') ?></a></li>
                <li><a onclick="return false;" id="tab-review" class="hotel-tab view-reviews"><?php echo __('Reviews'); ?></a></li>
            </ul>
        </div>
       
        <hr class="space2" />
        <div id="tab-data-info" class="hotel-tab-data">
            <h2 class="title"><?php echo __('Information') ?></h2>

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
                <div id="hotel-description">
                    <p class="small"><?php echo html_entity_decode($hotel->getFullDescription()); ?></p>
                </div>
                <p class="small"><?php //echo ($hotel->getFullDescription()); ?></p>

            </div>
            <hr class="space3" />

            <?php $hotelFacilites = $hotel->getFullFacilities(); ?>

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
        </div>


       <div id="tab-data-rate" class="hotel-tab-data">
            <div>
                <h2 class="title"><?php echo __('Rooms & Rates') ?></h2>
            </div>

            <?php include_partial('room',array('hotel'=>$hotel)); ?>
            
            <hr class="space3" />

        </div>


        <div id="tab-data-map" class="hotel-tab-data">

            <div id="map_canvas">
                
            </div>
            <ul>
                <li><a href="#" id="resetMap" class="resetGmap" onclick="initialize(); return false;"><?php echo ucfirst(__('reset map')); ?></a></li>
            </ul>
            <hr class="space3" />
            <h2 class="title">Area map</h2>


            <hr class="space"/>
            <h2 class="title">Nearby Activities & Points of Interest</h2>
            <div class="list-activities">
                <div class="span-7 append-1">
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
                <div class="span-7 last">
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

</form>

<hr class="space3" />

<?php
//echo "<pre>";
//print_r($hotel);

?>

<div id="hotel-thumb-<?php echo $hotel->id ?>" class="bg-1 hotel-thumb">
    <?php echo image_tag($hotel->getBaseLinkImage()); ?>
    <ul class="hotel-info">
    <li class="hotel-name">
        <?php
        echo link_to2($hotel->getName(), 'hotel_detail',
                array('slug' => Utils::slugify($hotel->getName())),
                array('class' => 'hotelNameDetailAjaxLink2',
                      'onclick'=> 'return false;'));
        ?></li>
        <li class="hotel-rating"><?php echo html_entity_decode(HotelGenericObj::getStarRating($hotel->starRating)); ?></li>
        <li><?php echo $hotel->getNumberRates() ?> rates available</li>
        <li><?php echo __('starting at: ')?>
            <span class="color2 bold"><?php echo format_currency($hotel->minPrice,sfConfig::get('app_currency')); ?></span>
        </li>

    </ul>
    <div class="hotel-thumb-off">
        <p class="white"><?php echo ucfirst(__('add to compare')); ?></p>
    </div>
    <div class="hotel-thumb-on">
        <p class="white"><?php echo ucfirst(__('added')); ?></p>
    </div>
    <div class="hotel-thumb-remove">
        <p class="white"><?php echo ucfirst(__('remove')); ?></p>
    </div>
</div>

<style>


    /* Table rates ------------------------------------------ */

    /* Table rates */

    

</style>

<script type="text/javascript">

  var hotelCoordinates = <?php echo $sf_data->get('hotelCoordinates', ESC_RAW); ?>

  var hotelLatitude = parseFloat(hotelCoordinates.latitude);
  var hotelLongitude = parseFloat(hotelCoordinates.longitude);
  var zoomLevel = parseFloat(hotelCoordinates.zoomlevel);

  var mapInitializedHotelDetail = false;

  function initialize() {

        mapInitializedHotelDetail = true;

        var latlng = new google.maps.LatLng((hotelLatitude), hotelLongitude);
        var markerImage = '/images/gmap/marker-hotel-viewed.png';
        var myOptions = {
          zoom: zoomLevel,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          scrollwheel: false
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);


        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title:"Hotel name",
            draggable: true,
            icon: markerImage
            //animation: google.maps.Animation.DROP
        });

        
        google.maps.event.addListener(map, 'click', function() {

          if (map.getZoom() <= 12) {
            map.setZoom(17);
            map.setCenter(latlng);
          } else {
            map.setZoom(12);
            map.setCenter(latlng);
          }
            
        });

        google.maps.event.addListener(marker,'dragend',function(){
            //alert('dragend');
            
            latlng = marker.getPosition();
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


        $('.hotel-tab-data').hide();
        $('#tab-data-info').show();
        

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
                if(mapInitializedHotelDetail == false){
                     initialize();
                }

                break;

                case 'tab-review':
                $('.hotel-tab').removeClass('selected');
                $(this).addClass('selected');
                $('.hotel-tab-data').hide();
                $('#tab-data-review').show();
                break;

                case 'tab-rate':
                $('.hotel-tab').removeClass('selected');
                $(this).addClass('selected');
                $('.hotel-tab-data').hide();
                $('#tab-data-rate').show();
                break;


            }

            return false;

        });


        //Move hotel-thumb to viewedHoteldiv
        var hotelThumb = $(hotelThumbName).detach();
        addHotelThumb(hotelThumbName, hotelThumb);
        //hotelThumb.appendTo('#viewedHotels');


        //Change icon for viewed
        for(var i in markers){
            if(markers[i].slug == slugName){
                changeMarkerIcon(markers[i],'viewed');
            }
        }

        activateRadioRoomPrice();
        activateTermsConditions();
        activateHotelThumbHover();

  });


  

</script>





