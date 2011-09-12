<?php use_stylesheet('grid.css'); ?>
<?php use_stylesheet('typography.css'); ?>
<?php use_stylesheet('ipad.css'); ?>

<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>

<?php use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>

<?php use_helper('Date', 'Number','I18n'); ?>

<div class="span-6 append-bottom">

    <div class="span-6 shadow bg-white append-bottom" id="form-index">
        <div style="margin:1px; overflow: hidden;">
            <ul id="tabs-form">
                <li><a href="#" class="selected"><?php echo __('Flight'); ?></a></li>
                <li><a href="#"><?php echo __('Hotel'); ?></a></li>
                <li><a href="#"><?php echo __('Car'); ?></a></li>
                <li><a href="#"><?php echo __('Package'); ?></a></li>
            </ul>
            <?php include_partial('searchFlight/form_index', array('form' => $flightForm)); ?>
            <div class="span-9">
                <div class="padded">
                    <h4 class="telephone"><?php echo __('Call our travel advisor'); ?></h4>
                    <p class="telephone">1-800-456-7890</p>
                </div>
            </div>
        </div>
    </div>


</div>

<div class="span-13 last append-bottom">

    <?php include_component('promotionalBanner', 'index'); ?>

            <div class="span-13">
                <?php include_component('topdestination', 'index'); ?>

        <div class="span-6 shadow bg-white last" id="tweet">
            <div class="box-1">
                <h2>Latest tweet <?php echo image_tag('generic/twitter_icon.png', array('style' => 'float:right;')); ?></h2>
            </div>

            <div class="box-2">
                <div id="tweet-pic">
                    <?php echo image_tag('generic/Z23_normal.jpg'); ?>
                </div>
                <div id="tweet-body">
                    <span id="tweet-title">Lorem ipsum</span> dolor sit amet<br />
                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                    It has roots in a piece of classical Latin literature from 45 BC, making.
                </div>
                <hr class="space2" />
                <div id="tweet-pic">
                    <?php echo image_tag('generic/Z23_normal.jpg'); ?>
                </div>
                <div id="tweet-body">
                    <span id="tweet-title">Lorem ipsum</span>
                    Contrary to popular belief, Lorem Ipsum is not simply random text.
                    It has roots in a piece of classical Latin literature from 45 BC, making.
                </div>
                <hr class="space3" />

            </div>

        </div>

    </div>

        <?php include_component('basket', 'index'); ?>



</div>



