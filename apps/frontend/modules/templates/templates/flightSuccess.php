
<script type="text/javascript">
    var filterValues = <?php echo $sf_data->get('filterValues', ESC_RAW); ?>
</script>

<?php //include_partial('dialog_message'); ?>

<div class="span-26 last summary">
    <?php //include_partial('flight/summary'.$type, array('parameters'=>$parameters, 'total'=>count($results))); ?>
</div>

<section class="span-6">
    <h2>Filter flight result</h2>
    <?php echo html_entity_decode($filteredResponse->displayFilterForm_html5()); ?>

</section>

<section class="span-18 prepend-1 last">

    <h2>Flight results list</h2>


    <div class="span-15 append-bottom ">
        <div id="form" class="hide">
            <?php //include_partial('searchFlight/form', array('form' => $form, 'parameters' => $parameters)); ?>
        </div>
    </div>


    <div class="span-18 append-bottom" id="tab-viewing">  
        <ul class="none">
            <li><a href="#" class="view-list selected"><?php echo __('List') ?></a></li>
            <li><a href="#" class="view-chart"><?php echo __('Chart') ?></a></li>
            <li><a href="#" class="view-matrix" id="matrix-btn"><?php echo __('Matrix') ?></a></li>
        </ul>
    </div>

    <?php //include_partial('sorting',array('total' => $filterResponse->nbrFlightsToPaginate, 'page' => $page)); ?>

    <hr class="space" />

    <div class="span-19 append-bottom none" id="matrix">
        <?php //foreach ($matrix as $key => $data): ?>
        <?php //include_partial('matrix', array('data' => $data, 'key' => $key)); ?>
        <?php //endforeach; ?>


    </div>
    <hr class="space" />

    <section class="flight-box">
        <table>
            <tr>
                <td class="airline-icon">
                    <img src="/images/airlines/AA.png" class="flight-icon" width="38px" height="25px" alt="AA" /><br />
                    American airlines
                </td>
                <td class="flight-datas">
                    <table class="flight-box">
                        <thead>
                            <tr>
                                <th colspan="3">Departure</th>
                                <th colspan="3">Arrival</th>
                                <th>Stops</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>LAX</td>
                                <td class="bold">Dec 01</td>
                                <td class="blue1">8:05 AM</td>
                                <td>LAX</td>
                                <td class="bold">Dec 01</td>
                                <td class="blue1">8:05 AM</td>
                                <td class="center">0</td>
                                <td>5h 25min</td>
                            </tr>
                            <tr>
                                <td>LAX</td>
                                <td class="bold">Dec 01</td>
                                <td class="blue1">8:05 AM</td>
                                <td>LAX</td>
                                <td class="bold">Dec 01</td>
                                <td class="blue1">8:05 AM</td>
                                <td class="center">0</td>
                                <td>5h 25min</td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    <ul class="flight-link">
                                        <li><a class="flight-link-details">Details</a></li>
                                        <li><a class="flight-link-save">Save</a></li>
                                        <li><a class="flight-link-share">Share</a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class="flight-price">
                    <ul class="none">
                        <li class="color2 bold biggest">$324.40</li>
                        <li class="grey1">$324.40 / person</li>
                        <li><input type="submit" value="select" class="big blue" /></li>
                    </ul>
                </td>
        </table>

    </section>

    <div class="flight-box-details prepend-top2">
        <table class="flight-details append-bottom">
            <tr>
                <td colspan="6" class="blue1 big bold no-border">Thursday, December 1, 2011</td>
            </tr>
            <tr class="header">
                <td class="center">Flight</td>
                <td>Depart/Arrive</td>
                <td>Time</td>
                <td>Airport</td>

                <td>Duration</td>
                <td>Cabin</td>
            </tr>
            <tr>
                <td class="center" rowspan="2">
                    <img class="bordered" alt="AA" src="../images/airlines/AA.png" /><br />American Airlines<br /><span class="small blue">34</span>
                </td>
                <td class="bold">Dec 1, 2011</td>
                <td class="blue1">8:05 AM</td>
                <td>LAX - Los Angeles International<br /><span class="small blue bold"> (Los Angeles [CA] - USA)</span></td>

                <td rowspan="2">5h 25min</td>
                <td rowspan="2">Q</td>
            </tr>
            <tr>
                <td class="bold">Dec 1, 2011</td>
                <td class="blue1">4:30 PM</td>
                <td>JFK - John F Kennedy International<br /><span class="small blue bold"> (New York [NY] - USA)</span></td>
            </tr>
            <tr>
                <td colspan="6" class="blue1 big bold no-border">Thursday, December 8, 2011</td>
            </tr>
            <tr class="header">
                <td class="center">Flight</td>
                <td>Depart/Arrive</td>
                <td>Time</td>
                <td>Airport</td>
                <td>Duration</td>
                <td>Cabin</td>
            </tr>
            <tr>
                <td class="center" rowspan="2">
                    <img class="airline bordered" alt="AA" src="../images/airlines/AA.png" /><br />American Airlines<br /><span class="small blue">1</span>
                </td>
                <td class="bold">Dec 8, 2011</td>
                <td class="blue1">9:00 AM</td>
                <td >JFK - John F Kennedy International<br /><span class="small blue bold"> (New York [NY] - USA)</span></td>
                <td rowspan="2">6h 25min</td>
                <td rowspan="2">Q</td>
            </tr>
            <tr>
                <td class="bold">Dec 8, 2011</td>
                <td class="blue1">12:25 PM</td>
                <td>LAX - Los Angeles International<br /><span class="small blue bold"> (Los Angeles [CA] - USA)</span></td>
            </tr>
        </table>
    </div>


</section>