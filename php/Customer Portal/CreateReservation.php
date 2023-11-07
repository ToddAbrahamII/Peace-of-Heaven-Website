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
                                        $dogName = $dog->DogName;
                                        echo "<option value='$dogName'>$dogName</option>";
                                    } ?>
                                    </select>
                                

                            <?php
                        } else {
                            echo "No dogs found for the customer.";
                        }
                        ?>
                                <a href="../Forms/DogAccountInfo.php">Create a Dog Account</a>
                                
                    

                    <!-- Generates Token and submits input -->
                    <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                    <input type="submit" value="Next"><br><br>
                    </p>


                </fieldset>
        </form> 
    </div>

</body>

</html>
<?php }else{Redirect::to('../UserHandling/login.php');} ?>