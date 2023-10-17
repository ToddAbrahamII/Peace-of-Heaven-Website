<?php
session_start(); //Starts the session -- REQUIRED ON EVERY PAGE --

    include("connection.php"); //Needed for making login required, calls other php page
    include("functions.php");//Needed for making login required, calls other php page

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

            header("Location: login.php");
            die;

        }else //Message for Wrong info
        {
            echo "Please Enter Valid Information!";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
    <div> 
    <!--Creates the Signup box in html -->
        <form method="POST">
            Username
            <input type="text" name="User_Name"><br><br>
            Password
            <input type="password" name="Password"><br><br>

            <input type="submit" value="Signup"><br><br>

            <a href="Login.php">Click to Login</a>
    </div>
    
</body>
</html>