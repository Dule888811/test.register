<?php
include_once 'core/init.php';

$users = User::search($_POST['criteria']);
if(!empty($users)){
    foreach($users as $user){
        echo $user['name'] .  $user['email'] . "</br>";
    }
}