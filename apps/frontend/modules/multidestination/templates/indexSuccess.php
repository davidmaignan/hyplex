<?php //use_javascript('jquery-1.5.1.min.js'); ?>
<?php //use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php //use_javascript('myScript'); ?>
<?php //use_javascript('functions.js'); ?>
<?php //use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>
<?php //use_stylesheet('grid'); ?>
<?php //use_stylesheet('typography'); ?>

<style>

    #area, #country, #state, #city{
        width: 150px;
        height: 250px;
        display: block;
        background-color: white;
        float: left;
        margin-right: 10px;
    }

    h5.multi-title{
        margin-bottom: 5px;
        color: #00557E;
        font-weight: bold;
        font-size: 85%;
    }

    h1{
        margin-bottom: 15px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
    }

</style>

<h1><?php echo __('Please select your destination') ?></h1>

<div id="area">
<h5 class="multi-title"><?php echo __($title); ?></h5>
<select name="area" onChange="sendDestinationRequest(this)" size="15" style="width: 150px;" id="areaSelect">
    <?php foreach ($areas as $area): ?>
    <?php echo "<option label='$area' value='{$area->getId()}'>$area</options>"; ?>
    <?php endforeach; ?>
</select>
</div>
<div id="country">

</div>
<div id="state">
    
</div>
<div id="city">
    
</div>

<div style="clear:both;"></div>


<script type="text/javascript">

var target;

function sendDestinationRequest(elt){

        if(elt.id == 'citySelect'){

            //Variable to determine which input field to add value
            var targetInfos = parent.targetInfos;
            //Variable to determine if multiple destination or simple destination
            var flightSearchType = parent.flightSearchType;

            //alert(flightSearchType);
            //alert(targetInfos[1]);
            //alert(parent.targetInfos);

            //Retreive area
            var countryDropMenu = document.getElementById('countrySelect');
            var countryId = countryDropMenu.selectedIndex;
            var countryName = countryDropMenu.options[countryId].text;
            
            var w = elt.selectedIndex;
            var selected_text = elt.options[w].text;
            var response = selected_text+ ', '+ countryName;


            if(flightSearchType == 'multiple'){
                var jeton = 'search_flight_newSegments_'+targetInfos[1]+'_'+targetInfos[0];
            }else if(flightSearchType == 'simple'){
                var jeton = 'search_flight_'+targetInfos[0];
            }
            

            parent.document.getElementById(jeton).value = response;
            parent.$.fancybox.close();
            exit;

        }
 
        //retreive the data from the filterForm
        var datas = 'type='+elt.id;

        if(elt.id == 'areaSelect'){
            //Select the right div for displaying the result
            target = $('#country');

            //Remove any previous result
            $('#country').empty();
            $('#city').empty();
            $('#state').empty();

        }else if(elt.id == 'countrySelect'){

            $('#state').empty();
            $('#city').empty();

            $('#state').css('display', 'none');

            if(elt.value == 232 || elt.value == 235){
                $('#state').css('display', 'block');
                target = $('#state');
            }else{
                target = $('#city');
            }


            
        }else if(elt.id == 'stateSelect'){
             target = $('#city');
             $('#city').empty();
        }


        datas += '&value='+elt.value;


        var url = '../multidestination/ajaxDestination';
        
        $.ajax({
            type: "post",
            url: url,
            data: datas,
            success: function(msg){
                target.html(msg);
            },
            error: function(){
                alert('An error has occured!');
            }
        });
        

    }

   



</script>
