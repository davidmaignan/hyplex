<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_stylesheet('iphone.css'); ?>
<?php use_javascript('iphone.js'); ?>

<div id="page_wrapper">
    <div id="header-index">
        <?php echo image_tag('generic/logo_beta.gif', array('alt' => 'Hypertech Solutions', 'width' => '200px', 'id' => 'logo')); ?>
        <a href="#" title="history" id="btn-history" class="btn"><?php echo __('History') ?></a>
    </div>

    <!-- LEFT OR RIGHT -->
    <div id="content_left">
        <?php include_partial('content_left_right', array('form' => $form)); ?>
        
    </div>

    <div id="content_right">
        <?php include_partial('content_left_right', array('form' => $form)); ?>
        <?php //include_partial('mysearches_normal'); ?>
    </div>

    <!-- NORMAL -->
    <div id="content_normal">
        <?php include_partial('content_normal', array('form' => $form)); ?>
        <?php //include_partial('mysearches_left_right'); ?>
    </div>

    <div id="content_flipped">
        <p>This doesn't work yet.</p>
    </div>
    <?php include_partial('mysearches_normal'); ?>
</div>

<noscript>
    <p style="padding:15px;">You need to have JavaScript enable to visit this website.</p>
</noscript>


