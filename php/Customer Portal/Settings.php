<?php
    require_once '../UserHandling/core/init.php';
    
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    if($user->isLoggedIn()) {

    //Adds Employee NavBar if Employee Acct logged in
    if($user->data()->group == 1){
        include("../Customer Portal/CustNavBar.php");

    }

    //Adds Employee NavBar if Employee Acct logged in
    if($user->data()->group == 2){
        include("../Employee Portal/EmpNavBar.php");

    }

    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group == 3 ){
        include("../AdminPortal/AdminNavBar.php");

    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/CustHome.css">

    <title>Check In Portal</title>
</head>
<body> 
<div class=content>
    <h1>Account Settings</h1>

    <!-- Change Password -->
    <a href="change_password.php"><button>Change Password</button></a><br><br>

    <!-- Update Personal Information -->
    <a href="update_personal_info.php"><button>Update Personal Info</button></a><br><br>

    <!-- Update Dog Information -->
    <a href="update_dog_info.php"><button>Update Dog Info</button></a><br><br>

    <!-- Update Dog Form Information -->
    <a href="update_dog_form_info.php"><button>Update Dog Form Info</button></a><br><br>

    <!-- Logout -->
    <a href="logout.php"><button>Logout</button></a>

</div>
</body>
</html>
<?php }else{Redirect ::to('../UserHandling/login.php');}