<?php use_javascript('index') ?>

<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js') ?>
<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css') ?>

<?php require_once sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'search'.DIRECTORY_SEPARATOR.'variables.php'; ?>

<?php use_javascript('culture/datepicker_'.$sf_user->getCulture().'.js') ?>

<?php //use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php //use_javascript('debugger/myLogger.js'); ?>

<?php include_partial('include/dialog_message'); ?>

<div class="span-9 append-bottom">

    <div class="span-9" id="form-index" >
            <ul id="tabs-form">
                <li><a href="#" class="selected form-tab" id="flight-tab"><?php echo __('Flight'); ?></a></li>
                <li><a href="#" class="form-tab" id="hotel-tab"><?php echo __('Hotel'); ?></a></li>
                <li><a href="#" class="form-tab" id="car-tab"><?php echo __('Car'); ?></a></li>
                <li><a href="#" class="form-tab" id="package-tab"><?php echo __('Package'); ?></a></li>
            </ul>
            <div id="flight-form">
                <?php include_partial('searchFlight/formIndex', array('form' => $flightForm)); ?>
            </div>
            <div id="hotel-form" class="">
                <?php include_partial('searchHotel/formIndex', array('form' => $hotelForm)); ?>
            </div>
            <div id="car-form">
                <?php include_partial('searchCar/formIndex',array('form'=>$carForm)); ?>
            </div>
            <div id="package-form" class="hide">
                <?php include_partial('searchPackage/formIndex',array('form'=>$packageForm)); ?>
            </div>
    </div>

    <hr class="space3" />
    
    <div class="span-9 prepend-top border">
        <?php include_component('prevSearch', 'index', array()); ?>
    </div>

</div>


<div class="span-16 last append-bottom">
<?php include_component('promotionalBanner', 'index'); ?>
<?php include_component('topdestination', 'index'); ?>
<?php include_component('promotionalBanner','featureDealsIndex'); ?>
<?php include_component('promotionalBanner','specialInterestIndex') ?>
<?php include_partial('include/signUpForm'); ?>
</div>

<hr class="space"/>
