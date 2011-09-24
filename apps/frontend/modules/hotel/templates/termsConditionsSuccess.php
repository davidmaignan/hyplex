<?php if(!empty($result->termsConditions)): ?>
    <span class="term-condition-title"><?php echo ucwords(__('terms & conditions')) ?></span>
    <?php foreach($result->termsConditions as $value): ?>
    &bull; <?php echo str_replace('<br>', '. ', $value) ?>
    <?php endforeach; ?>
<?php endif; ?>
    
<?php if(!empty($result->rateDetails)): ?>
    <span class="term-condition-title"><?php echo ucwords(__('rate details')) ?></span>
    <?php foreach($result->rateDetails as $value): ?>
    &bull; <?php echo str_replace('&lt;br&gt;', ' &bull; ',$value) ?>
    <?php endforeach; ?>
<?php endif; ?>

