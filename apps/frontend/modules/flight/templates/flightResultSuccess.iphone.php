<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_stylesheet('iphone/custom-theme/jquery-ui-1.8.11.custom.css'); ?>
<?php use_stylesheet('iphone.css'); ?>
<?php use_javascript('flight/flightResultIphone.js'); ?>
<?php use_helper('I18n', 'Date', 'Number'); ?>
<div id="page_wrapper">
    <ul id="header"  class="bg-light">
        <li><?php echo image_tag('iphone/logo_min.png', array('alt' => 'H', 'id' => 'logo')); ?></li>
        <li class="title"><?php echo __('Flight search'); ?></span></li>
        <li><a href="<?php echo url_for('homepage'); ?>" title="home" class="home">Home</a></li>
    </ul>
    <div class="search-box">
        <div class="search-box-list first">
            <div class="search-box-float">
               <!-- <a href="<?php //echo url_for('search_flight')?>" title="new" class="new">New</a> -->
            </div>
            <div class="search-box-float summary">
                <?php echo $parameters->displayParamsIphone(); ?>
            </div>
        </div>
        <?php foreach($results as $i=>$result): ?>
        <?php $result->setClass(fmod($i, 2) ? 'blue' : 'white') ?>
        <?php include_partial('flightReturn', array('result'=>$result)); ?>
        <?php endforeach; ?>
    </div>
</div>