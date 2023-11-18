<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    if($user->isLoggedIn()) {

    //Class Constructor Calls
    $customer = new Customer();
    $dog = new Dog();
    
        
    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group == 3) {
        include("../AdminPortal/AdminNavBar.php");

    }

    //Grabs all sessions variables from the previous page
    if (isset($_GET['custid']) && isset($_GET['dogid']) && isset($_GET['reservationid'])) {
        $_SESSION['custid'] = $_GET['custid'];
        $_SESSION['dogid'] = $_GET['dogid'];
        $_SESSION['reservationid'] = $_GET['reservationid'];
        $_SESSION['service'] = $_GET['service'];
    }

    //Gathers Customer and Dog Info
    $customer->findCustInfoWithCustID($_SESSION['custid']);
    $dog->findDogInfoWithDogID($_SESSION['dogid']);

    //Code to show Customer Name
    $custName = $customer->data()->CustFirstName . ' ' . $customer->data()->CustLastName;

    //Code to show Customer Phone
    $custPhone = $customer->data()->CustPhone;

    //Code to Show Customer Email
    $custEmail = $customer->data()->AcctEmail;

    //Code to Show Dog Name
    $dogName = $dog->data()->DogName;

    //Code to Show Dog Breed
    $dogBreed = $dog->data()->Breed;

    //Code to Dog DOB
    $dogDOB = $dog->data()->DogDOB;

    //Stores dog sex
    $dogSex = $dog->data()->Sex;

    //Stores Dog Weight
    $dogWeight = $dog->data()->Weight;

    //Stores dog other info
    $dogOtherInfo = $dog->data()->DogOtherInfo;



    // <!--PHP If Statement for Grooming Appointment Details-->
    if($_SESSION['service'] == 'Grooming')
    {
        //Class Constructor Call
        $groomingReservation = new GroomingReservation('Grooming',array());

        //Gather Reservation Info
        $groomingReservation->getReservationById($_SESSION['reservationid']);

        //Code to Show Appointment Time Range
        $timeRange = $groomingReservation->getReservationData()->ResStartDate . ' - ' . $groomingReservation->getReservationData()->ResEndDate; 

        //Store Emergency Contact
        $emerContact = $groomingReservation->getReservationData()->EmerContact;

        //Store Emergency Contact Phone
        $emerPhone = $groomingReservation->getReservationData()->EmerPhone;

        //Store Description
        $resDesc = $groomingReservation->getReservationData()->GroomingDesc;

        //Code to Select a Date for appointment


    }

    //<!--PHP If Statement for Boarding Appointment Details -->
    if($_SESSION['service'] == 'Boarding'){
        //new constructor
        $reservation = new Reservation('Boarding',  array());

        //Gather Reservation Info
        $reservation->getReservationById($_SESSION['reservationid']);

        //Code to Show Appointment Time Range
        $timeRange = $reservation->getReservationData()->ResStartTime . ' - ' . $reservation->getReservationData()->ResEndTime; 

        //Store Emergency Contact
        $emerContact = $reservation->getReservationData()->EmerContact;

        //Store Emergency Contact Phone
        $emerPhone = $reservation->getReservationData()->EmerPhone;

        //Store Description
        $resDesc = $reservation->getReservationData()->ResDesc;


        //Code to show dog vaccine, health, and behavior
    }

        
    //<!--PHP If Statement for Daycare Appointment Details -->
    if($_SESSION['service'] == 'Daycare'){
            //new constructor
            $reservation = new Reservation('Daycare',  array());

            //Gather Reservation Info
            $reservation->getReservationById($_SESSION['reservationid']);

            //Code to Show Appointment Time Range
            $timeRange = $reservation->getReservationData()->ResStartTime; 

            //Store Emergency Contact
            $emerContact = $reservation->getReservationData()->EmerContact;

            //Store Emergency Contact Phone
            $emerPhone = $reservation->getReservationData()->EmerPhone;

            //Store Description
            $resDesc = $reservation->getReservationData()->ResDesc;
    }

        //Checks if a button has been pressed
        if(Input::exists()){

             //Checks for Token
            if(Token::check(Input::get('token'))) {
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                ### Insert rules that acctInfo fields must meet in addition to js validation ###
        ));

        // If all rules are satisfied, create new customer
        if($validation->passed() || 1 == 1 ) {

           //if confirm is selected
           if(Input::get('Confirm')) {

            //if grooming was selected
            if($_SESSION['service'] == 'Grooming'){
                // First, you need to create an instance of the DB class.
                $db = DB::getInstance();

                // Define the table, row id, and fields you want to update.
                $table = 'grooming_reservation';
                $id = $groomingReservation->getReservationData()->GroomResID;
                $idcolumn = 'GroomResID';
                $fields = array(
                    'isApproved' => 1,
                    'ResStartDate' => Input::get('ResStartTime'),
                    'ResEndDate' => Input::get('ResStartTime'),
                );
 
                //Updates isApproved now that reservation has been approved
                 $db->updateWithID($table, $id, $idcolumn, $fields);
            }
            //if grooming was not selected
            if($_SESSION['service'] != 'Grooming'){
                    // First, you need to create an instance of the DB class.
                    $db = DB::getInstance();

                    // Define the table, row id, and fields you want to update.
                    $table = 'reservation';
                    $id = $reservation->getReservationData()->Res_ID;
                    $idcolumn = 'Res_ID';

                    //Updates fields for Daycare
                    if($_SESSION['service'] == 'Daycare'){
                    $fields = array(
                        'isApproved' => 1,
                        'ResStartTime' => Input::get('ResStartTime'),
                        'ResEndTime' => Input::get('ResStartTime'),
                    );
                }

                    //Updates Fields for Boarding
                    if($_SESSION['service'] == 'Boarding'){
                        $fields = array(
                            'isApproved' => 1,
                            'ResStartTime' => Input::get('ResStartTime'),
                            'ResEndTime' => Input::get('ResEndTime'),
                        );
                    }



                     //Updates isApproved now that reservation has been approved
                    $db->updateWithID($table, $id, $idcolumn, $fields);
            }

            //email for confirmation
                
           }   

           //if deny is selected
           if(Input::get('Deny')) {

            //if grooming was selected
            if($_SESSION['service'] == 'Grooming'){
                // First, you need to create an instance of the DB class.
                $db2 = DB::getInstance();

                // Define the table, row id, and fields you want to update.
                $table = 'grooming_reservation';
                $where = ['GroomResID', '=', $groomingReservation->getReservationData()->GroomResID];
                
                //Deletes from Database
                 $db2->delete($table,$where);
            }

            //if grooming was not selected
            if($_SESSION['service'] != 'Grooming'){
                 // First, you need to create an instance of the DB class.
                 $db = DB::getInstance();

                 // Define the table, row id, and fields you want to delete.
                 $table = 'reservation';
                 $where = ['Res_ID', '=', $reservation->getReservationData()->Res_ID];
                
                 //Deletes from Database
                 $db->delete($table,$where);  
            }

            //Email for denial

           }   

            //Redirect
            Redirect::to('../AdminPortal/AdminHome.php');

        }
    }
        }
            
        

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/AppointmentApproval.css">

    <title>Appointment Details</title>
</head>
<body>
    <div class=content>
        <h1> Appointment Details </h1>
    <form method="post" >

        <!-- Prints Information for Admin -->
        <h2>Reservation Info</h2>
        <p>Service: <?php print($_SESSION['service']) ?></p>
        <p>Time Range: <?php print($timeRange) ?></p>
        <p>Emergency Contact: <?php print($emerContact) ?></p>
        <p>Emergency Phone: <?php print($emerPhone) ?></p>
        <p>Reservation Description: <?php print($resDesc) ?></p>

        <br>

        <h2>Customer Info</h2>
        <p>Customer Name: <?php print($custName)?></p>
        <p>Customer Phone: <?php print($custPhone)?></p>
        <p>Customer Email: <?php print($custEmail)?></p>

        <br>

        <h2>Dog Info</h2>
        <p>Dog Name: <?php print($dogName)?></p>
        <p>Breed: <?php print($dogBreed)?></p>
        <p>Date of Birth: <?php print($dogDOB)?></p>
        <p>Dog Sex: <?php print($dogSex)?></p>
        <p>Weight: <?php print($dogWeight)?></p>
        <p>Dog Other Info: <?php print($dogOtherInfo)?></p>

        <!-- PHP If Statement for Update Dates -->
        <?php
            if($_SESSION['service'] == 'Grooming'){
                //echo for confirming dates
                echo '<label for="ResStartTime">Confirm the Date for this Grooming Appointment:</label>';
                echo'<input type="date" id="ResStartTime" name="ResStartTime" required><br>';
        
            }
            
            if($_SESSION['service'] != 'Grooming')
            {
                //Dog Behavior Html
                $dog -> findBehaviorRecord($_SESSION['dogid']);
                $behavior = $dog ->data();
                echo '<h2>Dog Behavior Information</h2>';
                //switch case for Experience values
                $exp = $behavior -> Experience;
                switch ($exp) {
                    case 0:
                        echo '<p>Daycare/Boarding Experience: Never attempted either</p>';
                        break;
                    case 1:
                        echo '<p>Daycare/Boarding Experience: Boarding and/or daycare client in past but no more than twice a year</p>';
                        break;
                    case 2:
                        echo '<p>Daycare/Boarding Experience: Has been at least once but stresses easily or does not adjust well to unfamiliar environments</p>';
                        break;
                    case 3:
                        echo '<p>Daycare/Boarding Experience: Boarded regularly & adjusts easily</p>';
                        break;
                    case 4:
                        echo '<p>Daycare/Boarding Experience: Attends daycare often & socializes well</p>';
                        break; 
                    default:
                        echo '<p>Daycare/Boarding Experience: Error grabbing information</p>';
                        break;
                }
                if($behavior -> IsSocial == 1){
                        echo '<p>Can the dog engage in social play?: Yes';
                }
                else{
                        echo '<p>Can the dog engage in social play?: No';
                }
                if($behavior -> IsAggressive == 1){
                    echo '<p>Is the dog aggressive?: Yes';
                }
                else{
                    echo '<p>Is the dog aggressive: No';
                }
                if(!empty($behavior ->AggressiveDesc))
                {
                    echo '<p>Description of Event: '  .  $behavior-> AggressiveDesc . '</p>';
                }
                if($behavior -> IsJumper == 1){
                    echo '<p>Is the dog a Jumper?: Yes';
                }
                else{
                    echo '<p>Is the dog a Jumper?: No';
                }
                if($behavior -> IsClimber == 1){
                    echo '<p>Is the dog a Climber?: Yes';
                }
                else{
                    echo '<p>Is the dog a Climber?: No';
                }
                if($behavior -> IsChewer == 1){
                    echo '<p>Is the dog a Chewer?: Yes';
                }
                else{
                    echo '<p>Is the dog a Chewer?: No';
                }
                if($behavior -> IsEscapeArtist == 1){
                    echo '<p>Is the dog an Escape Artist?: Yes';
                }
                else{
                    echo '<p>Is the dog an Escape Artist?: No';
                }
                if(!empty($behavior ->EscapeDesc))
                {
                    echo '<p>Description of Event: '  .  $behavior-> EscapeDesc . '</p>';
                }
                if($behavior -> CanWater == 1){
                    echo '<p>Can the dog do water activities?: Yes';
                }
                else{
                    echo '<p>Can the dog do water activities?: No';
                }
                if($behavior -> CanTreat == 1){
                    echo '<p>Can the dog have treats?: Yes';
                }
                else{
                    echo '<p>Can the dog have treats?: No';
                }
                if($behavior -> IsLeashTrained == 1){
                    echo '<p>Is the dog Leash Trained?: Yes';
                }
                else{
                    echo '<p>Is the dog Leash Trained?: No';
                }
                if($behavior -> IsRestriction == 1){
                    echo '<p>Any activity restrictions?: Yes';
                }
                else{
                    echo '<p>Any activity restrictions?: No';
                }
                if(!empty($behavior ->RestrictionDesc))
                {
                    echo '<p>Restriction Description: '  .  $behavior-> RestrictionDesc . '</p>';
                }
                echo '<p>Favorite toys: '  .  $behavior-> Toys . '</p>';
                echo '<p>Other behavoir information: '  .  $behavior-> OtherBehaviorInfo . '</p>';
                echo '<p>Things to reinforce: '  .  $behavior-> Reinforce . '</p>';
                echo '<p>Known commands: '  .  $behavior-> Commands . '</p>';
                echo '<p>Feeding schedule: '  .  $behavior-> FoodPref . '</p>';
                echo '<p>Bathroom routine: '  .  $behavior-> BathroomRoutine . '</p>';

                //Dog Health Html
                $dog -> findHealthRecord($_SESSION['dogid']);
                $health = $dog ->data();
                echo '<h2>Dog Health Information</h2>';
                echo '<p>Clinic Name: ' . $health-> ClinicName . '</p>';
                echo '<p>Vet phone number: ' . $health-> VetPhone . '</p>';
                echo '<p>Address: ' . $health-> VetAddress . '</p>';
                echo '<p>City: ' . $health-> VetCity . '</p>';
                echo '<p>State: ' . $health-> VetState . '</p>';
                echo '<p>Zip: ' . $health-> VetZip . '</p>';
                echo '<p>Prefered vet name: ' . $health-> VetName . '</p>';
                echo '<p>All known allergies, medical conditions, and mobility/vision/hearing impairments.: ' . $health-> MedicalCond . '</p>';
                echo '<p>All medication & dose frequency: ' . $health-> Medication . '</p>';

                //Dog Vaccine Html
                $dog -> findVaccineRecord($_SESSION['dogid']);
                $Vaccine = $dog ->data();
                echo '<h2>Dog Vaccine Information</h2>';
                echo '<p>DHPP: ' . $Vaccine-> DHPP_Date . '</p>';
                echo '<p>Rabies: ' . $Vaccine-> RabiesDate . '</p>';
                echo '<p>Bordella: ' . $Vaccine-> BordellaDate . '</p>';
                echo '<p>Flea Tick Product: ' . $Vaccine-> FleaTickProduct . '</p>';
                echo '<p>Flea Tick Date: ' . $Vaccine-> FleaTickDate . '</p>';
                echo '<p>Other Vaccine Information: ' . $Vaccine-> OtherVacInfo . '</p>';

                echo '<br>';


            if($_SESSION['service'] == 'Boarding'){
                //Echo format for Confirming dates
                echo '<p>Confirm the Dates for this Boarding Appointment</p>';
                echo '<label for="ResStartTime">Start Date:</label>';
                echo'<input type="date" id="ResStartTime" name="ResStartTime" required>';
                echo '<label for="ResEndTime">End Date:</label>';
                echo'<input type="date" id="ResEndTime" name="ResEndTime" required><br>';
            }

            if($_SESSION['service'] == 'Daycare'){
                //Echo for confirming dates
                echo '<label for="ResStartTime">Confirm the Date for this Daycare Appointment:</label>';
                echo'<input type="date" id="ResStartTime" name="ResStartTime" required><br>';
            }
        }
        ?>

        

        <!-- Generates token and submits -->
        <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
        <input type="submit" name="Confirm" value="Confirm">
        <input type="submit" name="Deny"value="Deny">
    </form>
    </div>
</body>
</html>
<?php
   
        }else(Redirect::to('../UserHandling/login.php'));
?>