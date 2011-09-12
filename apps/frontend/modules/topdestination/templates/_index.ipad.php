<div class="span-7 shadow bg-white top-dest append-bottom">
    <div class="box-1">
        <h2><?php echo __('Top destinations'); ?></h2>
    </div>

    <?php //var_dump($topDestinations[0]); ?>
    <div class="box-2">
        <?php foreach ($topDestinations as $topDest): ?>

            <div class="span-125 extra-margin">
            <?php echo image_tag('../uploads/images/top_destination/' . $topDest->getFilename(),
                    array('alt' => $topDest->getName())); ?>
            <?php //echo image_tag('generic/mexico.png'); ?>
            <?php echo link_to2($topDest->getName(), 'homepage', array('name' => $topDest->getName())); ?>
            
        </div>
        <?php endforeach; ?>



    </div>

</div>