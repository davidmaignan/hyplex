<section id="header">
	<div class="span-12"><a href="<?php echo url_for('@localized_homepage') ?>" title="#">
	<h2 id="logo">Hyplexdemo</h2>
	</a></div>
	
	<div class="span-6 last">
	<?php if(sfConfig::get('sf_web_debug')): ?>
		<ul class="none">
			<li>sTId: <?php echo truncate_text($sf_user->getAttribute('sTId'),20) ?></li>
			<li>Renew sTId in:<?php echo ($sf_user->getAttribute('sTId_time')-time()); ?> seconds <li>
			<li>Folder: <?php $folder = explode('/', sfConfig::get('sf_user_folder')); echo $folder[count($folder)-1] ?></li>
		</ul>
	<?php endif; ?>
	</div>
	<div class="span-4 last right" id="phoneInfo"><p class="right" id="phoneBox">1 800 123 1234</p></div>
</section>
