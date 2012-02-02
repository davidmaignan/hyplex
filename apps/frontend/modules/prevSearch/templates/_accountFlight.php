<tr>
		<td>
			<?php echo format_date($prevSearch['date'], 'd')?>
		</td>
		<td>
			<?php echo $prevSearch['parameters']->getOriginFormatResultPage($sf_user->getCulture()); ?><br />
			<?php echo $prevSearch['parameters']->getDestinationFormatResultPage($sf_user->getCulture()); ?>
		</td>
		<td>
			<?php echo format_date($prevSearch['parameters']->getDepartDate(), 'p')?><br />
			<?php echo format_date($prevSearch['parameters']->getReturnDate(), 'p')?>
		</td>
		<td>
			<?php echo Utils::getAdultChildInfantString(
                    $prevSearch['parameters']->getAdults(),
                    $prevSearch['parameters']->getChildren(),
                    $prevSearch['parameters']->getInfants()); ?>
		</td>
		<td>
			<?php foreach($prevSearch['filterDatas']['stop'] as $stop=>$price): ?>
			<?php echo $stop.' '.__('stop').': '.Utils::getPrice($price) ?><br />
			<?php endforeach;?>
		</td>
		<td class="text-center">
		<?php $route = ($prevSearch['type'] == 'flightReturn' || $prevSearch['type'] == 'flightOneway')? 'flight_modified_search':'hotel_modified_search'?>
                    <a href="<?php echo url_for($route,array('filename'=>$prevSearch['file'])) ?>"
                        class="">
                        <?php echo __('modify') ?>
                    </a>

                    <?php $route = ($prevSearch['type'] == 'flightReturn' || $prevSearch['type'] == 'flightOneway')? 'search_flight_again':'search_hotel_again'?>
                    <br />
                    <a href="<?php echo url_for($route,array('filename'=>$prevSearch['file'])) ?>"
                       class="button action blue smallest" >
                            <?php echo __('search') ?>
		</td>
	</tr>