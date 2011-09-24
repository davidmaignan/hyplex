<tr>
    <td colspan="6" class="title"><span class="depart"><?php echo __('Inbound') ?></span>
        <?php echo format_date($result->SegmentInbound->Departs, 'P') ?>
        <?php echo html_entity_decode($result->getDiffDays($result->Segments['inbound'])) ?>
    </td>
</tr>
<tr class="small">
    <td class="flight-info"><?php echo __('Flight') ?></td>
    <td><?php echo __('Depart/Arrive') ?></td>
    <td><?php echo __('Time') ?></td>
    <td><?php echo __('Airport') ?></td>
    <td><?php echo __('Duration') ?></td>
    <td><?php echo __('Cabin') ?></td>
</tr>
<?php $datas = $result->Segments['inbound']; ?>

<?php for ($i = 0; $i < count($datas); $i++): ?>
<?php include_partial('flight/segmentDetails', array('data' => $datas[$i], 'result' => $result)); ?>
<?php echo (count($datas) > 1 && $i < count($datas) - 1)? html_entity_decode($result->displayLayover($datas[$i], $datas[$i + 1])): null; ?>
<?php endfor; ?>
<tr>
    <td></td>
</tr>
