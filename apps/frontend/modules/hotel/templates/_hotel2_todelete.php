<div class="span-18 append-bottom last">

    <form action="#" id="hotel-form-<?php echo $hotel->id ?>" method="post">
        
    <div class="box-3">
        <table style="font-size: 90%; width:100%;">
            <tr>
                <td style="padding-right:280px;">Hotel</td>
                <td style="font-size: 110%; text-align: right;" class="hotel-total-price"><?php echo format_currency(3690, 'USD'); ?></td>
            </tr>
            <tr>
                <td></td>
                <td style=" text-align: right; font-size: 70%;">(includes Government Taxes and Fees)</td>
            </tr>
        </table>
    </div>

    <div class="hotel-container bg-light">
        <?php include_partial('description2',array('hotel'=>$hotel)) ?>
    <hr class="space" />
    
    <?php if(count($hotel->arRoomsType)>1):?>
    <div class="room-type-summary">
        <?php include_partial('summary2',array('hotel'=>$hotel)) ?>
    </div>
    <?php endif; ?>

    <?php include_partial('room',array('hotel'=>$hotel, 'open'=>false)); ?>
    

        <input type="submit" value="Select this hotel" class="search-small" style="width: 130px; float: right; margin:10px 0;" />
    </div>
    
    </form>
    
</div>
