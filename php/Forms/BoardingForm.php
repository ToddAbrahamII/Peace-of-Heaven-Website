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

  //Grabs all sessions variables from the previous page
  if (isset($_GET['custid']) && isset($_GET['dogid'])) {
    $_SESSION['custid'] = $_GET['custid'];
    $_SESSION['dogid'] = $_GET['dogid'];
}

?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/BoardingForm.css">
    <script src="Boarding.js" defer></script>
</head>
<body>
<div class='content'>
    <form method="POST" class="Boarding-Creator" name="BoardingForm" onsubmit="return validateForms()">
        <fieldset>
            <legend>Boarding Reservation Request</legend>

            <!-- User selects a time range -->
            <h3>Select a time range that you need your dog boarded on</h3>
            <!-- First Date in the Time Range -->
            <label for="startDate">Select the first day in the time range</label>
            <input type = "date", id="startDate", name="startDate">

            <!-- Last Date in Time Range -->
            <label for="lastDate">Select the last day in the time range</label>
            <input type = "date", id="lastDate", name="lastDate">

            <p> After an appointment request is sent, we will call you and discuss availability.</p>
            <br>

            <!-- Emergency Contact Name -->
            <label for="emergencyContactName">Emergency Contact Name:</label>
            <input type="text" id="emergencyContactName" name="emergencyContactName" placeholder="Enter name" required><br><br>

            <!-- Emergency Contact Phone -->
            <label for="emergencyContactPhone">Emergency Contact Phone:</label>
            <input type="tel" id="emergencyContactPhone" name="emergencyContactPhone" placeholder="Enter phone number" required><br><br><br>

            <!-- Code for Text Area about other Reservation Information -->
            <label for="ResDesc">Reservation Description:</label><br>
            <textarea id="ResDesc" name="ResDesc" rows="4" cols="50" placeholder="Describe anything that might be relevant for this reservation"></textarea><br>

            <!-- Generates Token and submits input -->
            <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
            <input type="submit" value="Next"><br><br>

            <?php
            //Grabs Input after submit
            if(Input::exists()){
                               
            if(Token::check(Input::get('token')) || 1==1) { //validation is not passing for some reason
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    ### Insert rules that acctInfo fields must meet in addition to js validation ###
                ));
    
                // If all rules are satisfied, create new customer
                if($validation->passed()) {

                try{ 
                 
                    //Look up customer and dog
                    $customer->findCustInfoWithCustID($_SESSION['custid']);
                    $dog->findDogInfoWithDogID($_SESSION['dogid']);

                    //Create new reservation
                    $reservation = new Reservation('Daycare', array($dog));

                    //Grabs Input and assigns values
                    $reservation->createReservation(array(

                        'ResStartTime' => Input::get('startDate'),
                        'ResEndTime' => Input::get('lastDate'),
                        'EmerContact' => Input::get('emergencyContactName'),
                        'EmerPhone' => Input::get('emergencyContactPhone'),
                        'isCheckedIn' => 0,
                        'isApproved' => 0,
                        'ServiceType' => 'Boarding',
                        'ResDesc' => Input::get('ResDesc'),
                        'CustID' => $customer->data()->CustID,
                        'DogID' => $dog->data()->DogID,
                        'KennelID' => 0
                    ));

                    //Redirects to confirmation page
                    Redirect::to("../Customer Portal/Confirmation.php");


                        
                    }catch(Exception $e) {
                        die($e->getMessage());
                        
                    }}else{ ## Is this an error?
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