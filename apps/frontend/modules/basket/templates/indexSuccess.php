<?php use_helper('Number', 'Text', 'I18n', 'Date');?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>
<?php use_stylesheet('custom-theme/jquery-ui-1.8.16.custom.css'); ?>
<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>
<?php use_stylesheet('flightResult'); ?>

<?php use_javascript('jquery-1.6.2.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.16.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>

<?php include_partial('include/dialog_message'); ?>

<h1 class="title">Your basket</h1>

<?php include_component('basket', 'checkOut') ?>

<div class="span-18 last">

    <div class="span-18 append-bottom" id="tab-viewing">
        <ul>
            <li><a id="tab-basket-flight" class="basket-view-flight hotelResult-tabs selected"><?php echo __('flight') ?></a></li>
            <li><a id="tab-basket-hotel"class="basket-view-hotel hotelResult-tabs"><?php echo __('hotel') ?></a></li>
            <li><a id="tab-basket-extras"class="basket-view-extras hotelResult-tabs"><?php echo __('extras') ?></a></li>
            <li><a id="tab-basket-car" class="basket-view-car hotelResult-tabs"><?php echo __('car'); ?></a></li>
            <li><a id="tab-basket-excursions" class="basket-view-excursions hotelResult-tabs"><?php echo __('excursions'); ?></a></li>
            <li><a id="checkout" href="<?php echo url_for('@checkout') ?>" class="hotelResult-tabs right"><?php echo __('checkout'); ?></a></li>
        </ul>
    </div>
    <hr class="space2" />

    <div id="flight" class="basket-data-container">

        <?php if(isset($flight)): ?>

        <h2 class="title"><?php echo ucwords(__('flight information')); ?></h2>
        <?php include_partial('flightSummary',array('parameters'=>$flightParameters)); ?>
        <hr class="space3" />
        <h2 class="title prepend-top"><?php echo ucfirst(__('flight details')) ?></h2>
        <div class="span-18 bg-grey append-bottom flight-box-details">
            <div class="padded">
                <table class="flight-details append-bottom">
                    <?php include_partial('flight/segmentOutbound', array('result'=>$flight)) ?>
                    <?php include_partial('flight/segmentInbound', array('result'=>$flight)) ?>
                </table>
            </div>
        </div>
        
        <?php else: ?>
        <p><?php echo __('You have no flight in your basket'); ?></p>
        <?php endif; ?>
    </div>
    
    <div id="hotel" class="basket-data-container hide">
        <?php if(isset($hotel)): ?>
        <h2 class="title"><?php echo ucwords(__('Hotel information')); ?></h2>
            <?php include_partial('hotelSummary_1',array('hotelParameters'=>$hotelParameters, 'hotel'=>$hotel)); ?>
            <?php include_partial('hotelDescription', array('result'=>$hotel)); ?>
            <?php include_partial('hotelRoom',array('hotel'=>$hotel)); ?>
        <?php else: ?>
        <p><?php echo __('You have no hotel in your basket'); ?></p>
        <?php endif; ?>
    </div>

    <div id="extras" class="basket-data-container hide">
        <?php if(isset($extras)): ?>
        <h2 class="title"><?php echo ucwords(__('Extras')); ?></h2>
        
        <?php else: ?>
        <p><?php echo __('You have no extras in your basket'); ?></p>
        <?php endif; ?>
    </div>

    <div id="car" class="basket-data-container hide">
        <?php if(isset($car)): ?>
        <h2 class="title"><?php echo ucwords(__('Car information')); ?></h2>

        <?php else: ?>
        <p><?php echo __('You have no car in your basket'); ?></p>
        <?php endif; ?>
    </div>

    <div id="excursions" class="basket-data-container hide">
        <?php if(isset($excursions)): ?>
        <h2 class="title"><?php echo ucwords(__('Excursions information')); ?></h2>

        <?php else: ?>
        <p><?php echo __('You have no excursions in your basket'); ?></p>
        <?php endif; ?>
    </div>
</div>

<hr class="space3" />

<script type="text/javascript">

$('document').ready(function(){
   activateBasketTabs();
   activateTermsConditions();
});


</script>
<?php
echo "<pre>";
print_r($plexBasket);