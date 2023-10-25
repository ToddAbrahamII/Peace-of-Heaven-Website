<?php
session_start(); //Starts the session -- REQUIRED ON EVERY PAGE --

    include("connection.php"); //Needed for making login required, calls other php page
    include("functions.php");//Needed for making login required, calls other php page
    include("/xampp/htdocs/PeaceOfHeavenWebPage/php/Core/init.php");

    //Check if user has clicked on the post button
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //Grabs Username from encryption
        $user_name = $_POST['User_Name'];
        $password = $_POST['Password'];
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT); //Password is Encrypted

        //Check if both are empty
        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            //All info is correct

            //Create User_Id
            $user_id = random_num(20);

            //Save to Database
            $query = "INSERT INTO login (User_ID, User_Name, Password) values ('$user_id', '$user_name', '$hashed_pass')";
            mysqli_query($connection, $query);
            //Add second query that adds USERID into Customer table 
            $query1 = "INSERT INTO customer (User_ID) values ('$user_id')";
            mysqli_query($connection, $query1);


            //Redirects             Add a page here that goes to a page that collects, name, email, phone, address, etc. 
            header("Location: acctinfo.php");
            die;

        }else //Message for Wrong info
        {
            echo "<p class='invalid_username'>Please Enter Valid Information!</p>";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/Signup.css">
    <script src="/PeaceOfHeavenWebPage/JavaScript/signup.js"></script>

    <title>Signup</title>
</head>
<body>
    <div class="signup-container"> 
    <!--Creates the Signup box in html -->
        <form method="POST" class="signup-form">
            Username
            <input type="text" name="User_Name"  id="User_Name"><br><br>
            Password
            <input type="password" name="Password"  id="Password"><br><br>

            <input type="submit" value="Signup"><br><br>

            <a href="Login.php" class = "login-link">Click to Login</a><br><br>
            <a href="/PeaceOfHeavenWebPage/php/Home.php" class="home-link">Return Home</a>
    </div>
    
</body>
</html>