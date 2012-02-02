<nav id="main-nav">
	<h2>Main navigation</h2>
	<?php echo link_to(__('Flight'), 'search_flight') ?>
	<?php echo link_to(__('Hotel'), 'search_hotel') ?>
	<?php echo link_to(__('Car'), 'search_car') ?>
	<?php echo link_to(__('Package'), 'search_package') ?>
	<?php echo link_to(__('Basket'), 'basket', array(), array('class'=>'right')) ?>
	<?php echo link_to(__('Account'), 'account', array(), array('class'=>'right')) ?>
</nav>
