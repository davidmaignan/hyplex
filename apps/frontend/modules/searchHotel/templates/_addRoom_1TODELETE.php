<div id="room-container-<?php echo $num ?>" class="room-container bordered">
    <table id="room-1" class="hotel-form-table">
        <tr class="topPadding">
            <td class="label" style="padding: 30px 10px 0 0;">Room:</td>
            <td>
                <ul>
                    <li><?php echo $form['newRooms'][$num]['number_adults']->renderLabel(); ?></li>
                    <li><?php echo $form['newRooms'][$num]['number_adults']; ?></li>
                </ul>
            </td>
            <td style="padding-left: 10px;">
                <ul>
                    <li><?php echo $form['newRooms'][$num]['number_children']->renderLabel(); ?></li>
                    <li><?php echo $form['newRooms'][$num]['number_children']->render(array('class'=>'hotel-children-age medium')); ?></li>
                </ul>
            </td>
            <td style="vertical-align: middle; width: 70px;">
                <a href="#" id="room-delete-<?php echo $num ?>" onclick="do_delete(this);" class="remove-small"><?php echo __('remove'); ?></a>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                
            </td>
            
        </tr>
    </table>
</div>
<div id="child-container-<?php echo $num; ?>" class="child-container"></div>