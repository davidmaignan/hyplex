<?php $class = ($key >0)? 'hide':''; ?>

<table class="matrix-table <?php echo $class; ?>" id="matrix-table-<?php echo $key; ?>">
    <thead>
        <tr>
            <th></th>
            <?php foreach($data[0] as $key=>$value): ?>
            <th><?php echo Utils::getAirlineIcon($key, true); ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo __('non-stop'); ?></td>
        <?php foreach($data[0] as $value): ?>
        <td class="<?php echo ($value[2] === TRUE)?'minPrice':'';  ?>"><?php echo Utils::getMatrixAirlinePriceLink($value); ?></td>
        <?php endforeach; ?>
    </tr>
    <tr>
        <td><?php echo __('1 stop'); ?></td>
        <?php foreach($data[1] as $value): ?>
        <td class="<?php echo ($value[2] === TRUE)?'minPrice':'';  ?>"><?php echo Utils::getMatrixAirlinePriceLink($value); ?></td>
        <?php endforeach; ?>
    </tr>
    <tr>
        <td><?php echo __('2+ stops'); ?></td>
        <?php foreach($data[2] as $value): ?>
        <td class="<?php echo ($value[2] === TRUE)?'minPrice':'';  ?>"><?php echo Utils::getMatrixAirlinePriceLink($value); ?></td>
        <?php endforeach; ?>
    </tr>
    </tbody>
</table>

