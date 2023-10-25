<?php

// Initialization method to be included on each webpage. Autoloader calls functions in each class when they are required (saves code).

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db' => 'peaceofheavendb'
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
    require_once 'classes/' . $class . '.php';
});

require_once 'sanitize.php';