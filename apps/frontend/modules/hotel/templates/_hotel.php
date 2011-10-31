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
            
        </ul>
        <ul class="hotel-temptation">
            <li class="show-map">
            <?php //echo truncate_text(strip_tags(html_entity_decode($results[0]->getDescription()), ''), 200);  ?>
            <?php echo '<a href="#" onclick="return false;" id="hotel-'.$result->id .'" class="hotel-show-map">Show map</a>' ?>
            </li>
            <li class="compare"><a href="#"><?php echo __('Compare'); ?></a><li>
            <li class="bookmark"><a href="#"><?php echo __('Bookmark'); ?></a><li>
        </ul>
    </div>
    <div class="span-4 last">
        <ul class="hotel-price-window">
            <li class="hotel-price"><?php echo format_currency($result->minPrice, sfConfig::get('app_currency')) ?></li>
            <li class="hotel-price-total">
                <?php echo  ucfirst(__('total price')). ': '.format_currency($result->minTotalPrice, sfConfig::get('app_currency')) ?>
            </li>
            <li>
                <?php
                echo link_to2(__('select'), 'hotel_detail',
                        array('slug' => Utils::slugify($result->getName())),
                        array('class' => 'hotelNameDetailAjaxLink button action blue bigger right'));
                ?>
        </ul>
    </div>
    
</div>

<?php

//echo "<pre><br /><br /><br /><br /><br /><br /><br /><br />";
//echo $result->minPrice;
//print_r($result);