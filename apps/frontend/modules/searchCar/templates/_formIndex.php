<?php use_helper('I18n'); ?>
<?php use_stylesheet('form'); ?>

<?php use_javascript('search/searchCar') ?>

<style>
    #car-form-index td{ padding-right: 5px;}
</style>

<form action="<?php echo url_for('@search_car_form') ?>" method="post" id="car-form-index">
    <fieldset>

        <h3 class="form-index"><?php echo __('Car details'); ?></h3>
        <table class="form-index">
            <tr>
                <td colspan="2" style="padding-bottom: 7px;">
                    <table>
                        <tr>
                            <td>
                                <?php echo $form['drop_off']->renderLabel(); ?>
                            </td>
                            <td>
                                <?php echo $form['drop_off']; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 10px;"><?php echo $form['location1']->renderLabel(); ?></td>
                <td colspan=""><?php echo $form['location2']->renderLabel(); ?></td>
            </tr>
             <tr class="">
                <td style="vertical-align: top;"><?php echo $form['location1']; ?></td>
                <td style="vertical-align: top;"><?php echo $form['location2']; ?></td>
            </tr>
            <tr  class="topPadding">
                <td>
                    <?php echo $form['pickup_date']->renderLabel(); ?>
                </td>
                <td>
                    <?php echo $form['pickup_hour']->renderLabel(); ?>
                </td>
            </tr>
            
            <tr >
                <td style="vertical-align: top;">
                    <?php echo $form['pickup_date'] ?>
                </td>
                <td>
                    <?php echo $form['pickup_hour'] ?>
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
                    <?php echo $form['dropoff_date'] ?>
                </td>
                <td>
                    <?php echo $form['dropoff_hour'] ?>
                </td>
            </tr>
        </table>
        
        <div class="span-2 last" style="height: 8px;">
            <?php echo $form['type']; ?>
            <?php echo $form['_csrf_token']; ?>
        </div>

        <div style="clear:both"></div>
        <div class="span-8 last right">
            <input type="submit" value="<?php echo __('search'); ?>" class="search" />
        </div>
    </fieldset>

</form>
