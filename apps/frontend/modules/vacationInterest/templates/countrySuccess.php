<?php use_javascript('jquery-1.6.2.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.16.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('gallery'); ?>

<?php use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php use_javascript('debugger/myLogger.js'); ?>


<?php use_stylesheet('custom-theme/jquery-ui-1.8.16.custom.css'); ?>
<?php use_stylesheet('gallery'); ?>

<style>
    .tmp{
        display: block;
        min-height: 1000px;
        abackground: url('/images/tmp/vacationInterest.jpg') no-repeat left top;
    }

    #vac-int .header {
        overflow: hidden;
        border:1px solid white;
        background-color: #1c4879;
        -moz-box-shadow: 0px 0px 2px #333;
        -webkit-box-shadow: 0px 0px 2px #333;
        box-shadow: 0px 0px 2px #333;
        border:1px solid white;
        border-radius: 2px;
        height: 200px;
    }

    .bg1{
        background-color: #777777
    }

    .bg2{
        background-color: #bbbbbb;
    }

    ul.inline li{
        display: inline;
        float: left;
    }

    ul.inline li.first{
        font-weight: bold;
        font-size: 120%;
        line-height: 38px;
        width: 160px;

    }

    ul.inline li.first.small{
        font-weight: normal;
        font-size: 80%;
        line-height: 16px;

    }

    ul.inline li.second{
        float: right;
        width: 120px;
    }

    #must-do{
        position: absolute;
    }

    .hotel-list-box li{
        line-height: 16px;
    }

    div.news-rss{
        margin-bottom: 10px;
        clear: both;
        border-bottom: 1px solid #ffffff;
        padding-bottom: 6px;
        overflow: auto;
    }

    ul.news-rss-l2 li{
        margin-bottom: 3px;
        line-height: 14px;
    }

    .weather-forcast{
        font-size: 80%;
        width: 240px;
        margin-left: 20px;

    }

    .weather-forcast td{
        border: 0px solid #e0edf8;
        padding: 4px 6px;
    }

    #gallery_container{
        width: 670px;
        height: 420px;
        display: block;
        background-color: #dedecf;
    }

    #map_canvas{
        width: 100%;
        height: 600px;
        display: block;
        background-color: #dedede;
    }

    table.gmapIcon{
        width: auto;
}

    div.gmapIcon{
        vertical-align: middle;
        font-size: 80%;
        padding: 4px;
        margin-right: 10px;
        float: left;
        margin-top: 8px;
        border: 1px solid #dedecf;
        background-color: none;
        cursor: pointer;
	cursor: hand;
    }

    div.gmapIcon ul li{
        display: inline;
        vertical-align: middle;
        height: 20px;
        line-height: 20px;
    }

    div.gmapIcon img{
        float: left;
        margin-right: 3px;
    }

    div.gmapIcon.selected{
        border: 1px solid #a3b9cb;
        background-color: #eff7fd;
    }

    .gMapCategory{
        margin-right: 45px;
        margin-bottom: 30px;
    }


    .gMapCategory.last{
        margin-right: 0;
    }

    .gmapActivity{
        margin-bottom: 10px;
    }

    .gmapActivity img{
        float: left;
        margin-right: 10px;
    }

    #gmapInfoBubble{
        position: absolute;
        float: left;
        z-index: 1000;
        top: 400;
        width: 250px;
        height: 150px;
        background-color:rgba(255,255,255,0.75);
        padding:10px;
        margin:10px;
        top: 400px;
    }

    #gmapInfoBubble img{
        margin-bottom: 8px;
    }

</style>


<div class="span-26 last tmp" id="vac-int">

    <div class="span-26 last header append-bottom">
        <?php echo image_tag('tmp/vacationInterest_header.jpg'); ?>
    </div>

    <h1 class="biggest append-bottom">Vacations in Australia</h1>

    <div class="span-17 shadow append-bottom" id="tab-viewing">
        <ul>
            <li><a href="#" class="tab selected" id="tab-info">Info</a></li>
            <li><a href="#" class="tab" id="tab-gallery">Pictures</a></li>
            <li><a href="#" class="tab" id="tab-map">Map</a></li>
        </ul>
    </div>

    <div id="info">

        <div class="span-17" style="margin-right: 30px;">

            <div class="span-17">
                <blockquote>Sure it's got deadly spiders, snakes and sharks, but they don't stop people from coming here, never mind living here.</blockquote>
                <p>
                    And for good reason. From the prehistoric gorges of Kakadu National Park, to the white sails of the Sydney Opera House,
                    Australia is a country as big your imagination. Kick back on a beach as white as your mother's wedding dress in
                    Western Australia; lose yourself in the labyrinthine laneways of culture-rich Melbourne or be humbled by red desert sunsets over Uluru. </p>
                <p>
                    Turn south to visit hundred year old giants that loom large in the forests of Tasmania or take on Sydney, a heady mix of surf, sun,
                    money and sex, and you'll soon realise Australia is a place to be discovered, not feared.</p>

                <p><?php echo image_tag('tmp/vacationInterest_1.jpg', array('class' => 'right bordered')); ?>
                    The locals seem to be cursed with an insatiable yen for the unknown and they bend to it willingly, fleeing for weeks, months even, into
                    that vast spot in the middle called the outback. And it's a big out back; you can travel indefinitely without coming within cooee of a
                    phone call or an email. Nuts! Instead you have to make do with landscapes that shift from saffron to ochre beneath a seamless
                    canopy of deep indigo. And then there are ancient Aboriginal cultures, dazzling salt pans, secretive reptiles, rough-cut canyons
                    and pristine gorges. Some Australians simply go walkabout, traversing national parks filled with such devilish critters as koalas,
                    sugar gliders and knee-high wallabies. Others whiz through

                    world heritage rainforests on mountain bikes or apply ropes to their limbs,
                    chalk to their hands, truly skimpy shorts to their nether regions and scale lofty summits like bronze-backed insects.
                    And some simply launch themselves into the sky with parachutes attached to their backs.</p>

                <p>

                    Then there are the Australians who feel separation pains if they stray from the coast. So they don't. They sport permanent golden hues,
                    adopt languid gaits and wear cheeky grins. They glue themselves to surfboards, kayaks and boats and loll in the surf for hours (days even!).
                    As if that weren't enough, they flee to the Whitsunday Islands (Qld), the Ningaloo Reef (WA) or the immense Great Barrier Reef (Qld)
                    and spend days under the water defending themselves from kaleidoscopic marine life, colossal whale sharks, giant turtles and mischievous dolphins.</p>

                <p>

                    Fortunately, this lovely country is not without its urban havens, and in its dizzying cities you'll find folk who indulge in saner delights.
                    Rather than risk life and limb in the feisty Australian bush, they litter the beaches like comatose seals, reluctant to move unless emergency
                    dictates. Or they populate pubs with enormous beer gardens and focus all their energy on the pint/schooner bicep curl. They watch hours of sport
                    and possess a vast amount of knowledge about most games, without ever having actually played them. Of course Australia's metropolises also offer
                    glorious ways to wrap your head around the country's culture in myriad museums, theatres, festivals and galleries. A solid study of the bars
                    and restaurants will reveal the population's helpless addiction to coffee, seafood, organics and global cuisine; and the wine industry delights
                    discerning connoisseurs from around the world.</p>
                <p>
                    <?php echo image_tag('tmp/vacationInterest_2.jpg', array('class' => 'left bordered')); ?>
                    Ask an Australian what issues make them tick and you'll get a diversity of responses to match the multicultural mix. In general,
                    they're a pretty laid-back mob and the fundamentals of family, friends and fun tend to keep them relatively placated.
                    To avoid 'spirited' discussions it's best to keep talk regarding lacklustre performances of Australian sports teams to a minimum.
                    Many Australians feel a strong connection to the land, regardless of their background, and in recent years, the fragile state of the environment
                    has emerged as a universal equalizer. As much of the world tackles climate change at a theoretical level, Australians experience
                    it at a micro level. This is the driest continent in the world, and water restrictions are now the norm in most cities.
                    But Australians tend to face such difficulties with the same cocky spirit as anything else, and although the question of when will it
                    rain/how will it rain/will it please bloody rain is a constant, they cope with little complaint.</p>

                <p>So yep, it's a tough life down under. But only if you're averse to wide open skies, dramatic landscapes, countless activities,
                    fine wining and dining, and friendly locals. We know, because we've done our research.</p>

                <hr class="space3" />
                <h2 class="title prepend-top">Our top picks for Australia</h2>

                <?php
                    $arPicks = array(
                        array('pic' => 'kakadu.jpg',
                            'title' => 'Kakadu National Park',
                            'desc' => 'Find legroom, extraordinary wildlife and ancient culture in Australia\'s largest national park.
                            There are hundreds of square kilometres of park, so allow at least three days to discover a smidgen.',
                            'misc' => ''),
                        array('pic' => 'broome.jpg',
                            'title' => 'Broome',
                            'desc' => 'Get cosy with a camel and revel burnt amber sunsets where the desert meets the sea.
                            An improbable combination of colours – red from the pindan,
                            the aquamarine of Roebuck Bay and the pearl white of Cable Beach’s sands.',
                            'misc' => ''),
                        array('pic' => 'sydney.jpg',
                            'title' => 'Sydney',
                            'desc' => 'Fall in lust with the stunning harbour, sexy beaches,
                            stylish bars and bite-you-on-the-bum culture. It’s little wonder that Sydney causes a brain
                            drain on the rest of Australia. ',
                            'misc' => ''),
                        array('pic' => 'uluru.jpg',
                            'title' => 'Uluru (Ayers Rock)',
                            'desc' => 'Pay homage to Australia\'s most sacred rock. One of the world’s greatest natural
                            attractions, this park has more to offer visitors than just the Rock.
                            Along with the equally impressive Kata Tjuta (the Olgas), this entire area
                            is of deep cultural significance to the traditional owners. ',
                            'misc' => ''),
                        array('pic' => 'flinders.jpg',
                            'title' => 'Flinders Ranges',
                            'desc' => 'An ancient range, a utopia for campers and bushwalkers, bruised purple and green.
                            The shimmering red and purple folds of the majestic Flinders Ranges herald one of
                            the most stunning destinations in SA. ',
                            'misc' => ''));
                ?>


                        <?php foreach ($arPicks as $pick): ?>

                        <div class="span-17 append-bottom pick-list-box">
                            <div class=" span-5">
                            <?php echo image_tag('tmp/' . $pick['pic'], array('class' => 'baseLinkImage')); ?>
                            </div>
                            <div class="span-11 last">
                                <ul class="hotel-list">
                                    <li class="hotel-name">
                                        <a href="#"><?php echo $pick['title'] ?></a>
                            </li>
                            <li class="hotel-address">
                            <?php echo $pick['desc'] ?>
                            </li>
                        </ul>
                        <ul class="hotel-temptation">
                            <li class="show-map"><a href="#">Map</a></li>
                            <li class="bookmark"><a href="#"><?php echo __('Bookmark'); ?></a><li>
                        </ul>
                            </div>
                        </div>
                        <?php endforeach; ?>

            </div><!-- info -->




        </div>

        <div class="span-8 last bg2">
            <div class="box-1">
                Weather
            </div>
            <div class="box-2">
                <ul class="inline">
                    <li class="first">Sydney NSW</li>
                    <li class="second">
                        <select class="large">
                            <option>Choose location</option>
                            <option>Melbourne</option>
                            <option>Brisbane</option>
                        </select>
                    </li>
                </ul>

                <div class="center">
                        <?php echo image_tag('tmp/weather.jpg'); ?>
                        </div>
                        <hr class="space3" />
                        <?php
                        $arMonths = array('January', 'February', 'March', 'April', 'May', 'June',
                            'July', 'August', 'September', 'October', 'November', 'December');
                         ?>
                        <h5 class="prepend-top append-bottom bold center">Annual forecast values</h5>
                        <div class="">
                            <table class="weather-forcast">
                                <tr>
                                    <td></td>
                                    <td>min</td>
                                    <td>max</td>
                                </tr>
                            <?php foreach ($arMonths as $key => $value): ?>
                            <tr class="<?php echo ($key % 2 == 0) ? 'bg-1' : ''; ?>">
                                <td><?php echo $value; ?></td>
                                <td><?php echo rand(8, 14) ?></td>
                                <td><?php echo rand(12, 26) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <div class="box-1">
                    Currency exchange
                </div>
                <div class="box-2">
                    <ul class="inline append-bottom">
                        <li class="first small">Mid-market rates:<br />2011-10-27 16:26 UTC </li>
                        <li class="second">
                            <select>
                                <option>Change currency</option>
                                <option>USD</option>
                                <option>GBP</option>
                                <option>CAD</option>
                                <option>EURO</option>
                            </select>
                        </li>
                    </ul>
                    <div class="span-8 last center prepend-top">
                        <table class="span-7">
                            <tr>
                                <td class="color2 bigger bold">1.00 USD</td>
                                <td> = </td>
                                <td class="color2 bigger bold">0.945837 AUD</td>
                            </tr>
                            <tr class="">
                                <td class="grey1 smallest">1.00 USD = 0.945837 AUD</td>
                                <td></td>
                                <td class="grey1 smallest">1.076846 USD = 1.00 AUD</td>
                            </tr>
                        </table>
                    </div>
                    <hr class="space3" />
                </div>
                <div class="box-1">
                    News of Australia
                </div>
                <div class="box-2">
                    <ul class="inline">
                        <li class="first">theaustralian.com</li>
                        <li class="second">
                            <select style="width: 122px">
                                <option>Change channel</option>
                                <option>skynews.com</option>
                                <option>Sydney Herald Tribune</option>
                                <option>brisbanetimes</option>
                            </select>
                        </li>
                    </ul>
                    <hr class="space3" />
                    
                    <?php foreach($news as $new): ?>
                    <div class="news-rss">
                        <ul class="inline">
                            <li style="width: 75px;">
                                <img src="<?php echo $new['image'] ?>" width="60px" height="40px" style="display: block;" />
                            </li>
                            <li style="width: 200px;">
                                <ul class="news-rss-l2">
                                    <li class="bold"><a><?php echo $new['title'] ?></a></li>
                                    <li class="grey1 smallest"><?php echo $new['pubDate'] ?></li>
                                    <li class="small">
                                        <?php echo html_entity_decode($new['description']) ?></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <hr class="space2" />
                    <?php endforeach; ?>

                    </div>
                    <div class="box-1">
                        Map
                    </div>
                    <div class="box-2">
                <?php echo image_tag('tmp/australia_map.jpg'); ?>
            </div>

        </div>

    </div>
    <hr class="space" />
    <div class="span-26 last" id="gallery" >

        <?php include_partial('gallery'); ?>

        
        
    </div>

    <div id="map" class="span-26 last">

        <div class="span-26 last" style="position: relative;">

            <div id="gmapInfoBubble">
                <?php echo image_tag('tmp/Antony_Gormley_Statues.jpg', array('width'=>'100px;', 'id'=>'gmapInfoBubble-img')); ?>
                <ul>
                    <li id="gmapInfoBubble-id" class="grey1 bold smaller append-bottom2">Boat Rock, Yarrawonga/ Mulwala</li>
                    <li class="smaller grey2 append-bottom2 ">
                        <span id="gmapInfoBubble-desc">Discover a treasure consectetur adipisicing
                        elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
                        <a href="#" onclick="alert('to complete'); return false;">more</a>
                    </li>
                </ul>
            </div>

            <div id="map_canvas"></div>

            

        </div>

        <div class="span-26 last">
            <?php foreach($arIcons as $key=>$value):?>
                <div class="gmapIcon selected" id="<?php echo $key; ?>">
                    <ul>
                        <li><?php echo image_tag('gmap/'.$key.'.png',array('width'=>'20px')) ?></li>
                        <li><?php echo $value ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
        <hr class="space3" />

        <div class="span-26 last">

            <?php $i = 1; ?>
            
            <?php foreach($combined as $key=>$category): ?>
                <div class="span-8 gMapCategory <?php echo ($i%3 == 0)? 'last':''; ?>">

                    <h3 class="blue append-bottom title bold"><?php echo ucwords($arIcons[$key]); ?></h3>

                    <?php foreach($category as $element): ?>
                    <div class="gmapActivity">
                        <div class="span-3 last">
                            <?php echo image_tag('tmp/'.$element['pic'], array('width'=>'100px')); ?>
                        </div>
                        <div class="span-5 last">
                            <ul>
                                <li class="grey1 bold smaller append-bottom2"><a><?php echo $element['name'] ?></a></li>
                                <li class="smaller grey2 append-bottom2 "><?php echo truncate_text($element['desc'], 90) ?>
                                    <a href="#" onclick="alert('to complete'); return false;">more</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr class="space3" />
                    <?php endforeach; ?>
                </div>

                <?php ++$i; ?>

            <?php endforeach; ?>

            
        </div>
        <hr class="space3" />
        <?php //var_dump($combined['aboriginal']); ?>
    </div>

</div>



<script type="text/javascript">

    var mapMarkers = <?php echo $sf_data->get('mapMarkers', ESC_RAW); ?>;
    var arKeys = <?php echo $sf_data->get('keys', ESC_RAW); ?>;

    var arMarkers = [];

    $('document').ready(function(){
        
        var galleries = $('.ad-gallery').adGallery();

        $('#tab-info').click(function(){
            $('.tab').removeClass('selected');
            $(this).addClass('selected');
            $('#info').show();
            $('#gallery').hide();
            $('#map').hide();
            return false;
        });

        $('#tab-gallery').click(function(){
            $('.tab').removeClass('selected');
            $(this).addClass('selected');
            $('#info').hide();
            $('#gallery').show();
            $('#map').hide();
            return false;
        });

         $('#tab-map').click(function(){
            $('.tab').removeClass('selected');
            $(this).addClass('selected');
            $('#info').hide();
            $('#gallery').hide();
            $('#map').show();
            initializeGmapDestination();
            return false;
        });

        

        //mapInitialized = false;

        //initializeGmapDestination(mapInitialized);

        
        $('#gallery').hide();
        $('#info').show();
        $('#map').hide();

        //Link to show / hide markers
        $('.gmapIcon').click(function(){
            var id = $(this).attr('id');
            if($(this).hasClass('selected')){
                 showHideMarker(id, false);
                $(this).removeClass('selected');
            }else{
                $(this).addClass('selected');
                showHideMarker(id, true)
            }
        });

    });


function showHideMarker(id, bool){
    for(var i in arMarkers){
        if(arMarkers[i].type == id){
            arMarkers[i].setVisible(bool);
        }
    }
}


function initializeGmapDestination(bool){

    //ADS.log.write()

    //if(mapInitialized == true){
    //    return false;
    //}

    //if(bool == true){
    //    return false;
    //}

    //mapInitialized = true; // global var declared in hotelResultSuccess.php line 111;

    var latitude = parseFloat(mapMarkers.latitude);
    var longitude = parseFloat(mapMarkers.longitude);
    var zoomLevel = parseFloat(mapMarkers.zoom);

    var latlng = new google.maps.LatLng(latitude, longitude);

    var myOptions = {
      zoom: zoomLevel,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      scrollwheel: false
    };

    
    gMapResultPage = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    var results = mapMarkers.markers;

    for(var i in results){
        
        var markerImage = '/images/gmap/'+ results[i].icon +'.png';

        var lat = parseFloat(results[i].latitude);
        var lng = parseFloat(results[i].longitude);

        var marketLatLng = new google.maps.LatLng(lat,lng);

        var marker = new google.maps.Marker({
            position: marketLatLng,
            map: gMapResultPage,
            icon: markerImage,
            title: results[i].name
        });

        marker.name = results[i].name;
        marker.desc = results[i].desc;
        marker.image = results[i].pic;

        google.maps.event.addListener(marker, 'mouseover', function(event){
            //$('#gmapInfoBubble').show();
            $('#gmapInfoBubble-id').html(this.name);
            $('#gmapInfoBubble-desc').html(this.desc);
            $('#gmapInfoBubble-img').attr('src', 'http://hyplexdemo/images/tmp/'+this.image);
        });

        google.maps.event.addListener(marker, 'mouseout', function() {
            //$('#gmapInfoBubble').hide();
        });

        marker.type = results[i].icon;
        arMarkers.push(marker);
    }

}

</script>