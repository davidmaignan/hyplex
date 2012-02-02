<div class="span-17 last" id="hotel-rooms-content">
    <h2 class="fontface blue1 title"><?php echo __('Rooms & rates') ?></h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <table class="rates">
        <thead>
            <tr>
                <th class="big">Room type</th>
                <?php foreach ($hotel->getRoomIds() as $value): ?>
                    <th class="span-3 big"><?php echo $value; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php $class = ''; ?>
            <?php $colspan = count($hotel->getRoomIds()) + 1; ?>
            <?php $i = 0; ?>
            <?php $firstRate = true; ?>

            <?php foreach ($hotel->arRoomsType as $key => $roomType): ?>

                <?php include_partial('roomType', array('roomType' => $roomType, 'i' => $i, 'class' => $class, 'key' => $key, 'colspan' => $colspan)) ?>

                <?php foreach ($roomType->arRates as $k => $rate): ?>
                    <?php include_partial('rate', array('rate' => $rate, 'firstRate' => $firstRate, 'k' => $k, 'i' => $i, 'class' => $class, 'hotel' => $hotel)) ?>
                    <?php $firstRate = false; ?>
                <?php endforeach; ?>

                <?php $class = 'none'; ?>
                <?php $i++; ?>
            <?php endforeach; ?>  
        </tbody>
    </table>
</div>