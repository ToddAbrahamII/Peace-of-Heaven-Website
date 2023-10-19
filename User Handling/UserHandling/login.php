<?php 
require_once 'core/init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        
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
        <input type="text" name="password" id="password" autocomplete="off">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Log in">
</form>