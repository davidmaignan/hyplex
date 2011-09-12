<div class="prev-search-details none">
    <table>
        <thead>
            <tr>
                <th class="flight"><?php echo __('Flight'); ?></th>
                <th><?php echo __('Number'); ?></th>
                <th><?php echo __('Depart'); ?></th>
                <th><?php echo __('Arrive'); ?></th>
                <th><?php echo __('Stop'); ?></th>
                <th class="right"><?php echo __('Duration'); ?></th>
            </tr>
        </thead>
        <tr>
            <td class="flight">
                <?php echo image_tag('airlines/delta.png', array('alt' => 'AA', 'class' => 'airline', 'width' => '30px')); ?><br />
            </td>
            <td>3245</td>
            <td>
                <?php echo format_date(date('Y-m-d', strtotime('+1day')), 'p'); ?><br />
            </td>
            <td>
                <?php echo format_date(date('Y-m-d', strtotime('+1day')), 'p'); ?><br />
            </td>
            <td>1</td>
            <td class="right"><?php echo Utils::getHourMinutes(187); ?></td>
        </tr>
        <tr>
            <td class="flight">
                <?php echo image_tag('airlines/delta.png', array('alt' => 'AA', 'class' => 'airline', 'width' => '30px')); ?><br />
            </td>
            <td>3245</td>
            <td>
                <?php echo format_date(date('Y-m-d', strtotime('+1day')), 'p'); ?><br />
            </td>
            <td>
                <?php echo format_date(date('Y-m-d', strtotime('+1day')), 'p'); ?><br />
            </td>
            <td class="center">1</td>
            <td class="right"><?php echo Utils::getHourMinutes(187); ?></td>
        </tr>
        <tr>
            <td style="text-align: right;" colspan="6"><a href="#"><?php echo __('Check availability'); ?></a></td>
        </tr>

    </table>

</div>