<?php use_helper('Date','Number','I18n'); ?>
<?php foreach ($results as $result): ?>
<?php include_partial('flightReturn', array('result' => $result)); ?>
<?php endforeach; ?>

