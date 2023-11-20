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

        <!-- View for Boarding and Daycare Reservations -->
        <h2>All Confirmed Upcoming Boarding and Daycare Reservations</h2>
        <table>
            <thead>
            <tr>
                <th>Date Range</th>
                <th>Dog</th>
                <th>Service</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
                //Constructor Calls
                $reservation = new Reservation('service', array());
                $dog = new Dog();
                $customer = new Customer();

                //Gathers the data
                $reservation->getConfirmedReservations();
                $allReservations = $reservation->getReservationData();

                if(!empty($allReservations)){

                    foreach ($allReservations as $reservation){
                        echo '<tr>';
                        echo '<td>' . $reservation->ResStartTime . '-'.$reservation->ResEndTime.'</td>';

                        //Finds the dog name with their ID
                        $dog->findDogInfoWithDogID($reservation->DogID);
                        $dogName = $dog->data()->DogName;

                        echo '<td>'.$dogName.'</td>';
                        echo '<td>' . $reservation->ServiceType .'</td>';
                        echo '<td> Confirmed </td>';
                        echo '</tr>';

                    }
                }

            ?>

            </tbody>
        </table>
        <br><br>

                <!-- View for Confirmed Grooming Reservations-->
                <h2>All Confirmed Upcoming Grooming Reservations</h2>
        <table>
            <thead>
            <tr>
                <th>Date Range</th>
                <th>Dog</th>
                <th>Description</th>
                <th>Service</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
                //Constructor Calls
                $reservation = new GroomingReservation('service', array());
                $dog = new Dog();
                $customer = new Customer();

                //Gathers the data
                $reservation->getConfirmedGroomingReservations();
                $allReservations = $reservation->getReservationData();

                if(!empty($allReservations)){

                    foreach ($allReservations as $reservation){
                        echo '<tr>';
                        echo '<td>' . $reservation->ResStartDate . '</td>';

                        //Finds the dog name with their ID
                        $dog->findDogInfoWithDogID($reservation->DogID);
                        $dogName = $dog->data()->DogName;

                        echo '<td>'.$dogName.'</td>';
                        $groomDesc = $reservation->GroomingDesc;
                        echo '<td>'.$groomDesc.'</td>';
                        echo '<td> Grooming </td>';
                        echo '<td> Confirmed </td>';
                        echo '</tr>';

                    }
                }

            ?>

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
            <?php
            //Constructor Calls
                $reservation = new Reservation('boarding', array());
                $dog = new Dog();

                // grabs all unapproved boarding and daycare reservations
                $reservation->getUnapprovedReservations();
                $allReservations = $reservation->getReservationData();

                //check for results
                if(!empty($allReservations)) {
                    // iterate through table rows
                    foreach($allReservations as $reservation) {
                        //populates rows 
                        echo '<tr>';

                        //change to if statement
                        echo '<td>' . $reservation->ResStartTime . ' - ' . $reservation->ResEndTime . '</td>';

                        //Finds the dog name with their ID
                        $dog->findDogInfoWithDogID($reservation->DogID);
                        $dogName = $dog->data()->DogName;

                        echo '<td>' . $dogName . '</td>';
                        echo '<td>' . $reservation->ServiceType .'</td>';
                        echo '<td><a href="../AdminPortal/AppointmentApproval.php?custid=' . $reservation->CustID . '&dogid=' . $reservation->DogID . '&reservationid=' . $reservation->Res_ID . '&service=' . $reservation->ServiceType . '">View Appointment</a></td>';
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
                <th>Reservation Date</th>
                <th>Print</th>
                <th>Breed</th>
                <th>Date of Birth</th>
                <th>Service</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            //Constructor Call
            $reservation = new Reservation('reservation', array());
            $dog = new Dog();

            //store checkedInReservation
            $reservation->getCheckedInReservations();
            $reservationData = $reservation->getReservationData();
            //print checked in reservation


            if(!empty($reservationData)){
                //Goes through each table row

                foreach ($reservationData as $reservation){

                    echo '<tr>'; // row start


                    //Finds the dog name with their ID
                    $dog->findDogInfoWithDogID($reservation->DogID);



                    $dogData = $dog->data();
                    $dogName = $dog->data()->DogName;

                    echo '<td>'. $dogName . '</td>';
                    echo '<td>'. $reservation->ResStartTime . ' - ' .  $reservation->ResStartTime . '</td>';
                    echo '<td><a href="">'. $dogName . '</td>';
                    echo '<td>' . $dogData->Breed . '</td>';
                    echo '<td>' . $dogData->DogDOB . '</td>';
                    echo '<td>' . $reservation->ServiceType . '</td>';
                    echo '<td>' . $reservation->isApproved . '</td>';
                    echo '</tr>';
                }
            }
            ?>
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