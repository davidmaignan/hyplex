<div id="top-header">
    <div class="container">
        <div class="span-13">
        <ul>
            <li><a href="#"><?php echo __('News') ?></a></li>
            <li><a href="<?php echo url_for('@feature_deals') ?>"><?php echo __('Feature deals') ?></a></li>
            <li><a href="#"><?php echo __('Top destinations') ?></a></li>
            <li><a href="<?php echo url_for('@vacation_interest') ?>"><?php echo __('Vacations by interest') ?></a></li>
            <li><a href="<?php echo url_for('@reset') ?>"><?php echo __('reset') ?></a></li>
        </ul>
        </div>
        <div class="span-2">
            <?php include_partial('global/language'); ?>
        </div>
        <div class="span-3">
            <?php include_partial('global/currency'); ?>
        </div>
        <div class="span-5 right">
           <?php include_partial('global/connection') ?>
        </div>
    </div>
    <?php //echo image_tag('generic/top-header.jpg'); ?>
</div>