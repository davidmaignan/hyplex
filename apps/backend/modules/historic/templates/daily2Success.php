<?php use_stylesheet('/sfDoctrinePlugin/css/default.css'); ?>
<?php use_stylesheet('/sfDoctrinePlugin/css/global.css'); ?>

<?php use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php use_javascript('debugger/myLogger.js'); ?>


<script
	type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
var functionDeclared = false;
google.load('visualization', '1.0', {'packages':['corechart', 'geochart']});



$('document').ready(function(){

    $('.tab').click(function(){

        $('.container').hide();

        var id = $(this).attr('id');
        var container = '#container-'+id;

        $(container).show();
        
    });

    //drawRegionsMap();


});


</script>



<h1>Daily report</h1>
<div id="nav-left">
<ul>
	<li><a href="#" id="1" class="tab">Traffic report</a></li>
	<li><a href="#" id="2" class="tab">User activity</a></li>
	<li><a href="#" id="3" class="tab">Top searches</a></li>
	<li><a href="#" id="4" class="tab">Bookings</a></li>
	<li><a href="#" id="5" class="tab">Daily bugs</a></li>
</ul>
</div>

<div id="main-content">

<div id="container-1" class="container">

<table>

	<tr>
	<td>
	
	<table>
			<thead>
				<tr>
					<th colspan="2">Summary</th>
				</tr>
			</thead>
			<tr>
				<td style="width: 150px;">Number of visitor</td>
				<td><?php echo count($stats); ?></td>
			</tr>
			<tr>
				<td>Page viewed / visitor</td>
				<td><?php echo $statsSummary['page_visitors'] ?></td>
			</tr>
			<tr>
				<td>Time (s) / visitor</td>
				<td><?php echo Utils::getMinutesSeconds(ceil($statsSummary['time_per_visitor'])) ?></td>
			</tr>
			<tr>
				<td>Time (s) / page</td>
				<td><?php echo Utils::getMinutesSeconds($statsSummary['time_per_visitor']/$statsSummary['page_visitors']) ?></td>
			</tr>
			<tr>
				<td>Number of searches:</td>
				<td><?php echo $statsSummary['number_searches'] ?></td>
			</tr>
		</table>
	
	</td>
		<td><?php
		$chart2 = new PlexColumnChart('hourly_traffic', $statsHourly, 900, 300);
		echo $chart2;
		?></td>
	</tr>
</table>
<table>
	<tr>
		<td><?php 
		$chart = new PlexPieChart('language', $languages, 350, 400);
		echo $chart;
		?></td>
		<td><?php 
		$chart2 = new PlexPieChart('OS', $statsOS, 350, 400);
		echo $chart2;
		?></td>
		<td><?php 
		$chart2 = new PlexMultiColumnChart('OS_browser', $statsBrowser, 420, 400);
		echo $chart2;
		?></td>
	</tr>

</table>
</div>

<div id="container-2"  class="container"style="display: none;">
<table>
	<tr>
		<td style="width: 350px;">

		
		</td>
		<td>
			<?php
				$ipMap = new PlexGeoChart('ipMap', $geoLocation, 790, 500);
				echo $ipMap;
			?>
		</td>
	</tr>
</table>

</div>




<div id="container-3"><?php if (count($stats)): ?> <?php $keys = array_keys($stats[0]); ?>
<table class="container" id="container-2" style="display: none;">
	<thead>
		<tr>
		<?php foreach ($keys as $key): ?>
			<th><?php echo $key ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($stats as $stat): ?>
		<tr>

		<?php foreach ($stat as $k => $st): ?>

			<td><?php echo $st; ?></td>

			<?php endforeach; ?>
		</tr>
		<?php endforeach; ?>
	</tbody>

</table>
<?php else: ?>
<p>No activities</p>
<?php endif; ?>
		
</div>

<div class="sf_admin_list"><?php $flight = $searches['flight']?>
<h2><?php echo __('Bookings') ?></h2>


<table>
	<thead>
		<tr>
			<th colspan="2">Booking</th>
		</tr>
	</thead>
	<tr>
		<td style="width: 240px;">Number of bookings:</td>
		<td><?php echo count($bookings) ?></td>
	</tr>
	<tr>
		<td>Total booking:</td>
		<td><?php echo Utils::getPrice($bookingsSpend['total'])?></td>
	</tr>
	<tr>
		<td>Ave. spend / booking</td>
		<td><?php echo Utils::getPrice($bookingsSpend['avg_booking'])?></td>
	</tr>
	<tr>
		<td>Number of flights</td>
		<td>To define</td>
	</tr>
	<tr>
		<td>Number of hotels</td>
		<td>To define</td>
	</tr>
</table>







</div>

<h2>Top Users / session</h2>
<table>
	<thead>
		<tr>
			<?php foreach($keys as $key):?>
			<td><?php echo $key?></td>
			<?php endforeach;?>
		</tr>
	</thead>
	<tbody>
		<?php foreach($stats as $stat): ?>
		<tr>
			<?php foreach($stat as $value): ?>
			<td><?php echo $value?></td>
			<?php endforeach;?>
		</tr>
		<?php endforeach;?>
	</tbody>
	
</table>






