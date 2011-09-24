<div class="hotel-room">
    <table class="rates">
        <thead>
            <tr>
                <th>Room type</th>
                <?php foreach ($hotel->getRoomIds() as $value): ?>
                    <th style="width: 140px; text-align: center;"><?php echo $value; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <?php $class = ''; ?>
        <?php $colspan = count($hotel->getRoomIds())+1; ?>
        <?php $i = 0; ?>
        <?php $firstRate = true; ?>
        <?php foreach ($hotel->arRoomsType as $key => $roomType): ?>

        <?php include_partial('roomType', array('roomType' => $roomType, 'i' => $i, 'class' => $class, 'key' => $key, 'colspan'=>$colspan)) ?>

        <?php foreach ($roomType->arRates as $k => $rate): ?>
        <?php include_partial('rate', array('rate' => $rate, 'firstRate' => $firstRate, 'k' => $k, 'i' => $i, 'class' => $class, 'hotel' => $hotel)) ?>
        <?php $firstRate = false; ?>
        <?php endforeach; ?>

        <?php $class = 'none'; ?>
        <?php $i++; ?>
        <?php endforeach; ?>

        <tfoot>
            <tr>
                <td colspan="<?php echo $colspan ?>"><input type="submit" value="Book Now" /></td>
            </tr>
        </tfoot>
    </table>
</div>
