<div id="room-container-<?php echo $num ?>" class="room-container">
    <table id="room-1" class="hotel-form-table">
        <tr class="topPadding">
            <td class="label" style="vertical-align: middle; width: 55px;">Room:</td>
            <td style="vertical-align: middle;">
                <ul>
                    <li><?php echo $form['newRooms'][$num]['number_adults']->renderLabel(); ?></li>
                    <li><?php echo $form['newRooms'][$num]['number_adults']; ?></li>
                </ul>
            </td>
            <td style="vertical-align: top; padding-left: 10px;">
                <ul>
                    <li><?php echo $form['newRooms'][$num]['number_children']->renderLabel(); ?></li>
                    <li><?php echo $form['newRooms'][$num]['number_children']; ?></li>
                </ul>
            </td>
            <td style="vertical-align: middle; width: 60px;">
                <a href="#" id="room-delete-<?php echo $num ?>" onclick="do_delete(this);" class="remove-small"><?php echo __('remove'); ?></a>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <div id="child-container-<?php echo $num; ?>"></div>
            </td>
            
        </tr>
    </table>
</div>