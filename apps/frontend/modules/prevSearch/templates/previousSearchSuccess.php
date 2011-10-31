
<style>
    .prevSearch th{
        text-align: left;
        font-size: 80%;
        padding:6px 3px;
        background-color: #aaa;
        color: white;
    }

    table.prevSearch td{
        padding: 9px 3px;
        border-bottom: 1px solid #aaa;
        vertical-align: top;
        font-size: 85%;
    }

</style>


<div class="span-7">
    <?php echo html_entity_decode($filterFormFinal); ?>
</div>


<div class="span-18 last" style="width: 715px;">

    <table class="prevSearch">

        <?php echo html_entity_decode($results[0]->getToStringHeader()); ?>

        <?php foreach($results as $k=>$result): ?>
        <?php $result->setClass((fmod($k, 2) == 0)?'bg-1':'bg-2'); ?>
        <?php echo html_entity_decode($result); ?>
        <?php endforeach; ?>
    </table>

</div>

<hr class="space3" />

<?php
//var_dump($results[0]);
?>