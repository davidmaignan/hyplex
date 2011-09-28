<?php use_javascript('jquery-1.5.1.min.js'); ?>
<?php use_javascript('jquery-ui-1.8.11.custom.min.js'); ?>
<?php use_javascript('myScript.js'); ?>
<?php use_stylesheet('custom-theme/jquery-ui-1.8.11.custom.css'); ?>

<?php use_stylesheet('grid'); ?>
<?php use_stylesheet('typography'); ?>
<?php use_stylesheet('form'); ?>
<?php use_stylesheet('flightResult'); ?>

<?php use_javascript('functions.js'); ?>
<?php //use_javascript('search/searchFlight.js'); ?>
<?php use_javascript('flight/flightResult.js'); ?>


<?php use_javascript('debugger/ADS-final-verbose.js'); ?>
<?php use_javascript('debugger/myLogger.js'); ?>

<?php use_helper('Date', 'Number', 'I18n', 'Text'); ?>

<script type="text/javascript">
    var filterValues = <?php echo $sf_data->get('filterValues', ESC_RAW); ?>
</script>

<?php include_partial('dialog_message'); ?>

<div class="span-26 last summary">
    <?php include_partial('summary',array('parameters'=>$parameters)); ?>
</div>

<div class="span-6 shadow bg-white">
    <?php echo html_entity_decode($filterFormFinal); ?>

    <div class="span-6 last">

        <div class="span-6 last bg-white append-bottom">
            <div class="span-box-margin center" id="call-center-span-5">
                <?php echo image_tag('generic/call_center_agent_1.jpg'); ?>
                <h2 class="blue"><?php echo __('Need help?'); ?></h2>
                <p class="small1 append-bottom"><?php echo __('Call us tool-free at'); ?></p>
                <p class="color2 big2">1-800-742-9244</p>
            </div>
            <div class="padded">

            </div>
        </div>


        <div class="span-6 no-shadow bg-white append-bottom">
            <div class="padded center">
                <?php echo image_tag('tmp/dum_v_1.jpg'); ?>
            </div>
        </div>

    </div>

</div>

<div class="span-19 last">
    <div class="span-15 append-bottom ">
        <div id="form" class="hide">
            <?php include_partial('searchFlight/form', array('form' => $form, 'parameters' => $parameters)); ?>
            </div>
        </div>

    <div class="span-19 shadow append-bottom" id="tab-viewing">
       
        <ul>
            <li><a href="#" class="view-list selected">List</a></li>
            <li><a href="#" class="view-chart">Chart</a></li>
            <li><a href="#" class="view-matrix" id="matrix-btn">Matrix</a></li>
        </ul>
    </div>

    <div class="span-19 append-bottom none" id="matrix">
        <?php foreach ($matrix as $key => $data): ?>
        <?php include_partial('matrix', array('data' => $data, 'key' => $key)); ?>
        <?php endforeach; ?>

        <ul id="matrix-toggle">
            <?php foreach ($matrix as $key => $data): ?>
            <?php $class = ($key == 0) ? 'selected' : ''; ?>
            <li><a href="#" onclick="return false;" class="matrix-link <?php echo $class; ?>" id="matrix-link-<?php echo $key; ?>"><?php echo $key + 1; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <hr class="space" />

    <?php include_partial('sorting',array('total' => $filterResponse->nbrFlightsToPaginate, 'page' => $page)); ?>

    <hr class="space3" />
    <div id="Results">
        <?php foreach ($results as $result): ?>
        <?php include_partial('flightReturn', array('result' => $result, 'filename'=>$filename)); ?>
        <?php endforeach; ?>
    </div>

</div>

<hr class="space3" />

