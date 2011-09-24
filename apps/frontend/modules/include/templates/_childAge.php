<?php if(isset($age)): ?>
<?php $class = !(is_null($age))? '':'none'; ?>
<?php //var_dump($age); ?>

<div class="child-age <?php echo $class; ?>" id="room-<?php echo $num ?>-child-<?php echo $i; ?>">
    <?php $values = range(0, 17); ?>
    <label for="room_<?php echo $num?>_child_<?php echo $i; ?>">Child <?php echo $i; ?></label>
    <select name="search_hotel[newRooms][<?php echo $num?>][child_age][<?php echo $i; ?>]" >
        <?php foreach ($values as $value) : ?>
        <?php //echo '<option>' . $value . '</option>'; ?>
        <?php echo ($value == (int) $age) ? '<option selected="selected">' . $value . '</option>' : '<option>' . $value . '</option>'; ?>
        <?php endforeach; ?>
    </select>
</div>

<?php else: ?>

<div class="child-age none" id="room-<?php echo $num ?>-child-<?php echo $i; ?>">
    <?php $values = range(0, 17); ?>
    <label for="room_<?php echo $num?>_child_<?php echo $i; ?>">Child <?php echo $i; ?></label>
    <select name="search_hotel[newRooms][<?php echo $num?>][child_age][<?php echo $i; ?>]" >
        <?php foreach ($values as $value) : ?>
        <?php echo '<option>' . $value . '</option>'; ?>
        <?php endforeach; ?>
    </select>
</div>


<?php endif; ?>