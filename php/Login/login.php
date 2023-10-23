<?php
    session_start(); //Starts the session -- REQUIRED ON EVERY PAGE --

    include("connection.php"); //Needed for making login required, calls other php page
    include("functions.php");//Needed for making login required, calls other php page

//Check if user has clicked on the post button
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //Something was Posted
    $user_name = $_POST['User_Name'];
    $password = $_POST['Password'];

    //Check if both are empty
    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
        //All info is correct

        //Read from Database
        $query = "SELECT * FROM Login WHERE User_Name = '$user_name' limit 1"; //Gets Username
      
        

        $result = mysqli_query($connection, $query); //Results from read
        
        if($result)
        {
            if($result && mysqli_num_rows($result) > 0) //Check to confirm at least 1 result and a results
            {
                $user_data = mysqli_fetch_assoc($result); //Fetchs Results
                
                //Verfies Password and Permission Level - Sends to Customer Portal
                if(password_verify($password, $user_data['Password']) && $user_data['PermissionLvl'] === '0') //Add check for permission level
                {
                    //Kills program, assigns session and redirects
                    $_SESSION['User_ID'] = $user_data['User_ID'];
                    header("Location: /PeaceOfHeavenWebPage/php/Customer Portal/CustHome.php");
                    die;
                }
                
                //Verfies Password and Permission Level - Sends to Employee Portal
                if(password_verify($password, $user_data['Password']) && $user_data['PermissionLvl'] === '1') //Add check for permission level
                {
                    //Kills program, assigns session and redirects
                    $_SESSION['User_ID'] = $user_data['User_ID'];
                    header("Location: /PeaceOfHeavenWebPage/php/Employee Portal/EmpHome.php");
                    die;
                }

                //Verfies Password and Permission Level - Sends to Admin Portal
                if(password_verify($password, $user_data['Password']) && $user_data['PermissionLvl'] === '2') //Add check for permission level
                {
                    //Kills program, assigns session and redirects
                    $_SESSION['User_ID'] = $user_data['User_ID'];
                    header("Location: /PeaceOfHeavenWebPage/php/AdminPortal/AdminHome.php");
                    die;
                }
            }

        }
                //Message for Wrong Credentials
                echo "Wrong Username or Password!"; 
        }
        else //Message for Wrong Credentials
            {
                echo "Wrong Username or Password!";
            }
        }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/Login.css">

    <title>Login</title>
</head>
<body>
    <div class="login-container"> 
    <!--Creates the login box in html -->
        <form method="post" class="login-form">
            Username
            <input type="text" name="User_Name" id="User_Name"><br><br>
            Password
            <input type="password" name="Password" id="Password"><br><br>

            <input type="submit" value="Login"><br><br>

            <a href="signup.php"  class="signup-link">Click to Signup</a><br><br>

            <a href="/PeaceOfHeavenWebPage/php/Home.php" class="home-link">Return Home</a>
    </div>
    
</body>
</html>