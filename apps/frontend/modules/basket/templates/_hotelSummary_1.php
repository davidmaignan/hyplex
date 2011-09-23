<div class="span-18" style="width: 693px ;padding: 10px; border: 1px solid #97d1f4; background-color: #eff7fd">
<h4 class="append-bottom"> <?php echo __('You have selected a %s% with the following parameters:' ,
            array(  '%s%' => 'd')) ?></h4>
<table class="basket-flight">
    <tr>
        <td class="first">
            <?php echo ucfirst(__('where')); ?>
        </td>
        <td colspan="3">
            <?php echo $hotelParameters->getWhereBoxResultPage($sf_user->getCulture()) ?>
        </td>
         
    </tr>
    <tr>
        <td class="first">
            <?php echo ucfirst(__('check in')); ?>
        </td>
        <td>
            <?php echo format_date($hotelParameters->getCheckinDate(), 'P')?>
        </td>
         <td class="first">
            <?php echo ucfirst(__('check out')); ?>
        </td>
        <td>
            <?php echo format_date($hotelParameters->getCheckoutDate(), 'P') ?>
        </td>
    </tr>
    <?php foreach($hotelParameters->arRooms as $key=>$room): ?>
    <tr>
        <td class="first"><?php echo ucfirst(__('room')).' '.$key ?></td>
        <td colspan="3">
        <?php echo format_number_choice(
        '[0]|[1]1 adult, |(1,+Inf]%1% adults, ', array('%1%' => $room['number_adults']), $room['number_adults']) ?>
        <?php echo format_number_choice(
            '[0]|[1]1 child |(1,+Inf]%1% children ', array('%1%' => $room['number_children']), $room['number_children']) ?>

        <?php if($room['number_children']>0):?> 
        <?php echo __('aged') ?> (
        <?php foreach($room['children_age'] as $k=>$child):?>
           <?php echo $child['age'] ?>
            <?php echo (($k < $room['number_children']-1)? ',': ''); ?>
        <?php endforeach; ?>
            )
        <?php endif; ?>

        </td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="4" style="background-color: none; border: none;">
            <a href="<?php echo url_for('basket_remove',array('type'=>'hotel')) ?>" class="delete left center"><?php echo ucfirst(__('remove hotel')) ?></a>
            <a href="<?php echo url_for('hotel_modified',array('filename'=>PlexBasket::getInstance()->getHotelFilename())) ?>"
               class="select basket-flight-link right center">
                    <?php echo ucfirst(__('change hotel')) ?>
            </a>
            <a href="<?php echo url_for('hotel_modified_search',array('filename'=>PlexBasket::getInstance()->getHotelFilename())) ?>"
                class="select basket-flight-link right center">
                <?php echo ucfirst(__('modify search')) ?>
            </a>
        </td>
    </tr>
</table>

</div>
<hr class="space3" />