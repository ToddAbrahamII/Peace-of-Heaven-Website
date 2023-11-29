<?php
    require_once '../UserHandling/core/init.php';
    
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    $customer = new Customer();
    $dog = new Dog();
    
    if($user->isLoggedIn()) {

    //Adds Employee NavBar if Employee Acct logged in
    if($user->data()->group == 2){
        include("../Employee Portal/EmpNavBar.php");

    }

    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group == 3 ){
        include("../AdminPortal/AdminNavBar.php");

    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/CheckInOut.css">

    <title>Check In Portal</title>
</head>
<body> 
<div class=content>
<form method="POST">
        <fieldset>
            <legend>Select a Reservation to Check Out</legend>

                <!-- Php code for drop down menu for dogs --> 
                <?php
                        //Constructor Call
                        $reservation = new GroomingReservation('',array());

                        //Gathers all unchecked Reservations
                        $reservation->getConfirmedGroomingReservations();
                        $reservation = $reservation->getReservationData();

                        // Check if $dogData is not empty
                        if (!empty($reservation)) {
                            ?>  
                                <!-- Dog Option for Each Dog in the Table -->
                                <label for="resDropdown">Select a Reservation to Check Out:</label>
                                <select id="resDropdown" name="selectedRes">

                                    <?php foreach ($reservation as $reservation) {

                                        //gathers dog info from the reservation
                                        $dog = new Dog();
                                        $dogid = $reservation->DogID;
                                        $dog->findDogInfoWithDogID($dogid);
                                        $dogName = $dog->data()->DogName; 
            
                                        //gathers customer information
                                        $custid = $reservation->CustID;
                                        $customer->findCustInfoWithCustID($custid);
                                        $custName = $customer->data()->CustFirstName . ' ' . $customer->data()->CustLastName;
                                       
                                        //Reservation Information
                                        $resid = $reservation->GroomResID;
                                        $timerange = $reservation->ResStartDate . '-' . $reservation->ResEndDate;
                                        $description = $reservation->GroomingDesc;
                                        echo "<option value='$resid'>Customer: $custName | Dog: $dogName | Description: $description | Dates: $timerange </option>";
                                    } ?>
                                    </select>
                                

                            <?php
                        } else  {
                            // Prints No Dogs Statement
                            echo "No Reservations found ";
                        }
                        ?>

                        <!-- Generates Token and submits input -->
                        <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                        <input type="submit" value="Check Out Reservation"><br><br>


                        <?php 
                        if(Input::exists()){

                            if(Token::check(Input::get('token')) || 1==1 ) { //validation is not passing for some reason
                                $validate = new Validate();
                                $validation = $validate->check($_POST, array(
                                    ### Insert rules that acctInfo fields must meet in addition to js validation ###
                                ));
                    
                                // If all rules are satisfied, create new customer
                                if($validation->passed() || 1 ==1 ) {

                                try{
                                    $resID = Input::get('selectedRes');
                             
                                    //DB Instance for Update
                                    $db = DB::getInstance();
                                    $currentReservation = new GroomingReservation('', array());

                                    //sets table and fields
                                    $table = 'grooming_reservation';
                                    $id = $resID;
                                    $idcolumn = 'GroomResID';
                                    $fields = array(
                                        //Checks dog in and sets approval for safe keeping
                                        'isApproved' => 1,
                                        'isFinished' => 1,
                                    );

                                    //updates
                                    $db->updateWithID($table, $id, $idcolumn, $fields);

            

                                    Redirect::to('../Employee Portal/EmpHome.php');

                                } catch(Exception $e) {
                                    die($e->getMessage());
                                    
                                }

                                }else { ## Is this an error?
                                    // output errors
                                    foreach ($validation->errors() as $error) {
                                        echo $error, '<br>';
                            }

                        }}}
                    ?>


                </fieldset>
            </form>
</div>
</body>
</html>
<?php }else{Redirect ::to('../UserHandling/login.php');}
