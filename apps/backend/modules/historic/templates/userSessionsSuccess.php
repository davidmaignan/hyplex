<script	type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1.0', {'packages':['corechart', 'geochart']});
</script>

<?php include_partial('navigation')?>

<div id="mainContent">
<h2 class="title">User session</h2>

<?php if($sessions):?>

<?php $keys = array_keys($sessions[0])?>

<table class="data" style="width: 100%">
	<thead>
		<tr>
		<th>Id</th>
		<?php foreach($keys as $key):?>
			<th><?php echo $key?></th>
		<?php endforeach; ?>
		<th></th>
		</tr>
	</thead>
	<?php foreach($sessions as $key=>$session):?>
	<tr>
		<td><?php echo ++$key?> </td>
		<?php foreach($session as $value):?>
		<td><?php echo $value?></td>
		<?php endforeach;?>
		<td>
			<?php echo link_to2('Details', 'historic_daily_user_detailed', 
							array('session_id'=>$session['session_id'], array())) ?><br />
		</td>
	</tr>
	<?php endforeach;?>
</table>

<?php else: ?>
<p>No data</p>

<?php endif; ?>

</div>