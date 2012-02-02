
<div class="span-6 shadow bg-white">
    <table class="style1">
        <tr class="header_1 bold">
            <td><?php echo link_to1(__('Home'), '@account', array('class'=>'account-home')) ?></td>
        </tr>
        <tr class="header_1 bold">
            <td><?php echo link_to1(__('Bookings'), '@my_booking', array('class'=>'account-booking')) ?></td>
        </tr>
        <tr class="header_1 bold">
            <td><?php echo link_to1(__('Previous searches'), '@my_previous_searches_account', array('class'=>'account-searches')) ?></td>
        </tr>
        <tr class="header_1 bold">
            <td><a class="account-reviews"><?php echo __('My reviews') ?></a></td>
        </tr>
        <tr class="header_1 bold">
            <td><a><?php echo link_to1(__('My preferences'), '@my_preferences', array('class'=>'account-preferences')) ?></a></td>
        </tr>
        <?php if ($sf_user->isAuthenticated()): ?>
            <tr class="header_1 bold">
                <td><?php echo link_to1(__('Profile'), '@account', array('class'=>'account-profile')) ?></td>
            </tr>
        <?php endif; ?>
        <tr class="header_1 bold">
            <td>
                <?php if ($sf_user->isAuthenticated()): ?>
                    <?php echo link_to1(__('Log out'), '@signout', array('class'=>'account-signout')); ?>
                <?php else: ?>
                    <?php echo link_to1(__('Sign in'), '@signin', array('class'=>'account-signin')); ?>
                <?php endif; ?>

            </td>
        </tr>
    </table>


</div>

