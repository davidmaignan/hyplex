<script	type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1.0', {'packages':['corechart', 'geochart']});
</script>

<?php include_partial('navigation')?>


<div id="mainContent">
<h2 class="title">Hourly traffic</h2>
<table class="data">
	<thead>
		<tr>
			<th>Summary</th>
			<th></th>
		</tr>
	</thead>
	<tr>
		<td>Number of visitor</td>
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
</table>


<div class="chart">
<?php
$chart2 = new PlexColumnChart('hourly_traffic', $statsHourly, 800, 300);
echo $chart2;
?>
</div>

<div style="clear:both;"></div>
<hr class="space" />

<h2>Languages</h2>
<?php 
$totalPageViewed = 0;
foreach($languages['values'] as $key=>$language){
	$totalPageViewed += $language;
}
?>

<table class="data">
	<thead>
		<tr>
			<th>Language</th>
			<th class="text-center">page viewed</th>
			<th class="text-center">percent</th>
		</tr>
	</thead>
	<?php foreach($languages['values'] as $key=>$language):?>
	<tr>
		<td><?php echo $key;?></td>
		<td class="text-center"><?php echo $language; ?></td>
		<td class="text-center"><?php echo round(($language/$totalPageViewed)*100,2)?></td>
	</tr>
	<?php endforeach;?>
</table>

<div class="chart">
<?php 
$chart = new PlexPieChart('language', $languages, 800, 200);
echo $chart;
?>
</div>

<div style="clear:both;"></div>
<hr class="space" />
<h2>Operating system</h2>
<table class="data">
	<thead>
		<tr>
			<th>OS</th>
			<th class="text-center">page viewed</th>
			<th class="text-center">percent</th>
		</tr>
	</thead>
	<?php foreach($statsOS['values'] as $key=>$os):?>
	<tr>
		<td><?php echo $key;?></td>
		<td class="text-center"><?php echo $os; ?></td>
		<td class="text-center"><?php echo round(($os/$totalPageViewed)*100,2)?></td>
	</tr>
	<?php endforeach;?>
</table>

<div class="chart">
<?php 
$chart2 = new PlexPieChart('OS', $statsOS, 800, 200);
echo $chart2;
?>
</div>

<div style="clear:both;"></div>

<hr class="space" />
<h2>Browser Vs Operating system</h2>
<table class="data">
	<thead>
		<tr>
			<th></th>
			<?php foreach($statsBrowser['values']['Macintosh'] as $key=>$browser):?>
			<th class="text-center" style="font-size: 80%;"><?php echo $key ?></th>
			<?php endforeach;?>
		</tr>
	</thead>
	<?php foreach($statsBrowser['values'] as $key=>$value):?>
	<tr>
		<td><?php echo $key;?></td>
		<?php foreach($value as $val):?>
			<td class="text-center"><?php echo $val; ?></td>
		<?php endforeach;?>
	</tr>
	<?php endforeach;?>
</table>

<div class="chart">
<?php 
$chart2 = new PlexMultiColumnChart('OS_browser', $statsBrowser,760, 400);
echo $chart2;
?>
</div>

<div style="clear:both;"></div>

<hr class="space" />
<h2>Users geolocation</h2>
<table class="data">
	<thead>
		<tr>
			<th>Country</th>
			<th class="text-center">Number of sessions</th>
		</tr>
	</thead>
	<?php foreach($geoLocation['values'] as $key=>$value):?>
	<tr>
		<td><?php echo $key;?></td>
		<td class="text-center"><?php echo $value; ?></td>
	</tr>
	<?php endforeach;?>
</table>

<div class="chart">
<?php
$ipMap = new PlexGeoChart('ipMap', $geoLocation, 760, 500);
echo $ipMap;
?>
</div>

</div>