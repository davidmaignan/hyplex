<ul class="none">
    <li class="color2 bold biggest"><?php echo Utils::getPrice($result->TotalPrice) ?></li>
    <li class="grey1"><?php echo Utils::getPrice($result->TotalPrice) ?> / <?php echo __('person') ?></li>
    <li class="prepend-top2"><?php
        echo link_to2(__('select'), 'flight_selected', array(
            'filename' => $filename, 'uniqueReferenceId' => $result->UniqueReferenceId), array(
            'class' => 'button action big blue'
        ))
    ?>
    </li>
</ul>