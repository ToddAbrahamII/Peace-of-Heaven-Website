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

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/AdminHome.css">

    <title>Admin Portal</title>
</head>
<body>
    <div class=content>
         <!-- Box to style welcome statement -->
        <div class="header">
            <div class="welcome-box">
            <h1>Welcome to the Admin Portal</h1>
            </div>
        </div>

        <!-- View for Today's Reservations -->
        <h2>Todays Date: 11/9/2023</h2>
        <h2>Today's Reservations</h2>
        <table>
            <thead>
            <tr>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Dog</th>
                <th>Service</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <!-- PHP Load Data Here -->     
            </tbody>
        </table>
        <br><br>

        <!-- Table for Pending Reservations with Confirm and Deny Buttons -->
        <h2>Pending Boarding and DayCare Reservations </h2>
        <table>
            <thead>
            <tr>
                <th>Date Range</th>
                <th>Dog</th>
                <th>Service</th>
                <th>Option</th>
            </tr>
            </thead>
            <tbody>
            <!-- PHP Load Data Here -->     
            <?php
                $reservation = new Reservation('boarding', array());
                $dog = new Dog();

                // grabs all unapproved boarding and daycare reservations
                $reservation->getUnapprovedReservations();
                $allReservations = $reservation->getReservationData();
                
                print_r('fuck this class');

                //check for results
                if(!empty($allReservations)) {
                    // iterate through table rows
                    foreach($allReservations as $reservation) {
                        //populates rows 
                        echo '<tr>';
                        echo '<td>' . $reservation->ResStartDate . ' - ' . $reservation->ResEndDate . '</td>';

                        //Finds the dog name with their ID
                        $dog->findDogInfoWithDogID($reservation->DogID);
                        $dogName = $dog->data()->DogName;

                        echo '<td>' . $dogName . '</td>';
                        echo '<td>' . $reservation->getReservationData()-> ServiceType .'</td>';
                        echo '<td><a href="../AdminPortal/AppointmentApproval.php?custid=' . $reservationGrooming->CustID . '&dogid=' . $reservationGrooming->DogID . '&reservationid=' . $reservationGrooming->GroomResID . '&service=Grooming">View Appointment</a></td>';
                        echo '</tr>';
                    }
                }



            ?>
            </tbody>
        </table>
        <br><br>

        <!-- Table for Checked In Dogs -->
        <h2>Checked-In Dogs</h2>
        <table>
            <thead>
            <tr>
                <th>Dog</th>
                <th>Breed</th>
                <th>Date of Birth</th>
                <th>Service</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <!-- PHP Load Data Here -->     
            </tbody>
        </table>
        <br><br>

         <!-- Table for Pending Reservations with Confirm and Deny Buttons -->
         <h2>Pending Grooming Reservations </h2>
        <table>
            <thead>
            <tr>
                <th>Time Range</th>
                <th>Dog</th>
                <th>Description</th>
                <th>Service</th>
                <th>Option</th>
            </tr>
            </thead>
            <tbody>
            <!-- Loads all unapproved grooming appointments --> 
            <?php

            //Load all grooming appointments where IsApproved = 0

            //Constructor Call
            $groomingReservation = new GroomingReservation('Grooming', array());
            $dog = new Dog();

            //Grabs all unapproved grooming reservations
            $groomingReservation->getUnApprovedReservations();
            $allGroomingData = $groomingReservation->getReservationData();

            //Checks that query has results
            if(!empty($allGroomingData)){
                //Goes through each table row

                foreach ($allGroomingData as $reservationGrooming){
                    //populates rows
                    echo '<tr>';
                    echo '<td>'. $reservationGrooming->ResStartDate . ' - ' .  $reservationGrooming->ResEndDate.'</td>';

                    //Finds the dog name with their ID
                    $dog->findDogInfoWithDogID($reservationGrooming->DogID);
                    $dogName = $dog->data()->DogName;

                    echo '<td>'. $dogName . '</td>';
                    echo '<td>'. $reservationGrooming->GroomingDesc. '</td>';
                    echo '<td>Grooming</td>';
                    echo '<td><a href="../AdminPortal/AppointmentApproval.php?custid=' . $reservationGrooming->CustID . '&dogid=' . $reservationGrooming->DogID . '&reservationid=' . $reservationGrooming->GroomResID . '&service=Grooming">View Appointment</a></td>';
                    echo '</tr>';
             }
            }
            ?> 
            </tbody>
        </table>
        <br><br>
  
</div>
</body>
</html>
<?php 
    //Gathers Data if anything is submitted
    if(Input::exists()){
        
    }


}else{Redirect::to('../UserHandling/login.php');} ?>