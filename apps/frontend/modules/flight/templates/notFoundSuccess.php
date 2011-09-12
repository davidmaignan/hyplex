<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('myScript'); ?>
<?php use_javascript('functions.js'); ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<div class="span-4 shadow bg-white">
    <div class="padded">
        <h2>Left column</h2>
        <p>Define some content</p>
    </div>
</div>

<div class="span-16">


    <div class="span-16 shadow bg-white append-bottom">
        <div class="padded">
            <?php
            foreach ($parameters['search_flight'] as $key => $value) {
                echo "$key: $value<br />";
            }
            ?>
        </div>
    </div>
    <div class="span-16 shadow bg-white">
        <div class="box-1">
            <h1>No flight found</h1>
        </div>
    </div>

</div>

<div class="span-4 shadow last bg-white">
    <div class="padded">
        <h2>Right column</h2>
        <p>Define some content</p>
    </div>
</div>

<hr class="space3" />