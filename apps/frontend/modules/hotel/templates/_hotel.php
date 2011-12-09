<div class="span-17 append-bottom hotel-list-box last">
    <div class=" span-4">
        <?php echo image_tag($result->getBaseLinkImage(), array('class' => 'baseLinkImage')); ?>
    </div>
    <div class="span-9">
        <ul class="none">
            <li><?php echo html_entity_decode(HotelGenericObj::getStarRating($result->starRating)); ?></li>
            <li>
                <?php
                echo link_to2($result->getName(), 'hotel_detail', 
                        array('slug' => Utils::slugify($result->getName())), 
                        array('class' => 'hotelNameDetailAjaxLink bigger bold grey0'));
                ?>
            </li>
            <li><?php echo $result->getAddress(); ?></li>
            <li>Location: <a class="bold" href="#"><?php echo $result->location; ?></a></li>
            <li class="prepend-top1">
                <ul class="inline hotel-box-links">
                    <li>
                        <a href="#" onclick="return false;"
                           id="hotel-<?php echo $result->id ?>" class="hotel-show-map"><?php echo __('Map') ?></a>
                    </li>
                    <li><a href="#" class=""><?php echo __('Compare'); ?></a></li>
                    <li><a href="#" class=""><?php echo __('Bookmark'); ?></a><li>
                </ul>
            </li>
        </ul>

    </div>
    <div class="span-4 last text-right">
        <ul class="none">
            <li class="bold biggest2"><?php echo Utils::getPrice($result->minPrice) ?></li>
            <li class="grey1 small"><?php echo __('total price') . ': ' . Utils::getPrice($result->minTotalPrice) ?></li>
            <li class="">
                <?php
                    echo link_to2(__('select'), 'hotel_detail', 
                            array('slug' => Utils::slugify($result->getName())), 
                            array('class' => 'hotelNameDetailAjaxLink button action blue bigger'));
                ?>
            </li>
        </ul>
    </div>
</div>