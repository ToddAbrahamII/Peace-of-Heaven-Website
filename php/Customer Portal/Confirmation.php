<?php
    require_once '../UserHandling/core/init.php';
    
    //Make sure session is logged in
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    //Class Constructor Call
    $user = new User();


    //Checks if user is logged in
    if($user->isLoggedIn()) {

    //Adds Customer NavBar if Customer Acct logged in
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Request Confirmation</title>
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/Confirmation.css">
</head>
<body>
    <div class="confirmation-container">
        <img src="/PeaceOfHeavenWebPage/Img/greencheckmark.png" alt="Green Checkmark" class="checkmark-img">
        <h1>Thank you for requesting with us today!</h1>
        <p>We will review the appointment and reach out by phone when it has been confirmed.</p>
        <a href="../Customer Portal/CustHome.php">
            <button class="Return-Home-Button">Return Home</button>
        </a>
    </div>

</body>
</html>



    <?php
    }
    ?>