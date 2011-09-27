<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('myScript.js'); ?>
<?php use_javascript('functions.js'); ?>

<?php use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>
<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>
<?php use_stylesheet('flightResult'); ?>

<?php use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php use_javascript('debugger/myLogger.js'); ?>

<!-- for gmap -->
<?php use_javascript('gmap/infobubble-compiled'); ?>
<?php use_javascript('gmap/markerclusterer_packed'); ?>
<?php include_partial('include/dialog_message'); ?>
<?php use_helper('Date','Number','I18n','Text'); ?>

<script type="text/javascript">
    var filterValues = <?php echo $sf_data->get('filterValues', ESC_RAW); ?>;
    var gMapHotels = <?php echo $sf_data->get('gMapHotels',ESC_RAW); ?>;
</script>

<div class="span-26 last summary">
    <?php include_partial('summary',array('parameters'=>$parameters,'nbrHotels'=>$filterResponse->nbrTotalHotels)); ?>
</div>




<div class="span-7">
    <?php echo html_entity_decode($filterFormFinal); ?>
</div>

<div class="span-18 last">

    <div id="form" class="span-18 last hide">
        <?php include_partial('searchHotel/form', array('form'=>$form)); ?>
        <hr class="space3" />
    </div>

    <div class="span-18 append-bottom" id="tab-viewing">
        <ul>
            <li><a id="tab-hotels-list" class="view-list hotelResult-tabs selected"><?php echo __('List') ?></a></li>
            <li><a id="tab-hotels-map"class="view-map hotelResult-tabs"><?php echo __('Map') ?></a></li>
            <li><a id="tab-hotels-viewed"class="view-hotel hotelResult-tabs"><?php echo __('Viewed Hotels') ?></a></li>
            <li><a id="backToResults" class="hotelResult-tabs"><?php echo __('Back to results'); ?></a></li>
        </ul>
    </div>
    <hr class="space2" />

    <div id="hotelListResult">
        <?php include_partial('sorting'); ?>
        <hr class="space2" />
        <div id="Results">
            <?php include_partial('pagination',array('total' => $filterResponse->nbrHotelsToPaginate, 'page' => $page)); ?>
            <?php foreach($results as $key=>$result): ?>
                <?php include_partial('hotel',array('key'=>$key,'result'=>$result,'parameters'=>$parameters)); ?>
            <?php endforeach; ?>
            <hr />
            <?php include_partial('pagination',array('total' => $filterResponse->nbrHotelsToPaginate, 'page' => $page)); ?>
        </div>
    </div>
    
    <div id="gMapHotels">
        <div id="gMapHotels_canvas"></div>
        <hr class="space"/>
        <ul id="gMapIcons-legend">
            <li>Filtered</li>
            <li class="off">Unfiltered</li>
            <li class="viewed">Viewed</li>
            <li class="viewedoff">Unfiltered viewed</li>
            <li class="last"><a class="resetGmap">Reset map</a></li>
        </ul>
        <hr />
        <ul id="gMapTips">
            <li class="tip-0">Tips</li>
            <li class="gMapTip tip-1">Zoom in</li>
            <li class="gMapTip tip-2">Center map on icon + zoom in.</li>
            <li class="gMapTip tip-3">Go to hotel<br /> detailed page</li>
        </ul>
    </div>
    <hr class="space3"/>

    <div id="viewedHotels" class="span-18">
        <h2 class="title"><?php echo __('My viewed hotels'); ?></h2>
        <div id="viewedHotelsContainer"> </div>
        <hr />
        <a class="select center" id="viewedHotelsCompare" href="<?php echo url_for('hotel_compare'); ?>"><?php echo ucfirst(__('compare')); ?></a>
    </div>

    <div id="compareHotels" class="span-18"></div>

</div>
<hr class="space3" />

</div>

<?php include_component('basket', 'index', array()); ?>

<script>

$('document').ready(function(){
       
        
        minPrice = Math.floor(filterValues.prices.min);
        maxPrice = Math.ceil(filterValues.prices.max);

        //activateHotelRateType(); //not in use anymore
        //Hotel name link to page detail -------------------------------------------------------------
        activateHotelNameDescriptionCall(); //See function.js file

        //For hotel name in viewed tabs
        activateHotelNameDescriptionCall2(); //See function.js file

        //Sorting ------------------------------------------------------------------------------------
        activateSorting();
         //Pagination --------------------------------------------------------------------------------
        activatePagination();
        //Gallery ------------------------------------------------------------------------------------
        activateHotelGallery();
        //Set values for slider price
        ResetAverageNightlyRateSlider(minPrice,maxPrice,minPrice,maxPrice,minPrice,maxPrice);
        
        activateHotelFilteringLinks();
        activateHotelFilteringCheckboxes();
        activateStarRatingFilter();
        activateLocationFilter();
        activateChainFilter();
        showRemoveSmallLink();

        //For reset filter btn
        activateResetFilter();

        activateHotelTabulation();

        //showHideHotelDivs(2);

        activateShowHideLocationChain();

        //Function create markers, add them to markers array.
        createMarkerArray();

        hotelShowMap();

        activateResetGmap();

        ActivateCompareHotelBtn();

        //activateHotelThumb();
        activateHotelThumbHover();

        $('#changeSearch').toggle(function(){
            $('#form').show();
        }, function(){
            $('#form').hide();
        });

    });
    
/*
function timeTotalPopup(){
    timerTotalPopup = setTimeout("hideTotalPopup()",5000);
};

function hideTotalPopup(){
    //alert("Hello");
    $("#total").animate({
        opacity: 0,
        top: "-=20"
    },300);

};
*/
function activateHotelRateType(){
    $('a.more-rates').click(function(){
        if($(this).hasClass('less-rate')){
            $(this).closest('.room-type').nextUntil('.room-type').hide();
            $(this).removeClass('less-rate');
        }else{
            $(this).addClass('less-rate');
            $(this).closest('.room-type').nextUntil('.room-type').show();
        }
        return false;
    });

    $('a.more-room-type').toggle(function(){
        $(this).closest('tr').prevAll('.type2').show();
        $(this).closest('tr').prevAll('.type2').find('a.less-rate').removeClass('less-rate');
        $(this).addClass('less-room-type');
        $(this).html('<?php echo __('Hide additional room types')?>');
    }, function(){
        var total = $(this).closest('tr').prevAll('.type2');
        $(this).html(total.length+'<?php echo __(' more room types available')?>');
        $(this).closest('tr').prevAll('.type2').hide();
        $(this).closest('tr').prevAll('.rate2').hide();
        $(this).removeClass('less-room-type');
    });

    $('a.hotel-open-all').toggle(function(){
        $(this).closest('thead').next('tbody').children('.room-type').show();
        $(this).closest('thead').next('tbody').children('.room-rate').show();
    }, function(){

    });
};

function activateHotelGallery(){
    $('.imageContainer').hover(function(){
        $(this).children('a.hotel-gallery').show();
    }, function(){
        $(this).children('a.hotel-gallery').hide();
    });
};


</script>

