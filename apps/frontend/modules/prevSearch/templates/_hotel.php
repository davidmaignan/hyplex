<?php use_helper('Date','Number','I18n','Text'); ?>
<h2 class="title"><?php echo __('Previous searches'); ?></h2>
<div>
    <table class="prev-searches">
        <?php $i=0; ?>
        <?php while($i<= 5 && $i<count($prevSearches)): ?>
            <?php $parameters = ($prevSearches[$i]['parameters']); ?>
            <tr class="<?php echo (fmod($i, 2) == 0) ? 'bg-1' : 'bg-2' ?>">
                <td style="font-weight: bold;">
                    <?php echo ucwords($parameters->getTypeRenamed()); ?>
                </td>
                <td>
                    <ul class="prevSearch-list-index">
                        <li>
                            <a href="#"><?php echo $parameters->getOriginDestination($sf_user->getCulture()); ?></a>
                        </li>
                        <li class="italic grey1"><?php echo $parameters->getDates(); ?><?php echo $parameters->getPassengers(); ?></li>
                        <li>
                            <?php if($prevSearches[$i]['type'] == 'flightReturn'):?>
                            <?php include_partial('prevSearch/flightPassenger', array('flightParameters'=>$parameters)); ?>
                            <?php elseif($prevSearches[$i]['type'] == 'hotelSimple'): ?>
                            <?php include_partial('prevSearch/hotelPassenger', array('hotelParameters'=>$parameters)); ?>
                            <?php endif; ?>
                        </li>
                    </ul>

                </td>
                <td style="width: 20px; text-align: center;">
                    <a>Modify</a><br />
                    <a class="select" style="width: 72px;">search</a><br />

                </td>
            </tr>
            
           
        <?php $i++;?>
        <?php endwhile; ?>
       
    </table>
</div>


<hr class="space3" />

<?php



