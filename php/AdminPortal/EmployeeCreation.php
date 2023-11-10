<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    if($user->isLoggedIn()) {


    //Only shows page to users with the correct PermissionLvl
    if($user->data()->group == 3) 
        {
        //Shows Admin NavBar
        include("../AdminPortal/AdminNavBar.php");

        if(Input::exists()) {
            if(Token::check(Input::get('token'))) {  
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    ### Insert rules that Employee Creation fields must meet in addition to js validation ###
                    // 'username' => array( 
                    //     'name' => 'Username',
                    //     'required' => true,
                    //     'min' => 2,
                    //     'max' => 80,
                    //     'unique' => 'users'
                    // ),
                    // 'password' => array(
                    //     'name' => 'Password',
                    //     'required' => true,
                    //     'min' => 6
                    // ),
                    // 'password_again' => array(
                    //     'name' => 'Password Again',
                    //     'required' => true,
                    //     'matches' => 'password'
                    // )
                ));

                // If all rules are satisfied, create new employee
                if($validation->passed()) {
                    $user = New User();
                     // Generate a unique salt for the user
                     $salt = Hash::salt(32);
                    

                    try {
                        //Grabs Input for Users Table
                        $user->create(array(
                            'username' => Input::get('User_Name'),
                            'password' => Hash::make(Input::get('password'), $salt),
                            'salt' => $salt,
                            'joined' => date('Y-m-d H:i:s'),
                            'isComplete' => 1,
                            'group' => 2,
                        ));
                    }catch (Exception $e) {
                        die($e->getMessage()); //Outputs error
                    }

                    //Code to Redirect
                    Redirect::to('../AdminPortal/AdminHome.php');

               }else {
                   foreach ($validation->errors() as $error) {
                       echo $error, '<br>';
                   }
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
        <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/EmployeeCreation.css">
    

        <title>Employee Signup</title>
    </head>
    <body>
        <div class=content>
        <form method="POST" class="EmpInfo-Form">
            <fieldset>

                <legend>Employee Account Creation</legend>
                <p>
                    <label>Username</label>
                    <input type="text" name="User_Name"  id="User_Name"><br><br>

                    <label>Password</label>
                    <input type="password" name="Password"  id="Password"><br><br>

                    <!-- <label>Enter The password again</label>
                    <input type="password" name="password_again" id="password_again"> -->

                    <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                    <input type="submit" value="Complete Employee Account"><br><br>

                </p>
            </fieldset>
        </form>
        </div>
    </body>
</html>
<?php } ?>