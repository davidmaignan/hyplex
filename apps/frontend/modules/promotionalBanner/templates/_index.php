<!-- Carousel -->

<?php //use_javascript('jquery-1.5.1.min.js'); ?>
<?php //use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php //use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>
<?php //use_javascript('functions.js'); ?>

<?php //use_stylesheet('grid'); ?>
<?php //use_stylesheet('typography'); ?>
<?php //use_stylesheet('form'); ?>

<!-- Carousel -->
<?php //use_javascript('carousel.js'); ?>
<?php use_stylesheet('carousel'); ?>

<script type="text/javascript">
    var promotionalBanners = null;<?php //echo $sf_data->get('promotionalBanners', ESC_RAW); ?>
</script>

<div class="span-16 last append-bottom" id="carousel">
    <div id="">
        <div id="promotional_container">
            <?php echo link_to(image_tag('tmp/gallery1.jpg'), '@vacation_interest'); ?>
        </div>
    </div>
</div>

