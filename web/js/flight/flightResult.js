$('document').ready(function(){

    activateFlightDetails();

    $('#matrix-btn').toggle(function(){
        $('#matrix').show();
    }, function(){
        $('#matrix').hide();
    });

    
    //Links in matrix to show all the tables one by one
    $('.matrix-link').click(function(){

        $('.matrix-link').removeClass('selected');
        $(this).addClass('selected');

        //Get number id
        var jeton = $(this).attr('id').charAt($(this).attr('id').length-1);
        //alert(jeton);
        $('.matrix-table').hide();
        $('#matrix-table-'+jeton).show();
    });

    //Links in matrix to hightlight the flight box on the page
    $('.matrix-anchor').click(function(){
        var value = $(this).attr('href').substr(1);
        //ADS.log.write(value);
        $($(this).attr('href')).parent().parent().effect("highlight", {}, 3000);
    });



    /* Filtering form functionality */

    $( "#dialog:ui-dialog" ).dialog( "destroy" );

    var minPrice = Math.floor(filterValues.minPrice);
    var maxPrice = Math.ceil(filterValues.maxPrice);
    var takeoffDepMin = getTimeInSeconds(filterValues.takeoffDepMin.hour,filterValues.takeoffDepMin.min,0);
    var takeoffDepMax = getTimeInSeconds(filterValues.takeoffDepMax.hour,filterValues.takeoffDepMax.min,0);
    var takeoffRetMin = getTimeInSeconds(filterValues.takeoffRetMin.hour,filterValues.takeoffRetMin.min,0);
    var takeoffRetMax = getTimeInSeconds(filterValues.takeoffRetMax.hour,filterValues.takeoffRetMax.min,0);
    var minDuration = filterValues.minDuration;
    var maxDuration = filterValues.maxDuration;



        //Slider takeoff return flight
        $("#slider_takeoff_departflight").slider({
            range: true,
            min: takeoffDepMin,
            max: takeoffDepMax,
            values: [takeoffDepMin, takeoffDepMax],
            step:300,
            slide: function(event, ui) {
                $("#takeoff_departflight").val(secondsToTime(ui.values[0],false) + ' - ' + secondsToTime(ui.values[1],false));
                $("#info_takeoff_departflight").html(secondsToTime(ui.values[0],true) + ' - ' + secondsToTime(ui.values[1],true));
            }

        });

        $("#takeoff_departflight").val(secondsToTime(takeoffDepMin,false) + ' - ' + secondsToTime(takeoffDepMax,false));
        $("#info_takeoff_departflight").html(secondsToTime(takeoffDepMin,true) + ' - ' + secondsToTime(takeoffDepMax,true));


        //Slider takeoff return flight
        $("#slider_takeoff_returnflight").slider({
            range: true,
            min: takeoffRetMin,
            max: takeoffRetMax,
            values: [takeoffRetMin, takeoffRetMax],
            step:300,
            slide: function(event, ui) {
                $("#takeoff_returnflight").val(secondsToTime(ui.values[0],false) + ' - ' + secondsToTime(ui.values[1],false));
                $("#info_takeoff_returnflight").html(secondsToTime(ui.values[0],true) + ' - ' + secondsToTime(ui.values[1],true));
            }

        });

        $("#takeoff_returnflight").val(secondsToTime(takeoffRetMin,false) + ' - ' + secondsToTime(takeoffRetMax,false));
        $("#info_takeoff_returnflight").html(secondsToTime(takeoffRetMin,true) + ' - ' + secondsToTime(takeoffRetMax,true));

        //slider_tripduration
        $( "#slider_tripduration" ).slider({
            range: "min",
            value: maxDuration,
            min: minDuration,
            max: maxDuration,
            slide: function( event, ui ) {
                $( "#tripduration" ).val((ui.value) );
                $( "#info_tripduration" ).html(tripDuration(minDuration)+ " - " + tripDuration(ui.value) );
            }
        });
        $( "#tripduration" ).val((maxDuration) );
        $( "#info_tripduration" ).html(tripDuration(minDuration)+ " - " + tripDuration(maxDuration) );

        //Slider price
        $( "#slider_price" ).slider({
            range: "min",
            value: maxPrice,
            min: minPrice,
            max: maxPrice,
            slide: function( event, ui ) {
                $( "#price" ).val(ui.value);
                $( "#info_price" ).html("$"+minPrice+ " - $" +  ui.value );
            }
        });

        $( "#price" ).val(maxPrice);
        $("#info_price").html("$"+ minPrice + " - $" + maxPrice);

        //Bind all sliders checkbox with click event
        $( ".ui-slider" ).bind( "slidestop", function(event, ui) {
            //ADS.log.write('sliding event');
            sendFilterRequest($(this));
        });

        //Bind filterForm checkbox with click event
        $('.FilterCheckbox').click(function(){
            //$('preloader').show();
            //ADS.log.write($(this) +' is clicked');
            sendFilterRequest($(this));
        });

        //Sorting ------------------------------------------------------------------------------------
        activateSorting();
         //Pagination --------------------------------------------------------------------------------
        activatePagination();

        //For reset filter btn
        activateResetFilter();


});