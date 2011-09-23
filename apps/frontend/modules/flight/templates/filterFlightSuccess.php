<?php foreach ($results as $result): ?>
<?php include_partial($type, array('result' => $result, 'filename'=>$filename)); ?>
<?php endforeach; ?>

<script>    
    $('#sidebar').html('it is working');
</script>
