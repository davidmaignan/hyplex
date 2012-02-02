<?php include_partial('account/navigationLeft')?>


<div class="span-18 prepend-1 last">


<?php if(isset($tabToShow)):?>
<script type="text/javascript">
var tabToShow = '<?php echo $tabToShow; ?>';
</script>
<?php else:?>
<script type="text/javascript">
var tabToShow = null;
</script>
<?php endif;?>

<h2 class=""><?php echo __('My profile')?></h2>
<div class="span-19 shadow" id="tab-viewing">
	<ul class="none">
		<li><a href="#" class="tab view-profile selected"><?php echo __('my information')?></a></li>
		<li><a href="#" class="tab view-password"><?php echo __('Change my password')?></a></li>
		<li><a href="#" class="tab view-email"><?php echo __('my emails')?></a></li>
		<li><a href="#" class="tab view-social"><?php echo __('my social networks')?></a></li>
	</ul>
</div>
<hr class="space" />

<div class="profile-container tab-container">

<table class="">
	<tr>
		<td class="bold span-3 th"><?php echo __('username') ?></td>
		<td><?php echo $sf_user->getUsername(); ?></td>
	</tr>
	<tr >
		<td class=" bold span-3 th"><?php echo __('name') ?></td>
		<td><?php echo $sf_user->getName(); ?></td>
	</tr>
	<tr>
		<td class=" bold th"><?php echo __('email') ?></td>
		<td><?php echo $sf_user->getGuardUser()->getEmailAddress(); ?></td>
	</tr>
	<tr>
		<td class=" bold th"><?php echo __('address') ?></td>
		<td><?php echo html_entity_decode($myInfos['address']);?></td>
	</tr>
	<tr>
		<td class=" bold th"><?php echo __('country') ?></td>
		<td><?php echo $myInfos['country']?></td>
	</tr>
	<tr>
		<td class=" bold th"><?php echo __('telephone') ?></td>
		<td><?php echo $myInfos['telephone']?></td>
	</tr>
	<tr>
		<td></td>
		<td><a class="button blue"><?php echo __('edit') ?></a></td>
	</tr>
</table>

<hr class="space" />
</div>


<div class="password-container tab-container hide">
<h3><?php echo __('Change my password')?></h3>
<p>Create your own password and reset it whenever you like.</p>

<?php if($sf_user->hasFlash('change_password')):?>
<p class="success"><?php echo $sf_user->getFlash('change_password')?></p>
<?php endif;?>

<form action="<?php echo url_for('change_password')?>" method="post" id="password_change">

<table class="span-8">
<?php if ($passwordForm->hasGlobalErrors()): ?>
  <tr>
    <td colspan="4">
      <ul class="error_list">
        <?php foreach ($passwordForm->getGlobalErrors() as $name => $error): ?>
          <li><?php echo $error ?></li>
        <?php endforeach; ?>
      </ul>
    </td>
  </tr>
<?php endif; ?>
<tr>
<td class="middle span-3"><?php echo $passwordForm['password']->renderLabel();?></td>
<td>
	<?php echo $passwordForm['password'];?><br /><br/>
	<?php echo $passwordForm['password']->renderError();?>
</td>
</tr>
<tr>
<td class="middle"><?php echo $passwordForm['password_confirm']->renderLabel();?></td>
<td>
	<?php echo $passwordForm['_csrf_token'];?>
	<?php echo $passwordForm['password_confirm'];?><br /><br/>
	<?php echo $passwordForm['password_confirm']->renderError();?>
</td>
</tr>
<tr>
<td colspan="2">
<input type="submit" class="action blue big right" value="<?php echo __('submit')?>" />
</td>
</tr>
</table>
</form>

<hr class="space" />
</div>




<div class="email-container tab-container hide">
<h3><?php echo __('Add emails')?></h3>

<hr class="space" />
</div>



<div class="social-container tab-container hide">
<h3><?php echo __('My social networks')?></h3>

<table>
    <tr>
        <td class="span-1"><?php echo image_tag('social/social_networking_iconpack/facebook_32.png') ?></td>
        <td><?php echo __('connect with facebook') ?></td>
    </tr>
    <tr>
        <td><?php echo image_tag('social/social_networking_iconpack/twitter_32.png') ?></td>
        <td><?php echo __('connect with twitter') ?></td>
    </tr>
    <tr>
        <td><?php echo image_tag('social/social_networking_iconpack/google_32.png') ?></td>
        <td><?php echo __('connect with google') ?></td>
    </tr>
    <tr>
        <td><?php echo image_tag('social/social_networking_iconpack/yahoo_32.png') ?></td>
        <td><?php echo __('connect with yahoo') ?></td>
    </tr>
    <tr>
        <td><?php echo image_tag('social/social_networking_iconpack/rss_32.png') ?></td>
        <td><?php echo __('connect with rss') ?></td>
    </tr>
</table>

<hr class="space" />
</div>










</div>


<script type="text/javascript">



$('document').ready(function(){	
	$('.tab').plexTabs(tabToShow);
});


</script>
