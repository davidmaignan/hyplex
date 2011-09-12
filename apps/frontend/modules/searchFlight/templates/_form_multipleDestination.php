<?php use_helper('I18n'); ?>
<?php use_stylesheet('form'); ?>

<?php use_javascript('jquery.autocomplete.min.js'); ?>
<?php use_javascript('search/searchFlight'); ?>
<?php use_javascript('search/airport_list_' . $sf_user->getCulture() . '.js'); ?>
<?php use_javascript('search/datepicker_' . $sf_user->getCulture() . '.js'); ?>

<?php use_javascript('search/airport_list_' . $sf_user->getCulture() . '.js'); ?>
<?php use_javascript('search/datepicker_' . $sf_user->getCulture() . '.js'); ?>

<?php use_javascript('fancybox/jquery.mousewheel-3.0.4.pack.js'); ?>
<?php use_javascript('fancybox/jquery.fancybox-1.3.4.pack.js'); ?>

<?php use_stylesheet('fancybox/jquery.fancybox-1.3.4.css'); ?>

<?php use_stylesheet('jquery.autocomplete.css'); ?>


<?php
if ($form->hasGlobalErrors()) {
    echo $form->renderGlobalErrors();
}
?>

<style>

    table.form-error{
        width: 100%;
    }

 #flight-form-multidestination  td{
        padding-right: 10px;
}

</style>

<div class="span-18"  id="form-index">

    <form action="<?php echo url_for('@search_multidestination_form') ?>" method="post" id="flight-form-multidestination">
        <fieldset>

            <div class="span-17">
                <h3 class="form-index"><?php echo __('Trip details'); ?></h3>
                <p><?php //echo $form['oneway']->render(); ?></p><br />
                <table class="form-error">
                <?php foreach ($form['newSegments'] as $key => $f): ?>
                <?php echo ($key >= 2) ? '<table class="form-error" id="segment-' . $key . '">' : '<table class="form-error">'; ?>
                    <tr>
                        <td class="first">&nbsp;</td>
                        <td colspan="2"><?php echo $f['origin']->renderLabel(); ?></td>
                        <td colspan="2"><?php echo $f['destination']->renderLabel(); ?></td>
                        <td colspan="2"><?php echo $f['depart_date']->renderLabel(); ?></td>
                    </tr>
                    <tr>
                        <td class="label" style="vertical-align: middle;"><?php echo __('Segment') ?>: <?php //echo $key;  ?></td>
                        <td><?php echo $f['origin'] ?></td>
                        <td style="vertical-align: middle;">
                            <a href="<?php echo url_for('multidestination'); ?>" id="origin-<?php echo $key; ?>" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a></td>
                        <td><?php echo $f['destination'] ?></td>
                        <td style="vertical-align: middle;">
                            <a href="<?php echo url_for('multidestination'); ?>" id="destination-<?php echo $key; ?>" onclick="return false;" class="multidestination-popup" ><?php echo image_tag('icons/world.png'); ?></a></td>
                        <td><?php echo $f['depart_date'] ?></td>
                        <td style="width: 90px; vertical-align: middle;">
                        <?php echo ($key >= 2) ? '<a href="#" class="remove-segment remove-small" id="' . $key . '" onclick="do_delete(this)">' . __('remove') . '</a>' : ''; ?>

                    </td>
                </tr>
                <tr class="line">
                    <td></td>
                    <td colspan="2"><?php echo $f['origin']->renderError(); ?></td>
                    <td colspan="2"><?php echo $f['destination']->renderError(); ?></td>
                    <td colspan="2"><?php echo $f['depart_date']->renderError(); ?></td>
                </tr>
                </table>

                <?php endforeach; ?>
                        <div id="extrapictures"></div>
                        <br />
                        <button id="add_picture" type="button"><?php echo __("More legs") ?></button>
                 </div>
                    <hr class="space2" />
                    <h3 class="form-index"><?php echo __('Flight options'); ?></h3>
                    <div class="span-4 last">
                        <p class="label-block"><?php echo $form['cabin']->renderRow(); ?></p>
                    </div>
                    <div class="span-4 last">
                        <p class="label-block" style="padding-top: 20px;"><?php echo $form['prefer_nonstop']->render(); ?></p>
                    </div>
                    <div style="clear:both"></div>
                    <h3 class="form-index"><?php echo __('Passengers informations'); ?></h3>
                    <div class="span-3 last">
                        <p class="label-block"><?php echo $form['number_adults']->renderRow(); ?></p>
                    </div>
                    <div class="span-3 last">
                        <p class="label-block"><?php echo $form['number_children']->renderRow(); ?></p>
                    </div>
                    <div class="span-3 last">
                        <p class="label-block"><?php echo $form['number_infants']->renderRow(); ?></p>
                    </div>
                    <div class="span-3 last" style="height: 0px;">
                <?php echo $form['type']; ?>
                <?php echo $form['_csrf_token']; ?>
                    </div>

                    <div style="clear:both"></div>
                    <div class="span-8 last right">
                        <input type="submit" value="<?php echo __('search'); ?>" class="search" />
                    </div>
                <div style="clear:both"></div>

        </fieldset>

    </form>

</div>
<hr class="space3" />
<script>

    var targetInfos;
    var flightSearchType = 'multiple';
    /*
    $('document').ready(function(){

        $(".multidestination-popup").click(function(){
            //Get the number
            targetInfos = $(this).attr('id').split('-')
        });
    

        $(".multidestination-popup").fancybox({
            'width'		: 700,
            'height'		: 400,
            'autoScale'     	: false,
            'centerOnScroll'        : true,
            'transitionIn'		: 'none',
            'transitionOut'		: 'none',
            'type'			: 'iframe'
        });



    });
    */
    
</script>