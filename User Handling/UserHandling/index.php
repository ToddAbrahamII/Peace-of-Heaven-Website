<?php 
//call init file containing class autoloader
require_once 'core/init.php';


// example insert **
$user=DB::getInstance()->insert('users', array(
    'username' => 'Dale',
    'password' => 'password',
    'salt' => 'salt'
));

if ($user->count()) {
    echo 'No User';
} else {
    foreach ($user->results() as $user) {
        echo $user->username , '<br>';
    }
}