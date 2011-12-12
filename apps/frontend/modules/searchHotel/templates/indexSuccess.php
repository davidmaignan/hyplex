<?php //use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php //use_javascript('debugger/myLogger.js'); ?>

<style type="text/css">
    #dialog-message{
        display: none;
        text-align: center;
    }
</style>

<?php include_partial('include/dialog_message') ?>

<div id="dialog-message" title="<?php echo __('You have sent a request') ?>">
    <p style="text-align: center;"><?php echo image_tag('generic/ajax-loader.gif', array('alt' => '')) ?></p>
    <br />
    <p><?php echo __('Your request has been sent. Please wait !'); ?></p>
    <p><?php //echo __('You can always change your mind. Click cancel');        ?></p>
</div>

<div class="span-26">

    <div class="span-15">

        <?php if($sf_user->hasFlash('children_age')): ?>
            <div class="span-14 notice" style="font-size: 80%; padding-right: 25px;">
                <?php echo __('Please provide children ages to get the best available price') ?>
            </div>
        <?php endif; ?>

        <?php if ($sf_request->hasParameter('wherebox')): ?>
            <h2><?php echo __('More information required for Wherebox'); ?></h2>
        <?php include_partial('searchFlight/matches', array('datas' => $sf_request->getParameter('wherebox'))); ?>
        <?php endif; ?>
        <?php include_partial('form', array('form' => $form)) ?>
    </div>

    <div class="span-9 prepend-1 last">
        <?php include_component('prevSearch', 'hotel'); ?>
    </div>

</div>

<hr class="space3"/>