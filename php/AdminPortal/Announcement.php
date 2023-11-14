<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    if($user->isLoggedIn()) {

       //Adds Admin NavBar if Admin Acct logged in
       if($user->data()->group == 3) {
        include("../AdminPortal/AdminNavBar.php");

    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/Announcement.css">

    <title>Announcement Page</title>
</head>
    <body> 
        <div class=content>
           
            <h2>Announcement Form</h2>

                <form action="#" method="post">
                <label for="textArea">Enter Announcement Message:</label>
                <textarea id="textArea" name="textArea" rows="4" cols="50"></textarea>

            <br>

            <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
            <input type="submit" value="Submit">
    </form>
        </div>
    </body>
</html>

<?php
    }else{Redirect::to('../UserHandling/login.php');}
?>
