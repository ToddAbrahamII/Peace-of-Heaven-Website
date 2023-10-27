<?php
require_once 'core/init.php';

/*
if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
    $validate = new Validate(); // return instance of DB
    // Validate elements of POST method against an array of conditions
    $validation = $validate->check($_POST, array( 
        'username' => array( 
            // username rules
            'name'=> 'Username',
            'required' => true,
            'min' => 2,
            'max' => 80,
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

    // Register a new user if validation passed
    if($validation->passed()) {
        // register user
        echo 'validation = passed';
        $user = new User();

        $salt = Hash::salt(32);
        try {
            $user->create(array( //!!! WRONG - update to match our User table
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password'), $salt),
                'salt' => $salt,
                'name' => Input::get('name'),
                'joined' => date('Y-m-d H:i:s'),
                'group' => 1 // this will eventually be the permission group. Right now there is only one permission group.
            ));

            Session::flash('home','You have been registered and can now log in!');
            

        } catch (Exception $e) {
            die($e->getMessage());
        }
    } else {
        // output errors
        foreach($validation->errors() as $error) {
            echo $error, '<br>';
        }   
    }
}*/

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate(); // Create an instance of the Validate class
        $validation = $validate->check($_POST, array(
            'username' => array( 
                'name' => 'Username',
                'required' => true,
                'min' => 2,
                'max' => 80,
                'unique' => 'users'
            ),
            'password' => array(
                'name' => 'Password',
                'required' => true,
                'min' => 6
            ),
            'password_again' => array(
                'name' => 'Password Again',
                'required' => true,
                'matches' => 'password'
            ),
            'name' => array(
                'name' => 'Name',
                'required' => true,
                'min' => 2,
                'max' => 50
            )
        ));

       
        if ($validation->passed()) {
            // Register user
            Session::flash('success', 'You registered successfully!');
            $user = new User();

            // Generate a unique salt for the user
            $salt = Hash::salt(32);
            
            //Hash the password with the user's unique salt.
            

            try {
                $user->create(array(
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'name' => Input::get('name'),
                    'joined' => date('Y-m-d H:i:s'),
                    'group' => 1
                ));

                Session::flash('home', 'You have been registered and can now log in!');
                Redirect::to(404); //once logged in, send user to index page

            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            // Output errors
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}


?>

<form action="" method="post">
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">

    </div>

    <div class="field">
        <label for="password">Choose a password</label>
        <input type="password" name="password" id="password">
    </div> 
    <div class="field">
        <label for="password_again">Enter your password again</label>
        <input type="password" name="password_again" id="password_again">
    </div>   

    <div class="field">
        <label for="name">Enter your Name</label>
        <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name'))?>">
    </div> 

    <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
    <input type="submit" value="Register">
</form>

