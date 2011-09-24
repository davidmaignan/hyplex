<?php

$test = new sfGuardUser();

$users = Doctrine::getTable('sfGuardUser')->findAll();

foreach($users as $user){

    echo $user->getUserName();
    echo '<br />';
    var_dump($user->getAllPermissions());
    echo '<br />';
    var_dump($user->getGroupNames());
    echo '<hr />';
}

echo '<h2>Credential</h2>';
var_dump($sf_user->getCredentials());

echo '<h2>Groupname</h2>';
var_dump($sf_user->getGroupNames());

