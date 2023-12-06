<?php

// Initialization method to be included on each webpage. Autoloader calls functions in each class when they are required (saves code).
session_start();

// Disable error reporting
error_reporting(0);
ini_set('display_errors', 0);


$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1', //local host
        'username' => 'root', //htdocs
        'password' => '', 
        'db' => 'peaceofheavendb' // database
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token' 
    )
);

// Pass in a function that is run every time a class is accessed (auto import)
spl_autoload_register(function($class) {
    require_once '../UserHandling/classes/' . $class . '.php';
});

require_once ('../UserHandling/functions/sanitize.php');
require_once ('../UserHandling/functions/sanitize.php');