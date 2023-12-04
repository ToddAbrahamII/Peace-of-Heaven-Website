<?php
    require_once '../UserHandling/core/init.php';
    
    if (!Session::exists('home')) {
        echo '<p>'. Session::flash('home') .'</p>';
    }

    $user = new User();
    $customer = new Customer();
    $dog = new Dog();

    if($user->isLoggedIn()) {

    //Adds Customer NavBar if Customer Acct logged in
    if($user->data()->group == 1){
        include("../Customer Portal/CustNavBar.php");
    }

    //Adds Employee NavBar if Employee Acct logged in
    if($user->data()->group == 2 ){
        include("../Employee Portal/EmpNavBar.php");

    }

    //Adds Admin NavBar if Admin Acct logged in
    if($user->data()->group == 3 ){
        include("../AdminPortal/AdminNavBar.php");

    }
    
    //Matches UserID to CustID with account logged in
    $customer->findCustInfo($user->data()->id);

    //Stores the CustID
    $custid = $customer->data()->CustID;

    //session variable
    $resid = $_GET['Res_ID'];
    $service = $_GET['ServiceType'];

    //gathers data from table depending on service
    if($service == 'Daycare' || $service == 'Boarding'){
        
        $reservation = new Reservation('service', array());

        $reservation->getReservationById($resid);

        $reservationData = $reservation->getReservationData();
    }

    //gathers data from table depending on service
    if($service == 'Grooming'){
        $reservation = new GroomingReservation('service', array());

        $reservation->getReservationById($resid);

        $reservationData = $reservation->getReservationData();
    
    }

    

    if(Input::exists()) {
        if(Token::check(Input::get('token'))){

            //If service is daycare
            if($service == 'Daycare'){

                $fieldsToUpdate = array(
                    'ResStartTime' => Input::get('date'),
                    'ResEndTime' => Input::get('date'),
                    'EmerContact' => Input::get('emergencyContactName'),
                    'EmerPhone' => Input::get('emergencyContactPhone'),
                    'ServiceType' => 'Daycare',
                    'ResDesc' => Input::get('ResDesc'),
                    
                );
                $key = 'Res_ID';

                  // UPDATE CUSTOMER TABLE
                    if ($reservation->update($fieldsToUpdate, $key, $resid)) {
                        echo "Update successful!";
                        header("Refresh:0"); // Reload the page after 0 seconds (immediately)
                    } else {
                        echo "Update failed.";
            } }


            //if service is boarding
            if($service == 'Boarding'){

                $fieldsToUpdate = array(
                    'ResStartTime' => Input::get('startDate'),
                    'ResEndTime' => Input::get('lastDate'),
                    'EmerContact' => Input::get('emergencyContactName'),
                    'EmerPhone' => Input::get('emergencyContactPhone'),
                    'ResDesc' => Input::get('ResDesc'),
                );
                $key = 'Res_ID';

                  // UPDATE CUSTOMER TABLE
                    if ($reservation->update($fieldsToUpdate, $key, $resid)) {
                        echo "Update successful!";
                        header("Refresh:0"); // Reload the page after 0 seconds (immediately)
                    } else {
                        echo "Update failed.";


            }


            }

            //if service is grooming
            if($service== 'Grooming'){

                $fieldsToUpdate = array(
                    'ResStartDate' => Input::get('startDate'),
                    'ResEndDate' =>Input::get('lastDate'),
                    'EmerContact' => Input::get('emergencyContactName'),
                    'EmerPhone' => Input::get('emergencyContactPhone'),
                    'GroomingDesc' => Input::get('groomingDescription'),
                );
                $key = 'GroomResID';

                  // UPDATE CUSTOMER TABLE
                    if ($reservation->update($fieldsToUpdate, $key, $resid)) {
                        echo "Update successful!";
                        header("Refresh:0"); // Reload the page after 0 seconds (immediately)
                    } else {
                        echo "Update failed.";


            }

            }

            Redirect::to('../Customer Portal/MyReservations.php');
        
    } }


?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/UpdateDogAccount.css">
    
    <title>Customer Dogs</title>
</head>
<body>
    <div class = 'content'>
    <form method="POST" class="Dog-Selector">
        <fieldset>
           
            <?php 
            
            if($service == 'Daycare'){
                // <!-- //HTML For Daycare Updates -->
                // <!-- Code to Suggest a Date for Day Care Appointment -->
                echo '<label for="date">Please select a date that works for you</label><br>';
                echo '<input type = "date", id="date", name="date" value="'.$reservationData->ResStartTime.'"><br><br>';
    
            // <!-- Code to Write Emergency Contact -->
                echo '<label for="emergencyContactName">Emergency Contact Name:</label><br>';
                echo '<input type="text" id="emergencyContactName" name="emergencyContactName" placeholder="Enter name" required value="'. $reservationData->EmerContact.'"><br><br>';
    
            // <!-- Code to Write Emergency Phone -->
                echo '<label for="emergencyContactPhone">Emergency Contact Phone:</label><br>';
                echo '<input type="tel" id="emergencyContactPhone" name="emergencyContactPhone" placeholder="Enter phone number" required value="'.$reservationData->EmerPhone.'"><br><br>';
    
            // <!-- Code for Text Area about other Reservation Information -->
                echo '<label for="ResDesc">Reservation Description:</label><br>';
                echo '<textarea id="ResDesc" name="ResDesc" rows="4" cols="50" placeholder="Describe anything that might be relevant for this reservation">'.$reservationData->ResDesc.'</textarea><br>';
               }

            else if($service == 'Boarding'){ 
                 //HTML for Boarding Updates -->
                echo '<h3>Select a time range that you need your dog boarded on</h3>';
                // <!-- First Date in the Time Range -->
                echo '<label for="startDate">Select the first day in the time range</label>';
                echo '<input type = "date", id="startDate", name="startDate"  value="'. $reservationData->ResStartTime.'">';

                // <!-- Last Date in Time Range -->
                echo '<label for="lastDate">Select the last day in the time range</label>';
                echo '<input type = "date", id="lastDate", name="lastDate" value="'.$reservationData->ResStartTime.'">';

                // <!-- Emergency Contact Name -->
                echo '<label for="emergencyContactName">Emergency Contact Name:</label>';
                echo '<input type="text" id="emergencyContactName" name="emergencyContactName" placeholder="Enter name" required  value="'.$reservationData->EmerPhone.'"><br><br>';

                // <!-- Emergency Contact Phone -->
                echo '<label for="emergencyContactPhone">Emergency Contact Phone:</label>';
                echo '<input type="tel" id="emergencyContactPhone" name="emergencyContactPhone" placeholder="Enter phone number" required  value="'. $reservationData->EmerContact.'"><br><br><br>';

                // <!-- Code for Text Area about other Reservation Information -->
                echo '<label for="ResDesc">Reservation Description:</label><br>';
                echo '<textarea id="ResDesc" name="ResDesc" rows="4" cols="50" placeholder="Describe anything that might be relevant for this reservation"><'.$reservationData->ResDesc.'</textarea><br>';
               }

            if($service == 'Grooming'){
                //HTML for Grooming Updates
                echo '<h3>Select a time range that you can schedule a grooming appointment on</h3>';
                // <!-- First Date in the Time Range -->
                echo '<label for="startDate">Select the first day in the time range</label>';
                echo '<input type = "date", id="startDate", name="startDate"value ="'.$reservationData->ResStartDate.'">';

                // <!-- Last Date in Time Range -->
                echo '<label for="lastDate">Select the last day in the time range</label>';
                echo '<input type = "date", id="lastDate", name="lastDate" value="'.$reservationData->ResEndDate.'">';
                
                // <!-- Emergency Contact Name -->
                echo '<label for="emergencyContactName">Emergency Contact Name:</label>';
                echo '<input type="text" id="emergencyContactName" name="emergencyContactName" placeholder="Enter name" required value="'.$reservationData->EmerContact.'"><br><br>';

                // <!-- Emergency Contact Phone -->
                echo '<label for="emergencyContactPhone">Emergency Contact Phone:</label>';
                echo '<input type="tel" id="emergencyContactPhone" name="emergencyContactPhone" placeholder="Enter phone number" required value = "'.$reservationData->EmerPhone.'"><br><br><br>';

                // <!-- Grooming Description Text Area -->
                echo '<label for="groomingDescription">Grooming Description:</label>';
                echo '<textarea id="groomingDescription" name="groomingDescription" rows="4" cols="50" placeholder="Enter grooming description">'.$reservationData->GroomingDesc.'</textarea><br>';
                }

            ?>

                <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
                <input type="submit" value="Update"><br><br>
                    </fieldset>
            </form>
    </div>


</body>
</html>
<?php }else 
        { Redirect::to('../UserHandling/login.php');} //Redirect User to Login if not logged in
?>