<h2 class="title2"><?php echo __('Your previous searches'); ?></h2>
<div>
    <table class="prev-searches">
        <?php $i=0; ?>
        <?php while($i<= 5 && $i<count($prevSearches)): ?>
            <?php $parameters = ($prevSearches[$i]['parameters']); ?>
            <tr class="<?php echo (fmod($i, 2) == 0) ? 'bg-1' : 'bg-2' ?>">
                <td>
                    <ul class="prevSearch-list-index" style="line-height: 14px;">
                        <li><?php echo $parameters->getTypeRenamed() ?> -
                            <?php echo link_to2(html_entity_decode($parameters->getOriginDestination($sf_user->getCulture())),
                                                'previous_search',
                                                array('filename'=>$prevSearches[$i]['file'])); ?>
                            <a href="#"><?php //echo $parameters->getOriginDestination($sf_user->getCulture()); ?></a>
                        </li>
                        <li class="italic grey1"><?php echo $parameters->getDates(); ?><?php echo $parameters->getPassengers(); ?></li>
                        <li>
                            <?php if($prevSearches[$i]['type'] == 'flightReturn'):?>
                            <?php include_partial('prevSearch/flightPassenger', array('flightParameters'=>$parameters)); ?>
                            <?php elseif($prevSearches[$i]['type'] == 'hotelSimple'): ?>
                            <?php include_partial('prevSearch/hotelPassenger', array('hotelParameters'=>$parameters)); ?>
                            <?php elseif($prevSearches[$i]['type'] == 'flightSimple'): ?>
                            <?php include_partial('prevSearch/flightPassenger', array('flightParameters'=>$parameters)); ?>
                            <?php endif; ?>
                        </li>
                    </ul>

                </td>
                <td style="text-align: center;">
                    <?php $route = ($prevSearches[$i]['type'] == 'flightReturn' || $prevSearches[$i]['type'] == 'flightOneway')? 'flight_modified_search':'hotel_modified_search'?>
                    <a href="<?php echo url_for($route,array('filename'=>$prevSearches[$i]['file'])) ?>"
                        class="">
                        <?php echo __('modify') ?>
                    </a>

                    <?php $route = ($prevSearches[$i]['type'] == 'flightReturn' || $prevSearches[$i]['type'] == 'flightOneway')? 'search_flight_again':'search_hotel_again'?>
                    <br /><br />
                    <a href="<?php echo url_for($route,array('filename'=>$prevSearches[$i]['file'])) ?>"
                       class="button action blue" style="font-size: 70%;">
                            <?php echo __('search') ?>
                    </a>
                </td>
            </tr>
        <?php $i++;?>
        <?php endwhile; ?>
    </table>
</div>



