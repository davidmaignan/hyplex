<?php include_partial('account/navigationLeft')?>


<div class="span-18 prepend-1 last">

<h2><?php echo __('My preferences')?></h2>

<div class="span-19 shadow" id="tab-viewing">
	<ul class="none">
		<li><a href="#" class="tab view-preference selected"><?php echo __('my preferences')?></a></li>
		<li><a href="#" class="tab view-newsletter"><?php echo __('my newsletters')?></a></li>
	</ul>
</div>
<hr class="space" />

<div class="preference-container tab-container">

<table class="span-12">
	<tr>
		<td class="big bold span-5 th">My preferred currency: </td>
		<td class="">
			<?php echo Utils::getSelectMenu(sfConfig::get('app_currencies_array'), 'currency'); ?>
		</td>
	</tr>
	<tr >
		<td class="big bold span-5 th">My language: </td>
		<td>
			<?php echo Utils::getSelectMenu(sfConfig::get('app_langues_array'), 'language'); ?>
		</td>
	</tr>
	<tr>
		<td></td>
		<td colspan=""><input type="submit" class="action blue" value="<?php echo __('save preferences')?>" /></td>
	</tr>
	<tr>
		<td class="big bold th">My favourite cities: </td>
		<td>
			
		</td>
	</tr>
	<tr>
		<td class="big bold th">My favourite countries: </td>
		<td></td>
	</tr>
</table>


<hr class="space" />
</div>

<div class="newsletter-container tab-container hide">
<p>Choose where and when you want to receive your newsletters.</p>

<div class="span-13">
<table class="">
	<tr>
		<td class="big bold th span-4">
			Email: 
		</td>
		<td>
			<?php echo $sf_user->getGuardUser()->getEmailAddress();?>
		</td>
	<tr>
	<tr>
		<td class="big bold th">
			Subscribed: 
		</td>
		<td>
			<input type="checkbox" name="subscribe_newsletter" />
		</td>
	<tr>
	<tr>
		<td></td>
		<td><input type="submit" value="<?php echo __('save')?>" class="action blue" /></td>
	</tr>
</table>
</div>

<hr class="space" />
</div>



</div>

<script type="text/javascript">



$('document').ready(function(){	
	$('.tab').plexTabs(null);
});


</script>