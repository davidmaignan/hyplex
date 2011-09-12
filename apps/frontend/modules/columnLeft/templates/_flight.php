<style>

    #column-left{
        border: none;
        background: none;
        padding:0;
    }

    .columnLeft-sort{
        font-size: 80%;
        background-color: white;
        padding:10px;
        border:1px solid #aaa;
        margin-bottom: 10px;

    }

    h2{
        font-size: 115%;
        border-bottom: 1px solid #aaa;
        margin-bottom: 4px;
        padding-bottom: 2px;
        color: #006eb4;
    }

    input[type=checkbox]{
        margin-right: 8px;

    }
    span.columnLeft-data{
        color: #006eb4;
        text-align: right;
        float: right;
        font-weight: bold;
    }

    #takeoff_departflight, #takeoff_returnflight{
        background-color: white;
        border:none;
        text-align: center;
        font-size: 100%;
    }

    h6{
        margin: 12px 0;
}


</style>

<div class="columnLeft-sort">
    <h2>Stops</h2>
    <input type="checkbox" value="0" />Non-stop
    <span class="columnLeft-data">$611</span><br />
    <input type="checkbox" value="0" />1 stop
    <span class="columnLeft-data">$618</span><br />
    <input type="checkbox" value="0" />2+ stops
    <span class="columnLeft-data">$982</span><br />
</div>

<div class="columnLeft-sort">
    <h2>Flight time</h2>
    <h6>Take-off (Depart flight)</h6>
    <div id="slider_takeoff" style="margin-top:10px; z-index: 0;"></div>
    <input type="text" disabled="true" id="takeoff_departflight" name="takeoff_departflight" class="_150"/>
    <h6>Take-off (Return flight)</h6>
    <div id="slider_return" style="margin-top:10px; z-index: 0;"></div>
    <input type="text" disabled="true" id="takeoff_returnflight" name="takeoff_returnflight" class="_150"/>
</div>

<div class="columnLeft-sort">
    <h2>Price</h2>
    <input type="checkbox" value="0" />Non-stop
    <span class="columnLeft-data">$611</span><br />
    <input type="checkbox" value="0" />1 stop
    <span class="columnLeft-data">$618</span><br />
    <input type="checkbox" value="0" />2+ stops
    <span class="columnLeft-data">$982</span><br />
</div>

<?php //print_r($results); ?>

<script type="text/javascript">

    $(document).ready(function(){


        var first_flight = 6*60*60;
        var last_flight = 21*60*60;

        $("#slider_takeoff").slider({
            range: true,
            min: first_flight,
            max: last_flight,
            values: [first_flight, last_flight],
            step:300,
            slide: function(event, ui) {
                $("#takeoff_departflight").val(secondsToTime(ui.values[0]) + ' - ' + secondsToTime(ui.values[1]));
            }

        });

        $("#takeoff_departflight").val(secondsToTime(first_flight) + ' - ' + secondsToTime(last_flight));

        $("#slider_return").slider({
            range: true,
            min: first_flight,
            max: last_flight,
            values: [first_flight, last_flight],
            step:300,
            slide: function(event, ui) {
                $("#takeoff_returnflight").val(secondsToTime(ui.values[0]) + ' - ' + secondsToTime(ui.values[1]));
            }

        });

        $("#takeoff_returnflight").val(secondsToTime(first_flight) + ' - ' + secondsToTime(last_flight));

    });

function secondsToTime(secs)
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

    if(hours <=12){
        hours = hours;
        jeton = "am";
    }else{
        hours = hours-12;
        jeton = "pm";
    }

    var divisor_for_seconds = divisor_for_minutes % 60;
    var seconds = Math.ceil(divisor_for_seconds);

    var result = hours+":"+minutes+jeton;

    return result;

};

</script>