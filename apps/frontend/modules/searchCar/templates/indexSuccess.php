<?php use_javascript('jquery-1.6.2.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.16.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>
<?php require_once sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'search'.DIRECTORY_SEPARATOR.'variables.php'; ?>
<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>
<?php use_javascript('search/searchCar'); ?>

<?php //use_javascript('search/airport_list_'.$sf_user->getCulture().'.js'); ?>
<?php //use_javascript('culture/datepicker_'.$sf_user->getCulture().'.js'); ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>
<?php use_stylesheet('custom-theme/jquery-ui-1.8.16.custom.css'); ?>
<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>

<?php //use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php //use_javascript('debugger/myLogger.js'); ?>

<?php include_partial('include/dialog_message'); ?>

<div class="span-26">
    
    <div class="span-15">
        <?php if ($sf_request->hasParameter('location1')): ?>
        <h2><?php echo __('More information is required from where you pick up the car'); ?></h2>
        <?php include_partial('matches', array('datas' => $sf_request->getParameter('location1'))); ?>
        <?php endif; ?>
        <?php if ($sf_request->hasParameter('location2')): ?>
        <h2 class="prepend-top"><?php echo __('More information is required to where you drop off the car'); ?></h2>
        <?php include_partial('matches', array('datas' => $sf_request->getParameter('location2'))); ?>
        <?php endif; ?>
        <?php include_partial('form', array('form' => $form)) ?>
    </div>
    <div class="span-9 last">
        <?php include_component('prevSearch', 'flight'); ?>
    </div>
</div>

<hr class="space3" />

<script type="text/javascript">

$('documtent').ready(function(){

    $('.matches').click(function(){

        var value = $(this).html();

        if($(this).hasClass('location1') == true){
            var target = '#search_car_location1';
        }else{
            var target = '#search_car_location2';
        }

        $(target).val(value);

        //alert(target);
        return false;

        //alert('here');
    });

});

</script>