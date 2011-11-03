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

<h1 class="title append-bottom"><?php echo __('Your basket') ?></h1>
<hr class="space2" />
<?php include_component('basket', 'checkOut') ?>

<div class="span-18 last">

    <?php include_partial('summary',array('parameters'=>$parameters)); ?>
    <hr class="space3" />
    <?php if(isset($flight)): ?>
    <div id="flight" class="basket-data-container">
        <h2 class="flight"><?php echo __('Flight'); ?></h2>
        
        <div class="span-18 bg-grey flight-box-details">
            <div class="padded">
                <table class="flight-details">
                    <?php include_partial('flight/segmentOutbound', array('result'=>$flight)) ?>
                    <tr><td colspan="6" class="border-bottom"></td></tr>
                    <?php if($flight->getType() == 'flightReturn'):?>
                    <?php include_partial('flight/segmentInbound', array('result'=>$flight)) ?>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        <div class="smaller">
            
            <a href="<?php echo url_for('flight_modified',array('filename'=>PlexBasket::getInstance()->getFlightFilename())) ?>"
               class="action button blue basket-flight-link right center">
                    <?php echo __('change flight') ?>
            </a>
            
        </div>
    </div>
    <?php endif; ?>

    <hr class="space3" />
    
    <?php if(isset($hotel)): ?>

    <div id="hotel" class="basket-data-container">
        <h2 class="hotel"><?php echo __('Hotel'); ?></h2>
            <?php include_partial('hotelDescription', array('result'=>$hotel)); ?>
            <?php include_partial('hotelRoom',array('hotel'=>$hotel)); ?>
        <div class="smaller">

            <a href="<?php echo url_for('hotel_modified',array('filename'=>PlexBasket::getInstance()->getHotelFilename())) ?>"
               class="action button blue basket-flight-link right center">
                    <?php echo __('change hotel') ?>
            </a>

        </div>
    </div>
    <?php endif; ?>

    <?php if(isset($extras)): ?>
    <div id="extras" class="basket-data-container hide">
        <h2 class="title extras"><?php echo __('Extras'); ?></h2>
    </div>
    <?php endif; ?>

    <hr class="space3" />

    <?php if(isset($car)): ?>
    <div id="car" class="basket-data-container">
        
        <h2 class="title car"><?php echo __('Car'); ?></h2>
       
        
    </div>
    <?php endif; ?>

    <hr class="space3" />

    <?php if(isset($excursions)): ?>
    <div id="excursions" class="basket-data-container">
       
        <h2 class="title excursions"><?php echo __('Excursions'); ?></h2>
       
        
    </div>
    <?php endif; ?>

    <div class="span-18 right last">
        <a href="<?php echo url_for('@checkout')?>" class="button action right bigger"><?php echo __('checkout');?></a>
    </div>

</div>

<hr class="space3" />

<script type="text/javascript">

$('document').ready(function(){
   activateTermsConditions();
});


</script>

<style>
    table.flight-details tr.small td{
        background-color: #E0EDF8;
        color: #333333;
        border:1px solid #CECECE;
    }

    table.flight-details td{
        background-color: white;
        aborder: none;
        
    }

    table.flight-details td.title{
        padding: 9px 0;
}

</style>