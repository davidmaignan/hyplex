<div class="padded">
    <?php //var_dump($datas); ?>
    <p class="">
        <?php echo $datas->offsetGet('message'); ?>
    </p>
    <?php if($datas->offsetExists('matches')): ?>
    <ul class="matches-list">
        <?php foreach($datas->offsetGet('matches') as $value): ?>
        <li><?php echo html_entity_decode($value); ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>


