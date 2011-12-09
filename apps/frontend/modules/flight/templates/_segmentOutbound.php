<tr>
    <td colspan="6" class="blue1 big bold no-border">
        <?php echo format_date($result->SegmentOutbound->Departs, 'P') ?>

        <span class="right">
            <?php echo html_entity_decode($result->getDiffDays($result->Segments['outbound'])) ?>
        </span>
    </td>
</tr>
<tr class="header">
    <td class="flight-info center"><?php echo __('Flight') ?></td>
    <td><?php echo __('Depart/Arrive') ?></td>
    <td><?php echo __('Time') ?></td>
    <td><?php echo __('Airport') ?></td>
    <td><?php echo __('Duration') ?></td>
    <td><?php echo __('Cabin') ?></td>
</tr>

<?php $datas = $result->Segments['outbound']; ?>

<?php for ($i = 0; $i < count($datas); $i++): ?>
    <?php include_partial('flight/segmentDetails', array('data' => $datas[$i], 'result' => $result)); ?>
    <?php echo (count($datas) > 1 && $i < count($datas) - 1) ? html_entity_decode($result->displayLayover($datas[$i], $datas[$i + 1])) : null; ?>
<?php endfor; ?>

