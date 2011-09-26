//Global variable
var gMapResultPage;     //var for the gMapHotel result page
var gMapBounds;
var infoBubble;         //window for map
var infoBubbleHotel;
var markers = [];
var markerToAnimate;
var markerFiltered;

var hotelViewediterator = 0;

var termsConditionsTarget;

var ajaxRequest;

var sTID_time;

var timer_is_on=0;

var hotelDetailPage = false;
var mapInitialized = false;

//var gMapHotel_starRating = [];

//Function to check if element is in_array.
if (!Array.prototype.indexOf)
{
    Array.prototype.indexOf = function(elt /*, from*/)
    {
        var len = this.length >>> 0;

        var from = Number(arguments[1]) || 0;
        from = (from < 0)
        ? Math.ceil(from)
        : Math.floor(from);
        if (from < 0)
            from += len;

        for (; from < len; from++)
        {
            if (from in this &&
                this[from] === elt)
                return from;
        }
        return -1;
    };
}

function ucfirst (str) {
    var f = str.charAt(0).toUpperCase();
    return f + str.substr(1);
}

function ucwords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
};

function preg_quote( str ) {
    return (str+'').replace(/([\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:])/g, "\\$1");
}


function highlight2( data, search ){
    //return data.replace( new RegExp( preg_quote( search ), 'gi' ), "<span style='font-weight:bold;color:#ED145B;'>" + search + "</span>" );

}


function tripDuration(secs)
{
    var hours = Math.floor(secs / (60));
    var divisor_for_minutes = secs % (60);
    var minutes = Math.floor(divisor_for_minutes);
    var result = hours +"h " +minutes+"m";

    return result;
}


function secondsToTime(secs, bool)
{

    var hours = Math.floor(secs / (60 * 60));

    var divisor_for_minutes = secs % (60 * 60);
    var minutes = Math.floor(divisor_for_minutes / 60);

    var jeton;

    if(minutes == 0){
        minutes = "00";
    }else if(minutes < 10){
        minutes = "0"+minutes
    }

    if(bool == true)
    {
        if(hours <=12){
            hours = hours;
            jeton = "am";
        }else{
            hours = hours-12;
            jeton = "pm";
        }

    }else{
        jeton = '';
    }

    var divisor_for_seconds = divisor_for_minutes % 60;
    var seconds = Math.ceil(divisor_for_seconds);

    var result = hours+":"+minutes+jeton;

    return result;

}

function getTimeInSeconds(hour, min, sec)
{
    return hour*3600+min*60+sec;
}


/* Active flight details show */

function activateFlightDetails(){

    $('.flight-link-details').toggle(function(){
        $(this).closest('.flight-box').next('.flight-box-details').show();
    }, function(){
        $(this).closest('.flight-box').next('.flight-box-details').hide();
    });
}

function formatAirportString(row)
{
    var str = '';

    

    for(var i in row){
        //ADS.log.write(row[i]);
    }
    
    str += row.cityName + ', ';
    if(row.state != ''){
        str += row.state + ', ';
    }
    if(row.country != ''){
        str += row.country + ', ';
    }
    if(row.airportName != '' && row.airportName != row.cityName){
        str += row.airportName;
    }
    if(row.airportCode != ''){
        str += ' ('+row.airportCode + ')';
    }

    return str;

}

function formatAirportStringNoComma(row)
{
    var str = '';



    for(var i in row){
        //ADS.log.write(row[i]);
    }

    str += row.cityName + ' ';
    if(row.state != ''){
        str += row.state + '  ';
    }
    if(row.country != ''){
        str += row.country + '  ';
    }
    if(row.airportName != '' && row.airportName != row.cityName){
        str += row.airportName;
    }
    if(row.airportCode != ''){
        str += ' ('+row.airportCode + ')';
    }

    return str;

}


function sendFilterRequest(target)
{

    var url;
    var page;

    $( "#dialog-message" ).dialog({
        modal: true,
        buttons: {
            Cancel: function() {
                $( this ).dialog( "close" );
                //Cancel the request sent
                ajaxRequest.abort();
            }
        }
    });

    var form = $('#filterForm');
    
    //retreive the data from the filterForm
    var datas = $('#filterForm').serialize();

    //retreive the sorting value
    //var sorting = target.attr('id');
    var sorting = $('#sorting a.selected').attr('id');
    datas += '&sortBy='+sorting;

    //If google marker is clicked.
    if(target instanceof google.maps.Marker){

        url = target.link;

    }else{

        //If page link clicked - retreive the page value
        if(target.hasClass('page-link')){
            page = target.html();
            showHideHotelDivs(0);
        }else{
            page = 1;
        }

        datas += '&page='+page;

        //If link from the form
        if(target.is('a')){
            url = target.attr('href');
            //showHideHotelDivs(0);

        }else{
            url = form.attr('action');
        }

        var classes = target.attr('class');

        //ADS.log.write(classes);

        //Special case if hotel name link clicked show div for displaying hotel detail page
        if(classes.search(/(hotelNameDetailAjaxLink2)/) > -1 || classes.search(/(hotelNameDetailAjaxLink)/) > -1){
            showHideHotelDivs(0);
        }

       
        if(url == '' || url == undefined){
            url = $('#filterForm').attr('action');
        }

        datas += '&class='+ classes.split(' ').join('_');

    }

    //alert(url);

    //ADS.log.write(url);

    //If hotel detail show tabs back to result
    if(url.search(/(hotel-detail)/) > -1){
        $('#backToResults').show();
    }

    //Determine which kind of filtering user is doing
    ajaxRequest = $.ajax({
        type: "post",
        url: url,
        data: datas,
        success: onRequest2Success,
        error: onRequestFailure
    });

}

//Functio when ajax request fails
function onRequestFailure(msg)
{
    $("#dialog-message").dialog( "destroy" );
    
    switch (msg.status) {
        case 403:
            // 403 specific handler
            break;

        case 404:
    // 404 specific handler
    }
}


//Function when ajax request is successfull
function onRequest2Success(msg){
    
    $('#Results').html(msg);
    $("#dialog-message").dialog( "destroy" );
    activateFlightDetails();
    activateSorting();
    activatePagination();
    activateHotelGallery();
    activateFilterBox();  //Yellow box filter
    activateHotelNameDescriptionCall();
    hotelShowMap();

    
    
}

//Function to activate links in the pagination list
function activatePagination(){
    $('.page-link').click(function(){
        sendFilterRequest($(this));
        return false;
    });
}

//Function for sorting
function activateSorting(){
    $('#sorting a').click(function(){

        $('#sorting a').removeClass('selected');
        $('#sorting a').closest('li.level-1').removeClass('selected');

        $(this).addClass('selected');
        $(this).closest('li.level-1').addClass('selected');

        sendFilterRequest($(this));
    });

}

//Function for the yellow filter boxes
function activateFilterBox(){

    $('.filter-box').click(function(){

        var value = $(this).attr('class');

        switch (true) {
            case value.search(/(Star)/) > -1:
                $('.reset-star').hide();
                $('input.starRatingCheckbox').attr('checked', 'checked');
                break;
            case value.search(/(pick)/) > -1:
                $('.reset-isOurPick').hide();
                $('input.isOurPickCheckbox').attr('checked', 'checked');
                break;
            case value.search(/(Location)/) > -1:
                $('.reset-location').hide();
                $('input.locationCheckbox').attr('checked', 'checked');
                break;
            case value.search(/(chain)/) > -1:
                $('.reset-chain').hide();
                $('input.chainCheckbox').attr('checked', 'checked');
                break;
            case value.search(/(Prices)/) > -1:
                $('.reset-slider').hide();
                ResetAverageNightlyRateSlider(minPrice,maxPrice,minPrice,maxPrice,minPrice,maxPrice);
                break;

            default:
                break;
        }

        sendFilterRequest($(this));
        return false;
    });
}

//Hotels --------------------------------------------------------------- //


//Function for link on the hotel name
function activateHotelNameDescriptionCall(){
    $('a.hotelNameDetailAjaxLink').click(function(){
            sendFilterRequest($(this));
            return false;
    });
}

//Function for link on the hotel name in viewed tabs
function activateHotelNameDescriptionCall2(){
    $('a.hotelNameDetailAjaxLink2').click(function(){
            sendFilterRequest($(this));
            return false;
    });
}

//Filtering functions

function activateResetGmap(){
    $('a.resetGmap').click(function(){
        mapInitialized = false;
        showHideHotelDivs(1);
        initializeGmapHotels(mapInitialized);

        return false;
    });
}

function activateHotelFilteringLinks(){
    $('a.hotelDetailAjaxLink').click(function(){
        sendFilterRequest($(this));
        return false;
    });


}

//Function to show/hide location and

function activateShowHideLocationChain(){

    $('.show-location').toggle(function(){
        $('.location2').show();
        return false;
    }, function(){
        $('.location2').hide();
        return false;
    });

    $('.show-chain').toggle(function(){
        $('.chain2').show();
        return false;
    }, function(){
        $('.chain2').hide();
        return false;
    });

}

//When any checkbox in the hotel filter form is clicked.
function activateHotelFilteringCheckboxes(){
    $('.filterHotelCheckbox').click(function(){
        $(this).closest('div').prev('div.box-1').children('a.remove-small').show();
        sendFilterRequest($(this));
    });
}

//When any links in the form is clicked -> display Remove-small btn
function showRemoveSmallLink(){
    $('#filterForm a').click(function(){
        $('#infoFilterResult').hide();
        $('#clearFiltersAll').show();
        $(this).closest('div').prev('div.box-1').children('a.remove-small').show();

    });
}

function activateStarRatingFilter(){
 $('a.filter-star-link').click(function(){
        var name = this.id.split('-');
        $('.starRatingCheckbox').removeAttr('checked');
        var number = name[name.length-1];
        $('#starRating_'+number).attr('checked', 'checked');
        sendFilterRequest($(this));
        return false;
  });
}

function activateLocationFilter(){
    $('a.filter-location-link').click(function(){
        var name = this.id.split('-');
        $('.locationCheckbox').removeAttr('checked');
        var number = name[name.length-1];
        $('#location_'+number).attr('checked', 'checked');
        sendFilterRequest($(this));
        return false;
    });
}

function activateChainFilter(){
    $('a.filter-chain-link').click(function(){
        var name = this.id.split('-');
        $('.chainCheckbox').removeAttr('checked');
        var number = name[name.length-1];
        $('#chain_'+number).attr('checked', 'checked');

        sendFilterRequest($(this));
        return false;
    });
}

function activateResetFilter(){

    //Reset filter btns
        $('a.remove-small').click(function(){
            $(this).hide();
            var value = $(this).prev('h4').attr('id');
 
            switch (value) {
                case 'star_rating':
                    $('input.starRatingCheckbox').attr('checked', 'checked');
                    break;
                case 'is_our_pick':
                    $('input.isOurPickCheckbox').attr('checked', 'checked');
                    break;
                case 'location':
                    $('input.locationCheckbox').attr('checked', 'checked');
                    break;
                case 'chain':
                    $('input.chainCheckbox').attr('checked', 'checked');
                    break;
                case 'average_nightly_rate':
                    ResetAverageNightlyRateSlider(minPrice,maxPrice,minPrice,maxPrice,minPrice,maxPrice);
                    break;
                default:
                    break;
            }
            sendFilterRequest($(this));
            return false;
        });
}

//Function for Slider price hotels
function ResetAverageNightlyRateSlider(min,max,posMin,posMax,minRange,maxRange){
    $('#slider_minPrice').html('min: <span class="bold">'+minPrice+'</span>');
    $('#slider_maxPrice').html('max: <span class="bold">'+maxPrice+'</span>');
    $("#average_nigthlyRate").val(minRange + ' - ' + maxRange);
    $("#info_average_nigthlyRate").html(minRange + ' - ' + maxRange);

    $("#slider_average_nigthlyRate").slider( "destroy" );
    $("#slider_average_nigthlyRate").slider({
        range: true,
        min: min,
        max: max,
        values: [minRange, maxRange],
        slide: function(event, ui) {
            $("#average_nigthlyRate").val(ui.values[0] + ' - ' + ui.values[1]);
            $("#info_average_nigthlyRate").html(ui.values[0] + ' - ' + ui.values[1]);
        }
    });

    $( "#slider_average_nigthlyRate").slider({
           stop: function(event, ui) {
                $('#average_nightly_rate').next('a.remove-small').show();
                sendFilterRequest($(this));
            }
    });

    /*

    $("#slider_average_nigthlyRate").slider2( "destroy" );
    $("#slider_average_nigthlyRate").slider2({
        range: true,
        min: min,
        max: max,
        posMin: posMin,
        posMax: posMax,
        values: [minRange, maxRange],
        slide: function(event, ui) {
            $("#average_nigthlyRate").val(ui.values[0] + ' - ' + ui.values[1]);
            $("#info_average_nigthlyRate").html(ui.values[0] + ' - ' + ui.values[1]);
        }
    });

    $( "#slider_average_nigthlyRate").slider2({
           stop: function(event, ui) {
                $('#average_nightly_rate').next('a.remove-small').show();
                sendFilterRequest($(this));
            }
    });

    */
};



/* GMap functions and hotel tabs */


function changeMarkerIcon(marker, bool){

    //ADS.log.write(marker.getIcon());
    var iconUrl;
    var newIconUrl;
    
    if(bool == 'off'){
        iconUrl = marker.getIcon();
        newIconUrl = iconUrl.replace('on','off');
        marker.setIcon(newIconUrl);
    }

    if(bool == 'viewed'){
        iconUrl = marker.getIcon();
        newIconUrl = iconUrl.replace('hotel-o','hotel-viewed-o');
        marker.setIcon(newIconUrl);
    }
    //alert('changeMarkerIcon');
    //ADS.log.write(iconUrl+ ':'+newIconUrl);

}

function showHideMarkers(){


    //ADS.log.write(markerFiltered);

    //Reset all the marker icons to on
    for(var i in markers){

        //Change all markers back to initial icon
        var iconUrl = markers[i].getIcon();
        var newIconUrl = iconUrl.replace('off','on');
        markers[i].setIcon(newIconUrl);

        //Check if in markerFiltered array return by filter action

        if(!in_array(markers[i].id, markerFiltered)){
           changeMarkerIcon(markers[i],'off');
        }
    }


    /*

    //retreive the data from the filterForm
    var datas = $('#filterForm').serializeArray();

    var filterDatas = [];

    for(var i in datas){
        var name = datas[i].name;
        var value = name.slice(name.indexOf('[') + 1).split(']');
        value = value.slice(0, -1);
        if(value != ''){
            filterDatas.push(value);
        }
    }

    for(var i in markers){

       //ADS.log.write(markers[i].chain);

       if(!in_array(markers[i].starRating, filterDatas)){
           changeMarkerIcon(markers[i],false);
       }

       if(!in_array(markers[i].location, filterDatas)){
           changeMarkerIcon(markers[i],false);
       }

       if(!in_array(markers[i].chain, filterDatas)){
           changeMarkerIcon(markers[i],false);
       }

    }

    */

}

function in_array (needle, haystack, argStrict) {

    var key = '',
        strict = !! argStrict;

    if (strict) {
        for (key in haystack) {
            if (haystack[key] === needle) {
                return true;
            }
        }
    } else {
        for (key in haystack) {
            if (haystack[key] == needle) {
                return true;
            }
        }
    }

    return false;
}


function activateHotelTabulation(){

    $('.hotelResult-tabs').click(function(){            

            var value = $(this).attr('id');

             switch (true) {
                case value.search(/(map)/) > -1:
                    
                    //ADS.log.write('mapInitialized: '+mapInitialized);
                    initializeGmapHotels(mapInitialized);
                    showHideHotelDivs(1);
                    break;

                case(value.search(/(backToResults)/)>-1):
                    $(this).hide();
                    showHideHotelDivs(0);
                    sendFilterRequest($(this));
                    break;

                case(value.search(/(viewed)/)>-1):
                    showHideHotelDivs(2);
                    break;

                default:
                    //ADS.log.write('show list');
                    showHideHotelDivs(0);
                    break;

             }


            return false;
    });


}

function showHideHotelDivs($val){
    
    switch($val){
        case 0:
            $('#hotelListResult').show();
            $('#gMapHotels').hide();
            $('#viewedHotels').hide();
            $('#compareHotels').hide();
            $('.hotelResult-tabs').removeClass('selected');
            $('#tab-hotels-list').addClass('selected');
            $('html,body').animate({scrollTop: $("#tab-hotels-map").offset().top},'fast');
        break;

        case 1:
            $('#hotelListResult').hide();
            $('#gMapHotels').show();
            $('#viewedHotels').hide();
            $('#compareHotels').hide();
            $('.hotelResult-tabs').removeClass('selected');
            $('#tab-hotels-map').addClass('selected');
            $('html,body').animate({scrollTop: $("#tab-hotels-map").offset().top},'fast');
        break;

        case 2:
            $('#viewedHotels').show();
            $('#hotelListResult').hide();
            $('#gMapHotels').hide();
            $('#compareHotels').hide();
            $('.hotelResult-tabs').removeClass('selected');
            $('#tab-hotels-viewed').addClass('selected');
            $('html,body').animate({scrollTop: $("#tab-hotels-map").offset().top},'fast');
        break;

        case 3:
            $('#viewedHotels').hide();
            $('#hotelListResult').hide();
            $('#gMapHotels').hide();
            $('#compareHotels').show();
            $('.hotelResult-tabs').removeClass('selected');
            $('#tab-hotels-viewed').addClass('selected');
            $('html,body').animate({scrollTop: $("#tab-hotels-map").offset().top},'fast');

            break;

    }


}

function showGmapForOneHotel(bool, marker, zoom){

    //var infoBubblePosition =

    //If true the map has been initialized before
    if(mapInitialized == true){
        
        gMapResultPage.setCenter(marker.getPosition());
        gMapResultPage.setZoom(zoom);

    }else{

        //mapInitialized = true; //variable to initialized map only once

        var myOptions = {
          zoom: zoom,
          center: marker.getPosition(),
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          scrollwheel: false
        };

        gMapResultPage = new google.maps.Map(document.getElementById("gMapHotels_canvas"), myOptions);

        mapInitialized = true; // global var declared in hotelResultSuccess.php line 111;

        var markerCluster = new MarkerClusterer(gMapResultPage, markers,{
            maxZoom: 8
        });

        

    }

    google.maps.event.addListenerOnce(gMapResultPage, 'tilesloaded', function() {

            infoBubbleHotel = new InfoBubble({
              map: gMapResultPage,
              content: marker.message,
              position: getInfoBubblePosition(marker),
              shadowStyle: 0,
              padding: 0,
              backgroundColor: 'rgb(235,235,235)',
              borderRadius: 0,
              arrowSize: 1,
              borderWidth: 1,
              borderColor: '#FFFFFF',
              disableAutoPan: true,
              hideCloseButton: true,
              arrowPosition: 30,
              backgroundClassName: 'phoney',
              arrowStyle: 2
            });

            infoBubbleHotel.open();

            markerToAnimate = marker;

            
            setToggleBounce();
         });

}

function setToggleBounce(){
    //markerToAnimate.setAnimation(null);
    //setTimeout(alert('set time out'), 100000);
    //ADS.log.write('setToggleBounce');

    if (markerToAnimate.getAnimation() != null) {
        markerToAnimate.setAnimation(null);
    } else {
        markerToAnimate.setAnimation(google.maps.Animation.BOUNCE);
        setTimeout('setToggleBounce()',1500);
    }    
}

function initializeGmapHotels(bool){

    //ADS.log.write()

    if(mapInitialized == true){
        return false;
    }

    if(bool == true){
        return false;
    }

    mapInitialized = true; // global var declared in hotelResultSuccess.php line 111;

    //ADS.log.write('initialize the map');

    var latitude = parseFloat(gMapHotels.latitude);
    var longitude = parseFloat(gMapHotels.longitude);
    var zoomLevel = parseFloat(gMapHotels.zoomlevel);

    //ADS.log.write(gMapHotels.latitude);
    //ADS.log.write(gMapHotels.longitude);


    var latlng = new google.maps.LatLng(latitude, longitude);

    var myOptions = {
      zoom: zoomLevel,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      scrollwheel: false
    };
    
    gMapResultPage = new google.maps.Map(document.getElementById("gMapHotels_canvas"), myOptions);
       
    //Add markers
    var hotels = gMapHotels.hotels;

    //gMapBounds = new google.maps.LatLngBounds();

    /*
    for(var i in hotels)
    {
        addMarker(i,hotels[i]);
    }
    */
    //alert(gMapBounds.getCenter());
    
    gMapResultPage.fitBounds(gMapBounds);

    var markerCluster = new MarkerClusterer(gMapResultPage, markers,{
        maxZoom: 8
    });
    
    google.maps.event.addListener(gMapResultPage, 'click', function() {
        var zoom = this.getZoom();
        if(zoom < 18){
            this.setZoom(zoom+1);
        }
        //ADS.log.write(zoom);

    });

}



function createMarkerArray(){

     gMapBounds = new google.maps.LatLngBounds();

     var hotels = gMapHotels.hotels;

     for(var i in hotels)
     {
        //ADS.log.write(i);
        //addMarker(i,hotels[i]);
        //ADS.log.write(hotels[i].name);
        createMarker(i, hotels[i]);
     }

   

}

function createMarker(id, a){

    var latitude = parseFloat(a.latitude);
    var longitude = parseFloat(a.longitude);

    var myLatlng = new google.maps.LatLng(latitude, longitude);

    var markerImage = '/images/gmap/marker-hotel-on.png';
    gMapBounds.extend(myLatlng);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: gMapResultPage,
        title:a.name,
        draggable: false,
        icon: markerImage
        //animation: google.maps.Animation.DROP
    });

    markers.push(marker);


    addMarkerFunctionality(marker, id, a);
    
}

function addMarkerFunctionality(marker, id, a){
    var content = '<div class="infoHotelBubble"><ul>';
    content += '<li class="title">'+a.name+'</span>';
    content += '<li class="starRating"><img src="/images/icons/'+a.starRating+'stars.png" /></li>';
    content += '</ul><div style="clear: both;"></div>';
    content += '<div class="desc"><img src="'+a.image+'" class="small-pic" />short description will come here</div>';
    content += '<div style="clear: both; "></div>'
    content += '<div class="info-rates">'+ a.numberRates+' rates starting at <span class="minPrice"> '+a.minPrice+'</span></div>';
    content += '</div>';

    marker.message = content;
    marker.id = id;
    marker.starRating = a.starRating;
    marker.location = a.location;
    marker.chain = a.chain;
    marker.slug = a.slug

    var host = window.location.href.slice(0, window.location.href.indexOf('hotel/'));
    marker.link = host+'/hotel-detail/'+a.slug;

    google.maps.event.addListener(marker, 'mouseover', function(event){


        if (infoBubbleHotel != undefined)
        {
            infoBubbleHotel.close();
        }
        //if (infoBubbleHotel) {
            //do something
            //infoBubbleHotel.close();
        //}
        
        createInfoBubble(this.message, getInfoBubblePosition(this));
    });

    google.maps.event.addListener(marker, 'mouseout', function() {
        infoBubbleHotel.close();
    });

    google.maps.event.addListener(marker,'click',function(){

        //change the icon
        this.setIcon('/images/gmap/marker-hotel-viewed-on.png');
        showHideHotelDivs(0);
        sendFilterRequest(this);
        return false;
    });

    google.maps.event.addListener(marker,'rightclick', function(){
        gMapResultPage.setCenter(this.getPosition());
        var zoom = gMapResultPage.getZoom();
        gMapResultPage.setZoom(14);
    });


    
}



function createInfoBubble(message, position){

    //ADS.log.write('createInfoBubble');
    
    infoBubbleHotel = new InfoBubble({
      map: gMapResultPage,
      content: message,
      position: position,
      shadowStyle: 0,
      padding: 0,
      backgroundColor: 'rgb(235,235,235)',
      borderRadius: 0,
      arrowSize: 1,
      borderWidth: 1,
      borderColor: '#FFFFFF',
      disableAutoPan: true,
      hideCloseButton: true,
      arrowPosition: 30,
      backgroundClassName: 'phoney',
      arrowStyle: 2
    });

    infoBubbleHotel.open();
}

function getInfoBubblePosition(marker){

    var markerLatLng = marker.getPosition();
        var mapWidth = 715;
        var mapHeight = 650;

        //Define the lat and lng of infoBubble
        var boundsNorthEast = gMapResultPage.getBounds().getNorthEast();
        var boundsSouthWest = gMapResultPage.getBounds().getSouthWest();

        var gMapHeight = Math.abs(boundsNorthEast.lat()) - Math.abs(boundsSouthWest.lat());
        var gMapWidth = Math.abs(boundsNorthEast.lng()) - Math.abs(boundsSouthWest.lng());

        //ADS.log.write(gMapWidth);

        var pxPerWidth = Math.abs(gMapWidth)/(mapWidth);
        var pxPerHeight = Math.abs(gMapHeight)/(mapHeight);

        var heightExtra = 0;
        var widthExtra = 0;

        var newLongitude;
        var newLatitude;

        var checkHeight = Math.abs(Math.abs(markerLatLng.lat()) - Math.abs(boundsNorthEast.lat()));
        var checkWidthWest = Math.abs(Math.abs(markerLatLng.lng()) - Math.abs(boundsSouthWest.lng()));

        //Height of window bubble
        if(checkHeight/pxPerHeight < 125){
            heightExtra = -120* pxPerHeight;
        }else{
            heightExtra = 25* pxPerHeight;
        }

        if(checkWidthWest/pxPerWidth < 35){
            newLongitude = markerLatLng.lng() +  130*pxPerWidth;
        }else if(checkWidthWest/pxPerWidth < 145){
            newLongitude = markerLatLng.lng() +  65*pxPerWidth;
        }else if(checkWidthWest/pxPerWidth > 528){
            newLongitude =  boundsNorthEast.lng() - 190 * pxPerWidth;
        }else{
            newLongitude = markerLatLng.lng();
        }

        newLatitude = markerLatLng.lat() + heightExtra;

        var infoBubbleLatlng = new google.maps.LatLng(newLatitude, newLongitude);

        return infoBubbleLatlng;

}

/*
function addMarker(id, a){

    //ADS.log.write(a.name);
    
    var latitude = parseFloat(a.latitude);
    var longitude = parseFloat(a.longitude);

    var myLatlng = new google.maps.LatLng(latitude, longitude);

    var markerImage = '/images/gmap/marker-hotel-on.png';
    gMapBounds.extend(myLatlng);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: gMapResultPage,
        title:a.name,
        draggable: false,
        icon: markerImage
        //animation: google.maps.Animation.DROP
    });

    markers.push(marker);

    attachSecretMessage(marker, id, a);
    
}

function attachSecretMessage(marker, id, a) {

    var content = '<div class="infoHotelBubble"><ul>';
    content += '<li class="title">'+a.name+'</span>';
    content += '<li class="starRating"><img src="/icons/'+a.starRating+'stars.png" /></li>';
    content += '</ul><div style="clear: both;"></div>';
    content += '<div class="desc"><img src="'+a.image+'" class="small-pic" />short description will comes here</div>';
    content += '<div style="clear: both; "></div>'
    content += '<div class="info-rates">'+ a.numberRates+' rates starting at <span class="minPrice"> '+a.minPrice+'</span></div>';
    content += '</div>';

    marker.message = content;
    marker.id = id;

    var host = window.location.href.slice(0, window.location.href.indexOf('hotel/'));
    marker.link = host+'/hotel-detail/'+a.slug;

    //var message = ["This","is","the","secret","message"];
    
    google.maps.event.addListener(marker, 'mouseover', function(event){
        InfoBubbleScript(this);
    });

    google.maps.event.addListener(marker, 'mouseout', function() {
        infoBubbleHotel.close();
    });

    google.maps.event.addListener(marker,'rightclick', function(){
        gMapResultPage.setCenter(this.getPosition());
        var zoom = gMapResultPage.getZoom();
        gMapResultPage.setZoom(14);
    });

    google.maps.event.addListener(marker,'dblclick', function(){
       var panoramaOptions = {
              position: marker.getPosition(),
              enableCloseButton: true,
              scrollwheel: false,
              pov: {
                heading: 34,
                pitch: 10,
                zoom: 0
              }
            };
        var panorama = new  google.maps.StreetViewPanorama(document.getElementById("gMapHotels_canvas"),panoramaOptions);
        gMapResultPage.setStreetView(panorama);
    });

    google.maps.event.addListener(marker,'click',function(){
        showHideHotelDivs(0);
        sendFilterRequest(this);
        return false;
    });
    
}

function InfoBubbleScript(marker){

        //ADS.log.writeRaw(this.getPosition());

        //Position of the marker
        var markerLatLng = marker.getPosition();
        var mapWidth = 715;
        var mapHeight = 650;

        //Define the lat and lng of infoBubble
        var boundsNorthEast = gMapResultPage.getBounds().getNorthEast();
        var boundsSouthWest = gMapResultPage.getBounds().getSouthWest();

        var gMapHeight = Math.abs(boundsNorthEast.lat()) - Math.abs(boundsSouthWest.lat());
        var gMapWidth = Math.abs(boundsNorthEast.lng()) - Math.abs(boundsSouthWest.lng());

        //ADS.log.write(gMapWidth);

        var pxPerWidth = Math.abs(gMapWidth)/(mapWidth);
        var pxPerHeight = Math.abs(gMapHeight)/(mapHeight);

        //ADS.log.write(pxPerWidth);
        //ADS.log.write(pxPerWidth);
        //ADS.log.write(pxPerHeight);
        //Map size width: 715 px ; height: 650px;

        var heightExtra = 0;
        var widthExtra = 0;

        var newLongitude;
        var newLatitude;

        var checkHeight = Math.abs(Math.abs(markerLatLng.lat()) - Math.abs(boundsNorthEast.lat()));
        var checkWidthWest = Math.abs(Math.abs(markerLatLng.lng()) - Math.abs(boundsSouthWest.lng()));

        //ADS.log.write('checkWidthWest: '+ checkWidthWest);
        //ADS.log.write(pxPerWidth);
        //ADS.log.write('quotient: '+checkWidthWest/pxPerWidth);


        //Height of window bubble
        if(checkHeight/pxPerHeight < 125){
            heightExtra = -120* pxPerHeight;
        }else{
            heightExtra = 25* pxPerHeight;
        }

        if(checkWidthWest/pxPerWidth < 35){
            newLongitude = markerLatLng.lng() +  130*pxPerWidth;
        }else if(checkWidthWest/pxPerWidth < 145){
            newLongitude = markerLatLng.lng() +  65*pxPerWidth;
        }else if(checkWidthWest/pxPerWidth > 528){
            newLongitude =  boundsNorthEast.lng() - 190 * pxPerWidth;
        }else{
            newLongitude = markerLatLng.lng();
        }


        //-116.12239884765626

        //ADS.log.write(boundsLng);
        //ADS.log.write(newLongitude);

        //if(Math.abs(newLongitude) - Math.abs(boundsLng) < (windowWidth*zoom)/8){
        //    newLongitude = boundsLng - (windowWidth*zoom)/8;
        //}

        newLatitude = markerLatLng.lat() + heightExtra;
        //var newLongitude = widthExtra;

        var infoBubbleLatlng = new google.maps.LatLng(newLatitude, newLongitude);

        createInfoBubbleHotel(infoBubbleLatlng,marker.message,marker);
}

function createInfoBubbleHotel(position, message, marker){

    infoBubbleHotel = new InfoBubble({
      map: gMapResultPage,
      content: message,
      position: position,
      shadowStyle: 0,
      padding: 0,
      backgroundColor: 'rgb(235,235,235)',
      borderRadius: 0,
      arrowSize: 1,
      borderWidth: 1,
      borderColor: '#FFFFFF',
      disableAutoPan: true,
      hideCloseButton: true,
      arrowPosition: 30,
      backgroundClassName: 'phoney',
      arrowStyle: 2
    });


    infoBubbleHotel.open();
    //alert('createInfoBubbleHotel');
}
*/
function hotelShowMap(){

    $('.hotel-show-map').click(function(){

        showHideHotelDivs(1);

        var hotelId = $(this).attr('id').slice($(this).attr('id').indexOf('-') + 1);

        //Loop through marker array to find the hotel one.

        for(var i in markers){

           if(markers[i].id == hotelId){
               //ADS.log.write(markers[i].id);
               //ADS.log.write(markers[i].getPosition());
               showGmapForOneHotel(mapInitialized, markers[i], 15);
               
               //markers[i].infoBubbleHotel.show();
               //gMapResultPage.setCenter(markers[i].getPosition());
           }
        }

        return false;

    });

}


/* Hotel Thumb function  -------------------------------------------- */

function addHotelThumb(hotelThumbName, hotelThumb){

    var name = hotelThumbName;
    
    if($(name).length == 0){

        hotelViewediterator++;

        if(hotelViewediterator%4 == 0 && hotelViewediterator !=0){
            hotelThumb.addClass('last');
        }

        hotelThumb.appendTo('#viewedHotelsContainer');
        $.gritter.add({
            title: 'Hotel viewed',
            text: 'Hotel added to your viewed list',
            time: 500,
            position: 'bottom-right'
        });

        if(hotelViewediterator%4 == 0 && hotelViewediterator !=0){
            $('#viewedHotelsContainer').append('<hr class="space2" />')
        }

        hotelThumb.click(function(event){

            //alert(event.target.nodeName);

                if(event.target.nodeName == 'DIV'){
                    if($(this).hasClass('selected')){
                    $(this).children('.hotel-thumb-on').hide();
                    $(this).children('.hotel-thumb-remove').hide();
                    $(this).removeClass('selected');

                }else{
                    $(this).children('.hotel-thumb-on').show();
                    //$(this).children('hotel-thumb-off').hide();
                    //this.children('hotel-thumb-on').show();
                    $(this).addClass('selected');
                }
            }else if(event.target.nodeName == 'A'){

                 //alert(name);

                 var link = name + ' .hotelNameDetailAjaxLink2';
                 sendFilterRequest($(link));
                 return false;
            }

            //alert(e.target.nodeName);


            

        });




        
        /*$(link).click(function(){
            sendFilterRequest($(this));
            return false;
        });
        */
    }


}


function activateHotelThumbHover(){
    $('.hotel-thumb').hover(function(){
        if($(this).hasClass('selected')){
            $(this).children('.hotel-thumb-remove').show();
        }else{
            $(this).children('.hotel-thumb-off').show();
        }
        
    }, function(){
        $(this).children('.hotel-thumb-off').hide();
        $(this).children('.hotel-thumb-remove').hide();
    });
}

function activateTermsConditions(){

    $('a.rate-description').toggle(function(){
        $(this).closest('.room-rate-name').children('.rate-description-content').show();
    }, function(){
        $(this).closest('.room-rate-name').children('.rate-description-content').hide();
    });


    $('a.termsConditions').toggle(function(){
        executeRequestTermsConditions($(this));
    }, function(){
        $(this).closest('.room-rate-name').children('.term-condition-content').hide();
    });

   
}


function executeRequestTermsConditions(target){

    var preLoader = new Image();
    preLoader.src = '/images/arrowLoader.gif';

    termsConditionsTarget = target.closest('.room-rate-name').children('.term-condition-content');
    termsConditionsTarget.append(preLoader);
    
    var url = target.attr('href');

    $.ajax({
            type: "post",
            url: url,
            success: onTermsConditionsSuccess,
            error: onTermsConditionsFailure
    });
    
    return false;

}

function onTermsConditionsSuccess(msg){
    //alert(msg);
    termsConditionsTarget.show();
    termsConditionsTarget.html(msg);
}

function onTermsConditionsFailure(){
    
}


function ActivateCompareHotelBtn(){

    $('#viewedHotelsCompare').click(function(){


        //ADS.log.header('ActivateCompareHotelBtn');

        var hotels = $('.hotel-thumb.selected');

        if(hotels.length <2 || hotels.length >5){
            $.gritter.add({
                title: 'Hotels to compare',
                text: 'You can compare a minimum of 2 hotels and a maximum of 4 hotels!',
                time: 2000,
                position: 'bottom-right'
            });
            return false;
        }

        //ADS.log.write(hotels.length);

        var url = $(this).attr('href');
        //ADS.log.write(url);

        //Retrieve
        var datas = 'hotels=';
        hotels.each(function(){

            datas += $(this).attr('id')+',';

        });


        //alert(datas);

        $.ajax({
            type: "post",
            url: url,
            data: datas,
            success: onCompareRequestSuccess,
            error: onCompareRequestFailure
        });

        

        return false;

    });

    

}

function onCompareRequestSuccess(msg){

    $("#dialog-message").dialog( "destroy" );
    showHideHotelDivs(3);
    $('#compareHotels').html(msg);
    //alert(msg);

}

function onCompareRequestFailure(msg){
    $("#dialog-message").dialog( "destroy" );
    alert('onCompareRequestFailure');
}


/* Hotel detail page functions -------------------------------------------- */

function activateRadioRoomPrice(){
    $('.radio-room-price').change(function(){

        var price = 0;
        $('.room-night-price').removeClass('selected');
        $('input:radio').each(function(){
            
            if($(this).attr('checked')){
                price += parseFloat($(this).parent().next().children('.price-total').html());
                $(this).closest('.room-night-price').addClass('selected');
            }
        });

        
        //$(this).closest('.room-night-price').addClass('selected');
        //var price = $(this).parent().next('.price-total').html();
        $('#hotel-price').html(price);
    });

}




/* STID renewal */


function plexStidRenewal(url){

    //alert(url);

    var timeToRequest = url.split('/');
    //alert(timeToRequest.length);
    var timing = timeToRequest[timeToRequest.length-1]*1000; //to converst in milliseconds


    //alert('timing: '+ timing+' ');
    
    //var t=setTimeout("plexStidRequest()",timeToRequest/10,url);

    var f = function() {plexStidRequest(url);};
    setTimeout(f, timing);


    //var time = Math.round(new Date().getTime()/1000);
    //ADS.log.write('plexStidRenewal: '+sTID_time);
    //ADS.log.write('time: '+time);

    /*
    $.PeriodicalUpdater({
            url : url,
            method: 'post',
            minTimeout: 60000,
        },
        function(data){
            //alert(data);
            var myHtml = 'The data returned from the server was: ' + data + ' <br />';
            $('#results').append(myHtml);
    });
    */
 
}


function plexStidRequest(url){

    //Determine which kind of filtering user is doing
    
    $.ajax({
        type: "post",
        url: url,
        success: onStidRequestSuccess,
        error: onStidRequestFailure
    });
    


}

function onStidRequestSuccess(msg){

    var response = msg.split('|');

    $.gritter.add({
        position: 'bottom-right',
	title: response[0],
	text: response[1],
        time: 2000
    });

    var url = response[2];

    var timeToRequest = url.split('/');
    var timing = timeToRequest[timeToRequest.length-1]*1000;
    var f = function() {plexStidRequest(url);};
    setTimeout(f, timing);

}

function onStidRequestFailure(){

    alert('Your session has expired');

}

/* Basket functions */


function activateBasketTabs(){

    $('#basket-summary tr.basket-list-header.active').click(function(){
        var classes = $(this).attr('class');
        basketTabulation(classes)
        
    });

    $('.hotelResult-tabs').click(function(){
        var id = $(this).attr('id');
        basketTabulation(id)
    });


}

function basketTabulation(value){

    $('.basket-data-container').hide();
    $('.hotelResult-tabs').removeClass('selected');

    switch(true){

            case value.search(/flight/) > -1:
                $('#flight').show();
                $('#tab-basket-flight').addClass('selected');
                break;
            case value.search(/hotel/) > -1:
                $('#hotel').show();
                $('#tab-basket-hotel').addClass('selected');
                break;
            case value.search(/extras/) > -1:
                $('#extras').show();
                $('#tab-basket-extras').addClass('selected');
                break;
            case value.search(/car/) > -1:
                $('#car').show();
                $('#tab-basket-car').addClass('selected');
                break;
            case value.search(/excursions/) > -1:
                $('#excursions').show();
                $('#tab-basket-excursions').addClass('selected');
                break;
            default:
                $('#flight').show();
                $('#tab-basket-flight').addClass('selected');
                break;
        }

    
}