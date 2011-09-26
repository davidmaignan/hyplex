<ul>
    <?php foreach ($hotelParameters->arRooms as $key => $room): ?>
        <li>

        <?php echo ucfirst(__('room')) ?>
        <?php echo $key + 1 ?>:
        <?php echo format_number_choice(
                '[0]|[1]1 adult, |(1,+Inf]%1% adults, ', array('%1%' => $room['number_adults']), $room['number_adults']) ?>
        <?php echo format_number_choice(
                '[0]|[1]1 child |(1,+Inf]%1% children ', array('%1%' => $room['number_children']), $room['number_children']) ?>

    </li>
    <?php endforeach; ?>
</ul>
