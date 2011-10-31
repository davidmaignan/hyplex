<div class="span-18 append-bottom hotel-list-box">
    <div class=" span-4">
        <?php echo image_tag($result->getBaseLinkImage(), array('class' => 'baseLinkImage')); ?>

    </div>
    <div class="span-8">
        <ul class="hotel-list">
            <li><?php echo html_entity_decode(HotelGenericObj::getStarRating($result->starRating)); ?></li>
            <li class="hotel-name">
                <?php
                echo link_to2($result->getName(), 'hotel_detail',
                        array('slug' => Utils::slugify($result->getName())),
                        array('class' => 'hotelNameDetailAjaxLink'));
                ?></li>

            <li class="hotel-address"><?php echo $result->getFullAddress(); ?></li>
            <li class="hotel-desc">Location: <span class="bold"><?php echo $result->location; ?></span></li>
        </ul>
        <ul class="hotel-temptation">
            <li class="prepend-top show-map"><a class="hotel-show-map" href="#">Map</a></li>
        </ul>
    </div>
    <div class="span-6 last" style="width: 218px;">
        <span class="right"><?php  echo html_entity_decode($result->getFacilities()); ?></span>
    </div>
</div>
<hr class="space" />

<style>
    .hotel-list-box{
        border: none;
}
</style>