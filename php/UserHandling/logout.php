<?php 
//call init file containing class autoloader
require_once 'core/init.php';

$user = new User();

$user->logout();

Redirect::to('login.php');