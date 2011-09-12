<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('myScript.js'); ?>
<?php use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>
<?php use_stylesheet('flightResult'); ?>

<?php //use_javascript('search/searchFlight.js'); ?>
<?php use_javascript('flight/flightResult.js'); ?>
<?php use_javascript('functions.js'); ?>

<?php use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php use_javascript('debugger/myLogger.js'); ?>

<?php use_helper('Date','Number','I18n','Text'); ?>

<?php include_partial('dialog_message'); ?>

<script type="text/javascript">
    var filterValues = <?php echo $sf_data->get('filterValues', ESC_RAW); ?>
</script>


<hr class="space3" />
<div class="span-5 shadow bg-white">
    <?php echo html_entity_decode($filterFormFinal); ?>
</div>

<div class="span-15">

    <div class="span-15 shadow bg-white append-bottom">
        <div class="padded">
            <div id="form-search">
                <?php include_partial('searchFlight/editForm', array('form' => $form, 'parameters' => $parameters)); ?>

            </div>

        </div>
    </div>

    <div class="span-15 shadow bg-white append-bottom">
        <div class="padded">
            <?php include_partial('list_sorting_flight'); ?>
        </div>
    </div>

    <div class="span-15 shadow bg-white append-bottom none" id="matrix">
        <div class="padded">
            <?php foreach ($matrix as $key=>$data): ?>
            <?php include_partial('matrix', array('data'=>$data, 'key'=>$key)); ?>
            <?php endforeach; ?>
            <hr class="space" />

            <ul id="matrix-toggle">
                <?php foreach ($matrix as $key=>$data): ?>
                <?php $class = ($key==0)? 'selected': ''; ?>
                <li><a href="#" onclick="return false;" class="matrix-link <?php echo $class; ?>" id="matrix-link-<?php echo $key; ?>"><?php echo $key+1; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
     </div>



        <div id="Results">

        <?php foreach ($results as $result): ?>
        <?php include_partial('flightOneway', array('result' => $result)); ?>
        <?php endforeach; ?>

        </div>

</div>

<div class="span-5 last">

                

</div>

<hr class="space3" />

<script type="text/javascript">

    $(document).ready(function(){

        $( "#dialog:ui-dialog" ).dialog( "destroy" );

        var minPrice = Math.floor(filterValues.minPrice);
        var maxPrice = Math.ceil(filterValues.maxPrice);
        var takeoffDepMin = getTimeInSeconds(filterValues.takeoffDepMin.hour,filterValues.takeoffDepMin.min,0);
        var takeoffDepMax = getTimeInSeconds(filterValues.takeoffDepMax.hour,filterValues.takeoffDepMax.min,0);
        //var takeoffRetMin = getTimeInSeconds(filterValues.takeoffRetMin.hour,filterValues.takeoffRetMin.min,0);
        //var takeoffRetMax = getTimeInSeconds(filterValues.takeoffRetMax.hour,filterValues.takeoffRetMax.min,0);
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
            sendFilterRequest();
        });

        //Bind filterForm checkbox with click event
        $('.FilterCheckbox').click(function(){
            //$('preloader').show();
            //ADS.log.write($(this) +' is clicked');
            sendFilterRequest();
        });

        $('#sort-list a.sorting').click(function(){

            //Check if it's already the sorting in place
            if($(this).hasClass('selected color2')){
                return true;
            }

            //Remove all the css
            $('#sort-list a.sorting').removeClass('selected color2');

            //Add the css to the new sorting criteria and continue the usual ajax request
            $(this).addClass('selected color2');
            sendFilterRequest();
        });


    });

    function firstRequestSuccess(msg)
    {
        alert(msg);
    }

    function firstRequestFailure(msg)
    {
        alert('An error has occured and I cannot ');
    }

    function sendFilterRequest()
    {

        //ADS.log.write("sendFilterRequest called");

        $( "#dialog-message" ).dialog({
            modal: true,
            buttons: {
                Cancel: function() {
                    $( this ).dialog( "close" );
                    //Cancel the request sent
                }
            }
        });


        //retreive the data from the filterForm
        var datas = $('#filterForm').serialize();

        //retreive the sorting value
        var sorting = $('#sort-list a.selected').attr('id');
        //ADS.log.write(sorting);

        datas += '&sortBy='+sorting;

        //ADS.log.write(datas);

        var form = $('#filterForm');

        //ADS.log.write('icit');
        //ADS.log.write(form.attr('action'));

        var url = '../process/filterFlight';

        var url = form.attr('action');

        //ADS.log.write(url);
        //ADS.log.write(datas);

        $.ajax({
            type: "post",
            url: url,
            data: datas,
            success: onRequestSuccess,
            error: onRequestFailure
        });

    }

    /*
success: function(msg){
                //alert( "Data Saved: " + msg );
                $('#result').html(msg);
                $( "#tabs" ).tabs();
            },
            error: function(){
                alert('error');
            }
     */
    function onRequestFailure(msg)
    {
        alert('An error has occured and I cannot ');
        switch (transport.status) {
            case 403:
                // 403 specific handler
                break;

            case 404:
            // 404 specific handler
    }
}



function onRequestSuccess(msg)
{
    //alert('here');
    //$( "#dialog-message" ).dialog( "destroy" );
    $("#dialog-message").dialog('close')

    $('#Results').html(msg);

    activateFlightDetails();

    // handle the response
    /*$('partial').innerHTML = transport.responseText;
    $('partial').setOpacity(0);
    new Effect.Opacity('partial', {
        from: 0,
        to: 1,
        duration: 0.5
    });
    //alert($$('#preloader'));
    $('preloader').hide();
    animatePanelLinks();
    createPagination();*/
}



</script>