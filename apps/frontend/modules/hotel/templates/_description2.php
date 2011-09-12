<?php

$imageSize = sfConfig::get('app_hotel_thumb');
$imageSizeComputed = "{$imageSize['width']}x{$imageSize['height']}";

?>

<div class="imageContainer" style="position: relative;">
    <?php echo image_tag($hotel->getBaseLinkImage(),array('class'=>'baseLinkImage')); ?>
    <a href="#" onclick="return false;" class="hotel-gallery none" style="position: absolute; left: 0;">
    <?php echo image_tag('generic/gallery_hover.png', array('size'=>$imageSizeComputed)); ?>
    </a>
</div>
<div class="hotel-facilities" style="float: right; width: 140px; text-align: right;">
    <?php echo html_entity_decode($hotel->getFacilities()); ?><br />
    <?php echo $hotel->location; ?>
</div>
<p style="margin-bottom: 6px;"><?php echo html_entity_decode(HotelGenericObj::getStarRating($hotel->starRating)); ?></p>
<h2 style="margin-bottom: 6px; font-size: 120%; font-weight: normal; font-family: 'Times';"><?php echo $hotel->getName(); ?></h2>
<p class="small" style="color: #888; margin-bottom: 6px;"><?php echo $hotel->getAddress(); ?></p>
<p class="small2 hotel-desc" style="margin:10px;"><?php echo truncate_text(strip_tags(html_entity_decode($hotel->getDescription()), ''), 260); ?></p>
