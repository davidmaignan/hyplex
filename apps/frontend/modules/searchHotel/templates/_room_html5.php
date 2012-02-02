<table class="form">
    <tr>
        <td class="span-1 bottom bold"><?php echo __('Room') ?></td>
        <td class="span-2">
            <?php echo $f['number_adults']->renderLabel(); ?><br>
            <?php echo $f['number_adults']->render(array('class' => 'span-2')); ?>
        </td>
        <td class="span-2">
            <?php echo $f['number_children']->renderLabel(); ?><br>
            <?php echo $f['number_children']->render(array('class' => 'span-2 hotel-children-age')); ?>
        </td>
        <td class="span-2 bottom">
            <?php if (($num) > 1): ?>
                <a href="#" class="remove right" onclick="do_delete(this);">Remove</a>
            <?php endif; ?>
        </td>
    </tr>
</table>



<?php

//Check if one of the childrenAge form is related to this room
$class = 'hide';
foreach ($form['childrenAge'] as $k => $f){
    if ($k[0] == $key){
        $class = '';
        break;
    }
}

?>


<div class="info <?php echo $class ?>">
    <p class="noMargin">Please provide ages of children at the time of travel.</p>
    <div class="child-age-container" >

        <?php if (isset($key) && isset($form)): ?>

            <?php foreach ($form['childrenAge'] as $k => $f): ?>

                <?php if ($k[0] == $key): ?>
                    <?php include_partial('searchHotel/addChildAge', array('form' => $form, 'roomNumber' => $k[0], 'i' => $k[2])) ?>
                <?php endif; ?>
            <?php endforeach; ?>

        <?php endif; ?>


    </div>

    <div style="clear: both;"></div>

</div>