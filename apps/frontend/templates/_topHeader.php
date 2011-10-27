<div id="top-header">
    <div class="container">
        <div class="span-13">
        <ul>
            <li><a href="#"><?php echo ucfirst(__('news')) ?></a></li>
            <li><a href="#"><?php echo ucfirst(__('feature deals')) ?></a></li>
            <li><a href="<?php echo url_for('@top_destination') ?>"><?php echo ucfirst(__('top destinations')) ?></a></li>
            <li><a href="<?php echo url_for('@reset') ?>"><?php echo ucfirst(__('vacations by interest')) ?></a></li>
        </ul>
        </div>
        <div class="span-2">
            <?php include_partial('global/language'); ?>
        </div>
        <div class="span-3">
            <?php include_partial('global/currency'); ?>
        </div>
        <div class="span-5 right">
        <ul>
            <?php if($sf_user->isAuthenticated()):?>
            <li class="right logout"><a href="<?php echo url_for('@sf_guard_signout') ?>"><?php echo ucfirst(__('log out')) ?></a></li>
            <li class="right white"><span><?php echo __('Welcome,  %1%',array('%1%'=>$sf_user->getGuardUser()->getUsername()))?></span></li>
            <?php else: ?>
            <li class="right login"><a href="#"><?php echo ucfirst(__('login')) ?></a></li>
            <li class="right"><a href="#"><?php echo ucfirst(__('register')) ?></a></li>
            <?php endif; ?>
        </ul>
        </div>
    </div>
    <?php //echo image_tag('generic/top-header.jpg'); ?>
</div>