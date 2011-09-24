 <?php for($i=0;$i<3;$i++): ?>

                <div id="hotel-thumb-<?php echo $results[$i]->id ?>" class="bg-1 hotel-thumb selected">
                <?php echo image_tag($results[$i]->getBaseLinkImage()); ?>
                <ul class="hotel-info">
                <li class="hotel-name">
                    <?php
                    echo link_to2($results[$i]->getName(), 'hotel_detail',
                            array('slug' => Utils::slugify($results[$i]->getName())),
                            array('class' => 'hotelNameDetailAjaxLink2',
                                  'onclick'=> 'return false;'));
                    ?></li>
                    <li class="hotel-rating"><?php echo html_entity_decode(HotelGenericObj::getStarRating($results[$i]->starRating)); ?></li>
                    <li><?php echo $results[$i]->getNumberRates() ?> rates available</li>
                    <li><?php echo __('starting at: ')?>
                        <span class="color2 bold"><?php echo format_currency($results[$i]->minPrice,sfConfig::get('app_currency')); ?></span>
                    </li>

                </ul>
                    <!--<div class="img-selected">Selected</div>-->
            </div>


            <?php endfor; ?><?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
