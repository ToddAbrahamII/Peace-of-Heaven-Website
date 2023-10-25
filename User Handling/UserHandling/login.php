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
                Redirect::to('index.php'); // default redirects user to home page. Can be expanded to return to requested page.
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

<form action="" method="post"> 
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" autocomplete="off">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" autocomplete="off">
    </div>

    <div>
        <label for="remember">
            <input type="checkbox" name="remember" id="remember"> Remember me
        </label>
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Log in">
</form>