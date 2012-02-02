<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1.0', {'packages':['corechart', 'geochart']});
</script>

<?php include_partial('navigation')?>



<div id="mainContent">


<?php //var_dump($historics);?>

<div id="user-details">


<table id="user-details" class="data">
<?php foreach($historics['infos'] as $key=>$info):?>
	<tr>
	<td class="key"><?php echo $key ?></td>
	<td><?php echo $info?></td>
	</tr>
 <?php endforeach; ?>
</table>

<table id="" class="data">
<?php foreach($historics['summary'] as $key=>$info):?>
	<tr>
	<td class="key"><?php echo $key ?></td>
	<td><?php echo $info?></td>
	</tr>
 <?php endforeach; ?>
</table>

<table id="" class="data">
<?php foreach($historics['searches'] as $key=>$info):?>
	<tr>
	<td class="key"><?php echo $key ?></td>
	<td><?php echo $info?></td>
	</tr>
 <?php endforeach; ?>
</table>

<?php unset($historics['infos']);?>
<?php unset($historics['summary']);?>
<?php unset($historics['searches']);?>
</div>

<div style="clear: both;"></div>
<hr class="space" />

<div class="legend-container">
	<div class="legend blue"></div>
	Search
</div>
<div class="legend-container">
	<div class="legend yellow"></div>
	Result page
</div>
<div class="legend-container">
	<div class="legend green"></div>
	Add to basket
</div>

<div class="legend-container">
	<div class="legend red"></div>
	Remove from basket
</div>

<div class="legend-container">
	<div class="legend"></div>
	Booking done
</div>

<div style="clear: both;"></div>

<?php
	$keys = array_keys($historics[0]);
	unset($keys[0]);
?>

<table class="data" style="width: 100%; margin-top: 10px;">
	<thead>
		<tr>
		<?php foreach($keys as $key): ?>
		<th><?php echo $key ?></th>
		<?php endforeach;?>
		</tr>
		<tbody>
			<?php foreach($historics as $historic):?>
			<tr class="<?php echo $historic['color'];?>">
			<?php foreach($historic as $key=>$line):?>
			<?php if($key != 'color'):?>
			<td><?php echo $line?></td>
			<?php endif;?>
			<?php endforeach;?>
			</tr>
			<?php endforeach;?>
		</tbody>
	</thead>


</table>
</div>
