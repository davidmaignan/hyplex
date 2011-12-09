<section class="span-9">
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
        <?php //include_partial('searchCar/formIndex',array('form'=>$carForm)); ?>
    </div>
    <div id="package-form" class="hide">
        <?php //include_partial('searchPackage/formIndex',array('form'=>$packageForm)); ?>
    </div>

</section>

<?php //include_component('promotionalBanner', 'index'); ?>
<?php //include_component('topdestination', 'index'); ?>
<?php //include_component('promotionalBanner','featureDealsIndex'); ?>

<?php //include_component('promotionalBanner','specialInterestIndex') ?>
<?php //include_partial('include/signUpForm'); ?>

