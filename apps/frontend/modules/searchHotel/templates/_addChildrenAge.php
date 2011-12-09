<?php for($i=1;$i<=$num;$i++): ?>
<div class="child-age">
    <ul class="none">
        <li class="label"><?php echo __('child'); ?> <?php echo $i; ?></li>
        <li><?php echo $form['childrenAge'][$roomNumber.'_'.$i]['age']->render(array('class'=>'hotel-child-age')); ?></li>
        <li><?php echo $form['childrenAge'][$roomNumber.'_'.$i]['age']->renderError(); ?></li>
    </ul>
</div>
<?php endfor; ?>
<div style="clear:both;"></div>
