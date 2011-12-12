<h2 class="title2"><?php echo __('Previous searches'); ?></h2>
<div>
    <table class="style2">
        <thead>
            <tr>
                <th>Dest/Pass</th>
                <th>Dates</th>
                <th class="center">Actions</th>
            </tr>
        </thead>
        <?php $i=0; ?>
        <?php while($i<= 5 && $i<count($prevSearches)): ?>
            <?php $parameters = ($prevSearches[$i]['parameters']); ?>
            <tr>
                <td>
                    <ul class="none">
                        <li><?php //echo $parameters->getType() ?>
                            
                            <?php echo link_to2(html_entity_decode($parameters->getOriginDestination($sf_user->getCulture())),
                                                'previous_search',
                                                array('filename'=>$prevSearches[$i]['file'])); ?>
                            
                        </li>
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
                <td>
                    <?php echo $parameters->getDates(); ?>
                </td>
                <td class="center">
                    <?php $route = ($prevSearches[$i]['type'] == 'flightReturn' || $prevSearches[$i]['type'] == 'flightOneway')? 'flight_modified_search':'hotel_modified_search'?>
                    <a href="<?php echo url_for($route,array('filename'=>$prevSearches[$i]['file'])) ?>"
                        class="">
                        <?php echo __('modify') ?>
                    </a>

                    <?php $route = ($prevSearches[$i]['type'] == 'flightReturn' || $prevSearches[$i]['type'] == 'flightOneway')? 'search_flight_again':'search_hotel_again'?>
                    <br />
                    <a href="<?php echo url_for($route,array('filename'=>$prevSearches[$i]['file'])) ?>"
                       class="button action blue smallest" >
                            <?php echo __('search') ?>
                    </a>
                </td>
            </tr>
        <?php $i++;?>
        <?php endwhile; ?>
    </table>
</div>



