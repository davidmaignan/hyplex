<style type="text/css">

    .ad-gallery {
        width: 310px;
        margin-left: 20px;
    }
    .ad-gallery, .ad-gallery * {
        margin: 0;
        padding: 0;
    }
    .ad-gallery .ad-image-wrapper {
        width: 100%;
        height: 310px;
        margin-bottom: 10px;
        position: relative;
        overflow: hidden;
    }

</style>

<?php echo "<script> var slugName = '" . $slugName . "'; </script>"; ?>
<?php echo "<script> var hotelThumbName = '#hotel-thumb-" . $hotel->id . "'; </script>"; ?>

<!-- Hotel main content -->
<div class="span-17 last">

    <form id="hotel-detail-form" method="post" action="<?php echo url_for('hotel_detail_form') ?>">

        <input type="hidden" name="slug" value="<?php echo Utils::slugify($hotel->name) ?>" />
        <input type="hidden" name="filename" value="<?php echo $filename ?>" />

        <div class="span-17 last ">
            <div class="span-12">
                <ul class="none">
                    <li><?php echo html_entity_decode(HotelGenericObj::getStarRating($hotel->starRating)); ?></li>
                    <li class="bigger bold"><?php echo $hotel->getName(); ?></li>
                    <li><?php echo $hotel->getFullAddress(); ?></li>
                    <li class="paddingTop"><?php echo html_entity_decode($hotel->getFacilities()); ?></li>
                </ul>
            </div>
            <div class="last text-right" id="hotel-total-top" class="hotel-total">
                <ul class="none noMargin">
                    <li id="hotel-price" class="grey0 bold biggest2 right"><?php echo __('select a room'); ?></li>
                    <li class="grey1 small right">
                        Total for
                        <?php echo Utils::getNumberRoomsString($parameters->getNumberRooms()) ?>,
                        <?php echo Utils::getNightString($parameters->getNumberNights()) ?>
                    </li>
                    <li>
                        <input type="submit" value="<?php echo __('Book now') ?>" class="big right blue"/>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="space" />

        <div class="span-17 last append-bottom" id="tab-viewing">
            <ul class="none">
                <li><a href="#" id="tab-info" class="tab hotel-tab tab-information selected">Information & Rooms</a></li>
                <li><a href="#" id="tab-map" class="tab hotel-tab tab-map">Map</a></li>
                <li><a href="#" id="tab-review" class="tab hotel-tab tab-reviews">Reviews</a></li>
            </ul>
        </div>

        <div id="hotel-information-content">

            <h2 class="fontface blue1 title"><?php echo __('Information') ?></h2>

            <div class="span-17 hotel-information last">

                <div id="gallery" class="ad-gallery span-8 right" style="margin-left: 20px;">
                    <div class="ad-image-wrapper box2">
                    </div>
                    <div class="ad-controls hide">
                    </div>
                    <div class="ad-nav">
                        <div class="ad-thumbs center">
                            <ul class="ad-thumb-list">
                                <li>
                                    <a href="/images/tmp/hotel/1.jpg">
                                        <img src="#" class="image0">
                                    </a>
                                </li>
                                <li>
                                    <a href="/images/tmp/hotel/2.jpg">
                                        <img src="#"   class="image6">
                                    </a>
                                </li>
                                <li>
                                    <a href="/images/tmp/hotel/3.jpg">
                                        <img src="#"  class="image7">
                                    </a>
                                </li>
                                <li>
                                    <a href="/images/tmp/hotel/4.jpg">
                                        <img src="#"  class="image8">
                                    </a>
                                </li>
                                <li>
                                    <a href="/images/tmp/hotel/5.jpg">
                                        <img src="#"  class="image9">
                                    </a>
                                </li>
                                <li>
                                    <a href="/images/tmp/hotel/6.jpg">
                                        <img src="#"  class="image10">
                                    </a>
                                </li>
                                <li>
                                    <a href="/images/tmp/hotel/7.jpg">
                                        <img src="#"  class="image11">
                                    </a>
                                </li>
                                <li>
                                    <a href="/images/tmp/hotel/8.jpg">
                                        <img src="#"  class="image12">
                                    </a>
                                </li>
                                <li>
                                    <a href="/images/tmp/hotel/9.jpg">
                                        <img src="#"  class="image13">
                                    </a>
                                </li>
                                <li>
                                    <a href="/images/tmp/hotel/10.jpg">
                                        <img src="#"  class="image13">
                                    </a>
                                </li>
                                <li>
                                    <a href="/images/tmp/hotel/11.jpg">
                                        <img src="#"  class="image13">
                                    </a>
                                </li>
                                <li>
                                    <a href="/images/tmp/hotel/12.jpg">
                                        <img src="#"  class="image13">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <?php echo html_entity_decode($hotel->getFullDescription()); ?>

            </div>

            <hr class="space" />

            <?php include_partial('room', array('hotel' => $hotel)) ?>
            
            <input type="submit" value="<?php echo __('Book now') ?>" class="big right blue"/>


            <div class="span-17 last">
                <h2 class="fontface blue1 title"><?php echo __('Hotel Policies & Fees') ?></h2>
                <p>The following fees and deposits are charged by the property at time of service, check-in, or check-out.</p>
                <table>
                    <tr class="dotted2">
                        <td class="span-4 bold big">Policies</td>
                        <td>
                            <ul>
                                <li>Extra-person charges may apply and vary depending on hotel policy.</li>
                                <li>Government-issued photo identification and a credit card or cash deposit are required at check-in for incidental charges.</li>
                                <li>Special requests are subject to availability upon check-in and may incur additional charges. Special requests cannot be guaranteed.</li>
                                <li>Pets not allowed</li>
                                <li>Resort fee charged at hotel/condo</li>
                                <li>Check-in time starts at: 3 PM</li>
                                <li>Check-out time is: Noon</li>
                                <li>Minimum check-in age is: 21</li>
                            </ul>
                        </td>
                    </tr>
                    <tr class="dotted2">
                        <td class="span-4 bold big">Mandatory hotel-imposed fees</td>
                        <td>
                            <ul>
                                <li>Extra-person charges may apply and vary depending on hotel policy.</li>
                                <li>Government-issued photo identification and a credit card or cash deposit are required at check-in for incidental charges.</li>
                                <li>Special requests are subject to availability upon check-in and may incur additional charges. Special requests cannot be guaranteed.</li>
                                <li>Pets not allowed</li>
                                <li>Resort fee charged at hotel/condo</li>
                                <li>Check-in time starts at: 3 PM</li>
                                <li>Check-out time is: Noon</li>
                                <li>Minimum check-in age is: 21</li>
                            </ul>
                        </td>
                    </tr>
                </table>
                <h3 class="fontface blue1">Property Amenities</h3>
                <p>Wynn Las Vegas provides an exceptional guest experience, where luxury and intimacy
                    abound at every turn. The most difficult decision guests will make concerning their
                    stay is the choice between staying in a plush resort room in the heart of activity
                    or in the privacy of the Forbes Five-Star, AAA Five Diamond award-winning Tower Suites.</p>
                <p>World-class dining is a cornerstone of the Wynn Las Vegas experience. The resort
                    offers a collection of imaginative signature restaurants to choose from, each with
                    a unique Wynn twist. The renowned troupe of chefs tapped to create the cuisines have
                    not just prepared the menu, they are also in the kitchen nightly preparing the meals.</p>
                <p>
                    Whether the purpose of the visit is a Vegas-style romp or a relaxing retreat,
                    Wynn Las Vegas has a multitude of entertainment options, activities and amenities
                    to transport guests worlds away from their everyday. Presented exclusively at Wynn
                    Las Vegas, the aquatic live production Le Rêve offers breathtaking performances
                    featuring aerial acrobatics, provocative choreography and artistic athleticism in
                    an intimate theater in-the-round. And the Lake of Dreams--secluded by a 140-foot
                    high mountain--dazzles guests and diners nightly with surreal multimedia presentations
                    packed with pulsating music, spectacular light displays, puppetry, film and sculpture.
                </p>


                </p>
                <ul class="hotel-amenities">
                    <li> Swimming pool - outdoor</li>
                    <li>Poolside bar</li>
                    <li>Spa tub</li>
                    <li>Massage - spa treatment room(s)</li>
                    <li>Sauna</li>
                    <li>Full-service health spa</li>
                    <li>Concierge desk</li>
                    <li>Health club</li>
                    <li>Nightclub</li>
                    <li>Room service (24 hours)</li>
                    <li>Coffee shop or café</li>
                    <li>Bar/lounge</li>
                    <li>Valet parking</li>
                    <li>Parking (free)</li>
                    <li>Limo or Town Car service available</li>
                    <li>Business center</li>
                    <li>Banquet facilities</li>
                    <li>Exhibit space</li>
                    <li>Multiple conference/meeting rooms</li>
                    <li>Event catering</li>
                    <li>Audio-visual equipment</li>
                    <li>Internet in public areas </li>
                    <li>Express check-in</li>
                    <li>24-hour front desk</li>
                    <li>Porter/bellhop</li>
                    <li>Express check-out</li>
                    <li>Total number of rooms - 2,716</li>
                    <li>Number of floors - 50</li>
                    <li>Hair salon</li>
                    <li>Gift shops or newsstand</li>
                    <li>Shopping on site</li>
                    <li>Dry cleaning/laundry service</li>
                    <li>Casino</li>
                    <li>Elevator/lift</li>
                    <li>Air-conditioned public areas</li>
                    <li>Wedding services
                    <li>Beauty services
                    <li>Fitness facilities
                    <li>Restaurant(s) in hotel
                </ul>
            </div>
    </form>
</div><!-- hotel-information-content -->

<hr class="space" />

<div class="span-17 last hide" id="hotel-map-content">
    <h3 class="fontface blue1">Area map</h3>
    <div id="map_canvas" style="width: 100%; height: 400px; display: block;"></div>

    <h4 class="title blue1 bold prepend-top">Nearby Activities & Points of Interest</h4>

    <div class="span-6">
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
    <div class="span-6">
        <h6>0.50 - 1.0 mi</h6>
        <ul>
            <li>Palais Royal - 100 yards</li>
            <li>Louvre - 300 yards</li>
            <li>Pont du Carrousel - 500 yards</li>
            <li>Passarelle des Arts - 600 yards</li>
        </ul>
    </div>
    <div class="span-5 last">
        <h6>3.0+ mi</h6>
        <ul>
            <li>Passarelle des Arts - 600 yards</li>
            <li>Pont Royal - 600 yards</li>
            <li>City Centre Paris - 700 yards</li>
            <li>Place Vendome - 700 yards</li>
            <li>Paris Bourse - 800 yards</li>
            <li>Les Halles - 800 yards</li>
        </ul>
    </div>


</div><!-- hotel-map-content -->

<hr class="space" />

<div class="span-17 last hide" id="hotel-reviews-content">

    <h3 class="fontface blue1">Reviews</h3>

    <div class="span-8 last">
        <h6>Scores per type of guest </h6>
        <ul class="tags">
            <li><a>City center (85)</a></li>
            <li><a>Very nice (80)</a></li>
            <li><a>Resort fee (76)</a></li>
            <li><a>Room service (58)</a></li>
            <li><a>Silk road (52)</a></li>
            <li><a>Monte carlo (50)</a></li>
            <li><a>Pool area (40)</a></li>
            <li><a>Short walk (34)</a></li>
            <li><a>Coffee maker (31)</a></li>
            <li><a>Great view (29)</a></li>

        </ul>
    </div>
    <div class="span-6 last">
        <h6>Scores per area </h6>
        <table class="review-rating">
            <tr>
                <td>Comfort</td>
                <td class="review-rate"><div class="fill" style="width: 50%" /></td>
                <td class="_35 center">4.7</td>
            </tr>
            <tr>
                <td>Clean</td>
                <td class="review-rate"><div class="fill" style="width: 40%" /></td>
                <td class="_35 center">4.7</td>
            </tr>
            <tr>
                <td>Neighborhood</td>
                <td class="review-rate"><div class="fill" style="width: 70%" /></td>
                <td class="_35 center">4.7</td>
            </tr>
            <tr>
                <td>Service</td>
                <td class="review-rate"><div class="fill" style="width: 30%" /></td>
                <td class="_35 center">4.7</td>
            </tr>
            <tr>
                <td>Condition</td>
                <td class="review-rate"><div class="fill" style="width: 55%" /></td>
                <td class="_35 center">4.7</td>
            </tr>
            <tr>
                <td>Value</td>
                <td class="review-rate"><div class="fill" style="width: 76%" /></td>
                <td class="_35 center">4.7</td>
            </tr>
        </table>

    </div>
    <div class="span-3 right last score">
        <ul class="none">
            <li class="biggest3 bold white center ">91%</li>
            <li class="small">based on <br /><b>814 reviews</b></li>
        </ul>
    </div>


    <hr class="space" />
    <ul class="entourage">
        <li class="bold">Only show reviews for:
        <li><a href="#">Family (177)</a></li>
        <li><a href="#">Couples (771)</a></li>
        <li><a href="#">Business (152)</a></li>
        <li class="right">
            <select class="smaller noMargin noPadding">
                <option>date</option>
                <option>rating</option>
            </select>
        </li>
        <li class="right bold">sort by:</li>
    </ul>

    <hr class="space" />

    <?php for ($i = 0; $i < 10; $i++): ?>
        <div class="span-17 last review append-bottom">
            <div class="span-3">
                <?php echo image_tag('generic/no_user_photo-v1.gif'); ?>

                <ul class="none">
                    <li><a href="#" >Username </a></li>
                    <li><a href="#" >3 reviews</a></li>
                    <li><a href="#" >8 helpful votes </a></li>
                </ul>
            </div>
            <div class="span-14 last">
                <h3>"Spotless hotel"</h3>
                <ul class="inline rating-heart">
                    <li class="">
                        <?php echo image_tag('icons/heart.png', array('alt' => 'full heart', 'class' => 'heart')); ?>
                        <?php echo image_tag('icons/heart.png', array('alt' => 'full heart', 'class' => 'heart')); ?>
                        <?php echo image_tag('icons/heart.png', array('alt' => 'full heart', 'class' => 'heart')); ?>
                        <?php echo image_tag('icons/heart.png', array('alt' => 'full heart', 'class' => 'heart')); ?>
                        <?php echo image_tag('icons/heart_half.png', array('alt' => 'half heart', 'class' => 'heart')); ?>
                        <?php echo image_tag('icons/heart_empty.png', array('alt' => 'empty heart', 'class' => 'heart')); ?>
                    </li>
                    <li class="grey1">Reviewed November 8, 2011</li>
                    <li class="color2">New</li>
                </ul>
                <hr class="space1">
                <p>
                    Non smoking which was great. Rooms were so spacious with separate kitchen and lounge area.
                    Panoramic views from the room overlooking the Belagio fountains. The bed is the comfiest bed
                    I have ever had in a hotel. The market cafe was a bit pricey for what you were getting.
                    The pool wasn't deep enough and felt like a hot bath.
                </p>
                <ul class="inline">
                    <li>Was this review helpful?
                        <a href="#" class="tag">Yes</a>
                        <a href="#" class="tag">No</a>
                    </li>
                    <li class="right">
                        <a href="#">Problem with this review?</a>
                    </li>
                </ul>
            </div>
        </div>
    <?php endfor; ?>

</div><!-- hotel-reviews-content -->

<hr class="space" />

</div>


<hr class="space3" />

<!-- HTML snippets to be added to hotel compare div -->

<div id="hotel-thumb-<?php echo $hotel->id ?>" class="bg-1 hotel-thumb">
    <?php echo image_tag($hotel->getBaseLinkImage()); ?>
    <ul class="hotel-info">
        <li class="hotel-name">
            <?php
            echo link_to2($hotel->getName(), 'hotel_detail', array('slug' => Utils::slugify($hotel->getName())), array('class' => 'hotelNameDetailAjaxLink2',
                'onclick' => 'return false;'));
            ?></li>
        <li class="hotel-rating"><?php echo html_entity_decode(HotelGenericObj::getStarRating($hotel->starRating)); ?></li>
        <li><?php echo $hotel->getNumberRates() ?> rates available</li>
        <li><?php echo __('starting at: ') ?>
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

<?php //echo $sf_data->get('hotelCoordinates', ESC_RAW);  ?>

<script type="text/javascript">
	
    var hotelCoordinates = <?php echo $sf_data->get('hotelCoordinates', ESC_RAW); ?>

    var hotelLatitude = parseFloat(hotelCoordinates.latitude);
    var hotelLongitude = parseFloat(hotelCoordinates.longitude);
    var zoomLevel = 14;  

    
    function initialize2() {
        

       /*   
       var myOptions = {
                zoom: zoomLevel,
                center: new google.maps.LatLng(hotelLatitude, hotelLongitude),
                mapTypeId: google.maps.MapTypeId.ROADMAP
              };
       map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
       */
        
        mapInitializedHotelDetail = true;

        var latlng = new google.maps.LatLng((hotelLatitude), hotelLongitude);
        var markerImage = '/images/gmap/marker-hotel-viewed.png';
        var myOptions = {
            zoom: zoomLevel,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        
        

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
            var panorama = new  google.maps.StreetViewPanorama(document.getElementById("gMapHotels_canvas"),panoramaOptions);
            map.setStreetView(panorama);

        });

    };

    

    $('document').ready(function(){
      
        
      
        var galleries = $('.ad-gallery').adGallery({
            loader_image: '/images/ad-gallery/loader.gif',
            'display_back_and_forward': false,
            effect: 'fade',
            slideshow: {
                enable: false
            }
        });
            

        $('.hotel-tab').click(function(){

            var id = $(this).attr('id');

            switch(id){
                case 'tab-info':
                    $('.hotel-tab').removeClass('selected');
                    $(this).addClass('selected');
                    $('#hotel-information-content').show();
                    $('#hotel-map-content').hide();
                    $('#hotel-reviews-content').hide();
                    break;

                case 'tab-map':
                    $('.hotel-tab').removeClass('selected');
                    $(this).addClass('selected');
                    $('.hotel-tab-data').hide();
                    $('#hotel-information-content').hide();
                    $('#hotel-map-content').show();
                    $('#hotel-reviews-content').hide();

                    //if(mapInitializedHotelDetail == false){
                    initialize2();
                    //}

                    break;

                case 'tab-review':
                    $('.hotel-tab').removeClass('selected');
                    $(this).addClass('selected');
                    $('#hotel-information-content').hide();
                    $('#hotel-map-content').hide();
                    $('#hotel-reviews-content').show();
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





