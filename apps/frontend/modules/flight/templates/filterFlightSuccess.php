<?php foreach ($results as $result): ?>
<?php include_partial($type, array('result' => $result)); ?>
<?php endforeach; ?>

<script>    
    $('#sidebar').html('it is working');
</script>
