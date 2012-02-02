<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1.0', {'packages':['corechart', 'geochart']});
</script>

<?php include_partial('navigation')?>

<div id="mainContent">
<h2>Flight</h2>

<?php
 $flight = $topSearches['flight'];
 $hotel = $topSearches['hotel'];
?>


<table class="data large">
<thead>
	<tr>
		<th>Rank</th>
		<th>Destination</th>
		<th><span style="float: left">Origin</span><span style="float: right">total</span></th>
		<th>Total</th>
	</tr>
</thead>
<?php $i = 0;?>
<?php foreach($flight->arDestination as $key=>$info):?>
	<tr>
	<td><?php echo ++$i;?></td>
	<td class="">
		<?php echo $key?><br />
		<?php echo $flight->getAirportFullName($key) ?></td>
	<td><?php echo $flight->getDestinationByOrigin($key); ?></td>
	<td class="grey"><?php echo $info?></td>
	</tr>
 <?php endforeach; ?>
</table>



<table class="data large">
<thead>
	<tr>
		<th>Rank</th>
		<th>Origin</th>
		<th><span style="float: left">Destination</span><span style="float: right">total</span></th>
		<th>Total</th>
	</tr>
</thead>
<?php $j = 0; ?>
<?php foreach($flight->arOrigin as $key=>$info):?>
	<tr>
	<td><?php echo ++$j;?></td>
	<td class="">
		<?php echo $key?><br />
		<?php echo $flight->getAirportFullName($key) ?></td>
	<td><?php echo $flight->getOriginByDestination($key); ?></td>
	<td class="grey"><?php echo $info?></td>
	</tr>
 <?php endforeach; ?>
</table>


<div style="clear:both;"></div>
<hr class="space" />

<h3>Fligth passengers</h3>
<table class="data">
	<thead>
		<tr>
			<th>Passengers</th>
			<th class="text-center">total</th>
			<th class="text-center">percent</th>
		</tr>
	</thead>
	<?php foreach($flightPassengers['values'] as $key=>$value):?>
	<tr>
		<td><?php echo $key;?></td>
		<td class="text-center"><?php echo $value; ?></td>
		<td class="text-center"><?php echo round(($value/array_sum($flightPassengers['values']))*100,2)?></td>
	</tr>
	<?php endforeach;?>
</table>


<div class="chart">
<?php 
$chart = new PlexPieChart('flightPassengers', $flightPassengers, 800, 400);
echo $chart;
?>
</div>

<div style="clear:both;"></div>
<hr class="space" />


<h2>Hotel</h2>

<h3>Destination - Number of days</h3>

<table class="data large">
<thead>
	<tr>
		<th>Rank</th>
		<th>Destination</th>
		<th>Total</th>
	</tr>
</thead>
<?php $i = 0;?>
<?php foreach($hotel->arWhere as $key=>$info):?>
	<tr>
	<td><?php echo ++$i;?></td>
	<td class="">
		<?php echo $key?><br />
		<?php echo $hotel->getAirportFullName($key) ?></td>
	<td class=""><?php echo $info?></td>
	</tr>
 <?php endforeach; ?>
</table>
<?php $i = 0;?>
<table class="data large">
	<thead>
	<tr>
		<th>Rank</th>
		<th>Number of days</th>
		<th>Total</th>
	</tr>
	<?php foreach($hotel->arNbrDaysBooked as $key=>$info):?>
	<tr>
	<td><?php echo ++$i;?></td>
	<td class=""><?php echo $key?></td>
	<td class=""><?php echo $info?></td>
	</tr>
	<?php endforeach;?>
</thead>

</table>

<div style="clear:both;"></div>
<hr class="space" />

<h3>Adults</h3>
<table class="data">
	<thead>
		<tr>
			<th>Number adults</th>
			<th class="text-center">total</th>
			<th class="text-center">percent</th>
		</tr>
	</thead>
	<?php foreach($hotelPassengers['values'] as $key=>$value):?>
	<tr>
		<td><?php echo $key;?></td>
		<td class="text-center"><?php echo $value; ?></td>
		<td class="text-center"><?php echo round(($value/array_sum($hotelPassengers['values']))*100,2)?></td>
	</tr>
	<?php endforeach;?>
</table>


<div class="chart">
<?php 
$chart = new PlexPieChart('hotelAdults', $hotelPassengers, 800, 400);
echo $chart;
?>
</div>

<div style="clear:both;"></div>
<hr class="space" />

<h3>Children</h3>
<table class="data">
	<thead>
		<tr>
			<th>Number children</th>
			<th class="text-center">total</th>
			<th class="text-center">percent</th>
		</tr>
	</thead>
	<?php foreach($hotelChildren['values'] as $key=>$value):?>
	<tr>
		<td><?php echo $key;?></td>
		<td class="text-center"><?php echo $value; ?></td>
		<td class="text-center"><?php echo round(($value/array_sum($hotelChildren['values']))*100,2)?></td>
	</tr>
	<?php endforeach;?>
</table>


<div class="chart">
<?php 
$chart = new PlexPieChart('hotelChildren', $hotelChildren, 800, 400);
echo $chart;
?>
</div>


<div style="clear:both;"></div>
<hr class="space" />

<h2>Calendar</h2>

<?php $k = 0;?>

<table class="data">
	<thead>
		<tr>
			<th>Rank</th>
			<th>Nbr of days</th>
			<th>Total</th>
		</tr>
	</thead>
	<?php foreach($flight->arNbrDays as $key=>$value):?>
	<tr>
		<td><?php echo ++$k;?></td>
		<td><?php echo $key;?></td>
		<td><?php echo $value; ?></td>
		
	</tr>
	<?php endforeach;?>
</table>

<div class="chart">
<?php 
$chart2 = new PlexMultiColumnChart('OS_browser', $searchDates,760, 400);
echo $chart2;
?>
</div>

</div>