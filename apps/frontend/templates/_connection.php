<ul>
    <?php if ($sf_user->isAuthenticated()): ?>
        <li class="right logout"><a href="<?php echo url_for('sfGuardAuth/signout') ?>"><?php echo __('log out') ?></a></li>
        <li class="right white"><span><?php echo __('Welcome,  %1%', array('%1%' => $sf_user->getGuardUser()->getUsername())) ?></span></li>
    <?php else: ?>
            <li class="right login"><a href="#"><?php echo __('login') ?></a></li>
            <li class="right"><a href="#"><?php echo __('register') ?></a></li>
    <?php endif; ?>
</ul>