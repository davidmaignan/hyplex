<?php echo "<script> var slugName = '".$slugName."'; </script>"; ?>
<?php echo "<script> var hotelThumbName = '#hotel-thumb-".$hotel->id."'; </script>"; ?>

<form id="hotel-detail-form" method="post" action="<?php echo url_for('hotel_detail_form') ?>">

    <input type="hidden" name="slug" value="<?php echo Utils::slugify($hotel->name) ?>" />
    <input type="hidden" name="filename" value="<?php echo $filename ?>" />

<div class="span-18 shadow bg-white prepend-top append-bottom hotel-detail">

    <div class="span-18 last ">
        <div class="span-12">
            <ul class="normal">
                <li><?php echo html_entity_decode(HotelGenericObj::getStarRating($hotel->starRating)); ?></li>
                <li class="bigger bold"><?php echo $hotel->getName(); ?></li>
                <li class="small append-bottom"><?php echo $hotel->getFullAddress(); ?></li>
                <li><?php  echo html_entity_decode($hotel->getFacilities()); ?></li>
            </ul>
        </div>
        <div class="span-5 last" id="hotel-total-top" class="hotel-total">
            <ul>
                <li id="hotel-price" class="hotel-price"><?php echo __('select a room'); ?></li>
                <li class="hotel-price-total">
                    Total for
                    <?php echo Utils::getNumberRoomsString($parameters->getNumberRooms()) ?>,
                    <?php echo Utils::getNightString($parameters->getNumberNights()) ?>
                </li>     
                <li><input type="submit" value="<?php echo __('Book now') ?>" class="search right blue"/></li>
            </ul>
        </div>
    </div>

    <hr class="space3" />

    <div class="span-18 append-bottom" id="tab-viewing">
        <ul>
            <li><a id="tab-info" class="view-information hotel-tab selected"><?php echo __('Information') ?></a></li>
            <li><a onclick="return false;" id="tab-map" class="view-map hotel-tab"><?php echo __('Map') ?></a></li>
            <li><a onclick="return false;" id="tab-review" class="hotel-tab view-reviews"><?php echo __('Reviews'); ?></a></li>
        </ul>
    </div>
       
    <hr class="space2" />


    <div id="tab-data-info" class="hotel-tab-data">
        <h2 class="title"><?php echo __('Information') ?></h2>

        <div id="images" class="span-18">
            <?php echo image_tag('tmp/hotel_gallery.jpg'); ?>

        </div>
        <div id="hotel-description" class="span-18">
            <p class="small"><?php echo html_entity_decode($hotel->getFullDescription()); ?></p>
        </div>
        <hr class="space3" />
        <div class="prepend-top">
            <h2 class="title"><?php echo __('Rooms & Rates') ?></h2>
        </div>

        <?php include_partial('room',array('hotel'=>$hotel)); ?>

        <hr class="space3" />

        <?php include_partial('hotelFacilities',array('hotelFacilites'=>$hotel->getFullFacilities())) ?>

        
    </div>

    <?php include_partial('map_hotelDetail'); ?>

    <hr class="space3" />

</div>

</form>

<hr class="space3" />

<!-- HTML snippets to be added to hotel compare div -->

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
            <span class="color2 bold"><?php echo Utils::getPrice($hotel->minPrice); ?></span>
        </li>

    </ul>
    <div class="hotel-thumb-off">
        <p class="white"><?php echo __('add to compare'); ?></p>
    </div>
    <div class="hotel-thumb-on">
        <p class="white"><?php echo __('added'); ?></p>
    </div>
    <div class="hotel-thumb-remove">
        <p class="white"><?php echo __('remove'); ?></p>
    </div>
</div>


<script type="text/javascript">

  var hotelCoordinates = <?php echo $sf_data->get('hotelCoordinates', ESC_RAW); ?>

  var hotelLatitude = parseFloat(hotelCoordinates.latitude);
  var hotelLongitude = parseFloat(hotelCoordinates.longitude);
  var zoomLevel = 14;
      //parseFloat(hotelCoordinates.zoomlevel);

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

          if (map.getZoom() <= 14) {
            map.setZoom(17);
            map.setCenter(latlng);
          } else {
            map.setZoom(14);
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





