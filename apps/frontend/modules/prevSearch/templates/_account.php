
<div class="span-19 shadow" id="tab-viewing">
	<ul class="none">
		<li><a href="#" class="tab view-flight selected">Flights</a></li>
		<li><a href="#" class="tab view-hotel">Hotels</a></li>
		<li><a href="#" class="tab view-package">Packages</a></li>
		<li><a href="#" class="tab view-car">Cars</a></li>
	</ul>
</div>


<hr class="space" />

<div class="flight-container tab-container">

<h3>Flights</h3>

<table class="data">
	<thead>
	<tr>
	<th><?php echo __('Date')?></th>
	<th><?php echo __('From / To')?></th>
	<th><?php echo __('Depart / Return')?></th>
	<th><?php echo __('Passengers')?></th>
	<th><?php echo __('Info')?></th>
	<th class="text-center"><?php echo __('actions')?></th>
	</tr>
	</thead>
	<?php foreach($prevSearches['flight'] as $key=>$prevSearch): ?>
	<?php include_partial('prevSearch/accountFlight', array('prevSearch'=>$prevSearch))?>
	<?php endforeach;?>
</table>
<hr class="space" />

</div>

<div class="hotel-container tab-container hide">
<h3>Hotel</h3>

<table class="data">
	<thead>
	<tr>
	<th><?php echo __('Date')?></th>
	<th><?php echo __('Where')?></th>
	<th><?php echo __('Checkin / Checkout')?></th>
	<th><?php echo __('Rooms')?></th>
	<th><?php echo __('Info')?></th>
	<th class="text-center"><?php echo __('actions')?></th>
	</tr>
	</thead>
	<?php foreach($prevSearches['hotel'] as $key=>$prevSearch): ?>
	<?php include_partial('prevSearch/accountHotel', array('prevSearch'=>$prevSearch))?>
	<?php endforeach;?>
</table>

<hr class="space" />
</div>

<div class="package-container tab-container hide">
<h3>Packages</h3>
<p>No search found</p>
</div>

<div class="car-container tab-container hide">
<h3>Cars</h3>
<p>No search found</p>
</div>

<script type="text/javascript">

$('document').ready(function(){

	$('.tab').plexTabs();
	
});




</script>

