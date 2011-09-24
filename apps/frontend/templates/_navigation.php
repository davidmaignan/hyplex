<ul id="main-nav">
    <li><a href="<?php echo url_for('@homepage') ?>"><?php echo __('Home'); ?></a></li>
    <li><a href="<?php echo url_for('search_flight') ?>"><?php echo __('Flight'); ?></a></li>
    <li><a href="<?php echo url_for('search_hotel') ?>"><?php echo __('Hotel'); ?></a></li>
    <li><a href="#"><?php echo __('Car'); ?></a></li>
    <li><a href="<?php //echo url_for('package') ?>"><?php echo __('Package'); ?></a></li>
    <li><a href="#"><?php echo __('Activities');?></a></li>
    <li class="right"><a href="<?php echo url_for('@basket') ?>"><?php echo __('my basket');?></a></li>
</ul>
