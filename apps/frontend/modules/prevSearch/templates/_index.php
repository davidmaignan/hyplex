<h2 class="title"><?php echo __('Previous searches'); ?></h2>
<div class=" span-9">
    <table class="prev-searches">
        <?php $i=0; ?>
        <?php while($i<= 5 && $i<count($prevSearches)): ?>
            <?php $parameters = ($prevSearches[$i]['parameters']); ?>
            <tr class="<?php echo (fmod($i, 2) == 0) ? 'bg-1' : 'bg-2' ?>">
                <td style="font-weight: bold;">
                    <?php echo ucwords($parameters->getTypeRenamed()); ?>
                </td>
                <td>
                    <a href="#">
                        <?php echo $parameters->getOriginDestination(); ?>
                    </a>
                </td>
                <td rowspan="2" style="width: 60px; text-align: center;">
                    <a>Modify</a><br />
                    <a class="select">search</a><br />

                </td>
            </tr>
            
            <tr class="<?php echo (fmod($i, 2) == 0) ? 'bg-1' : 'bg-2' ?>">
                <td colspan="2">
                    &bull; <?php echo $parameters->getDates(); ?>
                    | <?php echo $parameters->getPassengers(); ?>

                    <?php if($prevSearches[$i]['type'] == 'flightReturn'):?>
                    <?php include_partial('prevSearch/flightPassenger', array('flightParameters'=>$parameters)); ?>
                    <?php elseif($prevSearches[$i]['type'] == 'hotelSimple'): ?>
                    <?php include_partial('prevSearch/hotelPassenger', array('hotelParameters'=>$parameters)); ?>
                    <?php endif; ?>


                </td>
                
            </tr>
           
        <?php $i++;?>
        <?php endwhile; ?>

       
    </table>
</div>


<hr class="space3" />

<?php



