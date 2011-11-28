<div class="span-9 prepend-top" id="logo">
    <?php echo link_to(image_tag('generic/logo_beta.png', array('alt' => 'Hypertech Solutions', 'width'=>'260px', 'height'=>'50px')), 'localized_homepage'); ?>
</div>
<div class="span-6 last">
    <?php if(sfConfig::get('sf_web_debug')): ?>
    <ul style="font-size: 80%;">
        <li>sTId: <?php echo truncate_text($sf_user->getAttribute('sTId'),20) ?></li>
        <li>Renew sTId in:<?php echo ($sf_user->getAttribute('sTId_time')-time()); ?> seconds<li>
        <li>Folder: <?php $folder = explode('/', sfConfig::get('sf_user_folder')); echo $folder[count($folder)-1] ?></li>
    </ul>

    <?php endif; ?>
    
</div>
<div class="span-9 last right prepend-top" id="phoneInfo">
    
    <p class="right" id="phoneBox"><?php echo sfConfig::get('app_telephone'); ?></p>
</div>