<?php

header('Content-type: text/javascript');

echo "
<script>
    var autoCompleteURL = '".url_for('autocomplete') ."';
    //alert(autoCompleteURL);
</script>";