<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    if($user->isLoggedIn()) {
        
    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group == 3) {
        include("../AdminPortal/AdminNavBar.php");

    }

    //Grabs all sessions variables from the previous page
    if (isset($_GET['custid']) && isset($_GET['dogid']) && isset($_GET['reservationid'])) {
        $_SESSION['custid'] = $_GET['custid'];
        $_SESSION['dogid'] = $_GET['dogid'];
        $_SESSION['reservationid'] = $_GET['reservationid'];
        $_SESSION['service'] = $_GET['service'];
    }

    // <!--PHP If Statement for Grooming Appointment Details-->
    if($_SESSION['service'] == 'Grooming')
    {
        //Code to Show Appointment Time Range

        //Code to show Customer Name

        //Code to show Customer Phone

        //Code to Show Customer Email

        //Code to Show Dog Name

        //Code to Show Dog Info

        //Code to Select a Date for appointment
    }

    //<!--PHP If Statement for Boarding Appointment Details -->
        //Code to Show Appointment Date

        //Code to show Customer Name

        //Code to show Customer Phone

        //Code to Show Customer Email

        //Code to Show Dog Name

        //Code to Show Dog Info

        //Code to show dog vaccine, health, and behavior

        
    //<!--PHP If Statement for Day Appointment Details -->
        //Code to Show Appointment Date

        //Code to show Customer Name

        //Code to show Customer Phone

        //Code to Show Customer Email

        //Code to Show Dog Name

        //Code to Show Dog Info

        //Code to show dog vaccine, health, and behavior

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/AppointmentApproval.css">

    <title>Appointment Details</title>
</head>
<body>
    <div class=content>
        <h1> Appointment Details </h1>

        <?php
        //Prints Session Variables depending on selected appointment
            print_r($_SESSION['custid']);
            echo '<br>';
            print_r( $_SESSION['dogid']);
            echo '<br>';
            print_r($_SESSION['reservationid']);
            echo '<br>';
            print_r($_SESSION['service']);
        ?>
      


    </div>
</body>
</html>
<?php
    }else(Redirect::to('../UserHandling/login.php'));
?>