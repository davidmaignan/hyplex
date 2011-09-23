<?php use_helper('Number', 'Text', 'I18n', 'Date');?>

<?php use_stylesheet('flightResult'); ?>
<?php use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>
<?php use_stylesheet('jquery.autocomplete.css'); ?>
<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>

<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('myScript.js'); ?>
<?php use_javascript('functions.js'); ?>




<?php include_partial('include/dialog_message'); ?>

<h1 class="title">Your basket</h1>

<div class="span-7">

    <table id="basket-summary">

        <?php if(isset($flight)): ?>
        <?php include_partial('flightLeft', array('flight'=>$flight,'flightParameters'=>$flightParameters)) ?>
        <?php else: ?>
        <?php include_partial('flightLeftAdd');?>
        <?php endif; ?>

        <?php if(isset($hotel)): ?>
        <?php include_partial('hotelLeft', array('hotel'=>$hotel,'hotelParameters'=>$hotelParameters)) ?>
        <?php else: ?>
        <?php include_partial('hotelLeftAdd');?>
        <?php endif; ?>

         <?php if(isset($extra)): ?>
        <?php include_partial('extraLeft', array('extra'=>$extra)) ?>
        <?php else: ?>
        <?php include_partial('extraLeftAdd');?>
        <?php endif; ?>

        <?php if(isset($car)): ?>
        <?php include_partial('carLeft', array('car'=>$car,'carParameters'=>$carParameters)) ?>
        <?php else: ?>
        <?php include_partial('carLeftAdd');?>
        <?php endif; ?>
       
        <?php if(isset($excursions)): ?>
        <?php include_partial('excursionLeft', array('excursions'=>$excursions)) ?>
        <?php else: ?>
        <?php include_partial('excursionLeftAdd');?>
        <?php endif; ?>

        <tr class="basket-list-total">
            <td colspan="2">
                <ul>
                    <li><?php echo ucfirst(__('total')) ?></li>
                    <li class="sub-person"><?php echo ucfirst(__('price per person')) ?></li>
                </ul>
            </td>
            <td class="total">
                <ul>
                    <li>
                        <?php echo format_currency(rand(2999,8999),  sfConfig::get('app_currency')); ?>
                    </li>
                    <li class="sub-person">
                        <?php echo format_currency(rand(2999,8999)/3,  sfConfig::get('app_currency')); ?>
                    </li>
                </ul>
                
            </td>
        </tr>

    </table>
    
</div>

<div class="span-18 last">

    <div class="span-18 append-bottom" id="tab-viewing">
        <ul>
            <li><a id="tab-basket-flight" class="basket-view-flight hotelResult-tabs selected"><?php echo __('flight') ?></a></li>
            <li><a id="tab-basket-hotel"class="basket-view-hotel hotelResult-tabs"><?php echo __('hotel') ?></a></li>
            <li><a id="tab-basket-extras"class="basket-view-extras hotelResult-tabs"><?php echo __('extras') ?></a></li>
            <li><a id="tab-basket-car" class="basket-view-car hotelResult-tabs"><?php echo __('car'); ?></a></li>
            <li><a id="tab-basket-excursions" class="basket-view-excursions hotelResult-tabs"><?php echo __('excursions'); ?></a></li>
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