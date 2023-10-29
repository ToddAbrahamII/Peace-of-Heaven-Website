<?php 
/*
    Controller and View to update a user's information. 
    Right now it is set to username, but other profile updates should be added here.

*/
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
    Redirect::to('index.php');

}

if(Input::exists()) {
    echo 'exists';
    if(Token::check(Input::get('token'))) {
        
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required'=> true,
                'min' => 2,
                'max'=> 80,
                'unique' => 'users'           
            ) 
        ));   

        if($validation->passed()) {
            // Update information
            try {
                $user->update(array(
                    'username'=> Input::get('username')
                ));
            } catch (Exception $e) {
                die($e->getMessage());
            }

        } else {
            foreach($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
        
    }
}
?>

<form action="" method="post"> <!-- Something is wrong here, but IDK what -->
    <div class="field">
        <label for="username">Name</label>
        <input type="text" name="username" value="<?php echo escape($user->data()->username); ?>">

        <input type="submit" value="Update">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

    </div>
</form>