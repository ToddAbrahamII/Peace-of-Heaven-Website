<?php
require_once '../UserHandling/core/init.php';

//Make sure session is logged in
if (!Session::exists('home')) {
    echo '<p>'. Session::flash('home') .'</p>';
}

//Class Constructor Calls
$user = new User();
$customer = new Customer();
$dog = new Dog();

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

?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/CreateReservation.css">
</head>
<body>
<div class='content'>
    <form method="POST" class="Grooming-Creator">
        <fieldset>
            <legend>Boarding Reservation Request</legend>

            <!-- Php code for drop down menu for dogs -->
            <?php
            //Matches UserID to CustID with account logged in
            $customer->findCustInfo($user->data()->id);

            //Stores the CustID
            $custid = $customer->data()->CustID;

            //Finds all Dogs linked by CustID
            try {
                $dogs = $dog->findDogArray($customer->data()->CustID);
            } catch (Exception $e) {
                echo 'no dog found';
            }

            //Stores the Dogs Found
            $dogData = $dog->data();

            // Check if $dogData is not empty
            if (!empty($dogData)) {
                ?>
                <!-- Dog Option for Each Dog in the Table -->
                <label for="dogDropdown">Select a dog:</label>
                <select id="dogDropdown" name="selectedDog">
                    <?php foreach ($dogData as $dog) {
                        $dogID = $dog ->DogID;
                        $dogName = $dog->DogName;
                        echo "<option value='$dogID'>$dogName</option>";
                    } ?>
                </select>


                <?php
            } else {
                // Prints No Dogs Statement
                echo "No dogs found for the customer.";
            }


            //create reservation
            $reservation = new Reservation($custid);

            //Grab selected dog data

            echo '5454554545';
            $reservation->setDogId($dogID);

            print_r($reservation);



            ?>
            <!-- Link to Create a Dog Account -->
            <a href="../Forms/DogAccountInfo.php">Create a Dog Account</a>
        </fieldset>
    </form>
</div>
</body>

</html>
<?php }else{Redirect::to('../UserHandling/login.php');} ?>