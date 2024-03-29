<?php use_javascript('jquery-1.6.2.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.16.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>
<?php require_once sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'search'.DIRECTORY_SEPARATOR.'variables.php'; ?>
<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>

<?php use_javascript('search/searchHotel'); ?>


<?php use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php use_javascript('debugger/myLogger.js'); ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>
<?php use_stylesheet('custom-theme/jquery-ui-1.8.16.custom.css'); ?>
<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>


<style type="text/css">
    #dialog-message{
        display: none;
        text-align: center;
    }
</style>


<div id="dialog-message" title="<?php echo __('You have sent a request') ?>">
    <p style="text-align: center;"><?php echo image_tag('generic/ajax-loader.gif', array('alt' => '')) ?></p>
    <br />
    <p><?php echo __('Your request has been sent. Please wait !'); ?></p>
    <p><?php //echo __('You can always change your mind. Click cancel');        ?></p>
</div>

<div class="span-26">

    <div class="span-15">

        <?php if($sf_user->hasFlash('children_age')): ?>
            <div class="span-14 notice" style="font-size: 80%; padding-right: 25px;">
                <?php echo __('Please provide children ages to get the best available price') ?>
            </div>
        <?php endif; ?>

        <?php if ($sf_request->hasParameter('wherebox')): ?>
            <h2><?php echo __('More information required for Wherebox'); ?></h2>
        <?php include_partial('searchFlight/matches', array('datas' => $sf_request->getParameter('wherebox'))); ?>
        <?php endif; ?>
        <?php include_partial('form', array('form' => $form)) ?>
    </div>

    <div class="span-10 last">
        <?php include_component('prevSearch', 'hotel'); ?>
    </div>

</div>

<hr class="space3"/>