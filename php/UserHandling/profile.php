<?php 

require_once 'core/init.php';

if(!$username = Input::get('user')) { // Input helper gets user from url (get method)
    Redirect::to('index.php');
} else {
    $user = new User($username);
    if(!$user->exists()) { // username does not exist
        Redirect::to(404); // generate 404 message
    } else { // username does exists
        $data = $user->data(); // get user data
    }
    ?>

    <h3><?php echo escape($data->username); ?></h3>
    
    <?php
}