<?php
    require_once '../UserHandling/core/init.php';
    
    //Make sure session is logged in
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    //Class Calls
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

    <title>Create a Reservation</title>
</head>
<body>
    <div class='content'>
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

                    <!-- Php code for drop down menu for dogs --> 
                    <?php
                        //Matches UserID to CustID with account logged in
                        $customer->findCustInfo($user->data()->id);

                        //Stores the CustID
                        $custid = $customer->data()->CustID;

                        //Finds all Dogs linked by CustID
                        $dog->findDogArray($customer->data()->CustID);

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
                        ?>
                                <!-- Link to Create a Dog Account -->
                                <a href="../Forms/DogAccountInfo.php">Create a Dog Account</a>
                                
                    <!-- Generates Token and submits input -->
                    <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                    <input type="submit" value="Next"><br><br>

                    <?php 

                    //Stores the dog name that is selected
                    $dogID = Input::get('selectedDog');
            
                    //Query to Grab Dog Data for the selected Dog
                    $dog->findDogInfo($dogID);

                    //Stores which service was selected
                    $serviceCheck = Input::get('service');

                    //If Statement for if dog doesn't have forms already -
                    if($dog->findDogInfo($selectedDog)){

                        print_r('great success!');

                    }
                    
                    //If statement for if dog has forms

                 

                    // Create reservation
                    // $reservation = new Reservation($serviceCheck, array($selectedDog)); // ToDO:: need array of selected dogs

                    // try {
                    //     $reservation->createReservation(array(
                    //         'ResStartTime' => '2023-11-07', // temporary hard code date
                    //         'ResEndTime' => '2023-11-07',
                    //         'EmerContact' => 'test',
                    //         'EmerPhone' => 12345,
                    //         'isCheckedIn' => 0,
                    //         'ServiceType' => 'Testboarding',
                    //         'isApproved' => 0,
                    //         'CustId' => 1,
                    //         'DogId' => 2,
                    //         'KennelID' => 3
                    //     ));

                    //     Session::flash('home', 'You have been registered and can now log in!');
                    //     Redirect::to('login.php'); //once logged in, send user to index page

                    // } catch (Exception $e) {
                    //     die($e->getMessage());
                    // }

                    //If Statement for if dog does not have forms


                    ?>

                    </p>


                </fieldset>
        </form> 
    </div>

</body>

</html>
<?php }else{Redirect::to('../UserHandling/login.php');} ?>