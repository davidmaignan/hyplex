<?php use_javascript('index') ?>
<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css') ?>

<?php require_once sfConfig::get('sf_web_dir') . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'search' . DIRECTORY_SEPARATOR . 'variables.php'; ?>

<?php //use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php //use_javascript('debugger/myLogger.js'); ?>

<?php include_partial('include/dialog_message'); ?>

<div class="span-9">

    <section class="span-9" id="search-forms">
        <h2 class="hide">Search</h2>
        <ul id="tabs-form">
            <li><a href="#" class="selected form-tab" id="flight-tab"><?php echo __('Flight'); ?></a></li>
            <li><a href="#" class="form-tab" id="hotel-tab"><?php echo __('Hotel'); ?></a></li>
            <li><a href="#" class="form-tab" id="car-tab"><?php echo __('Car'); ?></a></li>
            <li><a href="#" class="form-tab form-tab-last" id="package-tab"><?php echo __('Package'); ?></a></li>
        </ul>
        <div id="flight-form">
            <?php include_partial('searchFlight/formIndex_html5', array('form' => $flightForm)); ?>
        </div>
        <div id="hotel-form" class="hide">
            <?php include_partial('searchHotel/formIndex_html5', array('form' => $hotelForm)); ?>
        </div>
        <div id="car-form">
            <?php include_partial('searchCar/formIndex', array('form' => $carForm)); ?>
        </div>
        <div id="package-form" class="hide">
            <?php //include_partial('searchPackage/formIndex',array('form'=>$packageForm)); ?>
        </div>
    </section>

    <section class="span-9 prepend-top">
        <?php include_component('prevSearch', 'index'); ?>
    </section>

</div>
<div class="span-15 last">
    <?php include_component('promotionalBanner', 'index'); ?>
    <?php include_component('promotionalBanner', 'topDestination'); ?>
    <div class="span-15 last"  style=" width: 610px; margin-left:10px;">
        <?php include_component('promotionalBanner', 'featureDealsIndex'); ?>
        <?php include_component('promotionalBanner', 'specialInterestIndex') ?>
    </div>
</div>