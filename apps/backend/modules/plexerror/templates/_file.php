<?php

echo link_to(image_tag('icons/page_white_code.png',array('alt'=>'View response')),
        'view_plex_error',
        array('filename'=>$plex_error_log->getFile()),array('target'=>'blank'));

?>
