<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    if($user->isLoggedIn()) {
        
    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group === '3' ||  $user->data()->group === 3 ){
        include("../AdminPortal/AdminNavBar.php");

    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/AdminHome.css">

    <title>Admin Portal</title>
</head>
<body>
    <div class=content>
    <h1> Welcome to the Admin Portal </h1>
    <p>Hello, <?php echo $user_data['User_Name']; ?>! </p>
 
<!-- Functions to have links to other pages if you have the permission -->
<?php 
 
?>
</div>
</body>
</html>
<?php } ?>