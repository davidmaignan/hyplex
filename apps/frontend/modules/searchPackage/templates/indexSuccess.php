<?php use_javascript('jquery-1.6.2.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.16.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>
<?php require_once sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'search'.DIRECTORY_SEPARATOR.'variables.php'; ?>
<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>
<?php use_javascript('search/searchPackage'); ?>

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
        <?php if ($sf_request->hasParameter('origin')): ?>
        <h2><?php echo __('More information required for origin'); ?></h2>
        <?php include_partial('matches', array('datas' => $sf_request->getParameter('origin'))); ?>
        <?php endif; ?>
        <?php if ($sf_request->hasParameter('destination')): ?>
                <h2><?php echo __('More information required for destination'); ?></h2>
        <?php include_partial('matches', array('datas' => $sf_request->getParameter('destination'))); ?>
        <?php endif; ?>
        <?php include_partial('form', array('form' => $form)) ?>
    </div>
    <div class="span-10 last">
        <?php include_component('prevSearch', 'package'); ?>
    </div>
</div>

<hr class="space3" />
