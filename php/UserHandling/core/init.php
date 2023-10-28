<?php

// Initialization method to be included on each webpage. Autoloader calls functions in each class when they are required (saves code).
session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
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

require_once 'functions/sanitize.php';

if(Cookie::exists(Config::get('remeber/cookie_name')) && Session::exists(Config::get('session/session_name'))) {
    //user has asked to be remembered
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

    if($hashCheck->count()) {
        //if hash founded, log em in
        $user = new User($hashCheck->first()->user_id);
        $user->login();

    }
}