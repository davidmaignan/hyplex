<?php use_helper('Text'); ?>

<?php include_partial('pagination',array('total' => $filterResponse->nbrHotelsToPaginate, 'page' => $page)); ?>

<div class="span-18 append-bottom">
<?php foreach ($filterResponse->arFilterActivated as $key => $value): ?>
    <div class="filter-box <?php echo $key ?>">
        <p><?php echo $key; ?></p>
    </div>
<?php endforeach; ?>
</div>

<div class="span-18">
<?php //echo $sf_data->get('filterToDeactivateJson', ESC_RAW); ?>
</div>

<?php
$pricesRange = $sf_request->getParameter('average_nigthlyRate');
$pricesRange = explode('-', $pricesRange);
$pricesRange = array_map('trim', $pricesRange);
//var_dump($pricesRange);
?>

<script type="text/javascript">
    var minRange = <?php echo $pricesRange[0]?>;
    var maxRange = <?php echo $pricesRange[1]?>;
    var filterToDeactivate = <?php echo $sf_data->get('filterToDeactivateJson', ESC_RAW); ?>;
    markerFiltered = <?php echo $sf_data->get('markerFiltered', ESC_RAW); ?>;
</script>

<?php //echo $sf_data->get('markerFiltered', ESC_RAW); ?>

<?php foreach ($results as $key => $result): ?>
<?php include_partial('hotel', array('result' => $result)); ?>
<?php endforeach; ?>
<hr />
<?php include_partial('pagination',array('total' => $filterResponse->nbrHotelsToPaginate, 'page' => $page)); ?>

<script type="text/javascript">

    function deactivatFilterCheckBox(){

        //If all reset
        var allHidden = false;

        $('.remove-small').each(function(){
            //alert($(this).is(":visible"));
            if(allHidden == false){
                allHidden = $(this).is(":visible");
            }
        });

        showHideMarkers();
        

        if(allHidden == false){
            $('.starRating_tr').removeClass('bg-filter-active');
            $('.location_tr').removeClass('bg-filter-active');
            $('.chain_tr').removeClass('bg-filter-active');
            $('#infoFilterResult').show();
            $('#clearFiltersAll').hide();
            exit;
        };


        //alert(allHidden);
        //Reset all the checkboxes
        //$('.filterHotelCheckbox').attr('checked','');
        //$('.chainCheckbox').attr('checked','');

        var starRating = filterToDeactivate.starRating;

        //$('#starRating_3_tr').addClass('bg-filter-active');
        //alert(starRating);

        if(starRating != undefined){
            
            $('.starRating_tr').removeClass('bg-filter-active');
            for(var i in starRating)
            {
                var name = '#starRating_'+starRating[i]+'_tr';
                $(name).addClass('bg-filter-active');
            }
        }else{
            //alert('star rating');
            //$('.starRatingCheckbox').attr('checked', 'checked');
        }
    

        //location

        var locations = filterToDeactivate.location;

        if(locations != undefined){
            //$('.locationCheckbox').attr('checked', '');
            $('.location_tr').removeClass('bg-filter-active');
            for(var i in locations)
            {
                var name = '#location_'+locations[i].split(' ').join('_')+'_tr';
                $(name).addClass('bg-filter-active');
            }
        }else{
            //alert('location');
            //$('.locationCheckbox').attr('checked', '');
        }
    
   
        //location
        var chains = filterToDeactivate.chain;

        if(chains != undefined){
            $('.chain_tr').removeClass('bg-filter-active');
            //$('.chainCheckbox').attr('checked', '');
            for(var i in chains)
            {
                var name = '#chain_'+chains[i].split(' ').join('_')+'_tr';
                $(name).addClass('bg-filter-active');

            }
        }else{
            //alert('chain');
            //$('.chainCheckbox').attr('checked', '');
        }

    }

    $('document').ready(function(){

        posMin = Math.floor(filterToDeactivate.prices.min);
        posMax = Math.ceil(filterToDeactivate.prices.max);
        
        deactivatFilterCheckBox();
        //ResetAverageNightlyRateSlider(minPrice, maxPrice, minPrice, maxPrice);

        activateFilterBox();

        //alert('here');
        ResetAverageNightlyRateSlider(minPrice, maxPrice, posMin, posMax, minRange, maxRange);

        //Active show map btn in hotel box
        hotelShowMap();


        

    });


    

</script>