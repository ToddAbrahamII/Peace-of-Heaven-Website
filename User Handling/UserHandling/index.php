<?php 
//call init file containing class autoloader
require_once 'core/init.php';


$user=DB::getInstance()->insert('users', array(
    'username' => 'Dale',
    'password' => 'password',
    'salt' => 'salt'
));