<?php $datas = $result->Segments['outbound']; ?>
<?php for ($i = 0; $i < count($datas); $i++): ?>
<?php include_partial('segmentDetails',array('data'=>$datas[$i], 'result'=>$result ,'way'=>'Outbound')); ?>
<?php echo (count($datas) > 1 && $i < count($datas) - 1)?
        html_entity_decode($result->displayIphoneLayover($datas[$i], $datas[$i + 1])):null; ?>
<?php endfor; ?>
