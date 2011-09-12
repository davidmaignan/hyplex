<div class="home-icon-left">
    <a href="<?php echo url_for('search_flight') ?>"><?php echo image_tag('iphone/icon_flight.png', array('alt' => 'Flight')); ?></a>
    <h3><?php echo __('Search a flight'); ?></h3>
</div>
<div class="home-icon-right">
    <a href="#"><?php echo image_tag('iphone/icon_hotel.png', array('alt' => 'Hotel')); ?></a>
    <h3><?php echo __('Search a hotel'); ?></h3>
</div>
<div class="home-icon-left">
    <a href="#"><?php echo image_tag('iphone/icon_car.png', array('alt' => 'Car')); ?></a>
    <h3><?php echo __('Search a car'); ?></h3>
</div>
<div class="home-icon-right">
    <a href="#"><?php echo image_tag('iphone/icon_package.png', array('alt' => 'Package')); ?></a>
    <h3><?php echo __('Search a package'); ?></h3>
</div>
<p><?php echo __('A short message like a phone number for call center or latest promotion or tweet'); ?></p>
<div id="change_culture">
    <form action="<?php echo url_for('change_language') ?>">
        <?php echo $form ?><input type="submit" value="ok" />
    </form>
</div>