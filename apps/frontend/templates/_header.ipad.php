<div class="span-6" id="logo">
    <?php echo link_to(image_tag('generic/logo_beta.gif', array('alt' => 'Hypertech Solutions')), 'homepage'); ?>
</div>

<div class="span-9">
    <ul  id="top-nav">
        <li class="second"><a href="<?php echo url_for('homepage'); ?>"><?php echo __('Home') ?></a></li>
        <li class="second"><a href=""><?php echo __('About us') ?></a></li>
        <li class="second"><a href=""><?php echo __('Booking infos') ?></a></li>
        <li class="second"><a href="<?php echo url_for1('search_flight') ?>"><?php echo __('Search Flight') ?></a></li>
        <?php if($sf_user->isAuthenticated()): ?>
            <li class="second"><a href="<?php echo url_for('sf_guard_signout'); ?>"><?php echo __('Log out') ?></a></li>
        <?php endif; ?>
    </ul>
</div>
<div class="span-3 last">
    <?php include_partial('global/language'); ?>

</div>

