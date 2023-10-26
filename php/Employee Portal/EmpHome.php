<?php
session_start(); //Starts the session -- REQUIRED ON EVERY PAGE --

    require("/xampp/htdocs/PeaceOfHeavenWebPage/php/Login/connection.php"); //Needed for making login required, calls other php page
    require("/xampp/htdocs/PeaceOfHeavenWebPage/php/Login/functions.php");//Needed for making login required, calls other php page
    include("/xampp/htdocs/PeaceOfHeavenWebPage/php/Core/init.php");

    $user_data = check_login($connection); //Needed for making login required, checks credentials
    $token = new Token;
    $token->check($token);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Portal</title>
</head>
<body>

    <a href="/PeaceOfHeavenWebPage/php/Login/logout.php">Logout</a>
    <h1> Welcome to the Employee Portal </h1>
    <p>Hello, <?php echo $user_data['User_Name']; ?>! </p>

<!-- Functions to have links to other pages if you have the permission -->
<?php
    //If statement for link to customer portal
    if($user_data['PermissionLvl'] >= '0'){
        echo '<a href="/PeaceOfHeavenWebPage/php/Customer Portal/CustHome.php">Customer Portal</a><br><br>';
    }

   //If statement for link to employee portal
   if($user_data['PermissionLvl'] >= '2'){
    echo '<a href="/PeaceOfHeavenWebPage/php/AdminPortal/AdminHome.php">Admin Portal</a>';
    }
?>
 
</body>
</html>