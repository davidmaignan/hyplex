<?php include_partial('account/navigationLeft') ?>

<div class="span-18 last prepend-1">

<h2>My Bookings</h2>

<?php if(count($bookings)):?>
<table class="data">
<thead>
<tr>
<th>Id</th>
<th>Infos</th>
<th>Date</th>
</tr>
</thead>

<?php foreach($bookings as $booking):?>
<tr>

<td><?php echo $booking['booking_id']?></td>
<td><?php echo html_entity_decode($booking['object'])?></td>
<td><?php echo $booking['created_at']?></td>


</tr>
<?php endforeach;?>
</table>
<?php else:?>
<p>Can't find your booking? It may be that your booking is not associated with this account. </p>
<?php endif;?>
</div>

<style type="text/css">
    
 
    
</style>