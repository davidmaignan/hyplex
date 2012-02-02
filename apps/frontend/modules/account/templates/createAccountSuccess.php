<?php include_partial('account/navigationLeft') ?>

<div class="span-18 last prepend-1">

    <h2 class="title"><?php echo __('Sign up') ?></h2>

    <ul class="">
        <li>Easily manage Your bookings, details and reviews</li>
        <li>Get exclusive members-only offers</li>
        <li>Booking is faster with a hyplexdemo profile</li>
        <li>Be the first to enjoy our new features</li>
    </ul>
    <hr class="space" />
    <form action="<?php echo url_for('@create_account') ?>" method="post">

        <h4 class="bold blue1  minMargin title"><?php echo __('Account information') ?></h4>
        <table class="middle">
            <tr>
                <td class="span-4"><?php echo $form['email']->renderLabel(); ?></td>
                <td class="span-5">
                    <?php echo $form['email']->render(array('class' => 'text span-5')); ?></td><td>
                    <?php echo $form['email']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['email_again']->renderLabel(); ?></td>
                <td>
                    <?php echo $form['email_again']->render(array('class' => 'text span-5')); ?></td><td>
                    <?php echo $form['email_again']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['password']->renderLabel(); ?></td>
                <td>
                    <?php echo $form['password']->render(array('value' => $password, 'class' => 'text span-5')); ?></td><td>
                    <?php echo $form['password']->renderError(); ?></li>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['password_again']->renderLabel(); ?></td>
                <td>
                    <?php echo $form['password_again']->render(array('value' => $password_again, 'class' => 'text span-5')); ?></td><td>
                    <?php echo $form['password_again']->renderError(); ?>
                </td>
            </tr>
        </table>

        <h4 class="bold blue1 minMargin title"><?php echo __('Address information') ?></h4>
        <table class="middle">
            <tr>
                <td class="span-4"><?php echo $form['address_1']->renderLabel(); ?></td>
                <td class="span-5">
                    <?php echo $form['address_1']->render(array('class' => 'text span-5')); ?></td><td>
                    <?php echo $form['address_1']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['address_2']->renderLabel(); ?></td>
                <td>    
                    <?php echo $form['address_2']->render(array('class' => 'text span-5')); ?></td><td>
                    <?php echo $form['address_2']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['city']->renderLabel(); ?></td>
                <td>    
                    <?php echo $form['city']->render(array('class' => 'text span-5')); ?></td><td>
                    <?php echo $form['city']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['postcode']->renderLabel(); ?></td>
                <td>
                    <?php echo $form['postcode']->render(array('class' => 'text span-5'));
                    ; ?></td><td>
<?php echo $form['postcode']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['state']->renderLabel(); ?></td>
                <td>
                    <?php echo $form['state']->render(array('class' => 'text span-5')); ?></td><td>
<?php echo $form['state']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['country']->renderLabel(); ?></td>
                <td>
                    <?php echo $form['country']->render(array('class' => 'text span-5')); ?></td><td>
<?php echo $form['country']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form['telephone']->renderLabel(); ?></td>
                <td>
                    <?php echo $form['telephone']->render(array('class' => 'text span-5')); ?></td><td>
<?php echo $form['telephone']->renderError(); ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="<?php echo __('create an account'); ?>" class="blue big" /></td>
            </tr>
        </table>
        <?php echo $form['_csrf_token']; ?>
<?php echo $form['country_id']; ?>


    </form>
    
    <p>By updating your profile you are agreeing with our <a>Terms and Conditions</a> and <a>Privacy Statement</a>.</p>
</div>