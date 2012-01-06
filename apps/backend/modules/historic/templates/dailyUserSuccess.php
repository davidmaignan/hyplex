<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1.0', {'packages':['corechart', 'geochart']});
</script>

<?php include_partial('navigation')?>


<div id="mainContent">
<h2 class="title">Top users</h2>

<?php $keys = array_keys($stats[0])?>

<table class="data" style="width: 100%">
	<thead>
		<tr>
		<th></th>
		<?php foreach($keys as $key):?>
			<th><?php echo $key?></th>
		<?php endforeach; ?>
		</tr>
	</thead>
	<?php foreach($stats as $key=>$stat):?>
	<tr>
		<td><?php echo $key?> </td>
		<?php foreach($stat as $value):?>
		<td><?php echo $value?></td>
		<?php endforeach;?>
	</tr>
	<?php endforeach;?>
</table>

<div id="user-traffic"></div>
