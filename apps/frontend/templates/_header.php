<div class="span-9 prepend-top" id="logo">
    <?php echo link_to(image_tag('generic/logo_beta.png', array('alt' => 'Hypertech Solutions')), 'localized_homepage'); ?>
</div>
<div class="span-6 last">
    <ul style="font-size: 80%;">
        <li>sTId: <?php echo $sf_user->getAttribute('sTId') ?></li>
        <li>Renew sTId in:<?php echo ($sf_user->getAttribute('sTId_time')-time()); ?> seconds<li>
        <li>Folder: <?php $folder = explode('/', sfConfig::get('sf_user_folder')); echo $folder[count($folder)-1] ?></li>
    </ul>
</div>
<div class="span-9 last right prepend-top" id="phoneInfo">
    <p class="left">Speak to one of our<br /> expert travel advisors</p>
    <p class="right" id="phoneBox"><?php echo sfConfig::get('app_telephone'); ?></p>
</div>