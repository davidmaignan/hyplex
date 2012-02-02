<p><?php echo __('Please supply a valid email address and telephone. A confirmation will be sent to this email.')?></p>
    <table class="middle">
        <tr>
            <td class="span-4"><?php echo $form['email']->renderLabel(); ?></td>
            <td>
                <?php echo $form['email']->render(array('class'=>'text span-5')); ?><br /><br />
                <?php echo $form['email']->renderError(); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['email_again']->renderLabel(); ?></td>
            <td>
                <?php echo $form['email_again']->render(array('class'=>'text span-5')); ?><br /><br />
                <?php echo $form['email_again']->renderError(); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['telephone']->renderLabel(); ?></td>
            <td>
                <?php echo $form['telephone']->render(array('class'=>'text span-5')); ?><br /><br />
                <?php echo $form['telephone']->renderError(); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['password']->renderLabel(); ?></td>
            <td>
                <?php echo $form['password']->render(array('value' => $password, 'class'=>'text span-5')); ?><br /><br />
                <?php echo $form['password']->renderError(); ?></li>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['password_again']->renderLabel(); ?></td>
            <td>
                <?php echo $form['password_again']->render(array('value' => $password_again, 'class'=>'text span-5')); ?><br /><br />
                <?php echo $form['password_again']->renderError(); ?>
            </td>
        </tr>
    </table>
    <h2 class="title">Address information</h2>
    <p><?php echo __("Please supply the cardholder's billing address as listed on the credit/debit card statement.") ?> </p>
    <table class="middle">
        <tr>
            <td class="span-4"><?php echo $form['address_1']->renderLabel(); ?></td>
            <td>
                <?php echo $form['address_1']->render(array('class'=>'text span-5')); ?><br /><br />
                <?php echo $form['address_1']->renderError(); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['address_2']->renderLabel(); ?></td>
            <td>    
                <?php echo $form['address_2']->render(array('class'=>'text span-5')); ?><br /><br />
                <?php echo $form['address_2']->renderError(); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['city']->renderLabel(); ?></td>
            <td>    
                <?php echo $form['city']->render(array('class'=>'text span-5')); ?><br /><br />
                <?php echo $form['city']->renderError(); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['postcode']->renderLabel(); ?></td>
            <td>
                <?php echo $form['postcode']->render(array('class'=>'text span-5'));; ?><br /><br />
                <?php echo $form['postcode']->renderError(); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['state']->renderLabel(); ?></td>
            <td>
                <?php echo $form['state']->render(array('class'=>'text span-5')); ?><br /><br />
                <?php echo $form['state']->renderError(); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form['country']->renderLabel(); ?></td>
            <td>
                <?php echo $form['country']->render(array('class'=>'text span-5s')); ?><br /><br />
                <?php echo $form['country']->renderError(); ?>
            </td>
        </tr>
    </table>