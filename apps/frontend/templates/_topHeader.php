<div id="top-header">
    <div class="container">
        <div class="span-13">
        <ul>
            <li><a href="#"><?php echo ucfirst(__('news')) ?></a></li>
            <li><a href="#"><?php echo ucfirst(__('feature deals')) ?></a></li>
            <li><a href="#"><?php echo ucfirst(__('top destinations')) ?></a></li>
            <li><a href="#"><?php echo ucfirst(__('vacations by interest')) ?></a></li>
        </ul>
        </div>
        <div class="span-2">
            <?php include_partial('global/language'); ?>
        </div>
        <div class="span-3">
            <?php include_partial('global/currency'); ?>
        </div>
        <div class="span-5 right">
        <ul>
            <li class="right login"><a href="#"><?php echo ucfirst(__('login')) ?></a></li>
            <li class="right"><a href="#"><?php echo ucfirst(__('register')) ?></a></li>
        </ul>
        </div>
    </div>
    <?php //echo image_tag('generic/top-header.jpg'); ?>
</div>