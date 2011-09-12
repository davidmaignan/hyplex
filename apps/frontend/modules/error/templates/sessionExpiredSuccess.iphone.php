<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_stylesheet('iphone'); ?>
<?php use_javascript('iphone.js'); ?>


<div id="page_wrapper">
    <ul id="header"  class="bg-light">
        <li><?php echo image_tag('iphone/logo_min.png', array('alt' => 'H', 'id' => 'logo')); ?></li>
        <li class="title"><?php echo __('Flight search'); ?></span</li>
        <li><a href="<?php echo url_for('homepage'); ?>" title="history" class="home">Home</a></li>
    </ul>
    <div class="box-1">
        <h2><?php echo __('Session Expired') ?></h2>
    </div>
</div>
