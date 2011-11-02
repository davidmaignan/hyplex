<?php use_helper('I18N') ?>
<div class="span-10 append-bottom">
<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table>
    <tbody>
        <tr>
            <td class="smaller">
                <?php echo __('Username', null, 'sf_guard') ?>
            </td>
            <td>
                <?php echo $form['username']->render(array('class'=>'small')); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?php echo $form['username']->renderError(); ?>
            </td>
        </tr>
        <tr>
            <td class="smaller">
                <?php echo __('Password', null, 'sf_guard') ?>
            </td>
            <td>
                <?php echo $form['password']->render(array('class'=>'small')); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?php echo $form['password']->renderError(); ?>
            </td>
        </tr>
        <tr>
            <td class="smaller">
                <?php echo __('Remember', null, 'sf_guard') ?>
            </td>
            <td>
                <?php echo $form['remember']; ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?php echo $form['remember']->renderError(); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"><?php echo $form['_csrf_token'] ?></td>
        </tr>
      
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2" style="padding-right: 20px;">
          <input type="submit" class="blue right" value="<?php echo __('Signin', null, 'sf_guard') ?>" />
          
          <?php $routes = $sf_context->getRouting()->getRoutes() ?>
          <?php if (isset($routes['sf_guard_forgot_password'])): ?>
            <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
          <?php endif; ?>

          <?php if (isset($routes['sf_guard_register'])): ?>
            &nbsp; <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('Want to register?', null, 'sf_guard') ?></a>
          <?php endif; ?>
        </td>
      </tr>
    </tfoot>
  </table>
</form>
</div>
<hr class="space3" />

<style>
    table td{
        vertical-align: middle;
        padding-right: 20px;
    }
</style>

