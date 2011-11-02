<div class="span-16 last append-bottom">
    <h2 class="title prepend-top"><?php echo __('Top destinations'); ?></h2>
    <?php //var_dump($topDestinations[0]); ?>
    
        <?php //foreach ($topDestinations as $topDest): ?>
            
            
        <?php   //echo image_tag('../uploads/images/top_destination/' . $topDest->getFilename(),
                //array('alt' => $topDest->getName())); ?>
        <?php //echo image_tag('generic/mexico.png'); ?>
        <?php //echo link_to2($topDest->getName(), 'homepage', array('name' => $topDest->getName())); ?>
        <?php //echo image_tag('../uploads/images/top_destination/'.$i.'jpg'); ?>
            

        <div class="top-destination">
            <?php echo image_tag('../uploads/images/top_destination/3.jpg'); ?>
            <h2><?php echo __('Venice') ?></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </div>
        <div class="top-destination">
            <?php echo image_tag('../uploads/images/top_destination/4.jpg'); ?>
            <h2><?php echo __('New York') ?></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </div>
        <div class="top-destination-last">
            <?php echo image_tag('../uploads/images/top_destination/2.jpg'); ?>
            <h2><?php echo __('Las Vegas') ?></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing eli.</p>
        </div>
    <div style="clear:both;"></div>
        <?php //endforeach; ?>
    <ul class="paginator">
        <li><a href="#" class="selected"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <!--<li><a href="#" class="next">Last</a></li>
        <li><a href="#" class="prev">First</a></li>-->
    </ul>
</div>
