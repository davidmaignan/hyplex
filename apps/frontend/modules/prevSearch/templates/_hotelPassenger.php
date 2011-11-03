<ul>
    <?php foreach ($hotelParameters->arRooms as $key => $room): ?>
        <li>

        <?php echo __('room') ?>
        <?php echo $key + 1 ?>:
        <?php echo Utils::getAdultChildInfantString(
                $room['number_adults'],
                $room['number_children'],
                0);
        ?>
    </li>
    <?php endforeach; ?>
</ul>
