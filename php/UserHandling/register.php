<?php
require_once 'core/init.php';


if(Input::exists()) {
    if(Token::check(Input::get('token'))) 
    $validate = new Validate(); // return instance of DB
    // Validate elements of POST method against an array of conditions
    $validation = $validate->check($_POST, array( 
        'username' => array( 
            // username requirements
            'name'=> 'Username',
            'required' => true,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'
        ),
        // password requirements
        'password' => array(
            'name'=> 'Password',
            'required' => true,
            'min' => 6
        ),
        'password_again' => array(
            'name'=> 'Password Again',
            'required' => true,
            'matches' => 'password'
        ),
        // name registration requirement
        'name' => array(
            'name'=> 'Name',
            'required' => true,
            'min' => 2,
            'max' => 50
        )
    ));

    // detect if passed
    if($validation->passed()) {
        // register user
        $user = new User();

        $salt = Hash::salt(32);
        try {
            $user->create(array( //!!! WRONG - update to match our User table
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password'), $salt),
                'salt' => $salt,
                //'name' => Input::get('name'),
                'joined' => date('Y-m-d H:i:s'),
                'group' => 1 // this will eventually be the permission group. Right now there is only one permission group.
            ));

            Session::flash('Location: acctinfo.php');
            

        } catch (Exception $e) {
            die($e->getMessage());
        }
    } else {
        // output errors
        foreach($validation->errors() as $error) {
            echo $error, '<br>';
        }   
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/Register.css">

    <title>Signup</title>
</head>
<body>
<div class="signup-container">
<form action="" method="post" class="signup-form">

        <label for="username">Create a Username</label>
        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off"><br><br>

        <label for="password">Choose a Password</label>
        <input type="password" name="password" id="password"><br><br>
 
        <label for="password_again">Enter your Password Again</label>
        <input type="password_again" name="password_again" id="password_again"><br><br>

    <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
    <input type="submit" value="Register"><br><br>

    <a href="Login.php" class = "login-link">Click to Login</a><br><br>
        <a href="/PeaceOfHeavenWebPage/php/Home.php" class="home-link">Return Home</a>

</div>
</body>
</html>
