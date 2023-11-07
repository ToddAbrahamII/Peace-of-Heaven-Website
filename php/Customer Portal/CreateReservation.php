<?php
    require_once '../UserHandling/core/init.php';
    
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    if($user->isLoggedIn()) {

    // //Adds Customer NavBar if Customer Acct logged in
    // if($user->data()->group == 1){
    //     include("../Customer Portal/CustNavBar.php");
    // }

    // //Adds Employee NavBar if Employee Acct logged in
    // if($user->data()->group == 2){
    //     include("../Employee Portal/EmpNavBar.php");

    // }

    // //Adds Admin NavBar if Admin Acct logged in
    // if($user->data()->group == 3 ){
    //     include("../AdminPortal/AdminNavBar.php");

    // }

    ?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/CustHome.css"> -->

    <title>Create a Reservation</title>
</head>
<body>
    <form method="POST" class="Reservation-Creator">
                <fieldset>
                        <!-- Collects information for the beginning of a reservation -->
                        <legend>Reservation Selection Start</legend>
                    <p> 
                        <!-- Allows user to select service for reservation -->
                    <label for="service">Select a Service:</label>
                    <select name="service" id="service">
                        <option value="Grooming">Grooming</option>
                        <option value="Boarding">Boarding</option>
                        <option value="Daycare">Daycare</option>
                    </select>

                    <!-- Add code for drop down menu of dogs linked to customer account --> 


                    <!-- Generates Token and submits input -->
                    <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                    <input type="submit" value="Next"><br><br>
                    </p>


                </fieldset>
    </form> 

</body>

</html>
<?php } ?>