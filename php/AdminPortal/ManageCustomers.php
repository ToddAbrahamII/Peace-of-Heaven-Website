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
        <h2>All Customers</h2>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Street</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Email</th>
                <th>UserID</th>
            </tr>
            </thead>
            <tbody>
            <?php
                //Constructor Calls
                $reservation = new Reservation('service', array());
                $dog = new Dog();
                $customer = new Customer();

                //Gathers the data
                $customer->getAllCustomers();
                $allCustomers = $customer->getCustomerData();
//                print_r($allCustomers);
                $reservation->getConfirmedReservations();
                $allReservations = $reservation->getReservationData();
//                print_r($allReservations);

                if(!empty($allCustomers)){

                    foreach ($allCustomers as $customer){
                        echo '<tr>'; // START ROW

                        echo '<td>' . $customer->CustID . '</td>';
                        echo '<td>' . $customer->CustFirstName . '</td>';
                        echo '<td>' . $customer->CustLastName . '</td>';

                        echo '<td>' . $customer->CustPhone .'</td>';
                        echo '<td>' . $customer->CustAddress . '</td>';
                        echo '<td>' . $customer->CustCity . '</td>';
                        echo '<td>' . $customer->CustState . '</td>';
                        echo '<td>' . $customer->CustZip . '</td>';
                        echo '<td>' . $customer->AcctEmail . '</td>';
                        echo '<td>' . $customer->User_ID . '</td>';
                        echo '<td>'
                            . '<p><a href="UpdateCustomer.php?CustID='
                            . urlencode($customer->CustID) .'">Update</a></p>'.
                            '</td>';
                        
    
                        echo '</tr>';

                    }
                }
            // TEST UPDATE USER
            $key = 'CustID';
            $customerId = 22;
            $fieldsToUpdate = array(
                'CustFirstName' => 'NewFirstName',
                'CustLastName'  => 'NewLastName',
                'CustPhone'      => '1234567890',
                'CustAddress'     => 'NewStreetAddress',
                'CustCity'       => 'NewCity',
                'CustState'      => 'NewState',
                'CustZip'        => '11122',
                'AcctEmail'      => 'newemail@example.com'
            );

            $customer = new Customer();
            $customer->update($fieldsToUpdate, $key, $customerId);


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