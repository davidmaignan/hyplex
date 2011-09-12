<div class="span-9 shadow bg-white last top-dest append-bottom">
    <div class="box-1" style="border-bottom: none;">
        <h2><?php echo __('Your previous searches'); ?></h2>
    </div>
    <div class="bg-white">

        <div id="result-prev-search" style="height: 275px;">

            <?php include_partial('basket/prevFlight'); ?>
            <?php include_partial('basket/prevFlightDetails'); ?>
            <?php include_partial('basket/prevFlight'); ?>
            <?php include_partial('basket/prevFlightDetails'); ?>
            <?php include_partial('basket/prevFlight'); ?>
            <?php include_partial('basket/prevFlightDetails'); ?>
            <?php include_partial('basket/prevFlight'); ?>
            <?php include_partial('basket/prevFlightDetails'); ?>
            <?php include_partial('basket/prevFlight'); ?>
            <?php include_partial('basket/prevFlightDetails'); ?>
            <?php include_partial('basket/prevFlight'); ?>
            <?php include_partial('basket/prevFlightDetails'); ?>

        </div>
        <div id="prev-search-nav">
            <div class="prev-search-bottom">
                <a href="#" title="previous" class="previous" ></a>
                <a href="#" title="next" class="next" ></a>
                <a class="carousel-btn" href="#" onclick="return false;"></a>
                <a class="carousel-btn" href="#" onclick="return false;"></a>
                <a class="carousel-btn" href="#" onclick="return false;"></a>
                <a class="carousel-btn" href="#" onclick="return false;"></a>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">

    $('document').ready(function(){

        var searchDetails = $('.prev-search-details');

        //Open first previous search
        if(searchDetails.length > 0){
            $(searchDetails[0]).removeClass('none');
            $('.prev-search-link').click(function(){
                $('.prev-search-details').hide();
                $(this).closest('.prev-search').next('div.prev-search-details').show();
            });
        }
    });

</script>