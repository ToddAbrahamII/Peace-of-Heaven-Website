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
                    'isApproved' => 1
                );
 
                //Updates isApproved now that reservation has been approved
                 $db->updateWithID($table, $id, $idcolumn, $fields);
            }
            //if grooming was not selected
            if($_SESSION['service'] != 'Grooming'){
                
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
                $where = ['GroomResID', $groomingReservation->getReservationData()->GroomResID];
                
                //Deletes from Database
                 $db2->delete($table,$where);
            }

            //if grooming was not selected
            if($_SESSION['service'] != 'Grooming'){
                
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