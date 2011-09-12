<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('jquery.autocomplete.min.js'); ?>
<?php use_stylesheet('jquery.autocomplete.css'); ?>
<?php use_javascript('search/searchFlight.js'); ?>

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

</style>

<form action="<?php echo url_for('searchFlight/create') ?>" method="post" id="searchFlightForm" name="searchFlightForm">
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
                    <?php echo $form['depart_date']->render(); ?>
                    <p class="info-form">yyyy-mm-dd</p>
                </td>
                
                <td class="arrow2">
                    <?php echo image_tag('generic/arrow.gif'); ?>
                </td>
                <td>
                    <?php echo $form['return_date']->render(); ?>
                    <p class="info-form">yyyy-mm-dd</p>
                </td>
                <td></td>
                <td>
                    <input type="submit" value="<?php echo __('search'); ?>" class="search-small" />
                </td>
                
            </tr>
           
           
    </table>
    <div style="display:none;">
    <?php echo $form['depart_time']->render(); ?>
    <?php echo $form['return_time']->render(); ?>
    <?php echo $form['prefer_nonstop']->render(); ?>
    <?php echo $form['flexible_date']->render(); ?>
    <?php echo $form['number_adults']->render(); ?>
    <?php echo $form['number_children']->render(); ?>
    <?php echo $form['number_infants']->render(); ?>
    <?php echo $form['cabin']->render(); ?>
    <?php echo $form['oneway']->render(); ?>
    <?php echo $form['type']; ?>
    <?php echo $form['_csrf_token']; ?>
    </div>
</form>

