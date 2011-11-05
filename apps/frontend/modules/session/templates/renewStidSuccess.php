<?php echo __('Session notification'); ?>|
<?php echo __('Your session has been extended for another %1% minutes',array('%1%'=>sfConfig::get('app_plexSession_duration')/60)); ?>|
<?php echo $url; ?>