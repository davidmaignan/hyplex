<div class="flight-box-price color2">
    <ul>
        <li class="price"><?php echo Utils::getPrice($result->TotalPrice) ?></li>
        <li class="pricePerPerson"><?php echo Utils::getPrice($result->TotalPrice) ?> / person</li>
        <li class="">
        <?php echo link_to2(__('select'), 'flight_selected',
                array(
                    'filename'=>$filename, 'uniqueReferenceId'=>$result->UniqueReferenceId), array(
                    'class'=>'button action smaller blue'
                )) ?>
        </li>
    </ul>
</div>