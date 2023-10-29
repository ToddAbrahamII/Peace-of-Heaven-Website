<?php 
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        echo 'OK!';
    }
}
?>

<form action="" method="post">
    <div class="field">
        <label for="password_current">Current Password</label>
        <input type="text" name="password_current" id="password_current">
    </div>

    <div class="field">
        <label for="password_new">New Password</label>
        <input type="text" name="password_new" id="password_new">
    </div>

    <div class="field">
        <label for="password_new_again">New Password Again</label>
        <input type="text" name="password_new_again" id="password_new_again">
    </div>

    <input type="submit" value="Change">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
   
</form>