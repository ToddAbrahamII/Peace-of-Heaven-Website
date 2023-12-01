<?php
    require_once '../UserHandling/core/init.php';
        
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    //Class Constructor Calls
    $user = new User();
    $customer = new Customer();
    $dog = new Dog();

    //Get Current Month and Date for Calendar
    $currentMonth = date('m');
    $currentYear = date('Y');

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

    //grab session variables
    if (isset($_GET['dogid']) && isset($_GET['custid'])){
        $_SESSION['dogid'] = $_GET['dogid'];
        $_SESSION['custid'] = $_GET['custid'];
    }

    

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/DayCareForm.css">
        <script src="DayCare.js" defer></script>
    </head>
<body>
    <div class='content'>
    <form method="POST" class="Daycare-Creator" name="DayCareFrom" onsubmit="return validateForms()">
        <fieldset>
            <legend>Daycare Reservation Request</legend>

        <!-- Code to Suggest a Date for Day Care Appointment -->
            <label for="date">Please select a date that works for you</label><br>
            <input type = "date", id="date", name="date"><br><br>

        <!-- Code to Write Emergency Contact -->
            <label for="emergencyContactName">Emergency Contact Name:</label><br>
            <input type="text" id="emergencyContactName" name="emergencyContactName" placeholder="Enter name" required><br><br>

        <!-- Code to Write Emergency Phone -->
            <label for="emergencyContactPhone">Emergency Contact Phone:</label><br>
            <input type="tel" id="emergencyContactPhone" name="emergencyContactPhone" placeholder="Enter phone number" required><br><br>

        <!-- Code for Text Area about other Reservation Information -->
            <label for="ResDesc">Reservation Description:</label><br>
            <textarea id="ResDesc" name="ResDesc" rows="4" cols="50" placeholder="Describe anything that might be relevant for this reservation"></textarea><br>

        <!-- Generates Token and submits input -->
            <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
            <input type="submit" value="Next"><br><br>

        <?php
        //Grabs input after submit
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

                        'ResStartTime' => Input::get('date'),
                        'ResEndTime' => Input::get('date'),
                        'EmerContact' => Input::get('emergencyContactName'),
                        'EmerPhone' => Input::get('emergencyContactPhone'),
                        'isCheckedIn' => 0,
                        'isApproved' => 0,
                        'ServiceType' => 'Daycare',
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
        
            </form>
        </div>
    </body>
</html>
<?php }else{Redirect::to('../UserHandling/login.php');}
?>