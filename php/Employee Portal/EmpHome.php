<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    if($user->isLoggedIn()) {

    //Adds Employee NavBar if Employee Acct logged in
    if($user->data()->group == 2 ){
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
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/EmpHome.css">

    <title>Employee Portal</title>
</head>
<body>
    <div class=content>
    <!-- Box to style welcome statement -->
    <div class="header">
        <div class="welcome-box">
        <h1>Welcome to the Employee Portal</h1>
        </div>
    </div>
<!-- Table for Checked In Dogs -->
<h2>Checked-In Dogs</h2>
        <table>
            <thead>
            <tr>
                <th>Dog</th>
                <th>Reservation Date</th>
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

        <div class="button-container">
            <a class="check-in-button" href='/PeaceOfHeavenWebPage/php/Employee Portal/CheckIn.php'><button>Check-In Dog</button></a>
            <a class="check-out-button" href='/PeaceOfHeavenWebPage/php/Employee Portal/CheckOut.php'><button>Check-Out Dog</button></a>
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

    </div>
</body>
</html>
<?php } ?>