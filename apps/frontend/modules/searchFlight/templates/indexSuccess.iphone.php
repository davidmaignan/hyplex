<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('jquery.autocomplete.min.js'); ?>
<?php use_stylesheet('iphone/custom-theme/jquery-ui-1.8.11.custom.css'); ?>
<?php use_stylesheet('iphone/jquery.autocomplete.css'); ?>

<?php use_stylesheet('iphone.css'); ?>
<?php use_javascript('iphone.js'); ?>
<?php use_helper('I18n'); ?>

<?php use_javascript('iphone/searchFlightIphone'); ?>

<?php use_javascript('iphone/searchFlightIphone'); ?>

<style>
    

    #date_container{
        position: absolute;
        background-color: white;
        width: 100%;
        adisplay: none;
        top:-560px;
        min-height: 420px;
        color: #0d4979;
        padding:10px 5px 10px 33px;
        
    }

    #date_container h3{
        margin: 6px 0;
    }

    #datepicker_depart, #datepicker_return{
        margin: 0 auto;
    }

    #close-datepicker-panel{
        margin-right: 60px;
    }

</style>

<div id="date_container" class="selectable">
    <h3>Please select a departure date</h3>
    <div id="datepicker_depart"></div>
    <br />
    <h3>Please select a return date</h3>
    <div id="datepicker_return"></div>
    <a href="#" onclick="return false;" class="btn" id="close-datepicker-panel">Close</a>
</div>


<div id="page_wrapper">
    <ul id="header"  class="bg-light">
        <li><?php echo image_tag('iphone/logo_min.png', array('alt' => 'H', 'id' => 'logo')); ?></li>
        <li class="title">Flight search</span</li>
        <li><a href="<?php echo url_for('homepage'); ?>" title="history" class="home">Home</a></li>
    </ul>

    <!-- LEFT OR RIGHT 

    <div id="content_left">
        <p>You are now holding your phone to the left</p>
    </div>
    <div id="content_right">
        <p>You are now holding your phone to the right</p>
    </div>
    <div id="content_normal">
-->

        <form action="<?php echo url_for('@search_flight_form') ?>" method="post" id="form-flight">
            <div class="form">
                <?php
                if($form->hasGlobalErrors()){
                    echo $form->renderGlobalErrors();
                }
                ?>
                
                <?php echo $form['oneway']->renderError() ?>
                <?php echo $form['origin']->renderError() ?>
                <?php echo $form['destination']->renderError() ?>
                <?php //echo $form['depart_date']->renderError() ?>
                <?php //echo $form['return_date']->renderError() ?>
                <h2><?php echo __('STEP 1: Select a type of flight') ?></h2>
                <div class="form-element-1">
                    <?php echo $form['oneway']->render(); ?>
                </div>
            </div>
            <br />
            <div class="form">
                <h2><?php echo __('STEP 2: Origin & destination') ?></h2>
                <div class="form-element-2">
                    <ul>
                        <li class="elt">
                            <span class="label"><?php echo $form['origin']->renderLabel(); ?></span>
                            <?php echo $form['origin']->render(); ?>
                        </li>
                        <li class="elt">
                            <span class="label"><?php echo $form['destination']->renderLabel(); ?></span>
                            <?php echo $form['destination']->render(); ?>
                        </li>
                    </ul>
                </div>

            </div>
            <br />
            <div class="form">
                <h2><?php echo __('STEP 3: Dates & times') ?></h2>
                <div class="form-element-2">
                    <ul>
                        <li class="elt">
                            <span class="label"><label><?php echo __('Depart'); ?></label></span>
                            <div id="depart_date_container" class="input-container"></div>
                            <?php echo $form['depart_date']->render(); ?>
                            <?php echo $form['depart_time']->render(); ?>
                        </li>
                        <li class="elt">
                            <span class="label"><label><?php echo __('Return'); ?></label></span>
                            <div id="return_date_container" class="input-container"></div>
                            <?php echo $form['return_date']->render(); ?>
                            <?php echo $form['return_time']->render(); ?>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="form">
                <h2><?php echo __('STEP 4: Flight options') ?></h2>
                <div class="form-element-2">
                    <ul>
                        <li class="elt">
                            <span class="label"><?php echo $form['cabin']->renderLabel(); ?></span>
                            <?php echo $form['cabin']->render(); ?>
                        </li>
                        <li class="elt">
                            <?php echo $form['prefer_nonstop']->render(); ?>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="form">
                <h2><?php echo __('STEP 5: Passengers information') ?></h2>
                <div class="form-element-3">
                    <ul>
                        <li class="elt">
                            <span class="label_2"><?php echo $form['number_adults']->renderLabel(); ?></span>
                            <?php echo $form['number_adults']->render(); ?>
                            <br />
                            
                        </li>
                        <li class="elt">
                            <span class="label_2"><?php echo $form['number_children']->renderLabel(); ?></span>
                            <?php echo $form['number_children']->render(); ?>
                            <br />
                        </li>
                        <li class="elt">
                            <span class="label_2"><?php echo $form['number_infants']->renderLabel(); ?></span>
                            <?php echo $form['number_infants']->render(); ?>
                        </li>
                    </ul>
                </div>

            </div>
            <?php echo $form['type']; ?>
            <?php echo $form['_csrf_token']; ?>
            <div id="search-btn-div">
            <input type="submit" class="btn-search" value="<?php echo __('search'); ?>" />
            </div>
            

        </form>

       

    </div>
<!--
    <div id="content_flipped">
        <p>This doesn't work yet.</p>
    </div>


</div>
-->
<noscript>
    <p style="padding:15px;">You need to have JavaScript enable to visit this website.</p>
</noscript>