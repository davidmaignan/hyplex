<?php use_javascript('flight/flightResult.js'); ?>

<script type="text/javascript">
    var filterValues = <?php echo $sf_data->get('filterValues', ESC_RAW); ?>
</script>

<?php include_partial('dialog_message'); ?>

<div class="span-26 last summary">
    <?php include_partial('summary'.$type, array('parameters'=>$parameters, 'total'=>count($results))); ?>
</div>

<div class="span-6 shadow bg-white">
    <?php echo html_entity_decode($filterResponse->displayFilterForm_html5()); ?>
    <hr class="space3"/>
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

<div class="span-18 prepend-1 last">
    <div class="span-15 append-bottom ">
        <div id="form" class="hide">
            <?php include_partial('searchFlight/form', array('form' => $form, 'parameters' => $parameters)); ?>
        </div>
    </div>

    <div class="span-19 shadow" id="tab-viewing">
       
        <ul class="none">
            <li><a href="#" class="view-list selected"><?php echo __('List') ?></a></li>
            <li><a href="#" class="view-chart"><?php echo __('Chart') ?></a></li>
            <li><a href="#" class="view-matrix" id="matrix-btn"><?php echo __('Matrix') ?></a></li>
        </ul>
    </div>

    <div class="span-18 prepend-top hide" id="matrix">
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

    <hr class="space" />
    <div id="Results">
        <?php foreach ($results as $result): ?>
        <?php include_partial($type, array('result' => $result, 'filename'=>$filename)); ?>
        <?php endforeach; ?>
    </div>

</div>

<hr class="space" />

