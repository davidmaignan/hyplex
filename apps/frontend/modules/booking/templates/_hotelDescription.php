<div class="span-18 append-bottom">
        <ul>
            <li class="bigger"><?php echo $result->getName()?> <?php echo html_entity_decode(HotelGenericObj::getStarRating($result->starRating)); ?></li>
            <li class="smaller"><?php echo $result->getFullAddress(); ?></li>
            <li class="smaller">Number of Rooms: 2 - Number of nights: 4 - Check in: 2010/1010 | Checkout: yyyy</li>
        </ul>
</div>
<hr class="space" />

