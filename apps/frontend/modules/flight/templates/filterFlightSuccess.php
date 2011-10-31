<?php use_helper('Date','Number','Text','I18n'); ?>
<?php foreach ($results as $result): ?>
<?php include_partial($type, array('result' => $result, 'filename'=>$filename)); ?>
<?php endforeach; ?>

