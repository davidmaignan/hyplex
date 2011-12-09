<?php use_javascript('search/searchCar') ?>

<style>
    #car-form-index td{ padding-right: 5px;}
</style>

<form action="<?php echo url_for('@search_car_form') ?>" method="post" id="car-form-index">
    <fieldset class="type1">

        <h5><?php echo __('Car details'); ?></h5>
        <table class="form">
            <tr>
                <td>
                    <?php echo $form['drop_off']->renderLabel(); ?>
                </td>
                <td>
                    <?php echo $form['drop_off']; ?>
                </td>
            </tr>
        </table>
        <table class="form">
            <tr>
                <td class="span-4"><?php echo $form['location1']->renderLabel(); ?></td>
                <td><?php echo $form['location2']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td><?php echo $form['location1']->render(array('class' => 'text span-4')); ?></td>
                <td><?php echo $form['location2']->render(array('class' => 'text span-4')); ?></td>
            </tr>
        </table>
        <table class="form">
            <tr>
                <td class="span-4">
                    <?php echo $form['pickup_date']->renderLabel(); ?>
                </td>
                <td>
                    <?php echo $form['pickup_hour']->renderLabel(); ?>
                </td>
            </tr>

            <tr >
                <td>
                    <?php echo $form['pickup_date']->render(array('class' => 'text span-3')); ?>
                </td>
                <td>
                    <?php echo $form['pickup_hour']->render(array('class' => 'text span-2')); ?>
                </td>
            </tr>
            <tr  class="topPadding">
                <td>
                    <?php echo $form['dropoff_date']->renderLabel(); ?>
                </td>
                <td>
                    <?php echo $form['dropoff_hour']->renderLabel(); ?>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <?php echo $form['dropoff_date']->render(array('class' => 'text span-3')); ?>
                </td>
                <td>
                    <?php echo $form['dropoff_hour']->render(array('class' => 'text span-2')); ?>
                </td>
            </tr>
        </table>

        <div class="span-2 last" style="height: 8px;">
            <?php echo $form['type']; ?>
            <?php echo $form['_csrf_token']; ?>
        </div>

        <div style="clear:both"></div>
        <div class="last right">
            <input type="submit" value="<?php echo __('search'); ?>" class="blue right bigger" />
        </div>
    </fieldset>

</form>
