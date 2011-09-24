<div id="my-searches">
    <h2 class="box">Previous searches</h2>
    <table id="search-flights">
        <tr class="description">
            <td></td>
            <td>From/To</td>
            <td>Depart/Return</td>
            <td>Stops</td>
            <td>Airline</td>
            <td>Price</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="vertical-align: middle; padding-left: 6px;">
<?php echo image_tag('icons/flight.png', array('alt' => 'flight')); ?>
            </td>
            <td>New York<br />Los Angeles</td>
            <td>
                <?php echo format_date(date('Y-m-d', strtotime('+1day')), 'D'); ?><br />
                <?php echo format_date(date('Y-m-d', strtotime('+8day')), 'D'); ?>
            </td>
            <td>0</td>
            <td>
                <?php echo image_tag('airlines/delta.png', array('alt' => 'AA', 'class' => 'airline')); ?>
            </td>
            <td>$695.00</td>
            <td>View</td>
            <td>Go</td>
        </tr>
        <tr>
            <td style="vertical-align: middle; padding-left: 6px;"><?php echo image_tag('icons/flight.png', array('alt' => 'flight')); ?></td>
            <td>New York<br />Los Angeles</td>
            <td>
                <?php echo format_date(date('Y-m-d', strtotime('+90day')), 'D'); ?><br />
                <?php echo format_date(date('Y-m-d', strtotime('+98day')), 'D'); ?>
            </td>
            <td>0</td>
            <td>
                <?php echo image_tag('airlines/united.png', array('alt' => 'AA', 'class' => 'airline')); ?>
            </td>
            <td>$695.00</td>
            <td>View</td>
            <td>Go</td>
        </tr>
        <tr class="description">
            <td></td>
            <td>Name</td>
            <td>Depart/Return</td>
            <td>Nights</td>
            <td>Type</td>
            <td>Price</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="vertical-align: middle; padding-left: 6px;"><?php echo image_tag('icons/hotel.png', array('alt' => 'flight')); ?></td>
            <td>Hyatt Paradiso<br />Myckonos</td>
            <td>
                <?php echo format_date(date('Y-m-d', strtotime('+240day')), 'D'); ?><br />
                <?php echo format_date(date('Y-m-d', strtotime('+248day')), 'D'); ?>
            </td>
            <td>7</td>
            <td>Standard</td>
            <td>$2,695.00</td>
            <td>View</td>
            <td>Go</td>
        </tr>
        <tr class="description">
            <td></td>
            <td>Name</td>
            <td>Depart/Return</td>
            <td>Days</td>
            <td>Company</td>
            <td>Price</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="vertical-align: middle; padding-left: 6px;"><?php echo image_tag('icons/car.png', array('alt' => 'flight')); ?></td>
            <td>New York<br />Los Angeles</td>
            <td>
                <?php echo format_date(date('Y-m-d', strtotime('+140day')), 'D'); ?><br />
                <?php echo format_date(date('Y-m-d', strtotime('+148day')), 'D'); ?>
            </td>
            <td>8</td>
            <td><?php echo image_tag('cars/cr_zelogo_55.gif', array('alt' => 'Hertz', 'class' => '')); ?></td>
            <td>$695</td>
            <td>View</td>
            <td>Go</td>
        </tr>
        <tr>
            <td style="vertical-align: middle; padding-left: 6px;"><?php echo image_tag('icons/car.png', array('alt' => 'flight')); ?></td>
            <td>New York<br />Los Angeles</td>
            <td>
                <?php echo format_date(date('Y-m-d', strtotime('+140day')), 'D'); ?><br />
                <?php echo format_date(date('Y-m-d', strtotime('+148day')), 'D'); ?>
            </td>
            <td>8</td>
            <td><?php echo image_tag('cars/cr_zelogo_55.gif', array('alt' => 'Hertz', 'class' => '')); ?></td>
            <td>$695</td>
            <td>View</td>
            <td>Go</td>
        </tr>
    </table>

</div>