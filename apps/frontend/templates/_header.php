<div class="span-10 prepend-top" id="logo">
    <?php echo link_to(image_tag('generic/logo_beta.png', array('alt' => 'Hypertech Solutions')), 'homepage'); ?>
</div>

<div class="span-5 last">
    <h4 style="margin-top: 5px;">
        <?php echo ($sf_user->getAttribute('sTId_time')-time()); ?> seconds before sTId request;
    </h4>
</div>

<div class="span-9 last right prepend-top" id="phoneInfo">
    <p class="left">Speak to one of our<br /> expert travel advisors</p>
    <p class="right" id="phoneBox"><?php echo sfConfig::get('app_telephone'); ?></p>
    <?php //echo image_tag('generic/telephone.png',array('class'=>'right')); ?>
</div>