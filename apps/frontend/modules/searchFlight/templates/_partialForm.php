<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheet('flightForm.css') ?>

<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('jquery.autocomplete.min.js'); ?>
<?php use_stylesheet('redmond/jquery-ui-1.8.11.custom.css'); ?>
<?php use_stylesheet('jquery.autocomplete.css'); ?>
<?php use_javascript('search/searchFlight.js'); ?>


<style>
    span.form-text-info{
        color: #006eb4;
        font-weight: bold;
        font-size: 110%;
    }

    td{
        padding-bottom: 2px;
    }
</style>



<?php

$parameters = $sf_request->getPostParameter('search_flight');

//echo "<pre>";
//print_r($parameters);

$origin = $parameters['origin'];
$destination = $parameters['destination'];
$crsf_token = $parameters['_csrf_token'];
//echo $crsf_token;
?>

<form action="<?php echo url_for('searchFlight/create') ?>" method="post">
    <table>
        <tbody>
            <tr>
                <td colspan="4">


                </td>
                </tr>
                <tr style="display:none;">
                    <td  colspan="4">
                        <?php echo $form['oneway']->render(); ?>
                    </td>
                </tr>
                <tr>
                    <td class="special first" colspan="2">
                    
                    From :
                        <span class="form-text-info"><?php echo $origin;?></span>
                        <?php echo $form['origin']->render(); ?>
                    </td>
                    <td class="special" colspan="2">
                        To:
                         <span class="form-text-info"><?php echo $destination;?></span>
                        <?php echo $form['destination']->render(); ?>
                    </td>

                </tr>
                <tr>
                    <td class="special" colspan="">
                    <?php echo $form['depart_date']->renderLabel(); ?>
                        <?php echo $form['depart_date']->render(); ?>
                        <p class="info-form">mm/dd/yyyy</p>
                    </td>
                    <td>
                        <?php echo $form['depart_time']->renderLabel(); ?><br />
                        <?php echo $form['depart_time']->render(); ?>
                    </td>
                    <td class="special">
                    <?php echo $form['return_date']->renderLabel(); ?>
                        <?php echo $form['return_date']->render(); ?>
                        <p class="info-form">mm/dd/yyyy</p>
                    </td>
                    <td>
                        <?php echo $form['return_time']->renderLabel(); ?><br />
                        <?php echo $form['return_time']->render(); ?>
                    </td>
                </tr>
                <tr  style="display:none;">
                    <td colspan="2"><?php echo $form['flexible_date']->render(); ?></td>
                    <td colspan="2"><?php echo $form['prefer_nonstop']->render(); ?></td>
                </tr>
                <tr  style="display:none;">
                    <td class="special">
                        <?php echo $form['number_adults']->renderLabel(); ?>
                        <?php echo $form['number_adults']->render(); ?>
                    </td>
                    <td class="special">
                        <?php echo $form['number_children']->renderLabel(); ?>
                        <?php echo $form['number_children']->render(); ?>
                    </td>
                    <td class="special" colspan="2">
                        <?php echo $form['cabin']->renderLabel(); ?>
                        <?php echo $form['cabin']->render(); ?>
                    </td>
                </tr>
                <?php echo $form['type']; ?>
                <?php //echo $form['_csrf_token']; ?>
                
                <tr>
                    <td><input type="hidden" name="search_flight__csrf_token" value="<?php echo $crsf_token ?>" /></td>
            </tr>
            <tr>
                <td colspan="4"><input type="submit" value="Search" /></td>
            </tr>
        </tbody>

    </table>
</form>

