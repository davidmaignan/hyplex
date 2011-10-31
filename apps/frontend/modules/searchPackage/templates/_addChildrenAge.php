<?php for($i=1;$i<=$num;$i++): ?>
<div class="child-age">
    <ul>
        <li class="label"><?php echo __('Child '); ?><?php echo $i; ?></li>
        <li><?php echo $form['childrenAge'][$roomNumber.'_'.$i]['age']->render(array('class'=>'package-child-age')); ?></li>
        <li><?php echo $form['childrenAge'][$roomNumber.'_'.$i]['age']->renderError(); ?></li>
    </ul>
</div>
<?php endfor; ?>
<div style="clear:both;"></div>
