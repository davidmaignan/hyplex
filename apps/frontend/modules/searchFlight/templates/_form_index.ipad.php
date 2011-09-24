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


<form action="<?php echo url_for('@search_flight_form') ?>" method="post" id="flight-form-index">
    <fieldset>
        <h3 class="form-index"><?php echo __('Trip details'); ?></h3>
        <p><?php echo $form['oneway']->render(); ?></p>
        <hr class="space2" />
        <p class="label-block">
            <?php echo $form['origin']->renderLabel(); ?></p>
        <?php echo $form['origin']->render(); ?></p>
            <hr class="space" />
            <p class="label-block">
            <?php echo $form['destination']->renderLabel(); ?></p>
        <?php echo $form['destination']->render(); ?></p>
            <hr class="space" />
            <div class="span-3">
                <p class="label-block"><?php echo $form['depart_date']->renderRow(); ?></p>
            </div>
            <div class="span-3 last">
                <p class="label-block">
                <?php echo $form['depart_time']->renderLabel(); ?>
                <?php echo $form['depart_time']->render(); ?>
                </p>
            </div>
            <hr class="space" />
            <div style="clear:both"></div>
            <div class="span-3">
                <p class="label-block"><?php echo $form['return_date']->renderRow(); ?></p>
            </div>
            <div class="span-3 last">
                <p class="label-block">
                <?php echo $form['return_time']->renderLabel(); ?>
                <?php echo $form['return_time']->render(); ?>
                </p>
        </div>
        <div style="clear:both"></div>
        <h3 class="form-index"><?php echo __('Flight options'); ?></h3>
        <div class="span-6 last">
            <p class="label-block">
                <?php echo $form['cabin']->renderLabel(); ?>
                <?php echo $form['cabin']->render(); ?><br
            </p>
            
       
            <p class="label-block" style="padding-top: 20px;"><?php echo $form['prefer_nonstop']->render(); ?></p>
        </div>
        <div style="clear:both"></div>
        <h3 class="form-index"><?php echo __('Passengers informations'); ?></h3>
        <div class="span-6 last">
            <p class="label-block">
                <?php echo $form['number_adults']->renderLabel(); ?>
                <?php echo $form['number_adults']->render(); ?>
            </p>
        </div>
         <div class="span-6 last">
            <p class="label-block">
                <?php echo $form['number_children']->renderLabel(); ?>
                <?php echo $form['number_children']->render(); ?>
            </p>
        </div>
         <div class="span-6 last">
            <p class="label-block">
                <?php echo $form['number_infants']->renderLabel(); ?>
                <?php echo $form['number_infants']->render(); ?>
            </p>
        </div>
        <div class="span-2 last">
            <?php echo $form['type']; ?>
            <?php echo $form['_csrf_token']; ?>
        </div>

            <div style="clear:both"></div>
            <div class="span-4 last">
                <input type="submit" value="<?php echo __('search'); ?>" class="search" />
        </div>
    </fieldset>

</form>

