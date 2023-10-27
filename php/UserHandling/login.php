<?php

use function PHPSTORM_META\elementType;

require_once 'core/init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        
        $validate = new Validate();
        $validation = $validate->check($_POST, array (
            'username'=> array('required'=> true),
            'password'=> array('required'=> true)
        ));

        if($validation->passed()) {
            // log user in
            $user = new User();

            $remember = (Input::get('remember' === 'on') ? true : false);
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

            if($login) {
                Redirect::to('acctinfo.php'); // default redirects user to home page. Can be expanded to return to requested page.
            } else {
                echo 'Sorry, Login Failed';
            }

        } else { 
            foreach($validation->errors() as $error) {
                echo $error, '<br>';
            }  
        }
    }      
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/Login.css">

    <title>Login</title>
</head>
<body>
<div class="login-container">
    <form action="" method="post" class="login-form"> 
        <label for="username">Username</label>
        <input type="text" name="username" id="username" autocomplete="off">
  
        <label for="password">Password</label>
        <input type="password" name="password" id="password" autocomplete="off">

        <!-- <label for="remember">
            <input type="checkbox" name="remember" id="remember" class="remember-checkbox">Remember me</label>
     -->
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" value="Log in"><br><br>

        <a href="register.php"  class="signup-link">Click to Signup</a><br><br>

        <a href="/PeaceOfHeavenWebPage/php/WebPages/Home.php" class="home-link">Return Home</a>
    </form>
</div>
</body>