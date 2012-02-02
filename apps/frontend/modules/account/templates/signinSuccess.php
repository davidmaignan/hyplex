<?php include_partial('account/navigationLeft') ?>

<div class="span-18 prepend-1 last">

<h2 class=""><?php echo __('Sign in')?></h2>

<p class="minMargin"><?php echo __('Sign in here to update your details. No profile yet? ') ?>
    <?php echo link_to(__('Create one.'), 'create_account') ?>
</p>

<div class="span-7">

<form action="<?php echo url_for('signin') ?>" method="POST" id="login-form">

<table>
	<tr>
		<td></td>
	</tr>
	<tr>
		<td>
		<?php echo $form['username']->renderLabel(); ?><br />
		<?php echo $form['username']->render(array('class'=>'text span-7')); ?>
		</td>
	</tr>
	<tr>
		<td><?php echo $form['username']->renderError(); ?></td>
	</tr>
	<tr>
		<td>
			<?php echo $form['password']->renderLabel(); ?><br />
			<?php echo $form['password']->render(array('class'=>'text span-7')); ?>
		</td>
	</tr>
	<tr>
		<td><?php echo $form['password']->renderError(); ?></td>
	</tr>
	<tr>
		<td>
			<?php echo $form['remember'] ?>
			Remember me
			<?php echo $form['_csrf_token']?>
		</td>
	</tr>
	
	<tr>
		<td><input type="submit" value="<?php echo __('sign in') ?>" class="blue" /></td>
	</tr>
	<tr>
		<td>
		<p>Forgotten your password? <?php echo link_to(__('Click here'), '@forgot_password')?></p>
			
		</td>
	</tr>
</table>

</form>

</div>
<hr class="space" />
<?php //echo $form; ?>


</div>