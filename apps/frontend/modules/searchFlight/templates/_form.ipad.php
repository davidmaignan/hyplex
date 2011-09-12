<?php use_helper('I18n'); ?>
<?php use_stylesheet('form'); ?>

<?php use_javascript('jquery.autocomplete.min.js'); ?>
<?php use_javascript('search/searchFlight'); ?>

<?php use_stylesheet('jquery.autocomplete.css'); ?>

<?php
if ($form->hasGlobalErrors()) {
    echo $form->renderGlobalErrors();
}
?>

<div class="span-19 shadow bg-white">



<form action="<?php echo url_for('@search_flight_form') ?>" method="post" id="flight-form-index">
    <fieldset>
        <div class="span-18">
        <h3 class="form-index"><?php echo __('Trip details'); ?></h3>
        <p><?php echo $form['oneway']->render(); ?></p>
        </div>
        <hr class="space2" />
        <div class="span-12">
        <p class="label-block"><?php echo $form['origin']->renderRow(); ?></p>
        </div>
        <div class="span-12 last">
        <p class="label-block"><?php echo $form['destination']->renderRow(); ?></p>
        </div>
        <div style="clear:both"></div>
        <div class="span-6">
            <p class="label-block"><?php echo $form['depart_date']->renderRow(); ?></p>
        </div>
        <div class="span-4">
            <p class="label-block"><?php echo $form['depart_time']->renderRow(); ?></p>
        </div>
        <div style="clear:both"></div>
        <div class="span-6 last">
            <p class="label-block"><?php echo $form['return_date']->renderRow(); ?></p>
        </div>
        <div class="span-4 last">
            <p class="label-block"><?php echo $form['return_time']->renderRow(); ?></p>
        </div>
        <div style="clear:both"></div>
        <h3 class="form-index"><?php echo __('Flight options'); ?></h3>
        <div class="span-4 last">
            <p class="label-block"><?php echo $form['cabin']->renderRow(); ?></p>
        </div>
        <div class="span-4 last">
            <p class="label-block" style="padding-top: 20px;"><?php echo $form['prefer_nonstop']->render(); ?></p>
        </div>
        <div style="clear:both"></div>
        <h3 class="form-index"><?php echo __('Passengers informations');?></h3>
        <div class="span-3 last">
            <p class="label-block"><?php echo $form['number_adults']->renderRow(); ?></p>
        </div>
        <div class="span-3 last">
            <p class="label-block"><?php echo $form['number_children']->renderRow(); ?></p>
        </div>
        <div class="span-2 last">
            <p class="label-block"><?php echo $form['number_infants']->renderRow(); ?></p>
        </div>
        <div class="span-2 last" style="height: 20px;">
            <?php echo $form['type']; ?>
            <?php echo $form['_csrf_token']; ?>
        </div>

        <div style="clear:both"><br /></div>
        <div class="span-8 bg1 last right">
            <input type="submit" value="<?php echo __('search'); ?>" class="search" />
        </div>
        <div style="clear:both"></div>
        <br />
    </fieldset>

</form>

</div>