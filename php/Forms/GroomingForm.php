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
                <legend>Grooming Reservation Request</legend>

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
                        } else  {
                            // Prints No Dogs Statement
                            echo "No dogs found for the customer.";
                        }
                        ?>
                                <!-- Link to Create a Dog Account -->
                                <br><a href="../Forms/DogAccountInfo.php">Create a Dog Account</a><br>
                        
                        <!-- User selects a week -->
                        <label for="week">Select a Week for a Grooming Appointment</label>
                        <input type = "week", id="week", name="week">
                        
                        <!-- Generates Token and submits input -->
                        <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                        <input type="submit" value="Next"><br><br>

                        <p>Grooming Appointment are requested for a certain week.<br>
                            After a Grooming Appointment Request is sent, we will call you and schedule a time during that week for the appointment.</p>

                        <?php 
                        if(Input::exists()){
                               
                            if(Token::check(Input::get('token')) || 1==1) {
                                $validate = new Validate();
                                $validation = $validate->check($_POST, array(
                                    ### Insert rules that acctInfo fields must meet in addition to js validation ###
                                ));
                    
                                // If all rules are satisfied, create new customer
                                if($validation->passed()) {
                                    try{ 
                                        //Gets the selected Dogs Info
                                        $selectedDogID = Input::get('selectedDog');
                                        $selectedDog = new Dog();
                                        $selectedDog->findDogInfoWithDogID($selectedDogID);
                                        $dogSelected = $selectedDog->data();

                                        //constructor call for reservation
                                        $reservation = new Reservation('Grooming', array($dogSelected));

                                        //Add reservation to reservation table
                                        $reservation->createReservation(array(
                                            
                                            //'ResStartTime' => ,
                                            //'ResEndTime' =>,
                                            //'EmerContact' => Input::get(),
                                            //'EmerPhone' => Input::get(),
                                            'isCheckedIn' => 0,
                                            'ServiceType' => 'Grooming',
                                            'isApproved' => 0,
                                            'CustID' => $custid,
                                            'DogID' => $selectedDog->data()->DogID
                                        ));

                                        //If statement for if dog has forms


                                        //if statement for if dog has no forms

                                    } 
                                    //Error Handling
                                    catch(Exception $e) {
                                        die($e->getMessage());
                                        
                                    }
                                }else { ## Is this an error?
                                    // output errors
                                    foreach ($validation->errors() as $error) {
                                        echo $error, '<br>';
                            }

                        }
                    }
                }

                    
                        
                        ?> 
                        

                        
            </fieldset>
        </form> 
    </div>
</body>

</html>
<?php }else{Redirect::to('../UserHandling/login.php');} ?>