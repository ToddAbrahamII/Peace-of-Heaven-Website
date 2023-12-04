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
            <h1>Manage Customers</h1>
            </div>
        </div>

        <!-- Table for All Customers -->
        <h2>All Dogs</h2>
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Breed</th>
                <th>Color</th>
                <th>Age</th>
                <th>Owner</th>
                <th>Weight</th>
                <th>Color</th>
                <th>Dog Notes</th>
                <th>Manage</th>
            </tr>
            </thead>
            <tbody>
            <?php
                //Constructor Calls
                $reservation = new Reservation('service', array());
                $dog = new Dog();
                $customer = new Customer();

                //Gathers the data
                $dog->findAllDogs();
                $allDogs = $dog->data();

//                print_r($allCustomers);
//                print_r($allReservations);

                if(!empty($allDogs)){
                    
                    foreach ($allDogs as $dog){

                     
                        // Get Customer Data 
                        $customer->findCustInfoWithCustID($dog->CustID);
                        $customerData = $customer->getCustomerData();
                        echo '<tr>'; // START ROW
                        echo '<td>' . $dog->DogName . '</td>';
                        echo '<td>' . $dog->Breed . '</td>';
                        echo '<td>' . $dog->Color . '</td>';
                        echo '<td>' . $dog->DogDOB .'</td>';
                        echo '<td>' . $customerData->CustFirstName . ' ' . $customerData->CustLastName . '</td>';
                        echo '<td>' . $dog->Weight . '</td>';
                        echo '<td>' . $dog->Color . '</td>';
                        echo '<td>' . $dog->DogOtherInfo . '</td>';
                        echo '<td>' 
                            . '<p><a href="ManageDogInfo.php?DogID='
                            . urlencode($dog->DogID) .'">Manage</a></p>'.
                            '</td>';
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