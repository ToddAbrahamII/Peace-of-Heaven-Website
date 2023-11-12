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
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/BoardingForm.css">
</head>
<body>
<div class='content'>
    <form method="POST" class="Boarding-Creator">
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

           

        </fieldset>
    </form>
</div>
</body>
</html>
<?php }else{Redirect::to('../UserHandling/login.php');} ?>