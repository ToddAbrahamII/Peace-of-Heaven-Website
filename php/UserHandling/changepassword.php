<?php 
require_once 'core/init.php';

    $user = new User();

    if(!$user->isLoggedIn()) {
        Redirect::to('../UserHandling/login.php');
    }

    //Adds Employee NavBar if Employee Acct logged in
    if($user->data()->group == 1){
        include("../Customer Portal/CustNavBar.php");

    }

    //Adds Employee NavBar if Employee Acct logged in
    if($user->data()->group == 2){
        include("../Employee Portal/EmpNavBar.php");

    }

    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group == 3 ){
        include("../AdminPortal/AdminNavBar.php");

    }

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'password_current' =>array(
                'required'=> true,
                'min'=> 6,
                'max'=> 64
            ),
            'password_new'=>array(
                'required'=> true,
                'min'=> 6,
                'max'=> 64
            ),
            'password_new_again'=>array(
                'required'=> true,
                'min'=> 6,
                'max'=> 64,
                'matches'=> 'password_new'
            )
        ));

        if($validation->passed()) {
            // change password
            if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password){
                echo 'Your current password is wrong.';
            } else { // passwords match
                $salt = Hash::salt(32);
                $user->update(array(
                    'password' => Hash::make(Input::get('password_new'), $salt),
                    'salt' => $salt
                ));

                Session::flash('home','Your password has been changed!');
                Redirect::to('../Customer Portal/CustHome.php');
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
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/ChangePass.css">

    <title>Check In Portal</title>
</head>
<body> 
<div class=content>
<form action="" method="post">
    <div class="field">
        <label for="password_current">Current Password</label>
        <input type="password" name="password_current" id="password_current">
    </div>

    <div class="field">
        <label for="password_new">New Password</label>
        <input type="password" name="password_new" id="password_new">
    </div>

    <div class="field">
        <label for="password_new_again">New Password Again</label>
        <input type="password" name="password_new_again" id="password_new_again">
    </div>

    <input type="submit" value="Change">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
   
</form>
</div>
</body>
</html>