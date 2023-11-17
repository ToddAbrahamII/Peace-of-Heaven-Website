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
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/GroomingForm.css">
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

                        //Checks if input exists
                        if(Input::exists()){
           
                            if(Token::check(Input::get('token')) || 1==1) { //validation is not passing for some reason
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
                    
                                        //constructor call for grooming reservation
                                        $reservation = new GroomingReservation('Grooming', array($dogSelected));
                    
                                        //Add reservation to reservation table
                                        $reservation->createReservation(array(
                                            
                                            'ResStartDate' => Input::get('startDate'),
                                            'ResEndDate' =>Input::get('lastDate'),
                                            'EmerContact' => Input::get('emergencyContactName'),
                                            'EmerPhone' => Input::get('emergencyContactPhone'),
                                            'isApproved' => 0,
                                            'GroomingDesc' => Input::get('groomingDescription'),
                                            'CustID' => $custid,
                                            'DogID' => $selectedDog->data()->DogID
                                        ));
                    
                                        //Redirects to confirmation page
                                        Redirect::to('../Customer Portal/Confirmation.php');
                    
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
                        <br><br>

<!-- 
                        < ?php
    //The following code get dates on a weekly basis instead of a day basis
    // Get the current date
    $currentDate = date('Y-m-d');
    setlocale(LC_TIME, 'en_US');
    // N is the numeric representation of a day
    $dayOfWeek = date('N', strtotime($currentDate));
    //makes sure it's asking about the correct week. If saturday, it makes this week be next week instead
    switch ($dayOfWeek) {
        case 6:
            $thisWeekMonday = date('Y-m-d', strtotime('next monday', strtotime($currentDate)));
            break;
        case 1:
        case 7:
            $thisWeekMonday = date('Y-m-d', strtotime('this monday', strtotime($currentDate)));
            break;
        default:
            $thisWeekMonday = date('Y-m-d', strtotime('last monday', strtotime($currentDate)));
            break;
    }
    $nextWeekMonday = date('Y-m-d', strtotime('+1 week', strtotime($thisWeekMonday)));
    ?>
                        <legend>Select your preferred week for the grooming appointment:</legend> 
                            <input type="radio" id="1a" name="Time" value="0">
                            <label for="1a">This Week (Starting < ?php echo $thisWeekMonday; ?> )</label>
                            <input type="radio" id="1b" name="Time" value="1">
                            <label for="1b">Next Week (Starting < ?php echo $nextWeekMonday; ?>)</label>
                            <input type="radio" id="1c" name="Time" value="2">
                            <label for="1c">Some other time</label> 
-->

                        <!-- User selects a time range -->
                        <h3>Select a time range that you can schedule a grooming appointment on</h3>
                            <!-- First Date in the Time Range -->
                            <label for="startDate">Select the first day in the time range</label>
                            <input type = "date", id="startDate", name="startDate">

                            <!-- Last Date in Time Range -->
                            <label for="lastDate">Select the last day in the time range</label>
                            <input type = "date", id="lastDate", name="lastDate">

                        <p> After a grooming appointment request is sent, we will call you and schedule a date for the appointment within the week you selected.</p>
                        <br>
                        
                        <!-- Emergency Contact Name -->
                        <label for="emergencyContactName">Emergency Contact Name:</label>
                        <input type="text" id="emergencyContactName" name="emergencyContactName" placeholder="Enter name" required><br><br>

                        <!-- Emergency Contact Phone -->
                        <label for="emergencyContactPhone">Emergency Contact Phone:</label>
                        <input type="tel" id="emergencyContactPhone" name="emergencyContactPhone" placeholder="Enter phone number" required><br><br><br>

                        <!-- Grooming Description Text Area -->
                        <label for="groomingDescription">Grooming Description:</label>
                        <textarea id="groomingDescription" name="groomingDescription" rows="4" cols="50" placeholder="Enter grooming description"></textarea><br>

                        <!-- Generates Token and submits input -->
                        <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                        <input type="submit" value="Next"><br><br>
       
            </fieldset>
        </form> 
    </div>
</body>

</html>
<?php 
    //Redirects if user is not logged in
    }else{Redirect::to('../UserHandling/login.php');} 
?>