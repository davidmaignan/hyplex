<div id="room-container-<?php echo $num ?>" class="room-container bordered">
    <table id="room-1" class="hotel-form-table">
        <tr>
            <td style="vertical-align: top; padding-top: 25px; width: 50px;" class="label">Room:</td>
            <td style="vertical-align: top; width: 80px;">
                <ul>
                    <li><?php echo $form['newRooms'][$num]['number_adults']->renderLabel(); ?></li>
                    <li><?php echo $form['newRooms'][$num]['number_adults'] ?></li>
                </ul>
            </td>
            <td style="vertical-align: top; padding-left: 10px;">
                <ul>
                    <li><?php echo $form['newRooms'][$num]['number_children']->renderLabel(); ?></li>
                    <li><?php echo $form['newRooms'][$num]['number_children']->render(array('class'=>'hotel-children-age medium')); ?></li>
                </ul>
            </td>
            <td style="width: 250px;">
                <div id="child-container-<?php echo $num; ?>"></div>
            </td>
            <td style="vertical-align: top; padding-top: 35px; width: 70px;">
                <a href="#" id="room-delete-<?php echo $num ?>" onclick="do_delete(this);" class="remove-small"><?php echo __('remove'); ?></a>
            </td>
             
        </tr>
        <tr>
            
        </tr>
    </table>
</div>