<?php
    require_once '../UserHandling/core/init.php';

    //Displays Admin's Navigation Bar
    if($user_data['PermissionLvl'] === '2'){
        include("/xampp/htdocs/PeaceOfHeavenWebPage/php/AdminPortal/AdminNavBar.php");
        }

    //Checks the login in the NavBar .php page
    $token = new Token;
    $token->check($token);
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
<?php> } ?>