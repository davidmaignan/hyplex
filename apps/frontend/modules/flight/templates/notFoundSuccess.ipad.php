<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('ipad'); ?>

<div class="span-4 shadow bg-white">
    <div class="padded">
        <h2>Left column</h2>
        <p>Define some content</p>
    </div>
</div>

<div class="span-15 bg1 last">


    <div class="span-15 shadow bg-white append-bottom">
        <div class="padded">
            <?php
            foreach ($parameters['search_flight'] as $key => $value) {
                echo "$key: $value<br />";
            }
            ?>
        </div>
    </div>
    <div class="span-15 shadow bg-white">
        <div class="box-1">
            <h1>No flight found</h1>
        </div>
    </div>

</div>
