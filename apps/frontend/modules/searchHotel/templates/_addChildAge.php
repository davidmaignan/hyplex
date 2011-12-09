<div class="child-age">
    <ul class="none">
        <li class="label"><?php echo __('child'); ?> <?php echo $i; ?></li>
        <li><?php echo $form['childrenAge'][$roomNumber.'_'.$i]['age']; ?></li>
        <li><?php echo $form['childrenAge'][$roomNumber.'_'.$i]['age']->renderError(); ?></li>
    </ul>
</div>
