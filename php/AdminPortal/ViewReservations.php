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
            <h1>Manage Reservations</h1>
            </div>
        </div>
        <!-- https://www.kryogenix.org/code/browser/licence.html Licence for code that makes the list sortable by columns-->
            <script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>

        <!-- Table for All Customers -->
        <h2>All Future Reservations</h2>
        <table  class="sortable">
            <thead>
            <tr>
                <th class="sortHeader">Reservation #</th>
                <th class="sortHeader">Start Date</th>
                <th class="sortHeader">End Date</th>
                <th class="sortHeader">Customer</th>
                <th class="sortHeader">Phone</th>
                <th class="sortHeader">Dog</th>
                <th class="sortHeader">Reservation Type</th>
                <th class="sortHeader">Dog Notes</th>
                <th class="sortHeader">Update</th>
                <th class="sortHeader">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
                //Constructor Calls
                $reservation = new Reservation('service', array());
                $dog = new Dog();
                $customer = new Customer();

                //Gathers the data
                $reservation->getAllReservationsView();
                $allReservations = $reservation->getReservationData();
                        

                if(!empty($allReservations)){
                    
                    foreach ($allReservations as $reservation){
                     
                        // Get Customer and Dog Data for each reservation
                        $customer->findCustInfoWithCustID($reservation->CustID);
                        $customerData = $customer->getCustomerData();
                        $dog->findDogInfoWithDogID($reservation->DogID);
                        $dogData = $dog->data();

                        echo '<tr>'; // START ROW
                        echo '<td>' . $reservation->Res_ID . '</td>';
                        echo '<td>' . $reservation->ResStartTime . '</td>';
                        echo '<td>' . $reservation->ResEndTime . '</td>';
                        echo '<td>' . $customerData->CustFirstName . ' ' . $customerData->CustLastName . '</td>';
                        echo '<td>' . $customerData->CustPhone . '</td>';
                        echo '<td>' . $dogData->DogName . '</td>';
                        echo '<td>' . $reservation->ServiceType . '</td>';
                        echo '<td>' . $reservation->ResDesc . '</td>';
                        echo '<td>' 
                                . '<p><a href="UpdateReservation.php?Res_ID='
                                    . urlencode($reservation->Res_ID)
                                . '&ServiceType=' . urlencode($reservation->ServiceType) . '">Update</a></p>'
                            . '</td>';

                        echo '<td>' 
                            . '<p><a href="DeleteReservation.php?Res_ID='
                                . urlencode($reservation->Res_ID)
                            . '&ServiceType=' . urlencode($reservation->ServiceType) . '">Delete</a></p>'
                            . '</td>';
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



}else{Redirect::to('../UserHandling/login.php');} ?>