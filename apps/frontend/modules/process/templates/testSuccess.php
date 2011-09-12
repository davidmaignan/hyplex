<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('jquery.autocomplete.min.js'); ?>
<?php use_stylesheet('redmond/jquery-ui-1.8.11.custom.css'); ?>
<?php use_stylesheet('jquery.autocomplete.css'); ?>

<?php use_stylesheet('frontend_temp.css'); ?>

<?php use_javascript('search/searchFlight.js'); ?>
<?php use_javascript('functions.js'); ?>

<?php use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php use_javascript('debugger/myLogger.js'); ?>

<?php //echo $filterValues; ?>

<script type="text/javascript">
    var filterValues = <?php echo $sf_data->get('filterValues', ESC_RAW); ?>
</script>

<style>
    .slider_info{
        height: 20px;
        display: block;
        width:100%;
        border:0px solid red;
        margin: 8px 0;
        font-size: 80%;
        text-align: center;
        color: black;
    }

    #ADSLogWindow{
        top:100px;
    }

    #filterForm span{
        font-size: 90%;
    }

    #dialog-message{
        display: none;
        text-align: center;
    }

</style>

<div id="dialog-message" title="You have sent a request">
    <p style="text-align: center;"><?php echo image_tag('generic/ajax-loader.gif', array('alt'=>'')) ?></p>
    <br />
    <p>Your request has been sent. Please wait !</p>
    <p>You can always change your mind. Click cancel</p>
</div>




<div id="column-left">
    <?php echo html_entity_decode($filterFormFinal); ?>
</div>

<div id="column-middle">
    <div id="form-search">
        <?php include_partial('searchFlight/editForm', array('form' => $form)); ?>
    </div>
    <br />
    <div id="matrix">
        Matrix comes here
    </div>

    <div id="results">
        <div id="filter-box">
            Filters comes here
        </div>
        <div id="list-results">
            <?php foreach($results as $result): ?>
            <?php include_partial('flightReturn', array('result' => $result)); ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div id="column-right">
    <ul>
        <li><a href="#">Receive this search in your email </a></li>
        <li><a href="#">Show fare chart</a></li>
        <li><a href="#">Get price alert</a></li>
        <li><a href="#">Share results in real time</a></li>
    </ul>
</div>



<script type="text/javascript">

    $(document).ready(function(){

       

        

         $( "#dialog:ui-dialog" ).dialog( "destroy" );
        /*{"minPrice":"1983.60","maxPrice":"3350.43","takeoffDepMin":
                {"hour":"06","min":"30"},"takeoffDepMax":{"hour":"16","min":"43"},
            "takeoffRetMin":{"hour":"07","min":"00"},"takeoffRetMax":
                {"hour":"22","min":"50"},
            "minDuration":660,"maxDuration":1139} */

        var minPrice = Math.floor(filterValues.minPrice);
        var maxPrice = Math.ceil(filterValues.maxPrice);
        var takeoffDepMin = getTimeInSeconds(filterValues.takeoffDepMin.hour,filterValues.takeoffDepMin.min,0);
        var takeoffDepMax = getTimeInSeconds(filterValues.takeoffDepMax.hour,filterValues.takeoffDepMax.min,0);
        var takeoffRetMin = getTimeInSeconds(filterValues.takeoffRetMin.hour,filterValues.takeoffRetMin.min,0);
        var takeoffRetMax = getTimeInSeconds(filterValues.takeoffRetMax.hour,filterValues.takeoffRetMax.min,0);
        var minDuration = filterValues.minDuration;
        var maxDuration = filterValues.maxDuration;



        //ADS.log.writeRaw('Debugger javascript.');
        ADS.log.header('Debugger');
        //ADS.log.writeRaw('<b>This is bold!</b>');
        //ADS.log.write('write source: <strong>This is bold!</strong>');

        ADS.log.write('minDuration: '+minDuration);
        ADS.log.write('maxDuration: '+maxDuration);

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
        $("#info_takeoff_departflight").html(secondsToTime(takeoffDepMin,false) + ' - ' + secondsToTime(takeoffDepMax,true));


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
                $( "#info_tripduration" ).html(tripDuration(minDuration)+ " to " + tripDuration(ui.value) );
            }
        });
        $( "#tripduration" ).val((maxDuration) );
        $( "#info_tripduration" ).html(tripDuration(minDuration)+ " to " + tripDuration(maxDuration) );

        //Slider price
        $( "#slider_price" ).slider({
            range: "min",
            value: maxPrice,
            min: minPrice,
            max: maxPrice,
            slide: function( event, ui ) {
                $( "#price" ).val(ui.value);
                $( "#info_price" ).html("$"+minPrice+ " to $" +  ui.value );
            }
        });
        $( "#price" ).val(maxPrice );
        $("#info_price").html("$"+minPrice+ " to $" + maxPrice );


        //Bind all sliders checkbox with click event
        $( ".ui-slider" ).bind( "slidestop", function(event, ui) {
            ADS.log.write('sliding event');
            sendFilterRequest();
        });
        
        //Bind filterForm checkbox with click event
        $('.FilterCheckbox').click(function(){
            //$('preloader').show();
            ADS.log.write($(this) +' is clicked');
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

        var form = $('#filterForm');




        ADS.log.write('icit');
        ADS.log.write(form.attr('action'));



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
    
    $('#results').html(msg);

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