<div class="span-18 append-bottom hotel-list-box">
    <div class=" span-4">
        <?php echo image_tag($result->getBaseLinkImage(), array('class' => 'baseLinkImage')); ?>

    </div>
    <div class="span-10 last">
        <ul class="hotel-list">
            <li><?php echo html_entity_decode(HotelGenericObj::getStarRating($result->starRating)); ?></li>
            <li class="hotel-name">
                <?php
                echo link_to2($result->getName(), 'hotel_detail',
                        array('slug' => Utils::slugify($result->getName())),
                        array('class' => 'hotelNameDetailAjaxLink'));
                ?></li>

            <li class="hotel-address"><?php echo $result->getAddress(); ?></li>
            <li class="hotel-desc">Location: <span class="bold"><?php echo $result->location; ?></span></li>
            <li><?php  echo html_entity_decode($result->getFacilities()); ?></li>
        </ul>
    </div>
</div>
<hr class="space" />