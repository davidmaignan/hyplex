<div class="child-age">
    <ul>
        <li class="label"><?php echo __('Child '); ?><?php echo $i; ?></li>
        <li><?php echo $form['childrenAge'][$roomNumber.'_'.$i]['age']; ?></li>
        <li><?php echo $form['childrenAge'][$roomNumber.'_'.$i]['age']->renderError(); ?></li>
    </ul>
</div>