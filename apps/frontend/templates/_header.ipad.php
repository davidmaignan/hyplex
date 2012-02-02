<nav>
        <ul id="main-nav" class="clearfix">
            <li class="second"><a href="<?php echo url_for('homepage'); ?>"><?php echo __('News') ?></a></li>
            <li class="second"><a href=""><?php echo __('Feature deals') ?></a></li>
            <li class="second"><a href=""><?php echo __('Top destinations') ?></a></li>
            <li class="second"><a href="<?php //echo url_for1('search_flight')  ?>"><?php echo __('Vacations by interest') ?></a></li>
            <?php if ($sf_user->isAuthenticated()): ?>
                <li class="second"><a href="<?php echo url_for('signout'); ?>"><?php echo __('Log out') ?></a></li>
            <?php else: ?>
                <li class="second"><a href="<?php echo url_for('signin'); ?>"><?php echo __('Sign in') ?></a></li>
            <?php endif; ?>
        </ul>
        <!-- /#main-nav --> 
</nav>

    
