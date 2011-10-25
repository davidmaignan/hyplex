<?php use_helper('I18n'); ?>
<?php use_stylesheet('form'); ?>

<form action="<?php echo url_for('@search_flight_form') ?>" method="post" id="flight-form-index">
    <fieldset>

        <h3 class="form-index"><?php echo __('Trip details'); ?></h3>
        <table class="form-index">
            <tr>
                <td><?php echo $form['oneway']->render(); ?></td>
                <td colspan=""><a class="multiple-destination" href="<?php echo url_for('multipleDestination') ?>"><?php echo __('Multiple destinations'); ?></a></td>
            </tr>
            <tr class="topPadding">
                <td colspan="2"><?php echo $form['origin']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td colspan="2" style="vertical-align: middle;">
                    <?php echo $form['origin'] ?>
                    <span class="multi-icon">
                        <a href="<?php echo url_for('multidestination'); ?>" id="origin-0" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a>
                    </span>
                </td>
            </tr>
            <tr class="topPadding">
                <td colspan="2"><?php echo $form['destination']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $form['destination'] ?>
                    <span class="multi-icon">
                        <a href="<?php echo url_for('multidestination'); ?>" id="destination-0" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a>
                    </span>
                </td>
            </tr>
            <tr class="topPadding">
                <td><?php echo $form['depart_date']->renderLabel(); ?></td>
                <td><?php echo $form['depart_time']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form['depart_date']; ?>
                </td>
                <td>
                    <?php echo $form['depart_time']; ?>
                </td>
            </tr>
            <tr class="topPadding">
                <td><?php echo $form['return_date']->renderLabel(); ?></td>
                <td><?php echo $form['return_time']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form['return_date']; ?>
                </td>
                <td>
                    <?php echo $form['return_time']; ?>
                </td>
            </tr>
        </table>
        
        <h3 class="form-index"><?php echo __('Flight options'); ?></h3>
        <table class="form-index">
            <tr>
                <td><?php echo $form['cabin']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td><?php echo $form['cabin']; ?></td>
                <td style="vertical-align: top; padding-top: 8px;"><?php echo $form['prefer_nonstop']; ?></td>
            </tr>
        </table>
       
        <h3 class="form-index"><?php echo __('Passengers informations');?></h3>
        <table class="form-index">
            <tr class="topPadding">
                <td><?php echo $form['number_adults']->renderLabel(); ?></td>
                <td><?php echo $form['number_children']->renderLabel(); ?></td>
                <td><?php echo $form['number_infants']->renderLabel(); ?></td>
            </tr>
            <tr>
                <td><?php echo $form['number_adults']; ?></td>
                <td><?php echo $form['number_children']; ?></td>
                <td><?php echo $form['number_infants']; ?></td>
            </tr>
        </table>
        
        <div class="span-2 last" style="height: 8px;">
            <?php echo $form['type']; ?>
            <?php echo $form['_csrf_token']; ?>
        </div>

        <div style="clear:both"></div>
        <div class="last bg1">
            <input type="submit" value="<?php echo __('search'); ?>" class="blue right" />
        </div>
    </fieldset>

</form>

<script>

    var flightSearchType = 'simple';

</script>