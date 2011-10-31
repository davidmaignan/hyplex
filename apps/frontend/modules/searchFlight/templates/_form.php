<?php use_helper('I18n'); ?>
<?php use_stylesheet('form'); ?>

<?php //use_javascript('search/airport_list_' . $sf_user->getCulture() . '.js'); ?>
<?php //use_javascript('search/datepicker_' . $sf_user->getCulture() . '.js'); ?>

<?php
if ($form->hasGlobalErrors()) {
    //echo $form->renderGlobalErrors();
}
?>

<style>

    table{
        width: 100%;
    }

    td{
        border:0px solid #ddd;
        padding-bottom:2px;
    }
    td.prepend-top{
        padding-top: 10px;
    }

    td.error{

    }

</style>

<div class="span-15" id="form-index" >

    <form action="<?php echo url_for('@search_flight_form') ?>" method="post" id="">
        <fieldset>

            <?php if($form->hasGlobalErrors()): ?>
            <ul class="error-global">
               <?php foreach ($form->getGlobalErrors() as $name => $error): ?>
                  <li class=""><?php echo $error ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <h3 class="form-index"><?php echo __('Trip details'); ?></h3>
            <table>
                <tr>
                    <td colspan="4">
                        <?php echo $form['oneway']; ?>
                    </td>
                </tr>
                <tr>
                    <td class="prepend-top" colspan="2">
                        <?php echo $form['origin']->renderLabel(); ?>
                    </td>
                    <td colspan="2">
                        <?php echo $form['destination']->renderLabel(); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo $form['origin']; ?>
                        <span class="multi-icon">
                        <a href="<?php echo url_for('multidestination'); ?>" id="origin-0" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a>
                    </span>
                    </td>
                    <td colspan="2">
                        <?php echo $form['destination']; ?>
                        <span class="multi-icon">
                            <a href="<?php echo url_for('multidestination'); ?>" id="destination-0" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="small" colspan="2" style="width: 49%;">
                        <?php echo $form['origin']->renderError(); ?>
                    </td>
                    <td class="small" colspan="2" style="width: 49%;">
                        <?php echo $form['destination']->renderError(); ?>
                    </td>
                </tr>
                <tr>
                    <td class="prepend-top"><?php echo $form['depart_date']->renderLabel(); ?></td>
                    <td><?php echo $form['depart_time']->renderLabel(); ?></td>
                    <td class="return-date"><?php echo $form['return_date']->renderLabel(); ?></td>
                    <td class="return-date"><?php echo $form['return_time']->renderLabel(); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form['depart_date'] ?></td>
                    <td><?php echo $form['depart_time'] ?></td>
                    <td class="return-date"><?php echo $form['return_date'] ?></td>
                    <td class="return-time"><?php echo $form['return_time'] ?></td>
                </tr>
                <tr>
                    <td class="small"><?php echo $form['depart_date']->renderError() ?></td>
                    <td class="small"><?php echo $form['depart_time']->renderError() ?></td>
                    <td class="small return-date"><?php echo $form['return_date']->renderError() ?></td>
                    <td class="small return-time"><?php echo $form['return_time']->renderError() ?></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <h3 class="form-index"><?php echo __('Flight options'); ?></h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo $form['cabin']->renderLabel(); ?>
                    </td>
                    <td colspan="2">
                        <?php echo $form['airline']->renderLabel(); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form['cabin']; ?>
                    </td>
                    <td style="vertical-align: top; padding-top: 7px;">
                        <?php echo $form['prefer_nonstop']->render(); ?>
                    </td>
                    <td colspan="2">
                        <?php echo $form['airline']; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2" id="prefered-airlines-list"></td>
                </tr>
                <tr>
                    <td  colspan="4">
                        <h3 class="form-index"><?php echo __('Passengers informations'); ?></h3>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form['number_adults']->renderLabel(); ?></td>
                    <td><?php echo $form['number_children']->renderLabel(); ?></td>
                    <td><?php echo $form['number_infants']->renderLabel(); ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form['number_adults']; ?>
                    </td>
                    <td>
                        <?php echo $form['number_children']; ?>
                    </td>
                    <td>
                        <?php echo $form['number_infants']; ?>
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="4">
                        <input type="submit" value="<?php echo __('search'); ?>" class="blue right" />
                    </td>
                </tr>
                <?php echo $form['type']; ?>
                <?php echo $form['_csrf_token']; ?>
            </table>

        </fieldset>
    </form>

</div>





<script>
    var flightSearchType = 'simple';
</script>