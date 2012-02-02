<tr>
	<td><?php echo format_date($prevSearch['date'], 'd')?></td>
	<td>
		<?php echo $prevSearch['parameters']->getOriginDestination($sf_user->getCulture()) ;?>
	</td>
	<td>
		<?php echo $prevSearch['parameters']->getDates(); ?>
	</td>
	<td>
	<ul class="none">
		<?php foreach ($prevSearch['parameters']->arRooms as $key => $room): ?>
        <li>

        <?php echo __('room') ?>
        <?php echo $key + 1 ?>:
        <?php echo Utils::getAdultChildInfantString(
                $room['number_adults'],
                $room['number_children'],
                0);
        ?>
    </li>
    <?php endforeach; ?>
    </ul>
	</td>
	<td>
		<?php foreach($prevSearch['filterDatas']['prices'] as $key=>$price): ?>
		<?php echo __($key).': '.Utils::getPrice($price)?><br />
		<?php endforeach;?>
	</td>
	<td class="text-center">
	 <?php $route = 'hotel_modified_search'?>
                    <a href="<?php echo url_for($route,array('filename'=> $prevSearch['file'])) ?>"
                        class="">
                        <?php echo __('modify') ?>
                    </a>

                    <?php $route = 'search_hotel_again'?>
                    <br />
                    <a href="<?php echo url_for($route,array('filename'=> $prevSearch['file'])) ?>"
                       class="button action blue smallest" >
                            <?php echo __('search') ?>
                    </a>
	</td>
</tr>