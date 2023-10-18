<?php
session_start(); //Starts the session -- REQUIRED ON EVERY PAGE --

    require("/xampp/htdocs/PeaceOfHeavenWebPage/php/Login/connection.php"); //Needed for making login required, calls other php page
    require("/xampp/htdocs/PeaceOfHeavenWebPage/php/Login/functions.php");//Needed for making login required, calls other php page

    $user_data = check_login($connection); //Needed for making login required, checks credentials

?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Portal</title>
</head>
<body>

    <a href="logout.php">Logout</a>
    <h1> Welcome to the Customer Portal </h1>
    <p>Hello, <?php echo $user_data['User_Name']; ?>! </p>
 
</body>
</html>