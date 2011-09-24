<!-- Carousel -->

<?php //use_javascript('jquery-1.5.1.min.js'); ?>
<?php //use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php //use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>
<?php //use_javascript('functions.js'); ?>

<?php //use_stylesheet('grid'); ?>
<?php //use_stylesheet('typography'); ?>
<?php //use_stylesheet('form'); ?>

<!-- Carousel -->
<?php use_javascript('carousel.ipad.js'); ?>
<?php use_stylesheet('carousel.ipad.css'); ?>

<?php use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php use_javascript('debugger/myLogger.js'); ?>

<script type="text/javascript">
    var promotionalBanners = <?php echo $sf_data->get('promotionalBanners', ESC_RAW); ?>
</script>

<div class="span-13 shadow bg-white last append-bottom" style="height: 240px; text-align: center;" id="carousel">
    <div class="bg1" style="margin:2px;" id="mask">
        <div id="promotional_container"></div>
    </div>

    <p id="carousel-btns">
        <a href="#" title="previous" id="previous" ></a>
        <a href="#" title="next" id="next" ></a>
    </p>


</div>
