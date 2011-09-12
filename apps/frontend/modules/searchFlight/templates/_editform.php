<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('fancybox/jquery.mousewheel-3.0.4.pack.js'); ?>
<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>
<?php use_javascript('jquery.autocomplete.min.js'); ?>
<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>
<?php use_stylesheet('jquery.autocomplete.css'); ?>
<?php use_javascript('search/searchFlight.js'); ?>
<?php use_javascript('search/airport_list_'.$sf_user->getCulture().'.js'); ?>
<?php use_javascript('search/datepicker_'.$sf_user->getCulture().'.js'); ?>

<style>

    td{
        padding-bottom: 1px;
        vertical-align: top;
    }

    input.span-8{
        width: 238px;
    }

    p.info-form{
        font-size: 70%;
        color:#aaa;
    }

    td.arrow{
        padding: 10px 10px;
    }
    td.arrow2{
        padding: 10px 5px 0 0px;
    }

    #form-details{
        width: 100%;
        margin-top: 10px;
        display: none;
    }

</style>

<form action="<?php echo url_for('searchFlight/create') ?>" method="post" id="searchFlightForm" name="searchFlightForm">
    <fieldset>
    <table>
            <tr>
                <td colspan="3">
                    <?php echo $form['origin']->render(); ?>
                </td>
                <td class="arrow">
                    <?php echo image_tag('generic/arrow.gif'); ?>
                </td>
                <td>
                    <?php echo $form['destination']->render(); ?>
                </td>

            </tr>
            <tr>
                <td>
                    <?php echo $form['depart_date']->render(); ?><br /><br />
                    <p class="info-form">yyyy-mm-dd</p>
                </td>
                
                <td class="arrow2">
                    <div class="return-date"><?php echo image_tag('generic/arrow.gif'); ?></div>
                </td>
                <td>
                    <div class="return-date">
                    <?php echo $form['return_date']->render(); ?>
                    <p class="info-form">yyyy-mm-dd</p></div>
                </td>
                <td></td>
                

                <td>
                    <input type="submit" value="<?php echo __('search'); ?>" class="search-small" />
                    
                </td>
            </tr>
    </table>
        <a href="#" onclick="return false;" id="search-more-options"><?php echo  __('Options'); ?>
    <table id="form-details">
        <tr>
            <td style="width: 250px;" colspan="3">&emsp;
                <?php echo $form['oneway']->render(); ?>
            </td>
            <td>
                <?php echo $form['depart_time']->renderLabel(); ?><br />
                <?php echo $form['depart_time']->render(); ?>
                
            </td>
            <td>
                <div class="return-time">
                <?php echo $form['return_time']->renderLabel(); ?> <br />
                <?php echo $form['return_time']->render(); ?></div>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form['number_adults']->renderLabel(); ?><br />
                <?php echo $form['number_adults']->render(); ?>
            </td>
            <td>
                <?php echo $form['number_children']->renderLabel(); ?><br />
                <?php echo $form['number_children']->render(); ?>
            </td>
            <td>
                <?php echo $form['number_infants']->renderLabel(); ?><br />
                <?php echo $form['number_infants']->render(); ?>
            </td>
            <td>&emsp;
                <?php echo $form['prefer_nonstop']->render(); ?>
                <?php //echo $form['flexible_date']->render(); ?>
            </td>
            <td>
                <?php echo $form['cabin']->renderLabel(); ?><br />
                <?php echo $form['cabin']->render(); ?>
            </td>
        </tr>
        <?php echo $form['type']->render(); ?>
        <?php echo $form['_csrf_token']; ?>
    </table>
    <div>
    
    </div>

        </fieldset>
</form>

