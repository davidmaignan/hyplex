<div class="span-17 append-bottom last">
    <div class=" span-4">
        <?php echo image_tag($result->getBaseLinkImage(), array('class' => 'baseLinkImage')); ?>

    </div>
    <div class="span-8">
        <ul class="none">
            <li><?php echo html_entity_decode(HotelGenericObj::getStarRating($result->starRating)); ?></li>
            <li class="hotel-name">
                <?php
                echo link_to2($result->getName(), 'hotel_detail',
                        array('slug' => Utils::slugify($result->getName())),
                        array('class' => 'hotelBasketDetailPopUp  bigger bold grey0'));
                ?></li>

            <li class="hotel-address"><?php echo $result->getFullAddress(); ?></li>
            <li class="hotel-desc"><?php echo __("Location")?>: <span class="bold"><?php echo $result->location; ?></span></li>
            <li class="show-map"><a class="hotel-show-map" href="#"><?php echo __('Map') ?></a></li>
        </ul>

    </div>
    <div class="span-5 last">
        <span class="right"><?php  echo html_entity_decode($result->getFacilities()); ?></span>
    </div>
</div>
<hr class="space" />
