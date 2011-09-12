<div id="filter-box">
    Filters comes here
</div>
<div id="list-results">
    <?php foreach ($results as $result): ?>
    <?php include_partial('flightReturn', array('result' => $result)); ?>
    <?php endforeach; ?>
</div>