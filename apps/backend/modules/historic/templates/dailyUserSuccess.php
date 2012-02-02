<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1.0', {'packages':['corechart', 'geochart']});
</script>

<?php include_partial('navigation')?>


<div id="mainContent">
<h2 class="title">Top users</h2>

<?php if($stats):?>

<?php $keys = array_keys($stats[0])?>

<table class="data" style="width: 100%">
	<thead>
		<tr>
		<th>Rank</th>
		<?php foreach($keys as $key):?>
			<th><?php echo $key?></th>
		<?php endforeach; ?>
		<th></th>
		</tr>
	</thead>
	<?php foreach($stats as $key=>$stat):?>
	<tr>
		<td><?php echo $key?> </td>
		<?php foreach($stat as $value):?>
		<td><?php echo $value?></td>
		<?php endforeach;?>
		<td>
			<?php echo link_to2('Details', 'historic_daily_user_detailed', 
							array('session_id'=>$stat['session_id'], array())) ?><br />
			<?php echo link_to('Prev Sessions', 'user_session', array('folder'=>$stat['folder']))?>
		</td>
	</tr>
	<?php endforeach;?>
</table>

<?php else: ?>
<p>No data</p>

<?php endif; ?>

</div>

<div id="user-traffic"></div>
