<?php
session_start(); //Starts the session -- REQUIRED ON EVERY PAGE --

    require("/xampp/htdocs/PeaceOfHeavenWebPage/php/Login/connection.php"); //Needed for making login required, calls other php page
    require("/xampp/htdocs/PeaceOfHeavenWebPage/php/Login/functions.php");//Needed for making login required, calls other php page
    include("/xampp/htdocs/PeaceOfHeavenWebPage/php/Core/init.php");

    $user_data = check_login($connection); //Needed for making login required, checks credentials

    //Displays Employee's Navigation Bar
    if($user_data['PermissionLvl'] === '1'){
        include("/xampp/htdocs/PeaceOfHeavenWebPage/php/Employee Portal/EmpNavBar.php");
        }

    //Displays Admin's Navigation Bar
    if($user_data['PermissionLvl'] === '2'){
        include("/xampp/htdocs/PeaceOfHeavenWebPage/php/AdminPortal/AdminNavBar.php");
        }

    $token = new Token;
    $token->check($token);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/EmpHome.css">

    <title>Employee Portal</title>
</head>
<body>
    <div class=content>
    <h1> Welcome to the Employee Portal </h1>
    <p>Hello, <?php echo $user_data['User_Name']; ?>! </p>

    </div>
</body>
</html>